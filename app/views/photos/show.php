<?php $this->layout('layout/layout') ?>

<div class="wrapper">
    <section class="hero is-info is-medium">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    <?= $photo['title']?>
                </h1>
                <h2 class="subtitle">
                    <?= $photo['description']?>
                </h2>
            </div>
        </div>
    </section>

    <div class="container main-content">
        <div class="columns">
            <div class="column"></div>
            <div class="column is-half auth-form">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="<?=  getImage($photo['image'])?>" alt="Placeholder image">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48x48">
                                    <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                                </figure>
                            </div>
                            <p class="title is-4">
                                Добавил: <a href="/photos/<?= $user['id']?>/user"><?= $user['username']?></a>
                            </p>
                        </div>

                        <div class="content">
                            <?php $photo['description']?>
                            <br>
                            <time datetime="2016-1-1" class="is-size-6 is-pulled-left">Добавлено: <?= $photo['date']?></time>
                            <a href="../download/<?= $photo['id'] ?>" class="button is-info is-pulled-right">Скачать</a>
                            <div class="is-clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="column"></div>
        </div>

        <hr>

        <div class="columns">
            <div class="column">
                <h1 class="title">Другие фотографии от <a href="/photos/<?= $user['id']?>/user"><?= $user['username']?></a></h1>
            </div>
        </div>

        <div class="columns section">

            <?php foreach ($userImages as $userImage): ?>
                <div class="column is-one-quarter">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <a href="../photos/<?= $userImage['id'] ?>">
                                    <img src="<?= getImage($userImage['image']) ?>" alt="Placeholder image">
                                </a>
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-left">
                                    <p class="title is-5"><a href="/category/<?= $userImage['category_id'];?>"><?= getCategory($userImage['category_id'])['title'];?></a></p>
                                </div>
                                <div class="media-right">
                                    <p  class="is-size-7">Размер: <?= $userImage['dimensions'] ?></p>
                                    <time datetime="2016-1-1" class="is-size-7">Добавлено:  <?= $userImage['date'] ?></time>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
    </div>
</div>
