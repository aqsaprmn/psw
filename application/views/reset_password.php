<div class="card o-hidden border-0 shadow-lg my-5 col-md-10 col-lg-6 mx-auto">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900">Reset Password</h1>
                        <h6 class="mb-4"><?= $this->session->userdata('reset_passmail'); ?></h6>
                    </div>
                    <form class="user" method="post" action="<?= base_url('user') ?>/gantipassword">
                        <div class="form-group password">
                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password" value="<?= set_value('password1'); ?>">
                            <a class="text-dark eye" href="#"><i class="fas fa-eye"></i></a>
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group password">
                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Konfirmasi Password" value="<?= set_value('password2'); ?>">
                            <a class="text-dark eye" href="#"><i class="fas fa-eye"></i></a>
                            <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <button class=" btn btn-primary btn-user btn-block">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>