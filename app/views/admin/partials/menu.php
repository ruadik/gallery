<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="/admin/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/img/avatar04.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= auth()->getUsername()?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Навигация</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="/admin/"><i class="fa fa-home fas fa-lg"></i> <span>Главная</span></a></li>
            <li><a href="/admin/photos"><i class="fa fa-image"></i> <span>Все картинки</span></a></li>
            <li><a href="/admin/categories"><i class="fa fa-list"></i> <span>Категории</span></a></li>
            <li><a href="/admin/users"><i class="fa fa-group"></i> <span>Пользователи</span></a></li>
            <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Выход</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

