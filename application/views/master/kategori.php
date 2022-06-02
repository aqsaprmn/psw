<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="kategori" class="px-5 py-4 shadow text-black rounded-3" style="background-color: white;font-size: 0.9rem;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0"><?= $title; ?></h4>
    </div>

    <!-- Alert -->
    <div class="flash-message" data-text="<?= ($this->session->flashdata('result') == "Berhasil") ? "Kategori Berhasil Ditambahkan" : "Kategori Gagal Ditambahkan"; ?>" data-title="Kategori" data-massage="<?= $this->session->flashdata('result'); ?>"></div>
    <!-- End Alert -->

    <a href="<?= base_url() ?>master/tambahKategori" class="btn btn-primary mb-3">Tambah</a>

    <table data-delete="<?= base_url('master/deleteKategori') ?>" class="table text-black table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">Keterangan</th>
                <th class="text-center" scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($kategori as $kt) : ?>
                <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td><?= $kt['keterangan']; ?></td>
                    <td class="text-center"><a class="btn btn-primary" href="<?= base_url('master/editKategori/') . $kt['id']; ?>">Edit</a><button data-id="<?= $kt['id']; ?>" class="btn btn-danger mx-1 delete">Delete</button></td>
                </tr>
                <?php $no++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>


</div>