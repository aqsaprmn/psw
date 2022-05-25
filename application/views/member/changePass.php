<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="px-5 py-4 text-black shadow rounded-3" style="background-color: white;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>
    <form action="<?= base_url('member/changepassword') ?>" method="POST">
        <div class="form-group">
            <label for="passwordlama">Password Lama</label>
            <input type="password" class="form-control" id="passwordlama" name="passwordlama">
            <?= form_error('passwordlama', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="form-group">
            <label for="passwordbaru">Password Baru</label>
            <input type="password" class="form-control" id="passwordbaru" name="passwordbaru" aria-describedby="pb">
            <small id="pb" class="form-text text-muted">Password baru harus berbeda dengan password lama.</small>
            <?= form_error('passwordbaru', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="form-group">
            <label for="konfpass">Konfirmasi Password Baru</label>
            <input type="password" class="form-control" id="konfpass" name="konfpass">
            <?= form_error('konfpass', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <button type="submit" class="btn btn-primary">Ganti</button>
    </form>
</div>