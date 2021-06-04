<?php

require_once('helpers.php');

$page_title = "readme: популярное";

$is_auth = rand(0, 1);

$user_name = 'Александр Батолло';

$active_post = 0;
$active_post = filter_input(INPUT_GET, 'post_id');

require_once 'init.php';

if (!$link) {
  $error = mysqli_connect_error();
  $content = include_template('error.php', ['error' => $error]);
} else {
  $sql = "SELECT * FROM posts JOIN users ON post_author_id = user_id JOIN content_types ON post_type_id = content_type_id WHERE post_id = $active_post";
  $result = mysqli_query($link, $sql);

  if ($result) {
    $active_post_col = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (!$active_post_col) {
      http_response_code(404);
      header("Location: 404.html");
    }
    $active_content_type_class = $active_post_col[0]['content_type_class'];
    $active_post_title = $active_post_col[0]['post_title'];
    $active_post_content = $active_post_col[0]['post_content'];
    $active_post_source_link = $active_post_col[0]['post_source_link'];
    $active_post_user_login = $active_post_col[0]['user_login'];
    $active_post_user_avatar = $active_post_col[0]['user_avatar'];
  } else {
    $error = mysqli_error($link);
    $page_content = include_template('error.php', ['error' => $error]);
  }
}

$post_content = include_template("post-$active_content_type_class.php", ['content' => $active_post_content, 'post_source_link' => $active_post_source_link]);

$page_content = include_template('single-post.php', ['content' => $post_content, 'post' => $active_post, 'title' => $active_post_title, 'active_post_user_login' => $active_post_user_login, 'active_post_user_avatar' => $active_post_user_avatar]);

$layout_content = include_template('layout.php', ['content' => $page_content, 'modifier' => 'page__main--publication', 'title' => $page_title, 'user_name' => $user_name, 'is_auth' => $is_auth]);

print($layout_content);
