<?php $this->layout('admin/layout/layout') ?>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Админ-панель</h3>

              <?php echo flash();?>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="">
            <div class="box-header">
              <h2 class="box-title">Все пользователи</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="/admin/users/create" class="btn btn-success btn-lg">Добавить</a> <br> <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Аватар</th>
                    <th>Верификация</th>
                    <th>Статус</th>
                    <th>Действия</th>
                  </tr>
                </thead>
                <tbody>
                   
                    <?php foreach ($users as $user):?>
                      <tr>
                        <td><?= $user['id']?></td>
                        <td><?= $user['username']?></td>
                        <td><?= $user['email']?></td>
                        <td><?=  getRole($user['roles_mask']) ?></td>
                        <td>
                          <img src="<?= getImage($user['image'])?>" width="50">
                        </td>
                        <td><?= getVerification($user['verified']) ?></td>
                        <td>
                            <?php $this->insert('admin/partials/status', ['status' => $user['status']]);?>
                        </td>
                        <td>
                          <a href="#" class="btn btn-info">
                            <i class="fa fa-eye"></i>
                          </a>
                          <a href="/admin/users/edit/<?= $user['id']?>" class="btn btn-warning">
                            <i class="fa fa-pencil"></i>
                          </a>
                          <a href="/admin/users/delete/<?= $user['id']?>" class="btn btn-danger" onclick="return confirm('Вы уверены?');">
                            <i class="fa fa-remove"></i>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach;?>

                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Аватар</th>
                    <th>Статус</th>
                    <th>Действия</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
                По вопросам к главному администратору.
          </div>
          <!-- /.box-footer-->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
