<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <!-- Content Row -->
    <div class="bg-white rounded-md pb-1">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Filter By Month & Year</button>
                <button class="nav-link" id="nav-creator-tab" data-toggle="tab" data-target="#nav-creator" type="button" role="tab" aria-controls="nav-creator" aria-selected="false">Filter By Creator</button>
                <button class="nav-link" id="nav-pic-tab" data-toggle="tab" data-target="#nav-pic" type="button" role="tab" aria-controls="nav-pic" aria-selected="false">Filter By PIC</button>
                <button class="nav-link" id="nav-engineer-tab" data-toggle="tab" data-target="#nav-engineer" type="button" role="tab" aria-controls="nav-engineer" aria-selected="false">Filter By Engineer</button>
                <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Filter By OHSE / Ketua ERT</button>
                <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Filter By Location</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <form action="" method="post" class="form-inline bg-white pt-3 rounded">
                    <div class="input-group mb-3 col-sm-4">
                        <?php
                        $selected_month = date('m'); //current month

                        echo '<select class="custom-select text-gray-900 font-weight-bold" id="month" name="month">' . "\n";
                        echo '<option selected disabled hidden>Choose Month</option>' . "\n";
                        for ($i_month = 1; $i_month <= 12; $i_month++) {
                            $selected = ($selected_month == $i_month ? ' selected' : '');
                            echo '<option value="' . $i_month . '"' . '>' . date('F', mktime(0, 0, 0, $i_month)) . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                        ?>
                    </div>
                    <div class="input-group mb-3 col-sm-3">
                        <?php
                        $year_start  = 2023;
                        $year_end = date('Y'); // current Year
                        $user_selected_year = 1992; // user date of birth year

                        echo '<select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="year" name="year">' . "\n";
                        echo '<option selected disabled hidden value="$year_end">Choose Year</option>' . "\n";
                        for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                            $selected = ($user_selected_year == $i_year ? ' selected' : '');
                            echo '<option value="' . $i_year . '"' . '>' . $i_year . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                        ?>
                        <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search-plus"></i></button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-creator" role="tabpanel" aria-labelledby="nav-creator-tab">
                <form action="" method="post" class="form-inline bg-white pt-3 rounded">
                    <div class="input-group mb-3 col-sm-4">
                        <?php
                        $selected_month = date('m'); //current month

                        echo '<select class="custom-select text-gray-900 font-weight-bold" id="month" name="month">' . "\n";
                        echo '<option selected disabled hidden>Choose Month</option>' . "\n";
                        for ($i_month = 1; $i_month <= 12; $i_month++) {
                            $selected = ($selected_month == $i_month ? ' selected' : '');
                            echo '<option value="' . $i_month . '"' . '>' . date('F', mktime(0, 0, 0, $i_month)) . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                        ?>
                    </div>
                    <div class="input-group mb-3 col-sm-3">
                        <?php
                        $year_start  = 2023;
                        $year_end = date('Y'); // current Year
                        $user_selected_year = 1992; // user date of birth year

                        echo '<select class="custom-select text-gray-900 font-weight-bold" id="year" name="year">' . "\n";
                        echo '<option selected disabled hidden value="$year_end">Choose Year</option>' . "\n";
                        for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                            $selected = ($user_selected_year == $i_year ? ' selected' : '');
                            echo '<option value="' . $i_year . '"' . '>' . $i_year . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                        ?>
                    </div>
                    <div class="input-group mb-3 col-sm-5">
                        <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="creator" name="creator">
                            <option selected hidden disabled>Choose User</option>
                            <?php foreach ($picList as $pL) : ?>
                                <option value="<?= $pL['id'];  ?>"><?= $pL['fullname'];  ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search-plus"></i></button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-pic" role="tabpanel" aria-labelledby="nav-pic-tab">
                <form action="" method="post" class="form-inline bg-white pt-3 rounded">
                    <div class="input-group mb-3 col-sm-4">
                        <?php
                        $selected_month = date('m'); //current month

                        echo '<select class="custom-select text-gray-900 font-weight-bold" id="month" name="month">' . "\n";
                        echo '<option selected disabled hidden>Choose Month</option>' . "\n";
                        for ($i_month = 1; $i_month <= 12; $i_month++) {
                            $selected = ($selected_month == $i_month ? ' selected' : '');
                            echo '<option value="' . $i_month . '"' . '>' . date('F', mktime(0, 0, 0, $i_month)) . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                        ?>
                    </div>
                    <div class="input-group mb-3 col-sm-3">
                        <?php
                        $year_start  = 2023;
                        $year_end = date('Y'); // current Year
                        $user_selected_year = 1992; // user date of birth year

                        echo '<select class="custom-select text-gray-900 font-weight-bold" id="year" name="year">' . "\n";
                        echo '<option selected disabled hidden value="$year_end">Choose Year</option>' . "\n";
                        for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                            $selected = ($user_selected_year == $i_year ? ' selected' : '');
                            echo '<option value="' . $i_year . '"' . '>' . $i_year . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                        ?>
                    </div>
                    <div class="input-group mb-3 col-sm-5">
                        <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="pic" name="pic">
                            <option selected hidden disabled>Choose User</option>
                            <?php foreach ($picList as $pL) : ?>
                                <option value="<?= $pL['id'];  ?>"><?= $pL['fullname'];  ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search-plus"></i></button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-engineer" role="tabpanel" aria-labelledby="nav-engineer-tab">
                <form action="" method="post" class="form-inline bg-white pt-3 rounded">
                    <div class="input-group mb-3 col-sm-4">
                        <?php
                        $selected_month = date('m'); //current month

                        echo '<select class="custom-select text-gray-900 font-weight-bold" id="month" name="month">' . "\n";
                        echo '<option selected disabled hidden>Choose Month</option>' . "\n";
                        for ($i_month = 1; $i_month <= 12; $i_month++) {
                            $selected = ($selected_month == $i_month ? ' selected' : '');
                            echo '<option value="' . $i_month . '"' . '>' . date('F', mktime(0, 0, 0, $i_month)) . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                        ?>
                    </div>
                    <div class="input-group mb-3 col-sm-3">
                        <?php
                        $year_start  = 2023;
                        $year_end = date('Y'); // current Year
                        $user_selected_year = 1992; // user date of birth year

                        echo '<select class="custom-select text-gray-900 font-weight-bold" id="year" name="year">' . "\n";
                        echo '<option selected disabled hidden value="$year_end">Choose Year</option>' . "\n";
                        for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                            $selected = ($user_selected_year == $i_year ? ' selected' : '');
                            echo '<option value="' . $i_year . '"' . '>' . $i_year . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                        ?>
                    </div>
                    <div class="input-group mb-3 col-sm-5">
                        <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="eng" name="eng">
                            <option selected hidden disabled>Choose User</option>
                            <?php foreach ($engList as $eL) : ?>
                                <option value="<?= $eL['id'];  ?>"><?= $eL['fullname'];  ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search-plus"></i></button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form action="" method="post" class="form-inline bg-white pt-3 rounded">
                    <div class="input-group mb-3 col-sm-4">
                        <?php
                        $selected_month = date('m'); //current month

                        echo '<select class="custom-select text-gray-900 font-weight-bold" id="month" name="month">' . "\n";
                        echo '<option selected disabled hidden>Choose Month</option>' . "\n";
                        for ($i_month = 1; $i_month <= 12; $i_month++) {
                            $selected = ($selected_month == $i_month ? ' selected' : '');
                            echo '<option value="' . $i_month . '"' . '>' . date('F', mktime(0, 0, 0, $i_month)) . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                        ?>
                    </div>
                    <div class="input-group mb-3 col-sm-3">
                        <?php
                        $year_start  = 2023;
                        $year_end = date('Y'); // current Year
                        $user_selected_year = 1992; // user date of birth year

                        echo '<select class="custom-select text-gray-900 font-weight-bold" id="year" name="year">' . "\n";
                        echo '<option selected disabled hidden value="$year_end">Choose Year</option>' . "\n";
                        for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                            $selected = ($user_selected_year == $i_year ? ' selected' : '');
                            echo '<option value="' . $i_year . '"' . '>' . $i_year . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                        ?>
                    </div>
                    <div class="input-group mb-3 col-sm-5">
                        <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="users" name="users">
                            <option selected hidden disabled>Choose User</option>
                            <?php foreach ($usersList as $uL) : ?>
                                <option value="<?= $uL['id'];  ?>"><?= $uL['fullname'];  ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search-plus"></i></button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <form action="" method="post" class="form-inline bg-white pt-3 rounded">
                    <div class="input-group mb-3 col-sm-4">
                        <?php
                        $selected_month = date('m'); //current month

                        echo '<select class="custom-select text-gray-900 font-weight-bold" id="month" name="month">' . "\n";
                        echo '<option selected disabled hidden>Choose Month</option>' . "\n";
                        for ($i_month = 1; $i_month <= 12; $i_month++) {
                            $selected = ($selected_month == $i_month ? ' selected' : '');
                            echo '<option value="' . $i_month . '"' . '>' . date('F', mktime(0, 0, 0, $i_month)) . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                        ?>
                    </div>
                    <div class="input-group mb-3 col-sm-3">
                        <?php
                        $year_start  = 2023;
                        $year_end = date('Y'); // current Year
                        $user_selected_year = 1992; // user date of birth year

                        echo '<select class="custom-select text-gray-900 font-weight-bold" id="year" name="year">' . "\n";
                        echo '<option selected disabled hidden value="$year_end">Choose Year</option>' . "\n";
                        for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                            $selected = ($user_selected_year == $i_year ? ' selected' : '');
                            echo '<option value="' . $i_year . '"' . '>' . $i_year . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                        ?>
                    </div>
                    <div class="input-group mb-3 col-sm-5">
                        <select class="custom-select text-gray-900 font-weight-bold rounded-sm" id="lokasi" name="lokasi">
                            <option selected disabled hidden>Choose Location</option>
                            <?php foreach ($lokasiList as $d) : ?>
                                <option value="<?= $d['id'];  ?>" <?= old('lokasi') == $d['id'] ? 'selected' : '' ?>><?= $d['nama_lokasi'];  ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-success ml-3"><i class="fas fa-search-plus"></i></button>
                    </div>
                </form>
            </div>

            <?php if ($month && $year) : ?>

                <div class="ml-4 mr-5 mb-3 border border-abu p-3 rounded">
                    <h6 class="text-gray-900 font-weight-bold">Filter Tags</h6>
                    <div class="form-inline ml-2 pl-2 rounded">
                        <div class="input-group mt-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                            <span class="mt-1 align-middle">
                                <i class="fas fa-check mr-2"></i><?= date("F", mktime(0, 0, 0, $month)); ?>&nbsp;
                            </span>
                        </div>
                        <div class="input-group mt-2 mx-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                            <span class="mt-1 align-middle">
                                <i class="fas fa-check mr-2"></i><?= $year; ?>&nbsp;
                            </span>
                        </div>
                        <?php if (empty($creator)) : ?>
                            <div class="input-group mt-2 mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                <span class="mt-1 align-middle">
                                    Creator
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="input-group mt-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-check mr-2"></i><?= $creatorNama['fullname']; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($pic)) : ?>
                            <div class="input-group mt-2 mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                <span class="mt-1 align-middle">
                                    PIC
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="input-group mt-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-check mr-2"></i><?= $picNama['fullname']; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($eng)) : ?>
                            <div class="input-group mt-2 mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                <span class="mt-1 align-middle">
                                    Engineer
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="input-group mt-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-check mr-2"></i><?= $engNama['fullname']; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($users)) : ?>
                            <div class="input-group mt-2 mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                <span class="mt-1 align-middle">
                                    OHSE / Ketua ERT
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="input-group mt-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-check mr-2"></i><?= $usersNama['fullname']; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($lokasi)) : ?>
                            <div class="input-group mt-2 mr-2 bg-light text-gray-800 text-center font-weight-bold form-control rounded border border-abu">
                                <span class="mt-1 align-middle">
                                    Location
                                </span>
                            </div>
                        <?php else : ?>
                            <div class="input-group mt-2 mr-2 bg-light text-success text-center font-weight-bold form-control rounded border border-success">
                                <span class="mt-1 align-middle">
                                    <i class="fas fa-check mr-2"></i><?= $lokasiNama['nama_lokasi']; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Area / Bar Chart -->
        <div class="col">
            <div class="card mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header rounded-lg bg-white border-bottom-0 py-4 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="font-weight-bold text-gray-900">Laporan Grafik Izin Fasilitas</h6>
                    <div class="dropdown no-arrow">
                        <?php
                        $request = \Config\Services::request();
                        $filter = $request->getVar('filter');
                        $month = $request->getVar('month');
                        $year = $request->getVar('year');
                        $creator = $request->getVar('creator');
                        $pic = $request->getVar('pic');
                        $eng = $request->getVar('eng');
                        $users = $request->getVar('users');
                        $lokasi = $request->getVar('lokasi');

                        if ($month && $year && $creator) {

                            $param = "?month=" . $month . "&year=" . $year . "&creator=" . $creator;
                        } elseif ($month && $year && $pic) {

                            $param = "?month=" . $month . "&year=" . $year . "&pic=" . $pic;
                        } elseif ($month && $year && $eng) {

                            $param = "?month=" . $month . "&year=" . $year . "&eng=" . $eng;
                        } elseif ($month && $year && $users) {

                            $param = "?month=" . $month . "&year=" . $year . "&users=" . $users;
                        } elseif ($month && $year && $lokasi) {

                            $param = "?month=" . $month . "&year=" . $year . "&lokasi=" . $lokasi;
                        } elseif ($month && $year) {

                            $param = "?month=" . $month . "&year=" . $year;
                        }
                        ?>
                        <?php if ($countTB == 0 && $countTF == 0  && $countTU == 0  && $countTL == 0) : ?>
                            <button type="button" id="tombolError" class="download-button dropdown-toggle">
                                <div class="docs">
                                    <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line y2="13" x2="8" y1="13" x1="16"></line>
                                        <line y2="17" x2="8" y1="17" x1="16"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    Download .XLSX
                                </div>
                                <div class="download">
                                    <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line y2="3" x2="12" y1="15" x1="12"></line>
                                    </svg>
                                </div>
                            </button>
                        <?php else : ?>
                            <a href="<?php base_url() ?>/opl/export<?= $param; ?>" class="download-button">
                                <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line y2="13" x2="8" y1="13" x1="16"></line>
                                        <line y2="17" x2="8" y1="17" x1="16"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>Download .XLSX</div>
                                <div class="download">
                                    <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line y2="3" x2="12" y1="15" x1="12"></line>
                                    </svg>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body mb-1">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2 text-dark">
                            <i class="fas fa-circle text-primary"></i> Pintu Emergency
                        </span>
                        <span class="mr-2 text-dark">
                            <i class="fas fa-circle text-success"></i> Hydrant
                        </span>
                        <span class="mr-2 text-dark">
                            <i class="fas fa-circle text-warning"></i> Smoke/Heat Detector
                        </span>
                        <span class="mr-2 text-dark">
                            <i class="fas fa-circle text-danger"></i> Fire Alarm
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BUAT CHART AREA BUILDING -->

<?php $i = 1; ?>
<?php if ($countTMB == 0) : ?>

    <input id="qcpMB1" type="hidden" value="0"></input>
    <input id="qcpMB2" type="hidden" value="0"></input>
    <input id="qcpMB3" type="hidden" value="0"></input>
    <input id="qcpMB4" type="hidden" value="0"></input>
    <input id="qcpMB5" type="hidden" value="0"></input>

<?php elseif ($countTMB == 1) : ?>

    <?php foreach ($countMB as $CMB) : ?>
        <input id="qcpMB<?= $i++; ?>" type="hidden" value="<?= $CMB['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpMB2" type="hidden" value="0"></input>
    <input id="qcpMB3" type="hidden" value="0"></input>
    <input id="qcpMB4" type="hidden" value="0"></input>
    <input id="qcpMB5" type="hidden" value="0"></input>

<?php elseif ($countTMB == 2) : ?>

    <?php foreach ($countMB as $CMB) : ?>
        <input id="qcpMB<?= $i++; ?>" type="hidden" value="<?= $CMB['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpMB3" type="hidden" value="0"></input>
    <input id="qcpMB4" type="hidden" value="0"></input>
    <input id="qcpMB5" type="hidden" value="0"></input>

<?php elseif ($countTMB == 3) : ?>

    <?php foreach ($countMB as $CMB) : ?>
        <input id="qcpMB<?= $i++; ?>" type="hidden" value="<?= $CMB['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpMB4" type="hidden" value="0"></input>
    <input id="qcpMB5" type="hidden" value="0"></input>

<?php elseif ($countTMB == 4) : ?>

    <?php foreach ($countMB as $CMB) : ?>
        <input id="qcpMB<?= $i++; ?>" type="hidden" value="<?= $CMB['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpMB5" type="hidden" value="0"></input>

<?php elseif ($countTMB == 5) : ?>

    <?php foreach ($countMB as $CMB) : ?>
        <input id="qcpMB<?= $i++; ?>" type="hidden" value="<?= $CMB['id']; ?>"></input>
    <?php endforeach; ?>
<?php endif; ?>

<!-- BUAT CHART AREA FACILITY -->

<?php $i = 1; ?>
<?php if ($countTMF == 0) : ?>

    <input id="qcpMF1" type="hidden" value="0"></input>
    <input id="qcpMF2" type="hidden" value="0"></input>
    <input id="qcpMF3" type="hidden" value="0"></input>
    <input id="qcpMF4" type="hidden" value="0"></input>
    <input id="qcpMF5" type="hidden" value="0"></input>

<?php elseif ($countTMF == 1) : ?>

    <?php foreach ($countMF as $CMF) : ?>
        <input id="qcpMF<?= $i++; ?>" type="hidden" value="<?= $CMF['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpMF2" type="hidden" value="0"></input>
    <input id="qcpMF3" type="hidden" value="0"></input>
    <input id="qcpMF4" type="hidden" value="0"></input>
    <input id="qcpMF5" type="hidden" value="0"></input>

<?php elseif ($countTMF == 2) : ?>

    <?php foreach ($countMF as $CMF) : ?>
        <input id="qcpMF<?= $i++; ?>" type="hidden" value="<?= $CMF['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpMF3" type="hidden" value="0"></input>
    <input id="qcpMF4" type="hidden" value="0"></input>
    <input id="qcpMF5" type="hidden" value="0"></input>

<?php elseif ($countTMF == 3) : ?>

    <?php foreach ($countMF as $CMF) : ?>
        <input id="qcpMF<?= $i++; ?>" type="hidden" value="<?= $CMF['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpMF4" type="hidden" value="0"></input>
    <input id="qcpMF5" type="hidden" value="0"></input>

<?php elseif ($countTMF == 4) : ?>

    <?php foreach ($countMF as $CMF) : ?>
        <input id="qcpMF<?= $i++; ?>" type="hidden" value="<?= $CMF['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpMF5" type="hidden" value="0"></input>

<?php elseif ($countTMF == 5) : ?>
    <?php foreach ($countMF as $CMF) : ?>
        <input id="qcpMF<?= $i++; ?>" type="hidden" value="<?= $CMF['id']; ?>"></input>
    <?php endforeach; ?>
<?php endif; ?>

<!-- BUAT CHART AREA UTILITY -->

<?php $i = 1; ?>
<?php if ($countTMU == 0) : ?>
    <input id="qcpMU1" type="hidden" value="0"></input>
    <input id="qcpMU2" type="hidden" value="0"></input>
    <input id="qcpMU3" type="hidden" value="0"></input>
    <input id="qcpMU4" type="hidden" value="0"></input>
    <input id="qcpMU5" type="hidden" value="0"></input>
<?php elseif ($countTMU == 1) : ?>

    <?php foreach ($countMU as $CMU) : ?>
        <input id="qcpMU<?= $i++; ?>" type="hidden" value="<?= $CMU['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpMU2" type="hidden" value="0"></input>
    <input id="qcpMU3" type="hidden" value="0"></input>
    <input id="qcpMU4" type="hidden" value="0"></input>
    <input id="qcpMU5" type="hidden" value="0"></input>

<?php elseif ($countTMU == 2) : ?>

    <?php foreach ($countMU as $CMU) : ?>
        <input id="qcpMU<?= $i++; ?>" type="hidden" value="<?= $CMU['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpMU3" type="hidden" value="0"></input>
    <input id="qcpMU4" type="hidden" value="0"></input>
    <input id="qcpMU5" type="hidden" value="0"></input>

<?php elseif ($countTMU == 3) : ?>

    <?php foreach ($countMU as $CMU) : ?>
        <input id="qcpMU<?= $i++; ?>" type="hidden" value="<?= $CMU['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpMU4" type="hidden" value="0"></input>
    <input id="qcpMU5" type="hidden" value="0"></input>

<?php elseif ($countTMU == 4) : ?>

    <?php foreach ($countMU as $CMU) : ?>
        <input id="qcpMU<?= $i++; ?>" type="hidden" value="<?= $CMU['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpMU5" type="hidden" value="0"></input>

<?php elseif ($countTMU == 5) : ?>

    <?php foreach ($countMU as $CMU) : ?>
        <input id="qcpMU<?= $i++; ?>" type="hidden" value="<?= $CMU['id']; ?>"></input>
    <?php endforeach; ?>
<?php endif; ?>

<!-- BUAT CHART AREA LAIN-LAIN -->

<?php $i = 1; ?>
<?php if ($countTML == 0) : ?>

    <input id="qcpML1" type="hidden" value="0"></input>
    <input id="qcpML2" type="hidden" value="0"></input>
    <input id="qcpML3" type="hidden" value="0"></input>
    <input id="qcpML4" type="hidden" value="0"></input>
    <input id="qcpML5" type="hidden" value="0"></input>

<?php elseif ($countTML == 1) : ?>

    <?php foreach ($countML as $CML) : ?>
        <input id="qcpML<?= $i++; ?>" type="hidden" value="<?= $CML['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpML2" type="hidden" value="0"></input>
    <input id="qcpML3" type="hidden" value="0"></input>
    <input id="qcpML4" type="hidden" value="0"></input>
    <input id="qcpML5" type="hidden" value="0"></input>

<?php elseif ($countTML == 2) : ?>

    <?php foreach ($countML as $CML) : ?>
        <input id="qcpML<?= $i++; ?>" type="hidden" value="<?= $CML['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpML3" type="hidden" value="0"></input>
    <input id="qcpML4" type="hidden" value="0"></input>
    <input id="qcpML5" type="hidden" value="0"></input>

<?php elseif ($countTML == 3) : ?>

    <?php foreach ($countML as $CML) : ?>
        <input id="qcpML<?= $i++; ?>" type="hidden" value="<?= $CML['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpML4" type="hidden" value="0"></input>
    <input id="qcpML5" type="hidden" value="0"></input>

<?php elseif ($countTML == 4) : ?>

    <?php foreach ($countML as $CML) : ?>
        <input id="qcpML<?= $i++; ?>" type="hidden" value="<?= $CML['id']; ?>"></input>
    <?php endforeach; ?>
    <input id="qcpML5" type="hidden" value="0"></input>

<?php elseif ($countTML == 5) : ?>

    <?php foreach ($countML as $CML) : ?>
        <input id="qcpML<?= $i++; ?>" type="hidden" value="<?= $CML['id']; ?>"></input>
    <?php endforeach; ?>
<?php endif; ?>
<?= $this->endSection(); ?>