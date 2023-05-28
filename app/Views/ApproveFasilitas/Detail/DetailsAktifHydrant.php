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

        <form class="" action="/PenonAktifanFasilitas/Hydrant/<?= $pintu['id']; ?>" method="post">
            <?= csrf_field(); ?>

            <div class="row my-4 mx-3 d-flex justify-content-between">
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
                <div class="d-flex justify-content-end">
                    <!-- <a target="_blank" href="/ApproveFasilitas/Hydrant/Details/<?= $pintu['id']; ?>" class="cssbuttons-io-button">
                        <span class="font-weight-bold">Detail Izin</span>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path>
                            </svg>
                        </div>
                    </a> -->

                    <?php if (in_groups('OHSE')) : ?>
                        <button type="button" class="button-status mt-1" data-toggle="modal" data-target="#staticBackdrop">
                            Detail Status
                        </button>
                    <?php endif; ?>
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
                            <input disabled type="text" value="<?= date('d F Y, h:i A', strtotime($aktifasi_izin['off_at'])); ?>" class="bg-light form-control rounded-sm <?php if (session('validation.off_at')) : ?>is-invalid<?php endif ?>" id="off_at" name="off_at" value="<?= date('l, d F Y / H:i'); ?>">
                            <div class="invalid-feedback">
                                <?= session('validation.off_at') ?>
                            </div>
                        </div>
                        <div class="my-2 col-7">
                            <textarea rows="5" disabled class="bg-light form-control rounded-sm <?php if (session('validation.note_off')) : ?>is-invalid<?php endif ?>" id="note_off" name="note_off" placeholder="Note"><?php if ($aktifasi_izin['off_at']) : ?><?= $aktifasi_izin['note_off']; ?> <?php endif ?></textarea>
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
            </div>
        </form>
        <br>

        <?php if ($pintu['agreed_at']) : ?>
            <form class="" action="/PengaktifanFasilitas/Hydrant/<?= $aktifasi_izin['id']; ?>" method="post">
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
                                <input type="text" disabled value="<?php if ($aktifasi_izin['on_at']) : ?><?= date('d F Y, h:i A', strtotime($aktifasi_izin['on_at'])); ?><?php endif ?>" class="bg-light form-control rounded-sm <?php if (session('validation.on_at')) : ?>is-invalid<?php endif ?>" id="on_at" name="on_at" value="<?= date('l, d F Y / H:i'); ?>">
                                <div class="invalid-feedback">
                                    <?= session('validation.on_at') ?>
                                </div>
                                <input type="hidden" value="<?= $pintu['id']; ?>" id="id_izin" name="id_izin">
                            </div>
                            <div class="my-2 col-7">
                                <textarea rows="5" disabled class="bg-light form-control rounded-sm <?php if (session('validation.note_on')) : ?>is-invalid<?php endif ?>" id="note_on" name="note_on" placeholder="Note"><?php if ($aktifasi_izin['on_at']) : ?><?= $aktifasi_izin['note_on']; ?> <?php endif ?></textarea>
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
        <?php endif; ?>

        <div class="table-responsive px-5 my-3">
            <?php if ($aktifasi_izin['on_at']) : ?>
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
                            } ?>
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
                                    <?php if (in_groups('manager') && $pintu['lokasi'] == user()->lokasi) : ?>
                                        <br>
                                        <br>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal">Approve</button>
                                        <br>
                                        <br>
                                    <?php else : ?>
                                        <br>
                                        <br>
                                        <h3 class="font-weight-bold">NA</h3>
                                        <br>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <span class="font-weight-bold text-gray-900"><?= $aktifasi_pic['username']; ?></span>
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
                                        <?php if (in_groups('manager') && empty($aktifasi_izin['approved_at_2']) && $pintu['lokasi_2'] == user()->lokasi) : ?>
                                            <br>
                                            <br>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal2">Approve</button>
                                            <br>
                                            <br>
                                        <?php else : ?>
                                            <br>
                                            <br>
                                            <h3 class="font-weight-bold">NA</h3>
                                            <br>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <span class="font-weight-bold text-gray-900"><?= $aktifasi_pic_2['username']; ?></span>
                                        <br>
                                        <br>
                                        <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($aktifasi_izin['approved_at_2'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($aktifasi_izin['approved_at_2'])); ?></small>
                                        <br>
                                        <br>
                                    <?php endif; ?>
                                    <small class="font-weight-bold text-gray-900">Penangggung Jawab</small>
                                    <small class="font-weight-bold text-gray-900">Lokasi Fasilitas Emergensi 2 (Spv/Mgr)</small>
                                </td>
                                <?php if ($pintu['lokasi_2'] || $pintu['lokasi_3']) : ?>
                                    <td style="max-width: 7rem;">
                                        <?php if (empty($aktifasi_izin['approved_at_3'])) : ?>
                                            <?php if (in_groups('manager') && empty($aktifasi_izin['approved_at_3']) && $pintu['lokasi_3'] == user()->lokasi) : ?>
                                                <br>
                                                <br>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal3">Approve</button>
                                                <br>
                                                <br>
                                            <?php else : ?>
                                                <br>
                                                <br>
                                                <h3 class="font-weight-bold">NA</h3>
                                                <br>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <span class="font-weight-bold text-gray-900"><?= $aktifasi_pic_3['username']; ?></span>
                                            <br>
                                            <br>
                                            <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($aktifasi_izin['approved_at_3'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($aktifasi_izin['approved_at_3'])); ?></small>
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
                                    <?php if (in_groups('engineer') && empty($aktifasi_izin['evaluated_at'])) : ?>
                                        <br>
                                        <br>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal">Approve</button>
                                        <br>
                                        <br>
                                    <?php else : ?>
                                        <br>
                                        <br>
                                        <h3 class="font-weight-bold">NA</h3>
                                        <br>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <span class="font-weight-bold text-gray-900"><?= $aktifasi_eng['username']; ?></span>
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
                                    <?php if (in_groups('ERT')) : ?>
                                        <br>
                                        <br>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal">Approve</button>
                                        <br>
                                        <br>
                                    <?php else : ?>
                                        <br>
                                        <br>
                                        <h3 class="font-weight-bold">NA</h3>
                                        <br>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <span class="font-weight-bold text-gray-900"><?= $aktifasi_ert['username']; ?></span>
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
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Start of Modal -->

<!-- Aprrove Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mb-0 rounded-md border-0">
            <div class="modal-header bg-success rounded-top">
                <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Approve Izin Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/img/sending.gif" class="w-25 mx-auto d-block">
                    <h4 class="text-center font-weight-bold text-gray-900">Yakin Menyetujui Izin Berikut?</h4>
                    <h6 class="small text-center text-gray-900">Periksa Ulang Bahwa Data Dibawah Benar</h6>

                    <?php if (in_groups('manager')) : ?>
                        <form action="/PengaktifanFasilitas/Hydrant/approve/<?= $pintu['id']; ?>" method="post">
                            <?= csrf_field();  ?>
                            <input type="hidden" value="<?= $aktifasi_izin['id']; ?>" id="id_aktifasi" name="id_aktifasi">
                            <div class="form-group row mb-0 mt-5">
                                <label for="lokasi1" class="col-sm-4 col-form-label">Lokasi </label>
                                <div class="col-sm-8">
                                    <p id="lokasi1" name="lokasi1" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['nama_lokasi']; ?></p>
                                </div>
                            </div>
                            <?php if ($pintu['lokasi_2']) : ?>
                                <div class="form-group row mb-0 mt-2">
                                    <label for="lokasi2" class="col-sm-4 col-form-label">Lokasi 2</label>
                                    <div class="col-sm-8">
                                        <p id="lokasi2" name="lokasi2" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $lokasi2['nama_lokasi']; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($pintu['lokasi_3']) : ?>
                                <div class="form-group row mb-0 mt-2">
                                    <label for="lokasi3" class="col-sm-4 col-form-label">Lokasi 3</label>
                                    <div class="col-sm-8">
                                        <p id="lokasi3" name="lokasi3" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $lokasi3['nama_lokasi']; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group row mb-0">
                                <label for="noreg" class="col-sm-4 col-form-label">No. Registrasi </label>
                                <div class="col-sm-8">
                                    <p id="noreg" name="noreg" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['no_registrasi']; ?></p>
                                </div>
                            </div>
                            <?php if (empty($pintu['checked_at'])) : ?>
                                <input type="hidden" value="Approved PIC" id="status" name="status">
                            <?php else : ?>
                                <input type="hidden" value="Approved Spv/Mgr" id="status" name="status">
                            <?php endif; ?>
                            <div class="form-group row mb-0">
                                <label for="approveopl" class="col-sm-4 col-form-label">Approver </label>
                                <div class="col-sm-8">
                                    <input type="hidden" value="<?= user()->id; ?>" id="approveopl" name="approveopl"></input>
                                    <p class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success px-4 mx-2 mt-5">Approve</button>
                            </div>
                        </form>

                    <?php elseif (in_groups('engineer')) : ?>
                        <form action="/PengaktifanFasilitas/Hydrant/check/<?= $pintu['id']; ?>" method="post">
                            <?= csrf_field();  ?>
                            <input type="hidden" value="<?= $aktifasi_izin['id']; ?>" id="id_aktifasi" name="id_aktifasi">
                            <div class="form-group row mb-0 mt-5">
                                <label for="lokasi1" class="col-sm-4 col-form-label">Lokasi </label>
                                <div class="col-sm-8">
                                    <p id="lokasi1" name="lokasi1" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['nama_lokasi']; ?></p>
                                </div>
                            </div>
                            <?php if ($pintu['lokasi_2']) : ?>
                                <div class="form-group row mb-0 mt-2">
                                    <label for="lokasi2" class="col-sm-4 col-form-label">Lokasi 2</label>
                                    <div class="col-sm-8">
                                        <p id="lokasi2" name="lokasi2" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $lokasi2['nama_lokasi']; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($pintu['lokasi_3']) : ?>
                                <div class="form-group row mb-0 mt-2">
                                    <label for="lokasi3" class="col-sm-4 col-form-label">Lokasi 3</label>
                                    <div class="col-sm-8">
                                        <p id="lokasi3" name="lokasi3" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $lokasi3['nama_lokasi']; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group row mb-0">
                                <label for="noreg" class="col-sm-4 col-form-label">No. Registrasi </label>
                                <div class="col-sm-8">
                                    <p id="noreg" name="noreg" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['no_registrasi']; ?></p>
                                </div>
                            </div>
                            <?php if (empty($pintu['approved_at'])) : ?>
                                <input type="hidden" value="Approved Engineer" id="status" name="status">
                            <?php else : ?>
                                <input type="hidden" value="Approved Spv/Mgr" id="status" name="status">
                            <?php endif; ?>
                            <div class="form-group row mb-0">
                                <label for="approveopl" class="col-sm-4 col-form-label">Approver </label>
                                <div class="col-sm-8">
                                    <input type="hidden" value="<?= user()->id; ?>" id="approveopl" name="approveopl"></input>
                                    <p class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success px-4 mx-2 mt-5">Approve</button>
                            </div>
                        </form>

                    <?php elseif (in_groups('ERT')) : ?>
                        <form action="/PengaktifanFasilitas/Hydrant/agree/<?= $pintu['id']; ?>" method="post">
                            <?= csrf_field();  ?>
                            <input type="hidden" value="<?= $aktifasi_izin['id']; ?>" id="id_aktifasi" name="id_aktifasi">
                            <div class="form-group row mb-0 mt-5">
                                <label for="lokasi1" class="col-sm-4 col-form-label">Lokasi </label>
                                <div class="col-sm-8">
                                    <p id="lokasi1" name="lokasi1" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['nama_lokasi']; ?></p>
                                </div>
                            </div>
                            <?php if ($pintu['lokasi_2']) : ?>
                                <div class="form-group row mb-0 mt-2">
                                    <label for="lokasi2" class="col-sm-4 col-form-label">Lokasi 2</label>
                                    <div class="col-sm-8">
                                        <p id="lokasi2" name="lokasi2" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $lokasi2['nama_lokasi']; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($pintu['lokasi_3']) : ?>
                                <div class="form-group row mb-0 mt-2">
                                    <label for="lokasi3" class="col-sm-4 col-form-label">Lokasi 3</label>
                                    <div class="col-sm-8">
                                        <p id="lokasi3" name="lokasi3" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $lokasi3['nama_lokasi']; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group row mb-0">
                                <label for="noreg" class="col-sm-4 col-form-label">No. Registrasi </label>
                                <div class="col-sm-8">
                                    <p id="noreg" name="noreg" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['no_registrasi']; ?></p>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="approveopl" class="col-sm-4 col-form-label">Approver </label>
                                <div class="col-sm-8">
                                    <input type="hidden" value="<?= user()->id; ?>" id="approveopl" name="approveopl"></input>
                                    <p class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success px-4 mx-2 mt-5">Approve</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Aprrove Modal 2 -->
<div class="modal fade" id="approveModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mb-0 rounded-md border-0">
            <div class="modal-header bg-success rounded-top">
                <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Approve Izin Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/img/sending.gif" class="w-25 mx-auto d-block">
                    <h4 class="text-center font-weight-bold text-gray-900">Yakin Menyetujui Izin Berikut?</h4>
                    <h6 class="small text-center text-gray-900">Periksa Ulang Bahwa Data Dibawah Benar</h6>

                    <?php if (in_groups('manager')) : ?>
                        <form action="/PengaktifanFasilitas/Hydrant/approve2/<?= $pintu['id']; ?>" method="post">
                            <?= csrf_field();  ?>

                            <input type="hidden" value="<?= $aktifasi_izin['id']; ?>" id="id_aktifasi" name="id_aktifasi">
                            <div class="form-group row mb-0 mt-5">
                                <label for="lokasi1" class="col-sm-4 col-form-label">Lokasi </label>
                                <div class="col-sm-8">
                                    <p id="lokasi1" name="lokasi1" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['nama_lokasi']; ?></p>
                                </div>
                            </div>
                            <?php if ($pintu['lokasi_2']) : ?>
                                <div class="form-group row mb-0 mt-2">
                                    <label for="lokasi2" class="col-sm-4 col-form-label">Lokasi 2</label>
                                    <div class="col-sm-8">
                                        <p id="lokasi2" name="lokasi2" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $lokasi2['nama_lokasi']; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($pintu['lokasi_3']) : ?>
                                <div class="form-group row mb-0 mt-2">
                                    <label for="lokasi3" class="col-sm-4 col-form-label">Lokasi 3</label>
                                    <div class="col-sm-8">
                                        <p id="lokasi3" name="lokasi3" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $lokasi3['nama_lokasi']; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($pintu['no_registrasi']) : ?>
                                <div class="form-group row mb-0">
                                    <label for="noreg" class="col-sm-4 col-form-label">No. Registrasi </label>
                                    <div class="col-sm-8">
                                        <p id="noreg" name="noreg" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['no_registrasi']; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (empty($pintu['checked_at']) || empty($pintu['evaluated_at']) || empty($pintu['approved_at']) || empty($pintu['approved_at_2'])) : ?>
                                <input type="hidden" value="Approved PIC 3" id="status" name="status">
                            <?php else : ?>
                                <input type="hidden" value="Approved Spv/Mgr" id="status" name="status">
                            <?php endif; ?>
                            <div class="form-group row mb-0">
                                <label for="approveopl" class="col-sm-4 col-form-label">Approver </label>
                                <div class="col-sm-8">
                                    <input type="hidden" value="<?= user()->id; ?>" id="approveopl" name="approveopl"></input>
                                    <p class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success px-4 mx-2 mt-5">Approve</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Aprrove Modal 3 -->
<div class="modal fade" id="approveModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mb-0 rounded-md border-0">
            <div class="modal-header bg-success rounded-top">
                <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Approve Izin Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/img/sending.gif" class="w-25 mx-auto d-block">
                    <h4 class="text-center font-weight-bold text-gray-900">Yakin Menyetujui Izin Berikut?</h4>
                    <h6 class="small text-center text-gray-900">Periksa Ulang Bahwa Data Dibawah Benar</h6>

                    <?php if (in_groups('manager')) : ?>
                        <form action="/PengaktifanFasilitas/Hydrant/approve3/<?= $pintu['id']; ?>" method="post">
                            <?= csrf_field();  ?>

                            <input type="hidden" value="<?= $aktifasi_izin['id']; ?>" id="id_aktifasi" name="id_aktifasi">
                            <div class="form-group row mb-0 mt-5">
                                <label for="lokasi1" class="col-sm-4 col-form-label">Lokasi </label>
                                <div class="col-sm-8">
                                    <p id="lokasi1" name="lokasi1" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['nama_lokasi']; ?></p>
                                </div>
                            </div>
                            <?php if ($pintu['lokasi_2']) : ?>
                                <div class="form-group row mb-0 mt-2">
                                    <label for="lokasi2" class="col-sm-4 col-form-label">Lokasi 2</label>
                                    <div class="col-sm-8">
                                        <p id="lokasi2" name="lokasi2" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $lokasi2['nama_lokasi']; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($pintu['lokasi_3']) : ?>
                                <div class="form-group row mb-0 mt-2">
                                    <label for="lokasi3" class="col-sm-4 col-form-label">Lokasi 3</label>
                                    <div class="col-sm-8">
                                        <p id="lokasi3" name="lokasi3" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $lokasi3['nama_lokasi']; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($pintu['no_registrasi']) : ?>
                                <div class="form-group row mb-0">
                                    <label for="noreg" class="col-sm-4 col-form-label">No. Registrasi </label>
                                    <div class="col-sm-8">
                                        <p id="noreg" name="noreg" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['no_registrasi']; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (empty($pintu['checked_at']) || empty($pintu['evaluated_at']) || empty($pintu['approved_at']) || empty($pintu['approved_at_2'])) : ?>
                                <input type="hidden" value="Approved PIC 3" id="status" name="status">
                            <?php else : ?>
                                <input type="hidden" value="Approved Spv/Mgr" id="status" name="status">
                            <?php endif; ?>
                            <div class="form-group row mb-0">
                                <label for="approveopl" class="col-sm-4 col-form-label">Approver </label>
                                <div class="col-sm-8">
                                    <input type="hidden" value="<?= user()->id; ?>" id="approveopl" name="approveopl"></input>
                                    <p class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success px-4 mx-2 mt-5">Approve</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Status Modal -->

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-md">
            <div class="modal-header">
                <h5 class="modal-title mt-1 ml-2" id="staticBackdropLabel">Detail Status</h5>
                <button type="button" class="close rounded-modal-x" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-gray-900 font-weight-bold">A. Permohonan</h5>
                <table class="table text-center text-gray-900 mb-5">
                    <thead>
                        <tr class="font-weight-bold">
                            <td scope="col">#</td>
                            <td scope="col">Nama</td>
                            <td scope="col">Status</td>
                            <td scope="col">Tanggal</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($detail_status as $s) : ?>
                            <tr>
                                <td scope="row"><?= $i++; ?></td>
                                <td><?= $s['username']; ?></td>
                                <td><?= $s['status']; ?></td>
                                <td>
                                    <?php if (empty($s['created_at'])) : ?>
                                        ~
                                    <?php else : ?>
                                        <?= date('d M Y', strtotime($s['created_at'])); ?>
                                        <?= date('H : i : s', strtotime($s['created_at'])); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h5 class="text-gray-900 font-weight-bold">B. Aktifasi Fasilitas</h5>
                <table class="table text-center text-gray-900">
                    <thead>
                        <tr class="font-weight-bold">
                            <td scope="col">#</td>
                            <td scope="col">Nama</td>
                            <td scope="col">Status</td>
                            <td scope="col">Tanggal</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">1</td>
                            <td>
                                <?php if (empty($aktifasi_izin['off_by'])) : ?>
                                    ~
                                <?php else : ?>
                                    <?= $aktifasi_off['username']; ?>
                                <?php endif; ?>
                            </td>
                            <td>OFF</td>
                            <td>
                                <?php if (empty($aktifasi_izin['off_at'])) : ?>
                                    ~
                                <?php else : ?>
                                    <?= date('d M Y', strtotime($aktifasi_izin['off_at'])); ?>
                                    <?= date('H : i : s', strtotime($aktifasi_izin['off_at'])); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">2</td>
                            <td>
                                <?php if (empty($aktifasi_izin['on_by'])) : ?>
                                    ~
                                <?php else : ?>
                                    <?= $aktifasi_on['username']; ?>
                                <?php endif; ?>
                            </td>
                            <td>ON</td>
                            <td>
                                <?php if (empty($aktifasi_izin['on_at'])) : ?>
                                    ~
                                <?php else : ?>
                                    <?= date('d M Y', strtotime($aktifasi_izin['on_at'])); ?>
                                    <?= date('H : i : s', strtotime($aktifasi_izin['on_at'])); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">3</td>
                            <td>
                                <?php if (empty($aktifasi_izin['PIC'])) : ?>
                                    ~
                                <?php else : ?>
                                    <?= $aktifasi_pic['username']; ?>
                                <?php endif; ?>
                            </td>
                            <td>Approved PIC</td>
                            <td>
                                <?php if (empty($aktifasi_izin['approved_at'])) : ?>
                                    ~
                                <?php else : ?>
                                    <?= date('d M Y', strtotime($aktifasi_izin['approved_at'])); ?>
                                    <?= date('H : i : s', strtotime($aktifasi_izin['approved_at'])); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">4</td>
                            <td>
                                <?php if (empty($aktifasi_izin['engineer'])) : ?>
                                    ~
                                <?php else : ?>
                                    <?= $aktifasi_eng['username']; ?>
                                <?php endif; ?>
                            </td>
                            <td>Approved Engineer</td>
                            <td>
                                <?php if (empty($aktifasi_izin['checked_at'])) : ?>
                                    ~
                                <?php else : ?>
                                    <?= date('d M Y', strtotime($aktifasi_izin['checked_at'])); ?>
                                    <?= date('H : i : s', strtotime($aktifasi_izin['checked_at'])); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">5</td>
                            <td>
                                <?php if (empty($aktifasi_izin['ketua_ert'])) : ?>
                                    ~
                                <?php else : ?>
                                    <?= $aktifasi_ert['username']; ?>
                                <?php endif; ?>
                            </td>
                            <td>Approved Ketua ERT</td>
                            <td>
                                <?php if (empty($aktifasi_izin['agreed_at'])) : ?>
                                    ~
                                <?php else : ?>
                                    <?= date('d M Y', strtotime($aktifasi_izin['agreed_at'])); ?>
                                    <?= date('H : i : s', strtotime($aktifasi_izin['agreed_at'])); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer text-gray-900">
                <?php
                $target = new DateTime($pintu['target_waktu']);
                $today = new DateTime(date('Y-m-d'));
                $jam = new DateTime(date('H:i:s'));
                $jarak = $today->diff($target);
                $jarakJam = $jam->diff($target);
                if ($jarak->d < 0) {
                    $jarak->d = 'Melewati Target';
                }
                ?>
                <p class="text-center mr-2">Target Waktu Tersisa : <b class=""><?= $jarak->d; ?> Hari</b></p>
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
                <?= $this->include('ModalDetailPerizinan/ModalDetailHydrant'); ?>
            </div>
        </div>
    </div>
</div>

<!-- End Of Modal -->
<?= $this->endSection(); ?>