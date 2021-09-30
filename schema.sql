CREATE DATABASE IF NOT EXISTS readme
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_0900_ai_ci;

USE readme;

CREATE TABLE IF NOT EXISTS users (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  user_email VARCHAR(255) NOT NULL UNIQUE,
  user_login TINYTEXT,
  user_password TINYTEXT,
  user_avatar TINYTEXT
);

CREATE TABLE IF NOT EXISTS posts (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  post_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
  post_title TINYTEXT,
  post_content LONGTEXT,
  post_cite_author TINYTEXT,
  post_featured_image TINYTEXT,
  post_featured_video TINYTEXT,
  post_source_link TINYTEXT,
  post_views_count BIGINT DEFAULT 0,
  post_author_id BIGINT NOT NULL,
  post_type_id BIGINT,
  post_tags_list TINYTEXT
);

CREATE TABLE IF NOT EXISTS comments (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  comment_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
  comment_content LONGTEXT,
  comment_author_id BIGINT NOT NULL,
  comment_post_id BIGINT NOT NULL
);

CREATE TABLE IF NOT EXISTS likes (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  like_post_id BIGINT NOT NULL,
  like_user_id BIGINT NOT NULL
);

CREATE TABLE IF NOT EXISTS subscriptions (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  subscription_from_user_id BIGINT NOT NULL,
  subscription_to_user_id BIGINT NOT NULL
);

CREATE TABLE IF NOT EXISTS messages (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  message_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
  message_content MEDIUMTEXT,
  message_from_user_id BIGINT NOT NULL,
  message_to_user_id BIGINT NOT NULL
);

CREATE TABLE IF NOT EXISTS hashtags (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  hashtag_content TINYTEXT
);

CREATE TABLE IF NOT EXISTS content_types (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  content_type_name TINYTEXT,
  content_type_class TINYTEXT
);
