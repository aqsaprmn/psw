<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>BHT - <?= $title; ?></title>

    <!-- My Style -->
    <link href="<?= base_url('assets') ?>/bootstrap5/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/main.css">


    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets') ?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fab fa-codepen"></i>
                </div>
                <div class="sidebar-brand-text mx-3">BHT<sup>1st</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <?php
            $role_id = $this->session->userdata('role_id');
            $query = "SELECT `user_menu`.`id` AS `id_menu` , `user_menu`.`menu` , `user_access_menu`.`role_id` , `user_access_menu`.`menu_id`
                          FROM `user_menu` 
                          JOIN `user_access_menu`
                            ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                         WHERE `user_access_menu`.`role_id` = $role_id
                            ";

            $menu = $this->db->query($query)->result_array();
            ?>


            <!-- Heading -->
            <?php foreach ($menu as $m) : ?>
                <div class="sidebar-heading">
                    <?= $m['menu']; ?>
                </div>

                <?php
                $menuId = $m['id_menu'];
                $queryMenuGo = "SELECT * FROM user_menu_go WHERE menu_id = $menuId";

                $menuGo = $this->db->query($queryMenuGo)->result_array();
                ?>

                <?php foreach ($menuGo as $Mg) : ?>
                    <?php if ($Mg['sub_menu_active'] == 0) : ?>
                        <!-- Nav Item - Dashboard -->
                        <li class="nav-item  <?= ($title == $Mg['title']) ? 'active' : ''; ?>">
                            <a class="nav-link py-2" href="<?= base_url() ?><?= $Mg['url']; ?>">
                                <i class="<?= $Mg['icon']; ?>"></i>
                                <span><?= $Mg['title']; ?></span></a>
                        </li>
                        <!-- Divider -->
                        <!-- <hr class="sidebar-divider"> -->
                    <?php else : ?>
                        <!-- Nav Item - Pages Collapse Menu -->
                        <li class="nav-item subMenu">
                            <a class="nav-link py-2 collapsed" href="#" data-toggle="collapse" aria-controls="subMenu">
                                <i class="<?= $Mg['icon']; ?>"></i>
                                <span><?= $Mg['title']; ?></span>
                            </a>
                            <div id="subMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                                    <?php
                                    $menuGoId = $Mg['id'];
                                    $querSubMenuGo = "SELECT * FROM user_sub_menu_go WHERE menu_go_id = $menuGoId";
                                    $subMenuGo = $this->db->query($querSubMenuGo)->result_array();
                                    ?>
                                    <?php foreach ($subMenuGo as $Smg) : ?>
                                        <a class="collapse-item" href="<?= base_url() ?><?= $Smg['url']; ?>"><i class="<?= $Smg['icon']; ?>"></i> <span> <?= $Smg['title']; ?></span></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </li>
                    <?php endif; ?>

                <?php endforeach; ?>
                <hr class="sidebar-divider">

            <?php endforeach; ?>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link py-2" href="#" data-toggle="modal" data-target="#logoutModal">
                    <!-- <i class="fas fa-fw fa-table"></i> -->
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->