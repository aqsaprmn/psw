<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="titleMenu" class="px-5 py-4 shadow text-black rounded-3" style="background-color: white;font-size: 0.9rem;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0"><?= $title; ?></h4>
    </div>

    <!-- Alert -->
    <!-- End Alert -->

    <button id="tambah" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#judulMenuModal">Tambah</button>

    <table data-url="<?= base_url('menu'); ?>" data-urlHapus="<?= base_url('menuapi') ?>/deleteTitleMenuGo" data-urlIdMenu="<?= base_url('menuapi') ?>/readIdMenu" data-urlRead="<?= base_url('menuapi') ?>/readTitleMenuGo" class="table text-black table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th scope="col">Judul Menu</th>
                <th class="text-center" scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="judulMenuModal" tabindex="-1" aria-labelledby="judulMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div id="titleMenuModal" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulMenuModalLabel">Tambah Judul Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row ">
                        <label for="menu" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" name="menu" class="form-control" id="menu" autofocus>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="tutup" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a id="tambah" href="<?= base_url('menuapi') ?>/addTitleMenuGo" type="button" class="btn btn-primary">Tambah</a>
                    <a id="simpan" hidden href="<?= base_url('menuapi') ?>/editTitleMenuGo" type="button" class="btn btn-primary">Simpan</a>
                </div>
            </div>
        </div>
    </div>
</div>