<?php $this->layout('layout/layout') ?>

<div class="wrapper">
    <section class="hero is-info">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Обновление события - Обновление фотографии!
                </h1>
                <h2 class="subtitle">
                    Обновление инфомации о фотографии.
                </h2>
            </div>
        </div>
    </section>
    <div class="container main-content">


        <form action="/photos/<?= $photo['id'];?>/update" method="post" enctype="multipart/form-data">
            <div class="columns">
                <div class="column"></div>
                <div class="column is-quarter auth-form">

<!--                    <div class="notification is-success">-->
<!--                        Спасибо! Картинка успешно загружена!-->
<!--                    </div>-->

                    <?= flash() ?>

                    <div class="field">
                        <label class="label">Название</label>
                        <div class="control">
                            <input class="input" type="text" name="title" value="<?= $photo['title'];?>" >
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Краткое описание</label>
                        <div class="control">
                            <textarea class="textarea" name="description"><?= $photo['description'];?></textarea>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Выберите категорию</label>
                        <div class="control">
                            <div class="select">
                                <select name="categories" >
                                    <option></option>
                                    <?php foreach($categories as $category):?>
                                        <option
                                            <?php if($photo['category_id'] == $category['id']):?>selected <?php endif;?>
                                            value="<?= $category['id'];?>"><?= $category['title'];?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Выберите картинку</label>
                        <div class="file is-normal has-name">
                            <label class="file-label">
                                <input class="file-input" type="file" name="image" value="">
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
</div>
