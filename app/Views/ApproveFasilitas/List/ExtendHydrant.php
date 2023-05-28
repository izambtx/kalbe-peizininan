<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <div class="card">

        <!-- Page Heading -->
        <div class="row my-4 mx-3">
            <div class="col-auto mr-auto my-auto">
                <div class="d-flex justify-content-around ">
                    <span class="text-gray-900 h4"><img src="/img/hydrant.png" alt="" style="width:40px;"></span>
                    <div class="d-inline h5 text-gray-900 ml-3 my-auto align-middle font-weight-bold">
                        <span class="align-middle">Hydrant &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 my-1">
                <form action="" method="post" class="d-flex justify-content-between">
                    <input type="text" class="form-control rounded-sm" id="pemohon" maxlength="3" name="pemohon" placeholder="Masukan Nama Pemohon">
                    <input type="date" class="form-control rounded-sm mx-3 " id="waktu" name="waktu">
                    <select class="custom-select rounded-sm col-sm-3" id="lokasi" name="lokasi">
                        <option selected disabled hidden>Lokasi</option>
                        <?php foreach ($lokasi as $d) : ?>
                            <option value="<?= $d['id'];  ?>" <?= old('lokasi') == $d['id'] ? 'selected' : '' ?>><?= $d['nama_lokasi'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success rounded-circle ml-3"><i class="fas fa-plus"></i></button>
                </form>
            </div>
            <?php if ($selectedPemohon || $selectedLokasi || $selectedWaktu) : ?>

                <div class="col d-flex mt-3 justify-content-end">
                    <div class="form-inline rounded">
                        <h6 class="mx-3 align-middle mt-2"> Hasil Pencarian : </h6>
                        <?php if (empty($selectedPemohon)) : ?>
                            <div class="input-group mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                <span class="mt-1 align-middle">
                                    Pemohon
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="input-group mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-check mr-2"></i>
                                    <?= $selectedPemohon; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($selectedWaktu)) : ?>
                            <div class="input-group mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                <span class="mt-1 align-middle">
                                    Waktu
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="input-group mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-check mr-2"></i> <?= date('d M Y', strtotime($selectedWaktu)); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($selectedLokasi)) : ?>
                            <div class="input-group mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                <span class="mt-1 align-middle">
                                    Lokasi
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="input-group mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-check mr-2"></i><?= $lokasiNama['nama_lokasi']; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <table class="table table-hover text-gray-900 text-center">
            <thead>
                <tr>
                    <td class="font-weight-bold" scope="col">No.</td>
                    <td class="font-weight-bold" scope="col">Pemohon</td>
                    <td class="font-weight-bold" scope="col">Lokasi</td>
                    <td class="font-weight-bold" scope="col">Target Waktu</td>
                    <td class="font-weight-bold" scope="col">Status</td>
                    <td class="font-weight-bold" scope="col">Tanggal Permohonan</td>
                    <td class="font-weight-bold" scope="col">Action</td>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 + ($perPage * ($currentPage - 1)); ?>
                <?php foreach ($pintu as $p) : ?>
                    <tr>
                        <td scope="row"><?= $i++; ?></td>
                        <td style="max-width: 10rem;"><?= $p['username']; ?></td>
                        <td style="max-width: 10rem;"><?= $p['nama_lokasi']; ?></td>
                        <td>
                            <?= date('d M Y', strtotime($p['target_waktu'])); ?>
                        </td>
                        <?php if ($p['extend'] == 0) : ?>
                            <td><span class="badge badge-secondary">Pending</span></td>
                        <?php else : ?>
                            <td><span class="badge badge-success">Extended</span></td>
                        <?php endif; ?>
                        <td><?= date('d M Y', strtotime($p['created_at'])); ?></td>
                        <td>
                            <?php if ($p['extend'] == 0) : ?>
                                <button class="btn rounded-circle" data-toggle="modal" data-target="#detailModal<?= $i; ?>">
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/alzqexpi.json" trigger="hover" colors="primary:#121331,secondary:#646e78,tertiary:#ffc738,quaternary:#f9c9c0,quinary:#ebe6ef" style="width:25px;height:25px">
                                    </lord-icon>
                                </button>
                            <?php else : ?>
                                <a href="/ApproveFasilitas/Hydrant/Details/<?= $p['id_izin']; ?>">
                                    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/mrjuyheh.json" trigger="hover" colors="outline:#000000,primary:#000000,secondary:#000000,tertiary:#ffffff" style="width:25px;height:25px">
                                    </lord-icon>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <!-- Detail Izin Modal -->

                    <div class="modal fade" id="detailModal<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content mb-0 rounded border-0">
                                <div class="modal-header bg-gradient-peach rounded-top">
                                    <h5 class="modal-title text-white font-weight-bold" id="exampleModalLabel">Detail Izin Fasilitas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/ExtendFasilitas/Hydrant/<?= $p['id']; ?>" method="post">
                                    <?= csrf_field(); ?>

                                    <input type="hidden" value="<?= $p['id_izin']; ?>" id="id_izin" name="id_izin">
                                    <input type="hidden" value="<?= $p['pembuat']; ?>" id="pembuat" name="pembuat">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="text-gray-900" for="target">Target Waktu (sebelum)</label>
                                            <input type="text" class="form-control rounded-sm bg-light" readonly value="<?= date('d F Y', strtotime($p['target_waktu'])); ?>" id="target">
                                            <div class="invalid-feedback">
                                                <?= session('validation.target') ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-gray-900" for="request">Target Tanggal</label>
                                            <input type="datetime-local" autofocus value="<?= $p['date_request']; ?>" class="form-control rounded-sm" name="request" id="request">
                                            <div class="invalid-feedback">
                                                <?= session('validation.request') ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-gray-900" for="alasan">Alasan</label>
                                            <input type="text" readonly value="<?= $p['alasan']; ?>" class="form-control rounded-sm bg-light" name="alasan" id="alasan">
                                            <div class="invalid-feedback">
                                                <?= session('validation.alasan') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Approve Request</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= \Config\Services::pager()->makeLinks($page, $perPage, $total, 'pager'); ?>
    </div>
</div>

<?= $this->endSection(); ?>