<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
</div>

<div class="row">
    <?php if ($user['role_id'] == 1) : ?>
        <?php foreach ($allUser as $aU) : ?>
            <div class="card mx-2" style="width: 18rem;">
                <img src="<?= base_url('assets') ?>/image/<?= $aU['gambar'] ?>" class="card-img-top w-50 mx-auto mt-3" alt="...">
                <div class="card-body pb-0">
                    <h5 class="card-title"><?= $aU['nama'] ?></h5>
                    <p class="card-text"><?php if ($aU['role_id'] == 1) : ?>
                            Administration
                        <?php elseif ($aU['role_id'] == 2) : ?>
                            User
                        <?php endif; ?>
                    </p>
                </div>
                <hr class="sidebar-divider">
                <!-- <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        
                    </li>
                </ul> -->
                <div class="card-body pt-0">
                    <a href="<?= base_url('components') ?>/editDataUser" class="btn btn-primary"><i class="fas fa-edit mr-2"></i>Edit</a>
                    <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt mr-2"></i>Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php elseif ($user['role_id'] == 2) : ?>
        <div class="card mx-2" style="width: 18rem;">
            <img src="<?= base_url('assets') ?>/image/<?= $user['gambar'] ?>" class="card-img-top w-50 mx-auto mt-3" alt="...">
            <div class="card-body pb-0">
                <h5 class="card-title"><?= $user['nama'] ?></h5>
                <p class="card-text">User</p>
            </div>
            <!-- <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    User
                </li>
            </ul> -->
            <hr class="sidebar-divider">
            <div class="card-body pt-0">
                <a href="#" class="btn btn-primary"><i class="fas fa-edit mr-2"></i>Edit</a>
            </div>
        </div>
    <?php endif; ?>
</div>