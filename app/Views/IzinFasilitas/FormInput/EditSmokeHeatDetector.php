<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid justify-content-center mb-5">

    <?php if (empty($inputFotoIM)) : ?>
        <?php $jumlahFoto = $countFotoPE + $inputFotoPE; ?>
    <?php else : ?>
        <?php $jumlahFoto = $countFotoPE + $inputFotoPE - $countFotoPE; ?>
    <?php endif; ?>

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <!-- Content Card -->
    <div class="card text-center shadow mx-auto pt-5">
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

        <div class="d-inline my-3">
            <?php foreach ($kategori as $k) : ?>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input <?php if ($k['nama_kategori'] == 'Smoke / Heat Detector') : ?>checked<?php else : ?>disabled<?php endif ?> class="is-valid custom-control-input" type="checkbox" id="<?= $k['nama_kategori']; ?>" value="<?= $k['nama_kategori']; ?>">
                    <label class="custom-control-label text-gray-900" for="<?= $k['nama_kategori']; ?>"><?= $k['nama_kategori']; ?></label>
                </div>
            <?php endforeach ?>
        </div>

        <form action="" method="get" class="mx-5 mt-2 px-5 text-left">
            <div class="form-group row">
                <i class="mb-2 text-gray-900">(Lampirkan Gambar Jika Diperlukan)</i>
                <div class="form-row col-sm-12 px-0">
                    <div class="form-group col-sm-3 my-auto">
                        <label for="jumlahFoto" class="align-middle mt-2 text-gray-900">Jumlah Foto</label>
                    </div>
                    <div class="form-group col-sm-5 my-auto">
                        <input type="number" disabled min="<?= $countFotoPE; ?>" max="8" class="form-control rounded-sm" id="jumlahFoto" name="jumlahFoto" placeholder="Masukan Jumlah Foto OPL Yang Diperlukan" value="<?= $jumlahFoto; ?>">
                    </div>
                    <div class="form-group my-auto">
                        <button type="submit" disabled value="gambar" name="submit" class="rounded-circle px-0 ml-4 form-control btn btn-success"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </form>

        <form class="mx-5 mt-2 mb-5 px-5 text-left" method="post" action="/IzinFasilitas/SmokeHeatDetector/UpdateIzin/<?= $pintu['id']; ?>" enctype="multipart/form-data">
            <?php csrf_field(); ?>

            <?php $i = 1; ?>
            <?php foreach ($fotoPE as $FPE) : ?>
                <div id="inputImage">
                    <div class="media mb-4">
                        <div class="d-block my-auto col-sm-3 border-0" id="row">
                            <img src="/img/<?= $FPE['nama_foto']; ?>" id="img" class="img-thumbnail col-sm-12 p-0 sebelum-preview<?= $i; ?> rounded" alt="Gambar Smoke / Heat Detector">
                        </div>
                        <div class="media-body mx-3">
                            <div class="d-flex justify-content-between">
                                <h5 class="text-gray-900 font-weight-bold align-middle my-3">Gambar <?= $i; ?></h5>
                                <div class="custom-file col-sm-10 my-2">
                                    <input type="file" accept="image/*" class="custom-file-input" id=" foto_sebelum<?= $i; ?>" name="foto_sebelum<?= $i; ?>" value="<?= old('foto_sebelum'); ?>" onchange="preview_sebelum<?= $i; ?>()">
                                    <label class="custom-file-label" data-browse="Choose" id="label_sebelum<?= $i; ?>" name="label_sebelum<?= $i; ?>" for="foto_sebelum<?= $i; ?>"><?= $FPE['nama_foto']; ?></label>
                                </div>
                            </div>
                            <textarea class="form-control mt-2 rounded" rows="6" id="ket_foto<?= $i; ?>" placeholder="Keterangan Foto <?= $i; ?>" name="ket_foto<?= $i; ?>" value="<?= old('ket_foto'); ?>"><?= $FPE['keterangan']; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
            <?php endforeach; ?>

            <div class="form-group">
                <label class="text-gray-900" for="exampleFormControlInput1">Tanggal Permohonan</label>
                <input type="text" readonly disabled class="form-control rounded-sm" id="exampleFormControlInput1" value="<?= date('l, d F Y / h.i A', strtotime($pintu['created_at'])); ?>">
            </div>
            <div class="form-group">
                <label for="lokasi" class=" text-gray-900">Lokasi</label>
                <div class="input-group">
                    <select class="<?php if (session('validation.lokasi')) : ?>is-invalid<?php endif ?> custom-select rounded-sm" id="lokasi" name="lokasi">
                        <option selected disabled hidden>Lokasi 1</option>
                        <?php foreach ($lokasi as $d) : ?>
                            <option value="<?= $d['id'];  ?>" <?= $pintu['lokasi'] == $d['id'] ? 'selected' : '' ?>><?= $d['nama_lokasi'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('validation.lokasi') ?>
                    </div>
                </div>
                <div class="input-group my-3">
                    <select class="custom-select rounded-sm" id="lokasi_2" name="lokasi_2">
                        <option selected disabled hidden>Lokasi 2 (Optional)</option>
                        <?php foreach ($lokasi as $d) : ?>
                            <option value="<?= $d['id'];  ?>" <?= $pintu['lokasi_2'] == $d['id'] ? 'selected' : '' ?>><?= $d['nama_lokasi'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group">
                    <select class="custom-select rounded-sm" id="lokasi_3" name="lokasi_3">
                        <option selected disabled hidden>Lokasi 3 (Optional)</option>
                        <?php foreach ($lokasi as $d) : ?>
                            <option value="<?= $d['id'];  ?>" <?= $pintu['lokasi_3'] == $d['id'] ? 'selected' : '' ?>><?= $d['nama_lokasi'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group mb-5">
                <input type="hidden" class="form-control" id="revisi" name="revisi" value="<?= $pintu['revisi'] + 1; ?>">
            </div>

            <div class="form-group">
                <label class="text-gray-900" for="titik">Jumlah Titik</label>
                <input type="number" value="<?= $pintu['jumlah_titik']; ?>" class="form-control rounded-sm <?php if (session('validation.titik')) : ?>is-invalid<?php endif ?>" name="titik" id="titik" placeholder="Jumlah Titik Yang Akan Dipakai">
                <div class="invalid-feedback">
                    <?= session('validation.titik') ?>
                </div>
                <input type="hidden" class="form-control" id="counterCPR" name="counterReg" value="<?= $countRegNo + 1; ?>">
                <input type="hidden" class="form-control" id="jumlahFileFoto" name="jumlahFileFoto" value="<?= $inputFotoPE; ?>">
            </div>

            <div class="form-group">
                <label class="text-gray-900" for="penggunaan">Waktu Penggunaan / Non-Aktif</label>
                <div class="row">
                    <div class="col">
                        <input type="datetime-local" value="<?= $pintu['waktu_penggunaan']; ?>" class="form-control rounded-sm <?php if (session('validation.penggunaan')) : ?>is-invalid<?php endif ?>" name="penggunaan" id="penggunaan">
                        <div class="invalid-feedback">
                            <?= session('validation.penggunaan') ?>
                        </div>
                    </div>
                    <h5 class="my-auto font-weight-bold text-gray-900"> s/d </h5>
                    <div class="col">
                        <input type="datetime-local" value="<?= $pintu['non_aktif']; ?>" class="form-control rounded-sm <?php if (session('validation.nonaktif')) : ?>is-invalid<?php endif ?>" name="nonaktif">
                        <div class="invalid-feedback">
                            <?= session('validation.nonaktif') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="text-gray-900" for="target">Target Waktu Penyegelan / Penonaktifan</label>
                <input type="datetime-local" value="<?= $pintu['target_waktu']; ?>" class="form-control rounded-sm <?php if (session('validation.target')) : ?>is-invalid<?php endif ?>" name="target" id="target">
                <div class="invalid-feedback">
                    <?= session('validation.target') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="text-gray-900" for="keperluan">Keperluan</label>
                <input type="text" value="<?= $pintu['keperluan']; ?>" class="form-control rounded-sm <?php if (session('validation.keperluan')) : ?>is-invalid<?php endif ?>" name="keperluan" id="keperluan" placeholder="Keterangan keperluan">
                <div class="invalid-feedback">
                    <?= session('validation.keperluan') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="text-gray-900" for="rencana">Rencana Antisipasi Kondisi Darurat Saat Fasilitas Emergency Tersebut Dimatikan</label>
                <textarea class="form-control rounded-sm <?php if (session('validation.rencana')) : ?>is-invalid<?php endif ?>" name="rencana" id="rencana" rows="5" placeholder="Keterangan Rencana Antisipasi"><?= $pintu['rencana_antisipasi']; ?></textarea>
                <div class="invalid-feedback">
                    <?= session('validation.rencana') ?>
                </div>
            </div>
            <button class="btn-submit-custom" type="submit">
                <div class="svg-wrapper-1">
                    <div class="svg-wrapper">
                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z" fill="currentColor"></path>
                        </svg>
                    </div>
                </div>
                <span>Send</span>
            </button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>