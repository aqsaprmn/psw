<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="daftarbarangTemuanAll" class="px-5 py-4 shadow text-black rounded-3" style="background-color: white;font-size: 0.9rem;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h4 class="mb-0"><?= $title; ?></h4>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <small class="mb-0 text-gray-700">Seluruh barang hilang yang terdaftar</small>
    </div>
    <!-- Alert -->
    <!-- <div class="flash-message" data-text="<?= ($this->session->flashdata('result') == "Berhasil") ? "Barang Hilang Berhasil Ditambahkan" : "Barang Hilang Gagal Ditambahkan"; ?>" data-title="Tambah Barang Hilang" data-massage="<?= $this->session->flashdata('result'); ?>"></div> -->
    <!-- End Alert -->
    <div class="row mb-3">
        <div class="col-sm-6">
            <input id="keyword" type="text" class="form-control p-3" placeholder="Cari Barang ...">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table text-black table-bordered" data-all="<?= base_url('barang/daftarbarangTemuanAll') ?>" data-hapus="<?= base_url('barang/barangTemuanDelete') ?>" data-edit="<?= base_url('barang/barangTemuanEdit') ?>" data-id="<?= $user['id'] ?>">
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