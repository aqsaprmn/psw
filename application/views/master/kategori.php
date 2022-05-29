<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="px-5 py-4 shadow text-black rounded-3" style="background-color: white;font-size: 0.9rem;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0"><?= $title; ?></h4>
    </div>

    <!-- Alert -->
    <div class="flash-message" data-text="<?= ($this->session->flashdata('result') == "Berhasil") ? "Kategori Berhasil Ditambahkan" : "Kategori Gagal Ditambahkan"; ?>" data-title="Kategori" data-massage="<?= $this->session->flashdata('result'); ?>"></div>
    <!-- End Alert -->

    <a href="<?= base_url() ?>master/tambahKategori" class="btn btn-primary mb-3">Tambah</a>

    <table class="table text-black table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">Keterangan</th>
                <th class="text-center" scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>




</div>