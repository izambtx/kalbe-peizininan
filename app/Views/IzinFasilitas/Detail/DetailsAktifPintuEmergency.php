<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <!-- Content Card -->
    <div class="card text-center shadow pt-5">
        <div class="table-responsive">
            <table class="table text-gray-900 my-auto">
                <tbody>
                    <tr>
                        <td scope="col" class="align-middle border-0">
                            <img src="/img/kalbe.png" width="130" alt="Logo Kalbe">
                        </td>
                        <td scope="col" class="align-middle border-0">
                            IZIN PENONAKTIFAN DAN PENGGUNAAN FASILITAS EMERGENCY DALAM KONDISI NORMAL
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider m-1 border-dark">
        </hr>

        <!-- Divider -->
        <hr class="sidebar-divider m-1 border-dark">
        </hr>

        <form class="" action="/PenonAktifanFasilitas/PintuEmergency/<?= $pintu['id']; ?>" method="post">
            <?= csrf_field(); ?>

            <div class="row my-4 mx-3">
                <div class="col-auto mr-auto my-auto">
                    <div class="text-left ml-4">
                        <h5 class="text-gray-900 font-weight-bold ">
                            B. Penon-aktifan
                            &nbsp;
                        </h5>
                        <small class="my-auto">
                            (Segel sudah dibuka.)
                        </small>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <!-- <a target="_blank" href="/IzinFasilitas/PintuEmergency/Details/<?= $pintu['id']; ?>" class="cssbuttons-io-button">
                        <span class="font-weight-bold">Detail Izin</span>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path>
                            </svg>
                        </div>
                    </a> -->
                    <button type="button" data-toggle="modal" data-target="#detailModal" class="cssbuttons-io-button">
                        <span class="font-weight-bold">Detail Izin</span>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path>
                            </svg>
                        </div>
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <div class="col-auto">

                    <div class="form-row ml-5">
                        <div class="my-auto col-7">
                            <input <?php if ($aktifasi_izin['off_at']) : ?>disabled type="text" value="<?= date('d F Y, h:i A', strtotime($aktifasi_izin['off_at'])); ?>" <?php else : ?> type="datetime-local" <?php endif ?> required class="form-control rounded-sm <?php if (session('validation.off_at')) : ?>is-invalid<?php endif ?>" id="off_at" name="off_at" value="<?= date('l, d F Y / H:i'); ?>">
                            <div class="invalid-feedback">
                                <?= session('validation.off_at') ?>
                            </div>
                            <input type="hidden" value="<?= $aktifasi_izin['id']; ?>" id="id_aktifasi" name="id_aktifasi">
                        </div>
                        <div class="my-2 col-7">
                            <textarea rows="5" required <?php if (($aktifasi_izin['off_at'])) : ?>disabled <?php endif ?> class="form-control rounded-sm <?php if (session('validation.note_off')) : ?>is-invalid<?php endif ?>" id="note_off" name="note_off" placeholder="Note"><?php if ($aktifasi_izin['off_at']) : ?><?= $aktifasi_izin['note_off']; ?> <?php endif ?></textarea>
                            <div class="invalid-feedback">
                                <?= session('validation.note_off') ?>
                            </div>
                        </div>
                        <div class="my-auto col-7">
                            <?php if (empty($aktifasi_izin['off_at'])) : ?>
                                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check-circle"></i></button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if ($pintu['status'] = 'OFF') : ?>
                    <div class="col-sm-3 mr-5 pr-5 my-auto">
                        <table class="table table-bordered text-gray-900 my-auto">
                            <tbody>
                                <tr>
                                    <td style="max-width: 1rem;">
                                        <small class="font-weight-bold text-gray-900">Nama PIC (Spv) :</small>
                                        <br>
                                        <?php if ($aktifasi_izin['off_at']) : ?>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $aktifasi_off['username']; ?></span>
                                            <br>
                                            <br>
                                            <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($aktifasi_izin['off_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($aktifasi_izin['off_at'])); ?></small>
                                        <?php else : ?>
                                            <br>
                                            <h4 class="font-weight-bold text-gray-900 my-auto">NA</h4>
                                            <br>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </form>

        <?php if ($aktifasi_izin['off_at']) : ?>
            <form action="/PenonAktifanFasilitas/aktif/PintuEmergency/<?= $aktifasi_izin['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="row my-4 mx-3">
                    <div class="col-auto mr-auto my-auto">
                        <div class="text-left ml-4">
                            <h5 class="text-gray-900 font-weight-bold ">
                                C. Pengaktifan (Closing Izin)
                                &nbsp;
                            </h5>
                            <small class="my-auto">
                                (Segel pintu (kawat/stiker) sudah dipasang.)
                            </small>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <div class="col-auto">

                        <div class="form-row ml-5">
                            <div class="my-auto col-7">
                                <input <?php if ($aktifasi_izin['on_at']) : ?>disabled type="text" value="<?= date('d F Y, h:i A', strtotime($aktifasi_izin['on_at'])); ?>" <?php else : ?> type="datetime-local" <?php endif ?> required class="form-control rounded-sm <?php if (session('validation.on_at')) : ?>is-invalid<?php endif ?>" id="on_at" name="on_at" value="<?= date('l, d F Y / H:i'); ?>">
                                <div class="invalid-feedback">
                                    <?= session('validation.on_at') ?>
                                </div>
                                <input type="hidden" value="<?= $pintu['id']; ?>" id="id_izin" name="id_izin">
                            </div>
                            <div class="my-2 col-7">
                                <textarea rows="5" required <?php if (($aktifasi_izin['on_at'])) : ?>disabled <?php endif ?> class="form-control rounded-sm <?php if (session('validation.note_on')) : ?>is-invalid<?php endif ?>" id="note_on" name="note_on" placeholder="Note"><?php if ($aktifasi_izin['on_at']) : ?><?= $aktifasi_izin['note_on']; ?> <?php endif ?></textarea>
                                <div class="invalid-feedback">
                                    <?= session('validation.note_on') ?>
                                </div>
                            </div>
                            <div class="my-auto col-7">
                                <?php if (empty($aktifasi_izin['on_at'])) : ?>
                                    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check-circle"></i></button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 mr-5 pr-5 my-auto">
                        <table class="table table-bordered text-gray-900 my-auto">
                            <tbody>
                                <tr>
                                    <td style="max-width: 1rem;">
                                        <small class="font-weight-bold text-gray-900">Nama PIC (Spv) :</small>
                                        <br>
                                        <?php if ($aktifasi_izin['on_at']) : ?>
                                            <br>
                                            <span class="font-weight-bold text-gray-900"><?= $aktifasi_on['username']; ?></span>
                                            <br>
                                            <br>
                                            <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($aktifasi_izin['on_at'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($aktifasi_izin['on_at'])); ?></small>
                                        <?php else : ?>
                                            <br>
                                            <h4 class="font-weight-bold text-gray-900 my-auto">NA</h4>
                                            <br>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>

            <?php if ($aktifasi_izin['on_at']) : ?>
                <div class="table-responsive px-5 my-3">
                    <table class="table table-bordered text-gray-900 my-auto">
                        <thead>
                            <tr>
                                <?php if ($pintu['lokasi_2']) {
                                    $colspan = 4;
                                    if ($pintu['lokasi_2'] || $pintu['lokasi_3']) {
                                        $colspan =  5;
                                    }
                                } else {
                                    $colspan = 3;
                                }
                                ?>
                                <td scope="col" colspan="<?= $colspan; ?>">Mengetahui</td>
                                <td scope="col">Menyetujui</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="max-width: 7rem;">
                                    <span class="font-weight-bold text-gray-900"><?= $aktifasi_on['username']; ?></span>
                                    <br>
                                    <br>
                                    <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($aktifasi_izin['on_at'])); ?></small>
                                    <br>
                                    <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($aktifasi_izin['on_at'])); ?></small>
                                    <br>
                                    <br>
                                    <small class="font-weight-bold text-gray-900m">Penangggung Jawab</small><br>
                                    <small class="font-weight-bold text-gray-900">Pekerjaan (Spv/Mgr)</small>
                                </td>
                                <td style="max-width: 7rem;">
                                    <?php if (empty($aktifasi_izin['approved_at'])) : ?>
                                        <br>
                                        <br>
                                        <h3 class="font-weight-bold">NA</h3>
                                        <br>
                                    <?php else : ?>
                                        <span class="font-weight-bold text-gray-900"><?= $pintu2['username']; ?></span>
                                        <br>
                                        <br>
                                        <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($aktifasi_izin['approved_at'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($aktifasi_izin['approved_at'])); ?></small>
                                        <br>
                                        <br>
                                    <?php endif; ?>
                                    <small class="font-weight-bold text-gray-900">Penangggung Jawab</small>
                                    <small class="font-weight-bold text-gray-900">Lokasi Fasilitas Emergensi (Spv/Mgr)</small>
                                </td>
                                <?php if ($pintu['lokasi_2']) : ?>
                                    <td style="max-width: 7rem;">
                                        <?php if (empty($aktifasi_izin['approved_at_2'])) : ?>
                                            <br>
                                            <br>
                                            <h3 class="font-weight-bold">NA</h3>
                                            <br>
                                        <?php else : ?>
                                            <span class="font-weight-bold text-gray-900"><?= $pintu2['username']; ?></span>
                                            <br>
                                            <br>
                                            <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($pintu['approved_at_2'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($pintu['approved_at_2'])); ?></small>
                                            <br>
                                            <br>
                                        <?php endif; ?>
                                        <small class="font-weight-bold text-gray-900">Penangggung Jawab</small>
                                        <small class="font-weight-bold text-gray-900">Lokasi Fasilitas Emergensi 2 (Spv/Mgr)</small>
                                    </td>
                                    <?php if ($pintu['lokasi_2'] || $pintu['lokasi_3']) : ?>
                                        <td style="max-width: 7rem;">
                                            <?php if (empty($aktifasi_izin['approved_at_3'])) : ?>
                                                <br>
                                                <br>
                                                <h3 class="font-weight-bold">NA</h3>
                                                <br>
                                            <?php else : ?>
                                                <span class="font-weight-bold text-gray-900"><?= $pintu2['username']; ?></span>
                                                <br>
                                                <br>
                                                <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($pintu['approved_at_3'])); ?></small>
                                                <br>
                                                <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($pintu['approved_at_3'])); ?></small>
                                                <br>
                                                <br>
                                            <?php endif; ?>
                                            <small class="font-weight-bold text-gray-900">Penangggung Jawab</small>
                                            <small class="font-weight-bold text-gray-900">Lokasi Fasilitas Emergensi 3 (Spv/Mgr)</small>
                                        </td>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <td>
                                    <?php if (empty($aktifasi_izin['checked_at'])) : ?>
                                        <br>
                                        <br>
                                        <h3 class="font-weight-bold">NA</h3>
                                        <br>
                                    <?php else : ?>
                                        <span class="font-weight-bold text-gray-900"><?= $pintu3['username']; ?></span>
                                        <br>
                                        <br>
                                        <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($aktifasi_izin['checked_at'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($aktifasi_izin['checked_at'])); ?></small>
                                        <br>
                                        <br>
                                    <?php endif; ?>
                                    <small class="font-weight-bold text-gray-900">Engineering</small><br>
                                    <small class="font-weight-bold text-gray-900">(Spv/Mgr)</small>
                                </td>
                                <td style="max-width: 7rem;">
                                    <?php if (empty($aktifasi_izin['agreed_at'])) : ?>
                                        <br>
                                        <br>
                                        <h3 class="font-weight-bold">NA</h3>
                                        <br>
                                        <br>
                                    <?php else : ?>
                                        <span class="font-weight-bold text-gray-900"><?= $pintu4['username']; ?></span>
                                        <br>
                                        <br>
                                        <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($aktifasi_izin['agreed_at'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($aktifasi_izin['agreed_at'])); ?></small>
                                        <br>
                                        <br>
                                    <?php endif; ?>
                                    <small class="font-weight-bold text-gray-900">Ketua ERT</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <br>
    </div>
</div>

<!-- Detail Status Modal -->

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table text-center text-gray-900">
                    <thead>
                        <tr>
                            <td scope="col">#</td>
                            <td scope="col">Nama</td>
                            <td scope="col">Status</td>
                            <td scope="col">Tanggal</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">1</td>
                            <td><?= $pintu['pembuat']; ?></td>
                            <td>Created</td>
                            <td>
                                <?= date('d M Y', strtotime($pintu['created_at'])); ?>
                                <?= date('H : i : s', strtotime($pintu['created_at'])); ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">2</td>
                            <td><?= $pintu['PIC']; ?></td>
                            <td>Approved PIC</td>
                            <td>
                                <?= date('d M Y', strtotime($pintu['approved_at'])); ?>
                                <?= date('H : i : s', strtotime($pintu['approved_at'])); ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">3</td>
                            <td><?= $pintu['engineer']; ?></td>
                            <td>Approved Engineer</td>
                            <td>
                                <?= date('d M Y', strtotime($pintu['checked_at'])); ?>
                                <?= date('H : i : s', strtotime($pintu['checked_at'])); ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">4</td>
                            <td><?= $pintu['ketua_ert']; ?></td>
                            <td>Approved Ketua ERT</td>
                            <td>
                                <?= date('d M Y', strtotime($pintu['agreed_at'])); ?>
                                <?= date('H : i : s', strtotime($pintu['agreed_at'])); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>

<!-- Detail Izin Modal -->

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content mb-0 rounded-md border-0">
            <div class="modal-header bg-gradient-peach rounded-top">
                <h5 class="modal-title text-white font-weight-bold" id="exampleModalLabel">Detail Izin Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->include('ModalDetailPerizinan/ModalDetailPintuEmergency'); ?>
            </div>
        </div>
    </div>
</div>
<!-- End Of Modal -->

<?= $this->endSection(); ?>