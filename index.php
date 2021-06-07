<?php
use JetBrains\PhpStorm\Pure;

require_once('helpers.php');

define("MAX_POST_STRING_LENGTH", 300);
define("DAYS_IN_WEEK", 7);
define("MAX_WEEKS_DAYS", 5 * DAYS_IN_WEEK);

$page_title = "readme: популярное";

$is_auth = rand(0, 1);

$user_name = 'Александр Батолло';

function get_human_time_diff(string $event_date): string
{
    $comparative_date = DateTime::createFromFormat('Y-m-d H:i:s', $event_date);
    $current_date = new DateTime('now', new DateTimeZone('Europe/Moscow'));
    $diff = $comparative_date->diff($current_date);

    if ($diff->y !== 0) {
        $human_time_diff = $diff->y . ' ' . get_noun_plural_form($diff->y, 'год', 'года', 'лет');
    } elseif ($diff->m !== 0) {
        $human_time_diff = $diff->m . ' ' . get_noun_plural_form($diff->m, 'месяц', 'месяца', 'месяцев');
    } elseif ($diff->d >= DAYS_IN_WEEK && $diff->d < MAX_WEEKS_DAYS) {
        $human_time_diff = $diff->d / 7 . ' ' . get_noun_plural_form($diff->d / 7, 'неделя', 'недели', 'недель');
    } elseif ($diff->d > 0 && $diff->d < DAYS_IN_WEEK) {
        $human_time_diff = $diff->d . ' ' . get_noun_plural_form($diff->d, 'день', 'дня', 'дней');
    } elseif ($diff->h !== 0) {
        $human_time_diff = $diff->h . ' ' . get_noun_plural_form($diff->h, 'час', 'часа', 'часов');
    } elseif ($diff->i !== 0) {
        $human_time_diff = $diff->i . ' ' . get_noun_plural_form($diff->i, 'минута', 'минуты', 'минут');
    } elseif ($diff->s !== 0) {
        $human_time_diff = $diff->s . ' ' . get_noun_plural_form($diff->s, 'секунда', 'секунды', 'секунд');
    } else {
        $human_time_diff = 'Неизвестный интервал';
    }

    return $human_time_diff;
}

function get_formatted_date(string $raw_date): string
{
    return DateTime::createFromFormat('Y-m-d H:i:s', $raw_date)->format('Y-m-d H:i');
}

function check_content_length(string $post_content): string
{
    $is_excerpted = false;

    if (strlen($post_content) > MAX_POST_STRING_LENGTH) {
        $post_content = get_content_excerpt($post_content);
        $is_excerpted = true;
    }

    $post_content = '<p>' . esc($post_content) . '</p>';

    if ($is_excerpted) {
        $post_content .= '<a class="post-text__more-link" href="#">Читать далее</a>';
    }

    return $post_content;
}

function get_content_excerpt(string $post_content): string
{
    $exploded_post_string = explode(" ", $post_content);
    $string_length_counter = MAX_POST_STRING_LENGTH;
    for ($i = 0, $j = count($exploded_post_string); $i < $j; $i++) {
        $string_length_counter -= strlen($exploded_post_string[$i]);
        if ($string_length_counter <= 0) {
            break;
        }
    }
    $post_content = rtrim(implode(" ", array_slice($exploded_post_string, 0, $i))) . '&hellip;';

    return $post_content;
}

#[Pure] function esc($str): string
{
    return htmlspecialchars($str);
}

$content_type_id_selected = 0;
$content_type_id_selected = filter_input(INPUT_GET, 'content-type');

require_once 'init.php';

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
} else {
    $sql = 'SELECT * FROM content_types';
    $result = mysqli_query($link, $sql);

    if ($result) {
        $content_types_col = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if ($content_type_id_selected) {
            $sql = "SELECT * FROM posts JOIN users ON post_author_id = user_id JOIN content_types ON post_type_id = content_type_id WHERE post_type_id = $content_type_id_selected ORDER BY post_views_count DESC";
        } else {
            $sql = "SELECT * FROM posts JOIN users ON post_author_id = user_id JOIN content_types ON post_type_id = content_type_id ORDER BY post_views_count DESC";
        }

        $result = mysqli_query($link, $sql);

        if ($result) {
            $posts_col = mysqli_fetch_all($result, MYSQLI_ASSOC);
            // HTML-код главной страницы
            $page_content = include_template('main.php', ['posts' => $posts_col, 'content_types' => $content_types_col, 'content_type_id_selected' => $content_type_id_selected]);
        } else {
            $error = mysqli_error($link);
            $page_content = include_template('error.php', ['error' => $error]);
        }
    } else {
        $error = mysqli_error($link);
        $page_content = include_template('error.php', ['error' => $error]);
    }
}

// окончательный HTML-код
$layout_content = include_template('layout.php', ['content' => $page_content, 'modifier' => 'page__main--popular', 'title' => $page_title, 'user_name' => $user_name, 'is_auth' => $is_auth]);

print($layout_content);
