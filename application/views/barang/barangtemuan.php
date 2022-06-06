<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="barangTemuan" class="px-5 py-4 shadow text-black rounded-3" style="background-color: white;font-size: 0.9rem;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0"><?= $title; ?></h4>
    </div>

    <!-- Alert -->
    <div class="flash-message" data-text="<?= ($this->session->flashdata('result') == "Berhasil") ? "Barang Temuan Berhasil Ditambahkan" : "Barang Temuan Gagal Ditambahkan"; ?>" data-title="Tambah Barang Temuan" data-massage="<?= $this->session->flashdata('result'); ?>"></div>
    <!-- End Alert -->

    <div class="row">
        <div class="col-sm-6">
            <a href="<?= base_url() ?>barang/tambahBarangTemuan" class="btn btn-primary mb-3">Tambah</a>
        </div>
        <div class="col-sm-6">
            <input id="keyword" type="text" class="form-control p-3" placeholder="Cari Barang ...">
        </div>
    </div>
    <table class="table text-black table-bordered" data-all="<?= base_url('barang/barangTemuanAll') ?>" data-hapus="<?= base_url('barang/barangTemuanDelete') ?>" data-edit="<?= base_url('barang/barangTemuanEdit') ?>">
        <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">Nama Barang</th>
                <th class="text-center" scope="col">Kategori</th>
                <th class="text-center" scope="col">Tanggal Temuan</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>




</div>