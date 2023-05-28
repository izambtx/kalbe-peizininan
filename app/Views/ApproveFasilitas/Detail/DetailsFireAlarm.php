<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <!-- Content Card -->
    <div class="card text-center shadow py-5">
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
        <?php if ($pintu['status'] == 'Returned Engineer' || $pintu['status'] == 'Returned PIC 1' || $pintu['status'] == 'Returned PIC 2' || $pintu['status'] == 'Returned PIC 3' || $pintu['status'] == 'Returned OHSE' || $pintu['status'] == 'Returned Ketua ERT') : ?>
            <table class="table table-bordered text-gray-900 my-auto">
                <tr>
                    <td style="max-width: 1rem;" rowspan="2" class="align-middle">Returned : </td>
                    <td style="max-width: 1rem;"><?= $pintu8['username']; ?></td>
                    <td style="max-width: 3rem;" rowspan="2"><?= $pintu['alasan']; ?></td>
                    <td style="max-width: 1rem;" rowspan="2" class="align-middle">
                        <h4><span class="badge badge-warning"><?= $pintu['status']; ?></span></h4>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td style="max-width: 1rem;"><?= date('d M Y', strtotime($pintu['returned_at'])); ?></td>
                </tr>
            </table>
        <?php elseif ($pintu['status'] == 'Rejected Engineer' || $pintu['status'] == 'Rejected PIC' || $pintu['status'] == 'Rejected PIC 2' || $pintu['status'] == 'Rejected PIC 3' || $pintu['status'] == 'Rejected OHSE' || $pintu['status'] == 'Rejected Ketua ERT') : ?>
            <table class="table table-bordered text-gray-900 my-auto">
                <tr>
                    <td style="max-width: 1rem;" rowspan="2" class="align-middle">Rejected : </td>
                    <td style="max-width: 1rem;"><?= $pintu9['username']; ?></td>
                    <td style="max-width: 3rem;" rowspan="2"><?= $pintu['alasan']; ?></td>
                    <td style="max-width: 1rem;" rowspan="2" class="align-middle">
                        <h4><span class="badge badge-danger"><?= $pintu['status']; ?></span></h4>
                    </td>
                </tr>
                <tr>
                    <td style="max-width: 1rem;"><?= date('d M Y', strtotime($pintu['rejected_at'])); ?></td>
                </tr>
            </table>
        <?php endif; ?>

        <div class="d-flex justify-content-between">
            <div class="col-auto my-auto">
                <h5 class="text-gray-900 font-weight-bold text-left m-3">A. Permohonan</h5>
            </div>

            <div class="d-flex justify-content-end">
                <?php if (in_groups('OHSE')) : ?>
                    <button class="button-status" data-toggle="modal" data-target="#staticBackdrop">
                        Detail Status
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <div class="d-inline my-3">
            <?php foreach ($kategori as $k) : ?>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input <?php if ($k['nama_kategori'] == 'Fire Alarm') : ?>checked<?php else : ?>disabled<?php endif ?> class="is-valid custom-control-input" type="checkbox" id="<?= $k['nama_kategori']; ?>" value="<?= $k['nama_kategori']; ?>">
                    <label class="custom-control-label text-gray-900" for="<?= $k['nama_kategori']; ?>"><?= $k['nama_kategori']; ?></label>
                </div>
            <?php endforeach ?>
        </div>

        <form class="mx-5 my-2 px-5 text-left">
            <div class="form-group">
                <label class="text-gray-900" for="noRegis">No. Registrasi</label>
                <input type="text" readonly <?php if ($pintu['no_registrasi']) : ?> value="<?= $pintu['no_registrasi']; ?>" <?php endif; ?> class="form-control rounded-sm bg-light" id="noRegis" placeholder="Belum Memiliki No. Registrasi">
            </div>
            <div class="form-group">
                <label class="text-gray-900" for="tanggal">Tanggal Permohonan</label>
                <input type="text" readonly value="<?= date('d F Y', strtotime($pintu['created_at'])); ?>" class="form-control rounded-sm bg-light" id="tanggal" value="">
            </div>
            <div class="form-group">
                <label class="text-gray-900" for="lokasi">Lokasi</label>
                <input type="text" readonly value="<?= $pintu['nama_lokasi']; ?>" class="form-control rounded-sm bg-light" id="lokasi" placeholder="Jumlah Titik Yang Akan Dipakai">
                <?php if ($pintu['lokasi_2']) : ?>
                    <input type="text" readonly value="<?= $lokasi2['nama_lokasi']; ?>" class="my-3 form-control rounded-sm bg-light" id="lokasi_2" placeholder="Jumlah Titik Yang Akan Dipakai">
                <?php endif; ?>

                <?php if ($pintu['lokasi_3']) : ?>
                    <input type="text" readonly value="<?= $lokasi3['nama_lokasi']; ?>" class="form-control rounded-sm bg-light" id="lokasi_3" placeholder="Jumlah Titik Yang Akan Dipakai">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="text-gray-900" for="titik">Jumlah Titik</label>
                <input type="number" readonly value="<?= $pintu['jumlah_titik']; ?>" class="form-control rounded-sm bg-light" id="titik" placeholder="Jumlah Titik Yang Akan Dipakai">
            </div>
            <div class="form-group">
                <label class="text-gray-900" for="waktu">Waktu Penggunaan / Non-Aktif</label>
                <div class="row">
                    <div class="col">
                        <input type="text" value="<?= date('l, d F Y / H:i', strtotime($pintu['waktu_penggunaan'])); ?>" readonly class="form-control rounded-sm bg-light" id="waktu">
                    </div>
                    <h5 class="my-auto font-weight-bold text-gray-900"> s/d </h5>
                    <div class="col">
                        <input type="text" value="<?= date('l, d F Y / H:i', strtotime($pintu['non_aktif'])); ?>" readonly class="form-control rounded-sm bg-light" id="nonaktif">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="text-gray-900" for="target">Target Waktu Penyegelan / Penonaktifan</label>
                <input type="text" class="form-control rounded-sm bg-light" readonly value="<?= date('d F Y', strtotime($pintu['target_waktu'])); ?>" id="target">
            </div>
            <div class="form-group">
                <label class="text-gray-900" for="keperluan">Keperluan</label>
                <textarea class="form-control rounded-sm bg-light" readonly id="keperluan" rows="3"><?= $pintu['keperluan']; ?></textarea>
            </div>
            <div class="form-group">
                <label class="text-gray-900" for="rencana">Rencana Antisipasi Kondisi Darurat Saat Fasilitas Emergency Tersebut Dimatikan</label>
                <textarea class="form-control rounded-sm bg-light" readonly id="rencana" rows="3"><?= $pintu['rencana_antisipasi']; ?></textarea>
            </div>
        </form>

        <div class="d-inline my-3 container">
            <i class="text-gray-900">Lampiran Gambar</i>
            <div class="row my-5">
                <?php $x = 1; ?>
                <?php foreach ($foto_izin as $foto) : ?>
                    <?php if ($foto['nama_foto'] == 'default.jpg') : ?>
                    <?php else : ?>
                        <div class="col-sm-3 d-flex flex-wrap align-items-center mx-auto d-block">
                            <div class="card border-0 col-sm-12">
                                <img class="card-img-top img-fluid rounded p-0 m-0" style="object-fit: contain; height: 250px;" src="/img/<?= $foto['nama_foto'];  ?>" alt="Foto Trouble Shooting">
                                <div class="card-block">
                                    <h4 class="mt-4 text-center card-title font-weight-bold text-gray-900">Gambar <?= $x++; ?>.</h4>
                                    <p class="card-text text-center text-gray-900"><?= $foto['keterangan'];  ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="table-responsive px-5">
            <table class="table table-bordered text-gray-900 my-auto">
                <thead>
                    <tr>
                        <td scope="col">Pemohon</td>
                        <?php if ($pintu['lokasi_2']) {
                            $colspan = 4;
                            if ($pintu['lokasi_2'] && $pintu['lokasi_3']) {
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
                            <span class="font-weight-bold text-gray-900"><?= $pintu['username']; ?></span>
                            <br>
                            <br>
                            <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($pintu['created_at'])); ?></small>
                            <br>
                            <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($pintu['created_at'])); ?></small>
                            <br>
                            <br>
                            <small class="font-weight-bold text-gray-900m">Penangggung Jawab</small><br>
                            <small class="font-weight-bold text-gray-900">Pekerjaan (Spv/Mgr)</small>
                        </td>
                        <td style="max-width: 7rem;">
                            <?php if (in_groups('manager') && empty($pintu['approved_at']) && $pintu['lokasi'] == user()->lokasi && stripos($pintu['status'], 'Returned') == TRUE && stripos($pintu['status'], 'Rejected') == TRUE) : ?>
                                <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                            <?php else : ?>
                                <?php if (empty($pintu['approved_at'])) : ?>
                                    <br>
                                    <br>
                                    <h3 class="font-weight-bold">NA</h3>
                                    <br>
                                <?php else : ?>
                                    <span class="font-weight-bold text-gray-900"><?= $pintu2['username']; ?></span>
                                    <br>
                                    <br>
                                    <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($pintu['approved_at'])); ?></small>
                                    <br>
                                    <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($pintu['approved_at'])); ?></small>
                                    <br>
                                    <br>
                                <?php endif; ?>
                            <?php endif; ?>
                            <small class="font-weight-bold text-gray-900">Penangggung Jawab</small>
                            <small class="font-weight-bold text-gray-900">Lokasi Fasilitas Emergensi 1 (Spv/Mgr)</small>
                        </td>
                        <?php if ($pintu['lokasi_2']) : ?>
                            <td style="max-width: 7rem;">
                                <?php if (in_groups('manager') && empty($pintu['approved_at_2']) && $pintu['lokasi_2'] == user()->lokasi && stripos($pintu['status'], 'Returned') == TRUE && stripos($pintu['status'], 'Rejected') == TRUE) : ?>
                                    <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal2">Return</button>
                                    <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal2">Reject</button>
                                    <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal2">Approve</button>
                                <?php else : ?>
                                    <?php if (empty($pintu['approved_at_2'])) : ?>
                                        <br>
                                        <br>
                                        <h3 class="font-weight-bold">NA</h3>
                                        <br>
                                    <?php else : ?>
                                        <span class="font-weight-bold text-gray-900"><?= $pintu6['username']; ?></span>
                                        <br>
                                        <br>
                                        <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($pintu['approved_at_2'])); ?></small>
                                        <br>
                                        <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($pintu['approved_at_2'])); ?></small>
                                        <br>
                                        <br>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <small class="font-weight-bold text-gray-900">Penangggung Jawab</small>
                                <small class="font-weight-bold text-gray-900">Lokasi Fasilitas Emergensi 2 (Spv/Mgr)</small>
                            </td>
                            <?php if ($pintu['lokasi_2'] && $pintu['lokasi_3']) : ?>
                                <td style="max-width: 7rem;">
                                    <?php if (in_groups('manager') && empty($pintu['approved_at_3']) && $pintu['lokasi_3'] == user()->lokasi && stripos($pintu['status'], 'Returned') == TRUE && stripos($pintu['status'], 'Rejected') == TRUE) : ?>
                                        <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal3">Return</button>
                                        <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal3">Reject</button>
                                        <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal3">Approve</button>
                                    <?php else : ?>
                                        <?php if (empty($pintu['approved_at_3'])) : ?>
                                            <br>
                                            <br>
                                            <h3 class="font-weight-bold">NA</h3>
                                            <br>
                                        <?php else : ?>
                                            <span class="font-weight-bold text-gray-900"><?= $pintu7['username']; ?></span>
                                            <br>
                                            <br>
                                            <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($pintu['approved_at_3'])); ?></small>
                                            <br>
                                            <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($pintu['approved_at_3'])); ?></small>
                                            <br>
                                            <br>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <small class="font-weight-bold text-gray-900">Penangggung Jawab</small>
                                    <small class="font-weight-bold text-gray-900">Lokasi Fasilitas Emergensi 3 (Spv/Mgr)</small>
                                </td>
                            <?php endif; ?>
                        <?php endif; ?>
                        <td style="max-width: 6rem;">
                            <?php if (in_groups('engineer') && empty($pintu['checked_at']) && stripos($pintu['status'], 'Returned') == TRUE && stripos($pintu['status'], 'Rejected') == TRUE) : ?>
                                <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                            <?php else : ?>
                                <?php if (empty($pintu['checked_at'])) : ?>
                                    <br>
                                    <br>
                                    <h3 class="font-weight-bold">NA</h3>
                                    <br>
                                <?php else : ?>
                                    <span class="font-weight-bold text-gray-900"><?= $pintu3['username']; ?></span>
                                    <br>
                                    <br>
                                    <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($pintu['checked_at'])); ?></small>
                                    <br>
                                    <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($pintu['checked_at'])); ?></small>
                                    <br>
                                    <br>
                                <?php endif; ?>
                            <?php endif; ?>
                            <small class="font-weight-bold text-gray-900">Engineering</small><br>
                            <small class="font-weight-bold text-gray-900">(Spv/Mgr)</small>
                        </td>
                        <td style="max-width: 6rem;">
                            <?php if (in_groups('OHSE') && empty($pintu['evaluated_at']) && stripos($pintu['status'], 'Returned') == TRUE && stripos($pintu['status'], 'Rejected') == TRUE) : ?>
                                <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                            <?php else : ?>
                                <?php if (empty($pintu['evaluated_at'])) : ?>
                                    <br>
                                    <br>
                                    <h3 class="font-weight-bold">NA</h3>
                                    <br>
                                <?php else : ?>
                                    <span class="font-weight-bold text-gray-900"><?= $pintu4['username']; ?></span>
                                    <br>
                                    <br>
                                    <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($pintu['evaluated_at'])); ?></small>
                                    <br>
                                    <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($pintu['evaluated_at'])); ?></small>
                                    <br>
                                    <br>
                                <?php endif; ?>
                            <?php endif; ?>
                            <small class="font-weight-bold text-gray-900">Sekretaris</small><br>
                            <small class="font-weight-bold text-gray-900">OHSE Committee</small>
                        </td>
                        <td style="max-width: 7rem;">
                            <?php if ($pintu['status'] == 'Approved Spv/Mgr' && in_groups('ERT') && empty($pintu['agreed_at']) && stripos($pintu['status'], 'Returned') == TRUE && stripos($pintu['status'], 'Rejected') == TRUE) : ?>
                                <button type="button" class="btn btn-warning btn-sm btn-block mt-2" data-toggle="modal" data-target="#returnModal">Return</button>
                                <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#approveModal">Approve</button>
                                <br>
                            <?php else : ?>
                                <?php if (empty($pintu['agreed_at'])) : ?>
                                    <br>
                                    <br>
                                    <h3 class="font-weight-bold">NA</h3>
                                    <br>
                                    <br>
                                <?php else : ?>
                                    <span class="font-weight-bold text-gray-900"><?= $pintu5['username']; ?></span>
                                    <br>
                                    <br>
                                    <small class="font-weight-bold text-success"><?= date('d M Y', strtotime($pintu['agreed_at'])); ?></small>
                                    <br>
                                    <small class="font-weight-bold text-success"><?= date('H : i : s', strtotime($pintu['agreed_at'])); ?></small>
                                    <br>
                                    <br>
                                <?php endif; ?>
                            <?php endif; ?>
                            <small class="font-weight-bold text-gray-900">Ketua ERT</small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- <i class="my-3 text-gray-900">Note : Setelah approval semua pihak salinan agar dikirim ke MSTD dan Security/GA serta ditempel dilokasi fasilitas emergensi</i> -->
    </div>
</div>

<!-- Start of Modal -->

<!-- Return Modal -->
<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mb-0 rounded-md border-0">
            <div class="modal-header bg-warning rounded-top">
                <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Return Izin Fasilitas Emergency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/img/caution.gif" class="w-25 mx-auto d-block">
                    <h4 class="text-center font-weight-bold text-gray-900">Sure Want To Return This Permit?</h4>
                    <h6 class="small text-center text-gray-900">Make Sure The Data is Correct!</h6>

                    <form action="/ReturnFasilitas/1/FireAlarm/<?= $pintu['id']; ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="form-group row mb-0 mt-5">
                            <label for="alasanReturn" class="col-sm-4 col-form-label">Reason Return </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" required id="alasanReturn" name="alasanReturn"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="returnopl" class="col-sm-4 col-form-label">Returned By </label>
                            <div class="col-sm-8">
                                <p class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
                            </div>
                        </div>
                        <?php if (in_groups('manager')) : ?>
                            <input type="text" value="Returned PIC 1" id="statusReturn" name="statusReturn"></input>
                        <?php elseif (in_groups('engineer')) : ?>
                            <input type="text" value="Returned Engineer" id="statusReturn" name="statusReturn"></input>
                        <?php elseif (in_groups('OHSE')) : ?>
                            <input type="text" value="Returned OHSE" id="statusReturn" name="statusReturn"></input>
                        <?php elseif (in_groups('ERT')) : ?>
                            <input type="text" value="Returned Ketua ERT" id="statusReturn" name="statusReturn"></input>
                        <?php endif; ?>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning px-4 mx-2 mt-5">Return</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Return Modal 2 -->
<div class="modal fade" id="returnModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mb-0 rounded-md border-0">
            <div class="modal-header bg-warning rounded-top">
                <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Return Izin Fasilitas Emergency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/img/caution.gif" class="w-25 mx-auto d-block">
                    <h4 class="text-center font-weight-bold text-gray-900">Sure Want To Return This Permit?</h4>
                    <h6 class="small text-center text-gray-900">Make Sure The Data is Correct!</h6>

                    <form action="/ReturnFasilitas/2/FireAlarm/<?= $pintu['id']; ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="form-group row mb-0 mt-5">
                            <label for="alasanReturn" class="col-sm-4 col-form-label">Reason Return </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" required id="alasanReturn" name="alasanReturn"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="returnopl" class="col-sm-4 col-form-label">Returned By </label>
                            <div class="col-sm-8">
                                <p class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
                            </div>
                        </div>
                        <?php if (in_groups('manager')) : ?>
                            <input type="text" value="Returned PIC 2" id="statusReturn" name="statusReturn"></input>
                        <?php elseif (in_groups('engineer')) : ?>
                            <input type="text" value="Returned Engineer" id="statusReturn" name="statusReturn"></input>
                        <?php elseif (in_groups('OHSE')) : ?>
                            <input type="text" value="Returned OHSE" id="statusReturn" name="statusReturn"></input>
                        <?php elseif (in_groups('ERT')) : ?>
                            <input type="text" value="Returned Ketua ERT" id="statusReturn" name="statusReturn"></input>
                        <?php endif; ?>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning px-4 mx-2 mt-5">Return</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Return Modal 3 -->
<div class="modal fade" id="returnModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mb-0 rounded-md border-0">
            <div class="modal-header bg-warning rounded-top">
                <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Return Izin Fasilitas Emergency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/img/caution.gif" class="w-25 mx-auto d-block">
                    <h4 class="text-center font-weight-bold text-gray-900">Sure Want To Return This Permit?</h4>
                    <h6 class="small text-center text-gray-900">Make Sure The Data is Correct!</h6>

                    <form action="/ReturnFasilitas/3/FireAlarm/<?= $pintu['id']; ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="form-group row mb-0 mt-5">
                            <label for="alasanReturn" class="col-sm-4 col-form-label">Reason Return </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" required id="alasanReturn" name="alasanReturn"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="returnopl" class="col-sm-4 col-form-label">Returned By </label>
                            <div class="col-sm-8">
                                <p class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
                            </div>
                        </div>
                        <?php if (in_groups('manager')) : ?>
                            <input type="text" value="Returned PIC 3" id="statusReturn" name="statusReturn"></input>
                        <?php elseif (in_groups('engineer')) : ?>
                            <input type="text" value="Returned Engineer" id="statusReturn" name="statusReturn"></input>
                        <?php elseif (in_groups('OHSE')) : ?>
                            <input type="text" value="Returned OHSE" id="statusReturn" name="statusReturn"></input>
                        <?php elseif (in_groups('ERT')) : ?>
                            <input type="text" value="Returned Ketua ERT" id="statusReturn" name="statusReturn"></input>
                        <?php endif; ?>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning px-4 mx-2 mt-5">Return</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mb-0 rounded-md border-0">
            <div class="modal-header bg-danger rounded-top">
                <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Reject Izin Fasilitas Emergency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/img/reject.gif" class="w-25 mx-auto d-block">
                    <h4 class="text-center font-weight-bold text-gray-900">Sure Want To Reject This Permit?</h4>
                    <h6 class="small text-center text-gray-900">Make Sure The Data is Correct!</h6>

                    <form action="/RejectFasilitas/1/FireAlarm/<?= $pintu['id']; ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="form-group row mb-0 mt-5">
                            <label for="alasanReject" class="col-sm-4 col-form-label">Reason Reject </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" required id="alasanReject" name="alasanReject"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="Rejectopl" class="col-sm-4 col-form-label">Rejected By </label>
                            <div class="col-sm-8">
                                <p class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
                            </div>
                        </div>
                        <?php if (in_groups('manager')) : ?>
                            <input type="text" value="Rejected PIC" id="statusReject" name="statusReject"></input>
                        <?php elseif (in_groups('engineer')) : ?>
                            <input type="text" value="Rejected Engineer" id="statusReject" name="statusReject"></input>
                        <?php elseif (in_groups('OHSE')) : ?>
                            <input type="text" value="Rejected OHSE" id="statusReject" name="statusReject"></input>
                        <?php elseif (in_groups('ERT')) : ?>
                            <input type="text" value="Rejected Ketua ERT" id="statusReject" name="statusReject"></input>
                        <?php endif; ?>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger px-4 mx-2 mt-5">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal 2 -->
<div class="modal fade" id="rejectModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mb-0 rounded-md border-0">
            <div class="modal-header bg-danger rounded-top">
                <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Reject Izin Fasilitas Emergency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/img/reject.gif" class="w-25 mx-auto d-block">
                    <h4 class="text-center font-weight-bold text-gray-900">Sure Want To Reject This Permit?</h4>
                    <h6 class="small text-center text-gray-900">Make Sure The Data is Correct!</h6>

                    <form action="/RejectFasilitas/2/FireAlarm/<?= $pintu['id']; ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="form-group row mb-0 mt-5">
                            <label for="alasanreject" class="col-sm-4 col-form-label">Reason Reject </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" required id="alasanreject" name="alasanreject"></textarea>
                                <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" id="tglreject" name="tglreject"></input>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="rejectopl" class="col-sm-4 col-form-label">Rejected By </label>
                            <div class="col-sm-8">
                                <input type="hidden" value="<?= user()->id; ?>" id="rejectopl" name="rejectopl"></input>
                                <input type="text" readonly value="<?= user()->NIK; ?>, <?= user()->fullname; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                            </div>
                        </div>
                        <?php if (in_groups('manager')) : ?>
                            <input type="text" value="Rejected PIC 2" id="statusReject" name="statusReject"></input>
                        <?php elseif (in_groups('engineer')) : ?>
                            <input type="text" value="Rejected Engineer" id="statusReject" name="statusReject"></input>
                        <?php elseif (in_groups('OHSE')) : ?>
                            <input type="text" value="Rejected OHSE" id="statusReject" name="statusReject"></input>
                        <?php elseif (in_groups('ERT')) : ?>
                            <input type="text" value="Rejected Ketua ERT" id="statusReject" name="statusReject"></input>
                        <?php endif; ?>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger px-4 mx-2 mt-5">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal 3 -->
<div class="modal fade" id="rejectModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mb-0 rounded-md border-0">
            <div class="modal-header bg-danger rounded-top">
                <h5 class="modal-title text-gray-900 font-weight-bold" id="exampleModalLabel">Reject Izin Fasilitas Emergency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img src="/img/reject.gif" class="w-25 mx-auto d-block">
                    <h4 class="text-center font-weight-bold text-gray-900">Sure Want To Reject This Permit?</h4>
                    <h6 class="small text-center text-gray-900">Make Sure The Data is Correct!</h6>

                    <form action="/RejectFasilitas/3/FireAlarm/<?= $pintu['id']; ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="form-group row mb-0 mt-5">
                            <label for="alasanreject" class="col-sm-4 col-form-label">Reason Reject </label>
                            <div class="col-sm-8">
                                <textarea class="form-control" required id="alasanreject" name="alasanReject"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="rejectopl" class="col-sm-4 col-form-label">Rejected By </label>
                            <div class="col-sm-8">
                                <input type="hidden" value="<?= user()->id; ?>" id="rejectopl" name="rejectopl"></input>
                                <input type="text" readonly value="<?= user()->NIK; ?>, <?= user()->fullname; ?>" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                            </div>
                        </div>
                        <?php if (in_groups('manager')) : ?>
                            <input type="text" value="Rejected PIC 3" id="statusReject" name="statusReject"></input>
                        <?php elseif (in_groups('engineer')) : ?>
                            <input type="text" value="Rejected Engineer" id="statusReject" name="statusReject"></input>
                        <?php elseif (in_groups('OHSE')) : ?>
                            <input type="text" value="Rejected OHSE" id="statusReject" name="statusReject"></input>
                        <?php elseif (in_groups('ERT')) : ?>
                            <input type="text" value="Rejected Ketua ERT" id="statusReject" name="statusReject"></input>
                        <?php endif; ?>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger px-4 mx-2 mt-5">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
                        <form action="/ApproveFasilitas/FireAlarm/approve/<?= $pintu['id']; ?>" method="post">
                            <?= csrf_field();  ?>

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
                            <?php if (empty($pintu['checked_at']) || empty($pintu['evaluated_at'])) : ?>
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
                        <form action="/ApproveFasilitas/FireAlarm/check/<?= $pintu['id']; ?>" method="post">
                            <?= csrf_field();  ?>
                            <div class="form-group row mb-0 mt-5">
                                <label for="namaproject" class="col-sm-4 col-form-label">Lokasi </label>
                                <div class="col-sm-8">
                                    <p id="namaproject" name="namaproject" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['nama_lokasi']; ?></p>
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
                            <?php if (empty($pintu['approved_at']) || empty($pintu['evaluated_at'])) : ?>
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

                    <?php elseif (in_groups('OHSE')) : ?>
                        <form action="/ApproveFasilitas/FireAlarm/read/<?= $pintu['id']; ?>" method="post">
                            <?= csrf_field();  ?>
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
                                    <p id="noreg" name="noreg" class="mt-2 font-weight-bold text-gray-900 border-0 bg-white"><?= $noReg + 1; ?> / OHSE - ER / <?= date("m"); ?> / <?= date("Y"); ?></p>
                                    <input type="hidden" value="<?= $noReg + 1; ?>/OHSE-ER/<?= date("m"); ?>/<?= date("Y"); ?>" id="noReg" name="noReg" class="form-control font-weight-bold text-gray-900 border-0 bg-white"></input>
                                </div>
                            </div>
                            <?php if (empty($pintu['checked_at']) || empty($pintu['approved_at'])) : ?>
                                <input type="hidden" value="Approved OHSE" id="status" name="status">
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
                        <form action="/ApproveFasilitas/FireAlarm/agree/<?= $pintu['id']; ?>" method="post">
                            <?= csrf_field();  ?>
                            <div class="form-group row mb-0 mt-5">
                                <label for="namaproject" class="col-sm-4 col-form-label">Lokasi </label>
                                <div class="col-sm-8">
                                    <p id="namaproject" name="namaproject" class="form-control font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['nama_lokasi']; ?></p>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="noreg" class="col-sm-4 col-form-label">No. Registrasi </label>
                                <div class="col-sm-8">
                                    <p id="noreg" name="noreg" class="form-control font-weight-bold text-gray-900 border-0 bg-white"><?= $pintu['no_registrasi']; ?></p>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="approveopl" class="col-sm-4 col-form-label">Approver </label>
                                <div class="col-sm-8">
                                    <input type="hidden" value="<?= user()->id; ?>" id="approveopl" name="approveopl"></input>
                                    <p class="form-control font-weight-bold text-gray-900 border-0 bg-white"><?= user()->NIK; ?>, <?= user()->fullname; ?></p>
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
                        <form action="/ApproveFasilitas/FireAlarm/approve2/<?= $pintu['id']; ?>" method="post">
                            <?= csrf_field();  ?>

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
                            <?php if (empty($pintu['checked_at']) || empty($pintu['evaluated_at']) || empty($pintu['approved_at'])) : ?>
                                <input type="hidden" value="Approved PIC 2" id="status" name="status">
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
                        <form action="/ApproveFasilitas/FireAlarm/approve3/<?= $pintu['id']; ?>" method="post">
                            <?= csrf_field();  ?>

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
    <div class="modal-dialog modal-lg">
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

<!-- End Of Modal -->

<?= $this->endSection(); ?>