<?php
require_once 'init.php';
require_once 'helpers.php';

$page_title = "readme: добавление публикации";

$is_auth = rand(0, 1);

$user_name = 'Александр Батолло';

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

$page_content = include_template(
    'new-post.php',
    [
        'content_types' => $content_types_col
    ]
);

$layout_content = include_template(
    'layout.php',
    [
        'content' => $page_content,
        'modifier' => 'page__main--adding-post',
        'title' => $page_title,
        'user_name' => $user_name,
        'is_auth' => $is_auth
    ]
);

print($layout_content);
