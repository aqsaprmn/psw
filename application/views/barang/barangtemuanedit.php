<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="px-5 py-4 shadow text-black rounded-3" style="background-color: white;font-size: 0.9rem;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h4 class="mb-0"><?= $title; ?></h4>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <small class="mb-0 text-gray-700">Edit Barang Hilang</small>
    </div>

    <?= form_open_multipart('barang/barangTemuanEdit/' . $kode['kode']); ?>
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
        <div class="col-sm-8 ">
            <input type="text" class="form-control ml-3" name="nama" id="nama" value="<?= $barang['nama_brt']; ?>">
            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-8 ms-3">
            <select name="kategori" id="kategori" class="form-select">
                <?php foreach ($kategori as $kat) : ?>
                    <option <?= ($kat['keterangan'] == $barang['keterangan']) ? "selected" : ""; ?> value="<?= $kat['keterangan']; ?>"><?= $kat['keterangan']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Temuan</label>
        <div class="col-sm-8">
            <input type="datetime-local" class="form-control ml-3" name="tanggal" id="tanggal" value="<?= date('Y-m-d\TH:i', $tgl_temu['tgl']); ?>">
            <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="gambar1" class="col-sm-2 col-form-label">Gambar 1</label>
        <div class="col-sm-8 ">
            <input type="file" class="form-control ml-3 mb-2" name="gambar1" id="gambar1">
            <img class="px-3" src="<?= base_url('assets/baranghilang/') . $barang['gambar1'] ?>" style="width:240px" alt="">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="gambar2" class="col-sm-2 col-form-label">Gambar 2</label>
        <div class="col-sm-8 ">
            <input type="file" class="form-control ml-3 mb-2" name="gambar2" id="gambar2">
            <img class="px-3" src="<?= base_url('assets/baranghilang/') . $barang['gambar2'] ?>" style="width:240px" alt="">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan/Rincian</label>
        <div class="col-sm-8 ">
            <input type="text" class="form-control ml-3" name="keterangan" id="keterangan" value="<?= $barang['keterangan']; ?>">
            <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-8 ms-3">
            <select name="status" id="status" class="form-select">
                <option <?= ($barang['status'] == 'Y') ? "selected" : ""; ?> value="Y">Barang Belum Kembali</option>
                <option <?= ($barang['status'] == 'P') ? "selected" : ""; ?> value="P">Sedang Diproses</option>
                <option <?= ($barang['status'] == 'N') ? "selected" : ""; ?> value="N">Barang Sudah Kembali</option>
            </select>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-8 px-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('barang/barangTemuan') ?>" class="btn btn-danger ">Batal</a>
        </div>
    </div>
    </form>

</div>