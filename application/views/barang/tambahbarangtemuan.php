<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="px-5 py-4 shadow text-black rounded-3" style="background-color: white;font-size: 0.9rem;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h4 class="mb-0"><?= $title; ?></h4>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <small class="mb-0 text-gray-700">Tambah Barang Temuan</small>
    </div>

    <?= form_open_multipart('barang/tambahBarangTemuan'); ?>
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
        <div class="col-sm-8 ">
            <input type="text" class="form-control ml-3" name="nama" id="nama" value="<?= set_value('nama'); ?>">
            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-8 ms-3">
            <select name="kategori" id="kategori" class="form-select">
                <?php foreach ($kategori as $kat) : ?>
                    <option value="<?= $kat['keterangan']; ?>"><?= $kat['keterangan']; ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Temuan</label>
        <div class="col-sm-8">
            <input type="datetime-local" class="form-control ml-3" name="tanggal" id="tanggal" value="<?= set_value('tanggal'); ?>">
            <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="gambar1" class="col-sm-2 col-form-label">Gambar 1</label>
        <div class="col-sm-8 ">
            <input required type="file" class="form-control ml-3" name="gambar1" id="gambar1">

        </div>
    </div>
    <div class="mb-3 row">
        <label for="gambar2" class="col-sm-2 col-form-label">Gambar 2</label>
        <div class="col-sm-8 ">
            <input required type="file" class="form-control ml-3" name="gambar2" id="gambar2">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
        <div class="col-sm-8 ">
            <input type="text" class="form-control ml-3" name="keterangan" id="keterangan" value="<?= set_value('keterangan'); ?>">
            <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-8 px-4">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="<?= base_url('barang/barangTemuan') ?>" class="btn btn-danger ">Batal</a>
        </div>
    </div>
    </form>

</div>