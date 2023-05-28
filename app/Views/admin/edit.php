<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center align-middle">

        <div class=" col-md-6">

            <div class="rounded-md o-hidden border-0 shadow-lg mb-5">
                <div class=" p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row-register">
                        <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                        <div class="col-lg-12">
                            <div class="px-5 pt-5 pb-3 my-4">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900 font-weight-bold">Update</h1>
                                    <hr class="my-2 mx-5">
                                    <small class="small font-weight-bold text-gray-900">Edit The User Communities Data</small>
                                </div>

                                <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

                                <form class="user" action="<?= base_url() ?>/update-email/<?= user_id(); ?>" method="post">
                                    <?= csrf_field() ?>

                                    <div class="form-group">
                                        <input type="text" style="text-transform: uppercase;" class="form-control form-control-user <?php if (session('errors.fullname')) : ?>is-invalid<?php endif ?>" name="fullname" placeholder="Fullname" value="<?= user()->fullname; ?>" autofocus>
                                    </div>
                                    <div class="form-group row-password">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" style="text-transform: uppercase;" class="form-control form-control-user <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="Aliases" value="<?= user()->username; ?>">
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control form-control-user <?php if (session('errors.NIK')) : ?>is-invalid<?php endif ?>" name="NIK" placeholder="NIK" value="<?= user()->NIK; ?>">
                                            <div class="invalid-feedback">
                                                Please choose a NIK.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" value="<?= user()->email; ?>" name="email" placeholder="Email">
                                    </div>
                                    <button type="submit" class="font-weight-bold btn btn-peach btn-user btn-block">
                                        UPDATE
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>