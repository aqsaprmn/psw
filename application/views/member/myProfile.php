<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?= $this->session->flashdata('message'); ?>
<div class="px-5 py-4 text-black shadow rounded-3" style="background-color: white;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <div class="row user">
        <?php if ($user['role_id'] == 1) : ?>
            <?php foreach ($allUser as $aU) : ?>
                <div class="card mx-2 shadow" style="width: 18rem;">
                    <img src="<?= base_url('assets') ?>/image/<?= $aU['gambar'] ?>" class="card-img-top w-50 img-thumbnail mx-auto mt-3" alt="<?= $aU['nama'] ?>">
                    <div class="card-body pb-0">
                        <h5 class="card-title text-center"><?= $aU['nama'] ?></h5>
                        <!-- <p class="card-text">
                    </p> -->
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <?php if ($aU['role_id'] == 1) : ?>
                                <p class="card-text">Administration</p>
                            <?php elseif ($aU['role_id'] == 2) : ?>
                                <p class="card-text">Member</p>
                            <?php endif; ?>
                        </li>
                        <li class="list-group-item">
                            <p class="card-text"><small class="text-muted">Member Since : <strong><?= date('D , d - m - Y', $aU['date']) ?></strong></small></p>
                        </li>
                    </ul>
                    <div class="card-body">
                        <a href="<?= base_url('member') ?>/editUser/<?= $aU['id']; ?>" class="btn btn-primary"><i class="fas fa-edit mr-2"></i>Edit</a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt mr-2"></i>Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php elseif ($user['role_id'] == 2) : ?>
            <div class="card mx-2" style="width: 18rem;">
                <img src="<?= base_url('assets') ?>/image/<?= $user['gambar'] ?>" class="card-img-top w-50 mx-auto mt-3" alt="">
                <div class="card-body pb-0">
                    <h5 class="card-title"><?= $user['nama'] ?></h5>

                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        Member
                    </li>
                    <li class="list-group-item">
                        <p class="card-text"><small class="text-muted">Member Since : <strong><?= date('D , d - m - Y', $user['date']) ?></strong></small></p>
                    </li>
                </ul>
                <div class="card-body">
                    <a href="<?= base_url('member') ?>/editUser/<?= $user['id']; ?>" class="btn btn-primary"><i class="fas fa-edit mr-2"></i>Edit</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>