SELECT
  p.id, post_title, post_content, post_views_count, COUNT(like_user_id) AS like_count
FROM posts p
       INNER JOIN likes ON p.id = like_post_id
GROUP BY like_post_id, post_views_count
ORDER BY post_views_count DESC;
