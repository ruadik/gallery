<?php $this->layout('layout/layout') ?>

<div class="wrapper">
<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                Добро пожаловать в наше сообщество!
            </h1>
            <h2 class="subtitle">
                Регистрация нового пользователя.
            </h2>
        </div>
    </div>
</section>
<div class="container main-content">
    <div class="columns">
        <div class="column"></div>
        <div class="column is-quarter auth-form">


            <?php  echo flash();?>
            <form action="/register" method="POST">
                <div class="field">
                    <label class="label">Ваше имя</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="text" name="username">
                        <span class="icon is-small is-left">
                      <i class="fas fa-user"></i>
                    </span>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="email" name="email">  <!-- is-danger -->
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>

<!--                        <span class="icon is-small is-right">-->
<!--                          <i class="fas fa-exclamation-triangle"></i>-->
<!--                        </span>-->
                    </div>
<!--                     <p class="help is-danger">This email is invalid</p>-->
                </div>

                <div class="field">
                    <label class="label">Пароль</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" name="password">
                        <span class="icon is-small is-left">
                      <i class="fas fa-lock"></i>
                    </span>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Подтвердите пароль</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" name="password_confirmation">
                        <span class="icon is-small is-left">
                      <i class="fas fa-lock"></i>
                    </span>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" name="terms" required>
                            Я согласен с <a href="#">правилами сайта</a>
                        </label>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link" type="submit">Зарегистрироваться</button>
                    </div>
                    <div class="control">
                        <a class="button is-text" href="/">Отмена</a>
                    </div>
                </div>
            </form>

            <div class="field">
                <p>Уже зарегистрированы? <b><a href="/login">Войти</a></b></p>
            </div>
        </div>
        <div class="column"></div>
    </div>
</div>
</div>
