<div class="container">
    <h1 class="page__title page__title--popular">Популярное</h1>
</div>
<div class="popular container">
    <div class="popular__filters-wrapper">
        <div class="popular__sorting sorting">
            <b class="popular__sorting-caption sorting__caption">Сортировка:</b>
            <ul class="popular__sorting-list sorting__list">
                <li class="sorting__item sorting__item--popular">
                    <a class="sorting__link sorting__link--active" href="#">
                        <span>Популярность</span>
                        <svg class="sorting__icon" width="10" height="12">
                            <use xlink:href="#icon-sort"></use>
                        </svg>
                    </a>
                </li>
                <li class="sorting__item">
                    <a class="sorting__link" href="#">
                        <span>Лайки</span>
                        <svg class="sorting__icon" width="10" height="12">
                            <use xlink:href="#icon-sort"></use>
                        </svg>
                    </a>
                </li>
                <li class="sorting__item">
                    <a class="sorting__link" href="#">
                        <span>Дата</span>
                        <svg class="sorting__icon" width="10" height="12">
                            <use xlink:href="#icon-sort"></use>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
        <div class="popular__filters filters">
            <b class="popular__filters-caption filters__caption">Тип контента:</b>
            <ul class="popular__filters-list filters__list">
                <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
                    <a class="filters__button filters__button--ellipse filters__button--all filters__button--active"
                       href="#">
                        <span>Все</span>
                    </a>
                </li>
                <?php foreach ($content_types as $content_type_key => $content_type) { ?>
                    <li class="popular__filters-item filters__item">
                        <a class="filters__button filters__button--<?= $content_type['content_type_class'] ?> <?= $content_type['content_type_id'] == $content_type_id_selected ? "filters__button--active " : "" ?>button"
                           href="index.php?content-type=<?= $content_type['content_type_id'] ?>">
                            <span class="visually-hidden"><?= $content_type['content_type_name'] ?></span>
                            <svg class="filters__icon" width="22" height="18">
                                <use xlink:href="#icon-filter-<?= $content_type['content_type_class'] ?>"></use>
                            </svg>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="popular__posts">
        <?php foreach ($posts as $post_key => $post) { ?>
            <article class="popular__post post <?= "post-" . $post['content_type_class'] ?>">
                <header class="post__header">
                    <h2>
                        <!--здесь заголовок-->
                        <a href="post.php?post_id=<?= $post['post_id'] ?>">
                            <?= esc($post['post_title']) ?>
                        </a>
                    </h2>
                </header>
                <div class="post__main">
                    <!--здесь содержимое карточки-->
                    <?php if ($post['content_type_class'] === 'quote') { ?>
                        <!--содержимое для поста-цитаты-->
                        <blockquote>
                            <p>
                                <?= esc($post['post_content']) ?>
                            </p>
                            <cite>Неизвестный Автор</cite>
                        </blockquote>
                    <?php } elseif ($post['content_type_class'] === 'text') { ?>
                        <!--содержимое для поста-текста-->
                        <?= check_content_length($post['post_content']) ?>
                    <?php } elseif ($post['content_type_class'] === 'photo') { ?>
                        <!--содержимое для поста-фото-->
                        <div class="post-photo__image-wrapper">
                            <img src="img/<?= $post['post_content'] ?>" alt="Фото от пользователя" width="360"
                                 height="240">
                        </div>
                    <?php } elseif ($post['content_type_class'] === 'link') { ?>
                        <!--содержимое для поста-ссылки-->
                        <div class="post-link__wrapper">
                            <a class="post-link__external" href="http://<?= $post['post_content'] ?>"
                               title="Перейти по ссылке">
                                <div class="post-link__info-wrapper">
                                    <div class="post-link__icon-wrapper">
                                        <img
                                            src="https://www.google.com/s2/favicons?domain=<?= $post['post_content'] ?>"
                                            alt="Иконка">
                                    </div>
                                    <div class="post-link__info">
                                        <h3><?= esc($post['post_content']) ?></h3>
                                    </div>
                                </div>
                                <span><?= esc($post['post_content']) ?></span>
                            </a>
                        </div>
                    <?php } elseif ($post['content_type_class'] === 'video') { ?>
                        <!--содержимое для поста-видео-->
                        <div class="post-video__block">
                            <div class="post-video__preview">
                                <?php embed_youtube_cover($post['post_content']); ?>
                                <img src="img/coast-medium.jpg" alt="Превью к видео" width="360" height="188">
                            </div>
                            <a href="post-details.html" class="post-video__play-big button">
                                <svg class="post-video__play-big-icon" width="14" height="14">
                                    <use xlink:href="#icon-video-play-big"></use>
                                </svg>
                                <span class="visually-hidden">Запустить проигрыватель</span>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <footer class="post__footer">
                    <div class="post__author">
                        <a class="post__author-link" href="#" title="Автор">
                            <div class="post__avatar-wrapper">
                                <!--укажите путь к файлу аватара-->
                                <img class="post__author-avatar" src="img/<?= $post['user_avatar'] ?>"
                                     alt="Аватар пользователя">
                            </div>
                            <div class="post__info">
                                <b class="post__author-name">
                                    <!--здесь имя пользователя-->
                                    <?= esc($post['user_login']) ?>
                                </b>
                                <time
                                    class="post__time"
                                    datetime="<?= $random_date = generate_random_date($post_key) ?>"
                                    title="<?= get_formatted_date($random_date) ?>"
                                >
                                    <?= get_human_time_diff($random_date) ?>
                                </time>
                            </div>
                        </a>
                    </div>
                    <div class="post__indicators">
                        <div class="post__buttons">
                            <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                <svg class="post__indicator-icon" width="20" height="17">
                                    <use xlink:href="#icon-heart"></use>
                                </svg>
                                <svg class="post__indicator-icon post__indicator-icon--like-active" width="20"
                                     height="17">
                                    <use xlink:href="#icon-heart-active"></use>
                                </svg>
                                <span>0</span>
                                <span class="visually-hidden">количество лайков</span>
                            </a>
                            <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                <svg class="post__indicator-icon" width="19" height="17">
                                    <use xlink:href="#icon-comment"></use>
                                </svg>
                                <span>0</span>
                                <span class="visually-hidden">количество комментариев</span>
                            </a>
                        </div>
                    </div>
                </footer>
            </article>
        <?php } ?>
    </div>
</div>
