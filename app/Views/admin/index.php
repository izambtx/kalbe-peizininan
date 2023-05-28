<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-4">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <!-- Page Heading -->
    <div class="row">
        <div class="col-auto mr-auto">
            <a href="<?= base_url('admin/create') ?>" class="btn btn-outline-primary"><i class="fas fa-plus-circle"> </i> Add New</a>
        </div>
        <div class="col-auto mt-1">
            <form action="" method="post" class="form-inline border border-secondary rounded-lg bg-white mr-3">
                <button type="submit" class="btn-cari border-0 rounded-circle m-1"><i class="fas fa-search"></i></button>
                <input name="keyword" value="<?= $keyword; ?>" class="pl-1 form-control rounded-right-lg border-0" placeholder="Search" type="search" aria-label="Search">
            </form>
            <!-- <form action="" method="post" class="form-inline rounded-lg bg-white mr-3">
                    <input name="keyword" value="<?= $keyword; ?>" class="pl-3 form-control rounded-lg" placeholder="Search" type="search" aria-label="Search">
                </form> -->
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    </div>


    <div class="row">
        <div class="card text-center shadow mx-auto table-responsive">
            <table class="table table-striped table-bordered font-weight-bold">
                <thead class="text-success">
                    <tr>
                        <td scope="col">No</td>
                        <td scope="col">NIK</td>
                        <td scope="col">Fullname</td>
                        <td scope="col">Department</td>
                        <td scope="col">Role</td>
                        <td scope="col">Action</td>
                    </tr>
                </thead>
                <tbody class="text-gray-900">
                    <?php $i = 1; ?>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td class="align-middle" scope="row"><?= $i++; ?></td>
                            <td class="align-middle"><?= $user->NIK; ?></td>
                            <td class="align-middle"><?= $user->fullname; ?></td>
                            <td class="align-middle"><?= $user->nama_distribusi; ?></td>
                            <?php if ($user->name == 'user') : ?>
                                <td class="align-middle">
                                    <h5><span class="badge badge-primary"><?= $user->name; ?></span></h5>
                                </td>
                            <?php elseif ($user->name == 'admin') : ?>
                                <td class="align-middle">
                                    <h5><span class="badge badge-danger"><?= $user->name;  ?></span></h5>
                                </td>
                            <?php elseif ($user->name == 'supervisor') : ?>
                                <td class="align-middle">
                                    <h5><span class="badge badge-success"><?= $user->name;  ?></span></h5>
                                </td>
                            <?php elseif ($user->name == 'engineer') : ?>
                                <td class="align-middle">
                                    <h5><span class="badge badge-warning"><?= $user->name;  ?></span></h5>
                                </td>
                            <?php endif; ?>
                            <td class="align-middle">
                                <a href="<?= base_url('admin/' . $user->UI) ?>" class="btn btn-sm rounded-circle">
                                    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/mrjuyheh.json" trigger="hover" colors="outline:#121331,primary:#231e2d,secondary:#545454,tertiary:#ebe6ef" style="width:25px;height:25px">
                                    </lord-icon>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'pager'); ?>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>