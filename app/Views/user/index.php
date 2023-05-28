<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
    <!-- Page Heading -->

    <div class="row d-flex justify-content-center">
        <div class="custom-card pt-1">
            <h1 class="h3 mt-4 text-gray-800 font-weight-bold">My Profile</h1>
            <div class="img text-center align-middle">
                <img class="w-100 p-3" src="<?= base_url('img/' . user()->user_image); ?>" alt="<?= user()->username ?>">
            </div>
            <div class="info mt-4">
                <span><?= user()->username ?></span><br>
                <span><?= user()->fullname ?></span><br>
                <span><?= user()->NIK ?></span>
                <?php if (in_groups('supervisor')) : ?>
                    <p class="mb-0">Supervisor</p>
                <?php elseif (in_groups('admin')) : ?>
                    <p class="mb-0">Admin</p>
                <?php elseif (in_groups('engineer')) : ?>
                    <p class="mb-0">Engineer</p>
                <?php else : ?>
                    <p class="mb-0">Manager</p>
                <?php endif; ?>
            </div>
            <a href="<?= base_url('/change-email'); ?>" class=""><i class="fas fa-user-circle ml-0 mr-2"></i> Change Data</a>
            <a href="<?= base_url('/change-password'); ?>" class="mt-1 pl-4"><i class="fas fa-key mr-2"></i> Change Password</a>
            <form method="post" action="<?= base_url('/sendEmail'); ?>">
                <button type="submit" class="mt-1 pl-4">Send Email</button>
            </form>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>