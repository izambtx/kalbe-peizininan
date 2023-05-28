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
        <hr class="sidebar-divider mt-1 mx-1 mb-0 border-dark">
        </hr>
        <?php if ($pintu['status'] == 'Returned Engineer' || $pintu['status'] == 'Returned PIC 1' || $pintu['status'] == 'Returned PIC 2' || $pintu['status'] == 'Returned PIC 3' || $pintu['status'] == 'Returned OHSE' || $pintu['status'] == 'Returned Ketua ERT') : ?>
            <table class="table table-bordered text-gray-900 my-auto">
                <tr>
                    <td style="max-width: 1rem;" rowspan="2" class="align-middle">Returned : </td>
                    <td style="max-width: 1rem;"><?= $pintu8['username']; ?></td>
                    <td style="max-width: 3rem;" rowspan="2"><?= $pintu['alasan']; ?></td>
                    <td style="max-width: 1rem;" rowspan="2" class="align-middle">
                        <a href="/IzinFasilitas/Hydrant/EditIzin/<?= $pintu['id']; ?>" class="cssbuttons-io-button">
                            <span class="font-weight-bold">Update Data</span>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path>
                                </svg>
                            </div>
                        </a>
                    </td>
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
            <div class="col-auto">
                <h5 class="text-gray-900 font-weight-bold text-left m-3">A. Permohonan</h5>
            </div>

            <div class="col-auto my-auto">
                <button class="button-status" data-toggle="modal" data-target="#modalExtend">
                    Extend
                </button>
            </div>
        </div>

        <div class="d-inline my-3">
            <?php foreach ($kategori as $k) : ?>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input <?php if ($k['nama_kategori'] == 'Pintu Emergency') : ?>checked<?php else : ?>disabled<?php endif ?> class="is-valid custom-control-input" type="checkbox" id="<?= $k['nama_kategori']; ?>" value="<?= $k['nama_kategori']; ?>">
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

        <div class="table-responsive px-5 mb-5">
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
                        }
                        ?>
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
                            <small class="font-weight-bold text-gray-900">Penangggung Jawab</small>
                            <small class="font-weight-bold text-gray-900">Lokasi Fasilitas Emergensi 1 (Spv/Mgr)</small>
                        </td>
                        <?php if ($pintu['lokasi_2']) : ?>
                            <td style="max-width: 7rem;">
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
                                <small class="font-weight-bold text-gray-900">Penangggung Jawab</small>
                                <small class="font-weight-bold text-gray-900">Lokasi Fasilitas Emergensi 2 (Spv/Mgr)</small>
                            </td>
                            <?php if ($pintu['lokasi_2'] && $pintu['lokasi_3']) : ?>
                                <td style="max-width: 7rem;">
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
                                    <small class="font-weight-bold text-gray-900">Penangggung Jawab</small>
                                    <small class="font-weight-bold text-gray-900">Lokasi Fasilitas Emergensi 3 (Spv/Mgr)</small>
                                </td>
                            <?php endif; ?>
                        <?php endif; ?>
                        <td style="max-width: 6rem;">
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
                            <small class="font-weight-bold text-gray-900">Engineering</small><br>
                            <small class="font-weight-bold text-gray-900">(Spv/Mgr)</small>
                        </td>
                        <td style="max-width: 6rem;">
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
                            <small class="font-weight-bold text-gray-900">Sekretaris</small><br>
                            <small class="font-weight-bold text-gray-900">OHSE Committee</small>
                        </td>
                        <td style="max-width: 7rem;">
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
                            <small class="font-weight-bold text-gray-900">Ketua ERT</small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Detail Extend Modal -->

<div class="modal fade" id="modalExtend" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalExtendLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content mb-0 rounded-md border-0">
            <div class="modal-header bg-gradient-peach rounded-top">
                <h5 class="modal-title text-white" id="modalExtendLabel">Request Perpanjang Waktu Target</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/IzinFasilitas/Hydrant/Request/<?= $pintu['id']; ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="text-gray-900" for="target">Target Waktu (sebelum)</label>
                        <input type="text" class="form-control rounded-sm bg-light" readonly value="<?= date('d F Y', strtotime($pintu['target_waktu'])); ?>" id="target">
                        <div class="invalid-feedback">
                            <?= session('validation.target') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-gray-900" for="request">Target Tanggal Yang Diinginkan</label>
                        <input type="datetime-local" autofocus class="form-control rounded-sm <?php if (session('validation.request')) : ?>is-invalid<?php endif ?>" name="request" id="request">
                        <div class="invalid-feedback">
                            <?= session('validation.request') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-gray-900" for="alasan">Alasan</label>
                        <input type="text" class="form-control rounded-sm <?php if (session('validation.alasan')) : ?>is-invalid<?php endif ?>" name="alasan" id="alasan">
                        <div class="invalid-feedback">
                            <?= session('validation.alasan') ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Extend Target</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End Of Modal -->

<?= $this->endSection(); ?>