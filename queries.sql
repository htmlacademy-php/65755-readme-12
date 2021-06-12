INSERT INTO content_types (content_type_name, content_type_class) VALUES
('Цитата', 'quote'),
('Текст', 'text'),
('Фото', 'photo'),
('Видео', 'video'),
('Ссылка', 'link');

INSERT INTO users (user_email, user_login, user_password, user_avatar) VALUES
('larisa@example.com', 'Лариса' , 'password', 'userpic-larisa-small.jpg'),
('vladik@example.com', 'Владик' , 'drowssap', 'userpic.jpg'),
('виктор@кц.рф', 'Виктор' , 'пароль', 'userpic-mark.jpg'),
('эльвира@кц.рф', 'Эльвира Хайпулинова' , 'ьлорап', 'userpic-elvira.jpg');

INSERT INTO comments (comment_content, comment_author_id, comment_post_id) VALUES
('Lorem ipsum', 3, 1),
('Первый!', 2, 2),
('Ура!', 1, 3),
('dolor sit amet', 3, 1),
('consectetur adipiscing elit', 2, 2);

INSERT INTO posts (post_title, post_content, post_source_link, post_author_id, post_type_id, post_tags_list) VALUES ('Цитата', 'Мы в жизни любим только раз, а после ищем лишь похожих', 'Неизвестный Автор', 1, 1, '1, 2, 3');
INSERT INTO posts (post_title, post_content, post_author_id, post_type_id, post_tags_list) VALUES ('Игра престолов', 'Не могу дождаться начала финального сезона своего любимого сериала!', 2, 2, '1, 3, 4');
INSERT INTO posts (post_title, post_content, post_author_id, post_type_id, post_tags_list) VALUES ('Наконец, обработал фотки!', 'rock-medium.jpg', 3, 3, '3, 4');
INSERT INTO posts (post_title, post_content, post_author_id, post_type_id, post_tags_list) VALUES ('Моя мечта', 'coast-medium.jpg', 1, 3, '5, 6');
INSERT INTO posts (post_title, post_content, post_author_id, post_type_id) VALUES ('Лучшие курсы', 'www.htmlacademy.ru', 2, 5);

# -=-=-=-

SELECT * FROM posts INNER JOIN users u ON post_author_id = u.id INNER JOIN content_types ct ON post_type_id = ct.id ORDER BY post_views_count DESC;
SELECT * FROM posts WHERE post_author_id = 1;
SELECT comment_content, user_login FROM comments INNER JOIN users u ON comment_author_id = u.id WHERE comment_post_id = 1;
UPDATE posts SET post_views_count = post_views_count + 1 WHERE id = 1;
INSERT INTO subscriptions (subscription_from_user_id, subscription_to_user_id) VALUES (1, 2);
