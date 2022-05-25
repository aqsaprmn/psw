<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="px-5 py-4 shadow rounded-3" style="background-color: white;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>
    <?php if (isset($error)) : ?>
        <?= $error; ?>
    <?php endif ?>
    <?= $this->session->flashdata('message'); ?>
    <?= form_open_multipart('member/editUserGo'); ?>
    <input type="text" name="id" hidden value="<?= $editUser['id']; ?>">
    <div class="mb-3 row">
        <label for="gambar" class="col-sm-1 col-form-label">Gambar</label>
        <div class="col-sm-6 d-flex">
            <img class="w-15" src="<?= base_url('assets') ?>/image/<?= $editUser['gambar']; ?>" alt="">
            <input type="file" class="form-control ml-3" name="gambar" id="gambar">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="nama" class="col-sm-1 col-form-label">Nama</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="nama" id="nama" value="<?= $editUser['nama']; ?>">
            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="email" class="col-sm-1 col-form-label">Email</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="email" id="email" value="<?= $editUser['email']; ?>">
            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="nik" class="col-sm-1 col-form-label">NIK</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="nik" id="nik" value="<?= $editUser['nik']; ?>">
            <?= form_error('nik', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="alamat" class="col-sm-1 col-form-label">Alamat</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $editUser['alamat']; ?>">
            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="hp" class="col-sm-1 col-form-label">Handphone</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="hp" id="hp" value="<?= $editUser['no_telp']; ?>">
            <?= form_error('hp', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
    </div>
    <div class="row mt-3">
        <label class="col-sm-1"></label>
        <div class="col-sm-6 d-flex">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('member') ?>" class="btn btn-danger ml-3">Batal</a>
        </div>
    </div>
    </form>
</div>