<?php $this->layout('layout/layout') ?>

<div class="wrapper">

    <div class="container main-content">

        <div class="columns">
            <div class="column">
                <div class="tabs is-centered pt-100">
                    <ul>
                        <li>
                            <a href="/profile_info">
                                <span class="icon is-small"><i class="fas fa-user"></i></span>
                                <span>Основная информация</span>
                            </a>
                        </li>
                        <li class="is-active">
                            <a href="/profile_security">
                                <span class="icon is-small"><i class="fas fa-lock"></i></span>
                                <span>Безопасность</span>
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="is-clearfix"></div>

                <form action="/profile_security" method="POST">
                    <div class="columns is-centered">
                        <div class="column is-half">
                            <div class="field">
                                <?php echo flash(); ?>
                                <label class="label">Текущий пароль</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input" type="password" name="oldPassword">
                                    <span class="icon is-small is-left">
                              <i class="fas fa-user"></i>
                            </span>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Новый пароль</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input" type="password" name="newPassword">
                                    <span class="icon is-small is-left">
                              <i class="fas fa-user"></i>
                            </span>
                                </div>
                            </div>

                            <div class="control">
                                <button class="button is-link">Обновить</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
