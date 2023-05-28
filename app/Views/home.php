<?= $this->extend('header/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid mb-5 justify-content-center">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php
        $hour = date('H');
        $dayTerm = ($hour > 17) ? "Evening" : (($hour > 12) ? "Afternoon" : "Morning");
        ?>
        <h1 class="h3 ml-5 mb-3 text-gray-900">Good <?= $dayTerm; ?> <span class="font-weight-bold"><?= user()->fullname; ?></span></h1>
    </div>
    <div class="row mb-5">
        <div class="col">
            <div class="position-absolute text-white" style="z-index: 1; top: 25%; left: 12%;">
                <h2 class=" font-weight-bold">
                    UPDATE EMAIL
                </h2>
            </div>
            <div class="position-absolute text-white d-flex justify-content-between" style="z-index: 1; top: 55%; left: 12%;">
                <a class="btn btn-light btn-sm text-black font-weight-bold rounded-sm my-auto" href="/change-email" role="button">
                    UPDATE
                </a>
                <p class="ml-3 my-auto">Harap update data email anda terlebih dahulu sebelum melakukan izin / approve</p>
            </div>
            <svg class="rounded bg-gradient-peach" id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 210" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
                        <stop stop-color="rgba(238, 77, 95, 1)" offset="0%"></stop>
                        <stop stop-color="rgba(255, 205, 165, 1)" offset="100%"></stop>
                    </linearGradient>
                </defs>
                <path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,0L40,17.5C80,35,160,70,240,77C320,84,400,63,480,70C560,77,640,112,720,129.5C800,147,880,147,960,143.5C1040,140,1120,133,1200,133C1280,133,1360,140,1440,129.5C1520,119,1600,91,1680,70C1760,49,1840,35,1920,42C2000,49,2080,77,2160,105C2240,133,2320,161,2400,147C2480,133,2560,77,2640,49C2720,21,2800,21,2880,21C2960,21,3040,21,3120,31.5C3200,42,3280,63,3360,63C3440,63,3520,42,3600,31.5C3680,21,3760,21,3840,24.5C3920,28,4000,35,4080,63C4160,91,4240,140,4320,150.5C4400,161,4480,133,4560,108.5C4640,84,4720,63,4800,73.5C4880,84,4960,126,5040,140C5120,154,5200,140,5280,143.5C5360,147,5440,168,5520,164.5C5600,161,5680,133,5720,119L5760,105L5760,210L5720,210C5680,210,5600,210,5520,210C5440,210,5360,210,5280,210C5200,210,5120,210,5040,210C4960,210,4880,210,4800,210C4720,210,4640,210,4560,210C4480,210,4400,210,4320,210C4240,210,4160,210,4080,210C4000,210,3920,210,3840,210C3760,210,3680,210,3600,210C3520,210,3440,210,3360,210C3280,210,3200,210,3120,210C3040,210,2960,210,2880,210C2800,210,2720,210,2640,210C2560,210,2480,210,2400,210C2320,210,2240,210,2160,210C2080,210,2000,210,1920,210C1840,210,1760,210,1680,210C1600,210,1520,210,1440,210C1360,210,1280,210,1200,210C1120,210,1040,210,960,210C880,210,800,210,720,210C640,210,560,210,480,210C400,210,320,210,240,210C160,210,80,210,40,210L0,210Z"></path>
                <defs>
                    <linearGradient id="sw-gradient-1" x1="0" x2="0" y1="1" y2="0">
                        <stop stop-color="rgba(238, 77, 95, 1)" offset="0%"></stop>
                        <stop stop-color="rgba(255, 205, 165, 1)" offset="100%"></stop>
                    </linearGradient>
                </defs>
                <path style="transform:translate(0, 50px); opacity:0.9" fill="url(#sw-gradient-1)" d="M0,126L40,122.5C80,119,160,112,240,115.5C320,119,400,133,480,119C560,105,640,63,720,38.5C800,14,880,7,960,7C1040,7,1120,14,1200,21C1280,28,1360,35,1440,35C1520,35,1600,28,1680,38.5C1760,49,1840,77,1920,94.5C2000,112,2080,119,2160,119C2240,119,2320,112,2400,122.5C2480,133,2560,161,2640,150.5C2720,140,2800,91,2880,91C2960,91,3040,140,3120,161C3200,182,3280,175,3360,164.5C3440,154,3520,140,3600,119C3680,98,3760,70,3840,52.5C3920,35,4000,28,4080,28C4160,28,4240,35,4320,56C4400,77,4480,112,4560,105C4640,98,4720,49,4800,35C4880,21,4960,42,5040,59.5C5120,77,5200,91,5280,98C5360,105,5440,105,5520,87.5C5600,70,5680,35,5720,17.5L5760,0L5760,210L5720,210C5680,210,5600,210,5520,210C5440,210,5360,210,5280,210C5200,210,5120,210,5040,210C4960,210,4880,210,4800,210C4720,210,4640,210,4560,210C4480,210,4400,210,4320,210C4240,210,4160,210,4080,210C4000,210,3920,210,3840,210C3760,210,3680,210,3600,210C3520,210,3440,210,3360,210C3280,210,3200,210,3120,210C3040,210,2960,210,2880,210C2800,210,2720,210,2640,210C2560,210,2480,210,2400,210C2320,210,2240,210,2160,210C2080,210,2000,210,1920,210C1840,210,1760,210,1680,210C1600,210,1520,210,1440,210C1360,210,1280,210,1200,210C1120,210,1040,210,960,210C880,210,800,210,720,210C640,210,560,210,480,210C400,210,320,210,240,210C160,210,80,210,40,210L0,210Z"></path>
            </svg>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-sm-4">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Pintu Emergency
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $countPintu; ?></div>
                            </div>
                            <div class="col-sm-2 text-primary">
                                <img src="img/emergency-exit.png" alt="" style="width:50px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Hydrant
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Total : <?= $countHydrant; ?></div>
                            </div>
                            <div class="col-sm-2">
                                <img src="img/hydrant.png" alt="" style="width:50px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Smoke/Heat Detector
                                </div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Total : <?= $countSmoke; ?></div>
                            </div>
                            <div class="col-sm-2">
                                <img src="img/smoke-detector.png" alt="" style="width:50px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Returned Card Example -->
            <div class="col mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Fire Alarm
                                </div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Total : <?= $countFire; ?></div>
                            </div>
                            <div class="col-sm-2">
                                <img src="img/fire-button.png" alt="" style="width:50px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">

            <!-- Pie Chart -->
            <div class="col my-0" style="border-radius: 50px;">
                <div class="card shadow rounded">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header rounded-top-lg border-bottom-0 pt-4 d-flex flex-row align-items-center justify-content-between bg-white">
                        <?php if (in_groups('admin')) : ?>
                            <h6 class="m-0 font-weight-bold text-gray-900">All Permit Per Category</h6>
                        <?php else : ?>
                            <h6 class="m-0 font-weight-bold text-gray-900"><span class="text-success"><?= user()->username; ?></span>'s Permit Per Category </h6>
                        <?php endif; ?>
                        <div class="dropdown no-arrow">
                            <a href="<?php base_url() ?>/opl/export" class="download-button dropdown-toggle">
                                <div class="docs py-0"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line y2="13" x2="8" y1="13" x1="16"></line>
                                        <line y2="17" x2="8" y1="17" x1="16"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    Download .XLSX</div>
                                <div class="download">
                                    <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line y2="3" x2="12" y1="15" x1="12"></line>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body rounded-bottom-lg">
                        <div class="chart-pie py-2 my-5">
                            <?php if (!empty($countPintu || $countHydrant || $countSmoke || $countFire)) : ?>
                                <canvas id="myPieChart"></canvas>
                            <?php else : ?>
                                <div class="container h-100">
                                    <div class="row align-items-center h-100">
                                        <span class="mx-auto text-center">Belum Ada Izin Yang Berkaitan Dengan User <span class="text-success font-weight-bold"><?= user()->username; ?></span></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mt-5 mb-2 text-center small">
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

    <!-- Content Row -->
</div>

<input id="CP" type="hidden" value="<?= $countPintu; ?>"></input>
<input id="CH" type="hidden" value="<?= $countHydrant; ?>"></input>
<input id="CS" type="hidden" value="<?= $countSmoke; ?>"></input>
<input id="CF" type="hidden" value="<?= $countFire; ?>"></input>

<?= $this->endSection(); ?>