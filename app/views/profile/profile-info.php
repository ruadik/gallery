<?php $this->layout('layout/layout') ?>
    <div class="wrapper">

      <div class="container main-content">
        <div class="columns">
            <div class="column">
              <div class="tabs is-centered pt-100">
                <ul>
                  <li class="is-active">
                    <a href="/profile_info">
                      <span class="icon is-small"><i class="fas fa-user"></i></span>
                      <span>Основная информация</span>
                    </a>
                  </li>
                  <li>
                    <a href="/profile_security">
                      <span class="icon is-small"><i class="fas fa-lock"></i></span>
                      <span>Безопасность</span>
                    </a>
                  </li>
                </ul>
              </div>

               <form action="/profile_info" method="POST" enctype="multipart/form-data">
                  <div class="is-clearfix"></div>
                    <div class="columns is-centered">
                      <div class="column is-half">
                        <div class="field">
                            <?php echo flash(); ?>
                          <label class="label">Ваше имя</label>
                          <div class="control has-icons-left has-icons-right">
                            <input class="input" type="text" name="username" value=<?= $user['username']; ?>>
                            <span class="icon is-small is-left">
                              <i class="fas fa-user"></i>
                            </span>
                          </div>
                        </div>

                        <div class="field">
                          <label class="label">Email</label>
                          <div class="control has-icons-left has-icons-right">
                            <input class="input" type="text" name="email" value=<?= $user['email']; ?>>
                            <span class="icon is-small is-left">
                              <i class="fas fa-user"></i>
                            </span>
                          </div>
                        </div>

                          <div class="field">
                          <div class="form-group">
                              <label class="label">Аватар</label>
                              <img src="<?= getImage($user['image'])?>" width="200" alt="">
                              <br>
                              <input type="file" id="exampleInputEmail1" name="image">
                              <br>
                              <br>
                          </div>
                          </div>


                        <div class="control">
                          <button class="button is-link">Обновить</button>
                        </div>
                      </div>
                    </div>
                  </div>
               </form>

        </div>
      </div>
    </div>
