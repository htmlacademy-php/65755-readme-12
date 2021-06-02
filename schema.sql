CREATE TABLE users (
  user_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  user_email TINYTEXT NOT NULL UNIQUE,
  user_login TINYTEXT,
  user_password TINYTEXT,
  user_avatar TINYTEXT
);

CREATE TABLE posts (
  post_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  post_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
  post_title TINYTEXT,
  post_content LONGTEXT,
  post_cite_author TINYTEXT,
  post_featured_image TINYTEXT,
  post_featured_video TINYTEXT,
  post_source_link TINYTEXT,
  post_views_count BIGINT DEFAULT 0,
  post_author BIGINT NOT NULL,
  post_type BIGINT,
  post_tags_list TINYTEXT
);

CREATE TABLE comments (
  comment_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  comment_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
  comment_content LONGTEXT,
  comment_author BIGINT NOT NULL,
  comment_post_id BIGINT NOT NULL
);

CREATE TABLE likes (
  like_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  like_user_id BIGINT NOT NULL,
  like_post_id BIGINT NOT NULL
);

CREATE TABLE subscriptions (
  subscription_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  subscription_from_user_id BIGINT NOT NULL,
  subscription_to_user_id BIGINT NOT NULL
);

CREATE TABLE messages (
  message_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  message_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
  message_content MEDIUMTEXT,
  message_from_user_id BIGINT NOT NULL,
  message_to_user_id BIGINT NOT NULL
);

CREATE TABLE hastags (
  hashtag_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  hashtag_content TINYTEXT
);

CREATE TABLE content_types (
  content_type_id BIGINT AUTO_INCREMENT PRIMARY KEY,
  content_type_name TINYTEXT,
  content_type_class TINYTEXT
);
