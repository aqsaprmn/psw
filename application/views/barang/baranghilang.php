<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="barangHilang" class="px-5 py-4 shadow text-black rounded-3" style="background-color: white;font-size: 0.9rem;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0"><?= $title; ?></h4>
    </div>

    <!-- Alert -->
    <div class="flash-message" data-text="<?= ($this->session->flashdata('result') == "Berhasil") ? "Barang Hilang Berhasil Ditambahkan" : "Barang Hilang Gagal Ditambahkan"; ?>" data-title="Tambah Barang Hilang" data-massage="<?= $this->session->flashdata('result'); ?>"></div>
    <!-- End Alert -->
    <div class="row">
        <div class="col-sm-6">
            <a href="<?= base_url() ?>barang/tambahBarangHilang" class="btn btn-primary mb-3">Tambah</a>
        </div>
        <div class="col-sm-6">
            <input id="keyword" type="text" class="form-control p-3" placeholder="Cari Barang ...">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table text-black table-bordered table-striped table-hover" data-all="<?= base_url('barang/barangHilangAll') ?>" data-hapus="<?= base_url('barang/barangHilangDelete') ?>" data-edit="<?= base_url('barang/barangHilangEdit') ?>">
            <thead>
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Nama Barang</th>
                    <th class="text-center" scope="col">Kategori</th>
                    <th class="text-center" scope="col">Tanggal Hilang</th>
                    <th class="text-center" scope="col">Status</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>



</div>