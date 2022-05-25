<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="roleAkses" class="px-5 py-4 shadow text-black rounded-3" style="background-color: white;font-size: 0.9rem;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0"><?= $title; ?></h4>
    </div>

    <!-- Button Modal -->
    <button id="tambah" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#roleModal">Tambah</button>

    <table id="tableRole" data-urlReadData="<?= base_url('admin') ?>/readDataRole" data-urlHapus="<?= base_url('admin') ?>/deleteRole" data-urlReadIdRole="<?= base_url('admin') ?>/readIdRole" class="table table-bordered table-striped table-hover text-black">
        <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th scope="col">Nama Peran</th>
                <th class="text-center" scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleModalLabel">Tambah Peran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row ">
                        <label for="role_name" class="col-sm-2 col-form-label">Nama Peran</label>
                        <div class="col-sm-10">
                            <input type="text" name="role_name" class="form-control" id="role_name" autofocus>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="tutup" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a id="tambah" href="<?= base_url('admin') ?>/addRole" type="button" class="btn btn-primary">Tambah</a>
                    <a id="simpan" hidden href="<?= base_url('admin') ?>/editRole" type="button" class="btn btn-primary">Simpan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Akses Menu-->
    <div class="modal fade" id="aksesModal" tabindex="-1" aria-labelledby="aksesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aksesModalLabel">Beri Peran Akses Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row px-3">
                        <table data-urlMenu="<?= base_url('menuapi') ?>" class="table table-bordered table-striped table-hover text-black" id="tableAkses">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th scope="col">Judul Menu</th>
                                    <th class="text-center" scope="col">Akses</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="tutup" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a id="simpan" href="<?= base_url('admin') ?>/editAkses" class="btn btn-primary">Simpan</a>
                </div>
            </div>
        </div>
    </div>
</div>