<div class="card o-hidden border-0 shadow-lg my-5 col-md-10 col-lg-6 mx-auto">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <?= $this->session->flashdata('message'); ?>
                    <form class="user" method="post" action="<?= base_url('user') ?>/registration">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group password">
                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password" value="<?= set_value('password1'); ?>">
                            <a class="text-dark eye" href="#"><i class="fas fa-eye"></i></a>
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group password">
                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password" value="<?= set_value('password2'); ?>">
                            <a class="text-dark eye" href="#"><i class="fas fa-eye"></i></a>
                            <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <button class=" btn btn-primary btn-user btn-block">
                            Register Account
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?= base_url('user') ?>/forgotpassword">Lupa Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="<?= base_url('user') ?>">Sudah punya akun? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>