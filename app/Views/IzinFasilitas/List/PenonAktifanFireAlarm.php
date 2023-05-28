<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>

    <div class="card">

        <!-- Page Heading -->
        <div class="row my-4 mx-3">
            <div class="col-auto mr-auto my-auto">
                <div class="d-flex justify-content-around">
                    <span class="text-gray-900 h4 my-auto"><img src="/img/fire-button.png" alt="" style="width:40px;"></span>
                    <div class="d-inline h5 text-gray-900 ml-3 my-auto align-middle font-weight-bold">
                        <span class="align-middle">Fire Alarm &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
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
                    <td class="font-weight-bold" scope="col">Lokasi</td>
                    <td class="font-weight-bold" scope="col">Waktu Penggunaan</td>
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
                        <td style="max-width: 10rem;"><?= $p['nama_lokasi']; ?></td>
                        <td>
                            <?= date('d M Y - H:i', strtotime($p['waktu_penggunaan'])); ?><br>
                            <span class="font-weight-bold">s/d</span><br>
                            <?= date('d M Y - H:i', strtotime($p['non_aktif'])); ?>
                        </td>
                        <?php if ($p['status'] == 'Created') : ?>
                            <td><span class="badge badge-primary">Created</span></td>
                        <?php elseif ($p['status'] == 'Approved PIC' || $p['status'] == 'Approved PIC 2' || $p['status'] == 'Approved PIC 3' || $p['status'] == 'Approved Engineer' || $p['status'] == 'Approved OHSE') : ?>
                            <td><span class="badge badge-secondary">Waiting</span></td>
                        <?php elseif ($p['status'] == 'Approved Spv/Mgr') : ?>
                            <td><span class="badge badge-info">Approved Spv/Mgr</span></td>
                        <?php elseif ($p['status'] == 'Approved Ketua ERT') : ?>
                            <td><span class="badge badge-primary">Approved</span></td>
                        <?php elseif ($p['status'] == 'OFF') : ?>
                            <td><span class="badge badge-danger">OFF</span></td>
                        <?php elseif ($p['status'] == 'ON') : ?>
                            <td><span class="badge badge-success">ON</span></td>
                        <?php elseif ($p['status'] == 'Updated' || $p['status'] == 'Returned Engineer' || $p['status'] == 'Returned PIC' || $p['status'] == 'Returned PIC 2' || $p['status'] == 'Returned PIC 3' || $p['status'] == 'Returned OHSE' || $p['status'] == 'Returned Ketua ERT') : ?>
                            <td><span class="badge badge-warning"><?= $p['status']; ?></span></td>
                        <?php elseif ($p['status'] == 'Rejected Engineer' || $p['status'] == 'Rejected PIC' || $p['status'] == 'Rejected PIC 2' || $p['status'] == 'Rejected PIC 3' || $p['status'] == 'Rejected OHSE' || $p['status'] == 'Rejected Ketua ERT') : ?>
                            <td><span class="badge badge-danger"><?= $p['status']; ?></span></td>
                        <?php endif; ?>
                        <td><?= date('d M Y', strtotime($p['created_at'])); ?></td>
                        <td>
                            <a href="/PenonAktifanFasilitas/FireAlarm/Details/<?= $p['id']; ?>">
                                <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/mrjuyheh.json" trigger="hover" colors="outline:#000000,primary:#000000,secondary:#000000,tertiary:#ffffff" style="width:25px;height:25px">
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

<?= $this->endSection(); ?>