<?php

use JetBrains\PhpStorm\Pure;

require_once 'helpers.php';
require_once 'init.php';

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

    if (mb_strlen($post_content) > MAX_POST_STRING_LENGTH) {
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
        $string_length_counter -= mb_strlen($exploded_post_string[$i]);
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

const MAX_POST_STRING_LENGTH = 300;
const DAYS_IN_WEEK = 7;
const MAX_WEEKS_DAYS = DAYS_IN_WEEK * 5;

$page_title = "readme: популярное";
$is_auth = rand(0, 1);
$user_name = 'Александр Батолло';

$content_type_id_selected = filter_input(INPUT_GET, 'content-type') ?? 0;
$sorting_criteria_selected = filter_input(INPUT_GET, 'sorting_criteria') ?? 'post_views_count';
$sorting_direction_selected = filter_input(INPUT_GET, 'sorting_direction') ?? 'DESC';

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template(
        'error.php',
        [
            'error' => $error
        ]
    );
} else {
    $sql = "SELECT * FROM content_types";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $content_types_col = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if ($content_type_id_selected) {
            $sql = "SELECT p.id, post_datetime, post_title, post_content, post_cite_author, " .
                "post_featured_image, post_featured_video, post_views_count, user_login, " .
                "user_avatar, content_type_class FROM posts p " .
                "INNER JOIN users u ON post_author_id = u.id " .
                "INNER JOIN content_types ct ON post_type_id = ct.id " .
                "WHERE post_type_id = $content_type_id_selected " .
                "ORDER BY post_views_count $sorting_direction_selected";
        } else {
            $sql = "SELECT p.id, post_datetime, post_title, post_content, post_cite_author, " .
                "post_featured_image, post_featured_video, post_views_count, user_login, " .
                "user_avatar, content_type_class FROM posts p " .
                "INNER JOIN users u ON post_author_id = u.id " .
                "INNER JOIN content_types ct ON post_type_id = ct.id " .
                "ORDER BY $sorting_criteria_selected $sorting_direction_selected";
        }

        $result = mysqli_query($link, $sql);

        if ($result) {
            $posts_col = mysqli_fetch_all($result, MYSQLI_ASSOC);
            // HTML главной страницы
            $page_content = include_template(
                'main.php',
                [
                    'posts' => $posts_col,
                    'content_types' => $content_types_col,
                    'content_type_id_selected' => $content_type_id_selected
                ]
            );
        } else {
            $error = mysqli_error($link);
            $page_content = include_template(
                'error.php',
                [
                    'error' => $error
                ]
            );
        }
    } else {
        $error = mysqli_error($link);
        $page_content = include_template(
            'error.php',
            [
                'error' => $error
            ]
        );
    }
}

// Окончательный HTML
$layout_content = include_template(
    'layout.php',
    [
        'content' => $page_content,
        'modifier' => 'page__main--popular',
        'title' => $page_title,
        'user_name' => $user_name,
        'is_auth' => $is_auth
    ]
);

print($layout_content);
