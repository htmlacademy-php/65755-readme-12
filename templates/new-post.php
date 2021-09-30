<?php
function getPostVal($name) {
    return $_POST[$name] ?? "";
}
?>

<div class="page__main-section">
    <div class="container">
        <h1 class="page__title page__title--adding-post">Добавить публикацию</h1>
    </div>
    <div class="adding-post container">
        <div class="adding-post__tabs-wrapper tabs">
            <div class="adding-post__tabs filters">
                <ul class="adding-post__tabs-list filters__list tabs__list">
                    <?php foreach ($content_types as $content_type_key => $content_type) { ?>
                        <li class="adding-post__tabs-item filters__item">
                            <a class="
                                adding-post__tabs-link
                                filters__button
                                filters__button--<?= $content_type['content_type_class'] ?>
                                <?= $content_type['id'] === '1' ? 'filters__button--active' : '' ?>
                                tabs__item
                                <?= $content_type['id'] === '1' ? 'tabs__item--active' : '' ?>
                                button"
                               href="#"
                            >
                                <svg class="filters__icon" width="20" height="21">
                                    <use xlink:href="#icon-filter-<?= $content_type['content_type_class'] ?>"></use>
                                </svg>
                                <span><?= $content_type['content_type_name'] ?></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="adding-post__tab-content">
                <?php foreach ($content_types as $content_type_key => $content_type) { ?>
                    <?php if ($content_type['content_type_class'] === 'photo') { ?>
                        <section class="adding-post__photo tabs__content<?= $content_type_key === 0 ? " tabs__content--active" : "" ?>">
                            <h2 class="visually-hidden">Форма добавления фото</h2>
                            <form class="adding-post__form form" action="add.php" method="post" enctype="multipart/form-data">
                                <div class="form__text-inputs-wrapper">
                                    <div class="form__text-inputs">
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="photo-heading">Заголовок <span class="form__input-required">*</span></label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="photo-heading" type="text" name="photo-heading" placeholder="Введите заголовок">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="photo-url">Ссылка из интернета</label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="photo-url" type="text" name="photo-heading" placeholder="Введите ссылку">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="photo-tags">Теги</label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="photo-tags" type="text" name="photo-heading" placeholder="Введите теги">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__invalid-block">
                                        <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                                        <ul class="form__invalid-list">
                                            <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="adding-post__input-file-container form__input-container form__input-container--file">
                                    <div class="adding-post__input-file-wrapper form__input-file-wrapper">
                                        <div class="adding-post__file-zone adding-post__file-zone--photo form__file-zone dropzone">
                                            <input class="adding-post__input-file form__input-file" id="userpic-file-photo" type="file" name="userpic-file-photo" title=" ">
                                            <div class="form__file-zone-text">
                                                <span>Перетащите фото сюда</span>
                                            </div>
                                        </div>
                                        <button class="adding-post__input-file-button form__input-file-button form__input-file-button--photo button" type="button">
                                            <span>Выбрать фото</span>
                                            <svg class="adding-post__attach-icon form__attach-icon" width="10" height="20">
                                                <use xlink:href="#icon-attach"></use>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="adding-post__file adding-post__file--photo form__file dropzone-previews">

                                    </div>
                                </div>
                                <div class="adding-post__buttons">
                                    <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                    <a class="adding-post__close" href="#">Закрыть</a>
                                </div>
                            </form>
                        </section>
                    <?php } elseif ($content_type['content_type_class'] === 'video') { ?>
                        <section class="adding-post__video tabs__content<?= $content_type_key === 0 ? " tabs__content--active" : "" ?>">
                            <h2 class="visually-hidden">Форма добавления видео</h2>
                            <form class="adding-post__form form" action="add.php" method="post">
                                <div class="form__text-inputs-wrapper">
                                    <div class="form__text-inputs">
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="video-heading">Заголовок <span class="form__input-required">*</span></label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="video-heading" type="text" name="video-heading" placeholder="Введите заголовок">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="video-url">Ссылка youtube <span class="form__input-required">*</span></label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="video-url" type="text" name="video-heading" placeholder="Введите ссылку">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="video-tags">Теги</label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="video-tags" type="text" name="photo-heading" placeholder="Введите ссылку">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__invalid-block">
                                        <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                                        <ul class="form__invalid-list">
                                            <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="adding-post__buttons">
                                    <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                    <a class="adding-post__close" href="#">Закрыть</a>
                                </div>
                            </form>
                        </section>
                    <?php } elseif ($content_type['content_type_class'] === 'text') { ?>
                        <section class="adding-post__text tabs__content<?= $content_type_key === 0 ? " tabs__content--active" : "" ?>">
                            <h2 class="visually-hidden">Форма добавления текста</h2>
                            <form class="adding-post__form form" action="add.php" method="post">
                                <div class="form__text-inputs-wrapper">
                                    <div class="form__text-inputs">
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="text-heading">Заголовок <span class="form__input-required">*</span></label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="text-heading" type="text" name="text-heading" placeholder="Введите заголовок">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="adding-post__textarea-wrapper form__textarea-wrapper">
                                            <label class="adding-post__label form__label" for="post-text">Текст поста <span class="form__input-required">*</span></label>
                                            <div class="form__input-section">
                                                <textarea class="adding-post__textarea form__textarea form__input" id="post-text" placeholder="Введите текст публикации"></textarea>
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="post-tags">Теги</label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="post-tags" type="text" name="photo-heading" placeholder="Введите теги">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__invalid-block">
                                        <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                                        <ul class="form__invalid-list">
                                            <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                                            <li class="form__invalid-item">Цитата. Она не должна превышать 70 знаков.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="adding-post__buttons">
                                    <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                    <a class="adding-post__close" href="#">Закрыть</a>
                                </div>
                            </form>
                        </section>
                    <?php } elseif ($content_type['content_type_class'] === 'quote') { ?>
                        <section class="adding-post__quote tabs__content<?= $content_type_key === 0 ? " tabs__content--active" : "" ?>">
                            <h2 class="visually-hidden">Форма добавления цитаты</h2>
                            <form class="adding-post__form form" action="add.php" method="post">
                                <div class="form__text-inputs-wrapper">
                                    <div class="form__text-inputs">
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="quote-heading">Заголовок <span class="form__input-required">*</span></label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="quote-heading" type="text" name="quote-heading" placeholder="Введите заголовок" value="<?= getPostVal('quote-heading') ?>">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="adding-post__input-wrapper form__textarea-wrapper">
                                            <label class="adding-post__label form__label" for="cite-text">Текст цитаты <span class="form__input-required">*</span></label>
                                            <div class="form__input-section">
                                                <textarea class="adding-post__textarea adding-post__textarea--quote form__textarea form__input" id="cite-text" placeholder="Текст цитаты" name="quote-text"><?= getPostVal('quote-text') ?></textarea>
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="adding-post__textarea-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="quote-author">Автор <span class="form__input-required">*</span></label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="quote-author" type="text" name="quote-author" value="<?= getPostVal('quote-author') ?>">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="cite-tags">Теги</label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="cite-tags" type="text" name="quote-tags" placeholder="Введите теги" value="<?= getPostVal('quote-tags') ?>">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__invalid-block">
                                        <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                                        <ul class="form__invalid-list">
                                            <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                                            <li class="form__invalid-item">Цитата. Она не должна превышать 70 знаков.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="adding-post__buttons">
                                    <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                    <a class="adding-post__close" href="#">Закрыть</a>
                                </div>
                            </form>
                        </section>
                    <?php } elseif ($content_type['content_type_class'] === 'link') { ?>
                        <section class="adding-post__link tabs__content<?= $content_type_key === 0 ? " tabs__content--active" : "" ?>">
                            <h2 class="visually-hidden">Форма добавления ссылки</h2>
                            <form class="adding-post__form form" action="add.php" method="post">
                                <div class="form__text-inputs-wrapper">
                                    <div class="form__text-inputs">
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="link-heading">Заголовок <span class="form__input-required">*</span></label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="link-heading" type="text" name="link-heading" placeholder="Введите заголовок">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="adding-post__textarea-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="post-link">Ссылка <span class="form__input-required">*</span></label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="post-link" type="text" name="post-link">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="adding-post__input-wrapper form__input-wrapper">
                                            <label class="adding-post__label form__label" for="link-tags">Теги</label>
                                            <div class="form__input-section">
                                                <input class="adding-post__input form__input" id="link-tags" type="text" name="photo-heading" placeholder="Введите ссылку">
                                                <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                                <div class="form__error-text">
                                                    <h3 class="form__error-title">Заголовок сообщения</h3>
                                                    <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__invalid-block">
                                        <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                                        <ul class="form__invalid-list">
                                            <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                                            <li class="form__invalid-item">Цитата. Она не должна превышать 70 знаков.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="adding-post__buttons">
                                    <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                    <a class="adding-post__close" href="#">Закрыть</a>
                                </div>
                            </form>
                        </section>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
