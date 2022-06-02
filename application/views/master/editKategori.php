<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="px-5 py-4 shadow text-black rounded-3" style="background-color: white;font-size: 0.9rem;">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0"><?= $title; ?></h4>
    </div>

    <form action="<?= base_url('master/editKategori/') . $kate['id'] ?>" method="post">

        <div class="mb-3 row">
            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-8 ">
                <input type="text" class="form-control ml-3" name="keterangan" id="keterangan" value="<?= $kate['keterangan']; ?>">
                <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-8 px-4">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="<?= base_url('master/kategori') ?>" class="btn btn-danger">Batal</a>
            </div>
        </div>
    </form>

</div>