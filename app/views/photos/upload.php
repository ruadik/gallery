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
                        <a class="navbar-link" href="../category.html">
                            Категории
                        </a>
                        <div class="navbar-dropdown is-boxed">
                            <a class="navbar-item" href="../category.html">
                                Природа
                            </a>
                            <a class="navbar-item" href="../category.html">
                                Машины
                            </a>
                            <a class="navbar-item" href="../category.html">
                                Дизайн и Интерьер
                            </a>
                            <a class="navbar-item" href="../category.html">
                                Животные
                            </a>
                        </div>
                    </div>
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="field is-grouped">
                            <div class="dropdown is-hoverable">
                                <div class="dropdown-trigger">
                                    <button class="button is-primary" aria-haspopup="true" aria-controls="dropdown-menu4">
                                        <span>Управление</span>
                                        <span class="icon is-small">
                                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                                </span>
                                    </button>
                                </div>
                                <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                                    <div class="dropdown-content">
                                        <div class="dropdown-item manager-links">
                                            <p class="control">
                                                <a class="button" href="/photos/create">
                                            <span class="icon">
                                              <i class="fas fa-upload"></i>
                                            </span>
                                                    <span>Загрузить картинку</span>
                                                </a>
                                            </p>

                                            <p class="control">
                                                <a class="button" href="/photos/create">
                                            <span class="icon">
                                              <i class="fas fa-list"></i>
                                            </span>
                                                    <span>Моя галерея</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="account control">
                                <p>
                                    Здравствуйте, <b>marlin</b>
                                </p>
                            </div>
                            <p class="control">
                                <a class="button is-info" href="Auth/login.html">
                      <span class="icon">
                        <i class="fas fa-user"></i>
                      </span>
                                    <span>Профиль</span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button is-dark" href="Auth/login.html">
                      <span class="icon">
                        <i class="fas fa-window-close"></i>
                      </span>
                                    <span>Выйти</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <section class="hero is-warning">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Новые события - новые фотографии!
                </h1>
                <h2 class="subtitle">
                    Заполните форму и пополните вашу галерею.
                </h2>
            </div>
        </div>
    </section>
    <div class="container main-content">
      <form action="/upload" method="post" enctype="multipart/form-data">
        <div class="columns">
            <div class="column"></div>
            <div class="column is-quarter auth-form">
                <div class="notification is-success">
                    Спасибо! Картинка успешно загружена!
                </div>

                <div class="field">
                    <label class="label">Название</label>
                    <div class="control">
                        <input class="input" type="text" name="title" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Краткое описание</label>
                    <div class="control">
                        <textarea class="textarea" name="description" required></textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Выберите категорию</label>
                    <div class="control">
                        <div class="select">
                            <select name="categories" required>
                                <option></option>
                                <option>Природа</option>
                                <option>Животные</option>
                                <option>Дизайн и Интерьер</option>
                                <option>Игры</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Выберите картинку</label>
                    <div class="file is-normal has-name">
                        <label class="file-label">
                            <input class="file-input" type="file" name="image" required>
                            <span class="file-cta">
                    <span class="file-icon">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                      Выбрать файл
                    </span>
                  </span>
                        </label>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-success is-large">Загрузить</button>
                    </div>
                </div>
            </div>
            <div class="column"></div>
        </div>
     </form>
    </div>
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
