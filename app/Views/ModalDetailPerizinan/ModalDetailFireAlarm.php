<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <!-- Content Card -->
    <div class="card text-center border-0 pt-5">
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

        <div class="d-flex justify-content-between">
            <div class="col-auto">
                <h5 class="text-gray-900 font-weight-bold text-left m-3">A. Permohonan</h5>
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
            <?php if ($pintu['id_kategori'] == 3) : ?>
                <div class="form-group">
                    <label class="text-gray-900" for="titik">Jumlah Titik</label>
                    <input type="number" readonly value="<?= $pintu['jumlah_titik']; ?>" class="form-control rounded-sm bg-light" id="titik" placeholder="Jumlah Titik Yang Akan Dipakai">
                </div>
            <?php endif; ?>
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
                                    <span class="font-weight-bold text-gray-900"><?= $lokasi2['username']; ?></span>
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
                                    <?php if (empty($pintu['approved_at_3'])) : ?>
                                        <br>
                                        <br>
                                        <h3 class="font-weight-bold">NA</h3>
                                        <br>
                                    <?php else : ?>
                                        <span class="font-weight-bold text-gray-900"><?= $lokasi3['username']; ?></span>
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