<?php $this->layout('layout/layout') ?>

<div class="wrapper">
    <div class="container">
        <nav class="navbar is-transparent">
            <div class="navbar-brand">
                <a class="navbar-item" href="index.html">
                    <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
                </a>
                <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div id="navbarExampleTransparentExample" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="index.html">
                        Главная
                    </a>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link" href="category.html">
                            Категории
                        </a>
                        <div class="navbar-dropdown is-boxed">
                            <a class="navbar-item" href="category.html">
                                Природа
                            </a>
                            <a class="navbar-item" href="category.html">
                                Машины
                            </a>
                            <a class="navbar-item" href="category.html">
                                Дизайн и Интерьер
                            </a>
                            <a class="navbar-item" href="category.html">
                                Животные
                            </a>
                        </div>
                    </div>
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="field is-grouped">
                            <p class="control">
                                <a class="button is-link" href="login.html">
                                      <span class="icon">
                                        <i class="fas fa-user"></i>
                                      </span>
                                      <span>Войти</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button is-primary" href="/register">
                                      <span class="icon">
                                        <i class="fas fa-address-book"></i>
                                      </span>
                                      <span>Зарегистрироваться</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Самые минималистичные и элегантные обои для вашего рабочего стола!
                </h1>
                <h2 class="subtitle">
                    Настроение и вдохновение в одном кадре.
                </h2>
            </div>
        </div>
    </section>
    <section class="section main-content">
        <div class="container">
            <div class="columns  is-multiline">






                <?php foreach ($photos as $photo): ?>
                    <div class="column is-one-quarter">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <a href="photo.html">
                                        <img src="uploads/<?= $photo['image']; ?>" alt="Placeholder image">
                                    </a>
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                        <p class="title is-5"><a href="category.html"><?= $photo['title']; ?></a></p>
                                    </div>
                                    <div class="media-right">
                                        <p  class="is-size-7">Размер: <?= $photo['dimensions']; ?></p>
                                        <time datetime="2016-1-1" class="is-size-7">Добавлено: <?= $photo['date']; ?></time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>






            </div>
        </div>
    </section>
    <footer class="section hero is-light">
        <div class="container">
            <div class="content has-text-centered">
                <div class="tabs">
                    <ul>
                        <li class="is-active"><a>Главная</a></li>
                        <li><a>Природа</a></li>
                        <li><a>Дизайн и Интерьер</a></li>
                        <li><a>Животные</a></li>
                        <li><a>Природа</a></li>
                        <li><a>Дизайн и Интерьер</a></li>
                        <li><a>Животные</a></li>
                        <li><a>Природа</a></li>
                        <li><a>Дизайн и Интерьер</a></li>
                        <li><a>Животные</a></li>
                    </ul>
                </div>
                <p>
                    <strong>Marlin</strong> - Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit expedita consequatur, et. Unde, nulla, dicta.
                </p>
                <p class="is-size-7">
                    All rights reserved. 2018
                </p>
            </div>
        </div>
    </footer>
</div>