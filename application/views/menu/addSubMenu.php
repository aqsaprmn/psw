<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="subMenuGo" class="px-5 py-4 shadow text-black rounded-3" style="background-color: white;font-size: 0.9rem;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0"><?= $title; ?></h4>
    </div>

    <!-- Alert -->
    <?= $this->session->flashdata('message'); ?>
    <!-- End Alert -->

    <button id="tambah" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#subMenuModal">Tambah</button>

    <table data-url="<?= base_url('menu'); ?>/addSubMenu" data-urlHapus="<?= base_url('menuapi') ?>/deleteSubMenuGo" data-urlIdMenu="<?= base_url('menuapi') ?>/readIdSubMenuGo" data-urlRead="<?= base_url('menuapi') ?>/readSubMenuGo" class="table text-black table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">Menu</th>
                <th class="text-center" scope="col">Sub Menu</th>
                <th class="text-center" scope="col">URL</th>
                <th class="text-center" scope="col">Icon</th>
                <th class="text-center" scope="col">Aktif</th>
                <th class="text-center" scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="subMenuModal" tabindex="-1" aria-labelledby="subMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div id="subMenuGoModal" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subMenuModalLabel">Tambah Sub Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="id_menu" class="col-sm-2 col-form-label">Nama Menu</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="id_menu" name="id_menu" aria-label="Default select example">
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id'] ?>"><?= $m['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Nama Sub Menu</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="title">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="url" class="col-sm-2 col-form-label">URL</label>
                        <div class="col-sm-10">
                            <input type="text" name="url" class="form-control" id="url">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                        <div class="col-sm-10">
                            <input type="text" name="icon" class="form-control" id="icon">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                            <div class="form-check text-center form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" role="switch" id="is_active" checked value="">
                                <label class="form-check-label" for="is_active">Aktif ?</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="tutup" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <a id="tambah" href="<?= base_url('menuapi') ?>/addSubMenuGo" type="button" class="btn btn-primary">Tambah</a>
                        <a id="simpan" hidden href="<?= base_url('menuapi') ?>/editSubMenuGo" type="button" class="btn btn-primary">Simpan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>