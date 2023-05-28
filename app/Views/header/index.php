<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT. Kalbe Farma Tbk</title>

    <link rel="icon" type="img/x-icon" href="/img/favicon.ico">
    <!-- Custom fonts for this template-->
    <link href="<?php base_url(); ?>/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <link type="text/css" href="<?php base_url(); ?>/css/sb-admin-2.css" rel="stylesheet">
</head>

<body id="page-top" onload="autoClick();">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light bg-white accordion shadow-no-bottom" style="z-index: 1;" id="accordionSidebar">
            <div class="sticky-top text-gray-900">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand rounded-bottom-lg d-flex align-items-center justify-content-center" href="<?= base_url(); ?>/Home">
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Home</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php base_url(); ?>/Dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">
                </hr>

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <?php if (in_groups('engineer') || in_groups('manager') || in_groups('ERT') || in_groups('OHSE')) : ?>

                    <!-- Nav Item - Approve Izin Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-file-signature"></i>
                            <span>Form Permohonan Izin</span>
                        </a>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="py-2 collapse-inner rounded" style="background-color: #eaeaea;">
                                <h6 class="collapse-header text-gray-900">Kategori :</h6>
                                <a class="collapse-item" href="<?= base_url(); ?>/ApproveFasilitas/PintuEmergency">Pintu Emergency</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/ApproveFasilitas/Hydrant">Hydrant</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/ApproveFasilitas/SmokeHeatDetector">Smoke/Heat Detector</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/ApproveFasilitas/FireAlarm">Fire Alarm</a>
                            </div>
                        </div>
                    </li>

                    <!-- Nav Item - Pengaktifan Izin Menu -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            <i class="fas fa-inbox"></i>
                            <span>Pengaktifan (Closing)</span>
                        </a>
                        <div id="collapseThree" class="collapse pb-1" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="py-2 collapse-inner rounded" style="background-color: #eaeaea;">
                                <h6 class="collapse-header text-gray-900">Kategori :</h6>
                                <a class="collapse-item" href="<?= base_url(); ?>/PengaktifanFasilitas/PintuEmergency">Pintu Emergency</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/PengaktifanFasilitas/Hydrant">Hydrant</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/PengaktifanFasilitas/SmokeHeatDetector">Smoke/Heat Detector</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/PengaktifanFasilitas/FireAlarm">Fire Alarm</a>
                            </div>
                        </div>
                    </li>

                    <!-- Nav Item - History Izin Menu -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-history"></i>
                            <span>History Izin Akses</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="py-2 collapse-inner rounded" style="background-color: #eaeaea;">
                                <h6 class="collapse-header text-gray-900">Kategori :</h6>
                                <a class="collapse-item" href="<?= base_url(); ?>/HistoryFasilitas/PintuEmergency">Pintu Emergency</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/HistoryFasilitas/Hydrant">Hydrant</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/HistoryFasilitas/SmokeHeatDetector">Smoke/Heat Detector</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/HistoryFasilitas/FireAlarm">Fire Alarm</a>
                            </div>
                        </div>
                    </li>

                    <?php if (in_groups('OHSE')) : ?>

                        <!-- Nav Item - Perpanjang Izin OHSE Menu -->
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                <i class="fas fa-calendar-day"></i>
                                <span>Perpanjang Izin</span>
                            </a>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                                <div class="py-2 collapse-inner rounded" style="background-color: #eaeaea;">
                                    <h6 class="collapse-header text-gray-900">Kategori :</h6>
                                    <a class="collapse-item" href="<?= base_url(); ?>/ExtendFasilitas/PintuEmergency">Pintu Emergency</a>
                                    <a class="collapse-item" href="<?= base_url(); ?>/ExtendFasilitas/Hydrant">Hydrant</a>
                                    <a class="collapse-item" href="<?= base_url(); ?>/ExtendFasilitas/SmokeHeatDetector">Smoke/Heat Detector</a>
                                    <a class="collapse-item" href="<?= base_url(); ?>/ExtendFasilitas/FireAlarm">Fire Alarm</a>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (in_groups('admin')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin'); ?>">
                            <i class="fas fa-users-cog"></i>
                            <span>Users Management</span></a>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (in_groups('supervisor') || in_groups('admin')) : ?>

                    <!-- Nav Item - Add Izin Menu -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-file-medical"></i>
                            <span>Form Permohonan Izin</span>
                        </a>
                        <div id="collapseUtilities" class="collapse pb-1" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                            <div class="py-2 collapse-inner rounded" style="background-color: #eaeaea;">
                                <h6 class="collapse-header text-gray-900">Kategori :</h6>
                                <a class="collapse-item" href="<?= base_url(); ?>/IzinFasilitas/PintuEmergency">Pintu Emergency</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/IzinFasilitas/Hydrant">Hydrant</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/IzinFasilitas/SmokeHeatDetector">Smoke/Heat Detector</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/IzinFasilitas/FireAlarm">Fire Alarm</a>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if (in_groups('supervisor')) : ?>

                    <!-- Nav Item - On / Off Fasilitas Menu -->

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fab fa-readme"></i>
                            <span>On / Off Fasilitas</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="py-2 collapse-inner rounded" style="background-color: #eaeaea;">
                                <h6 class="collapse-header text-gray-900">Kategori :</h6>
                                <a class="collapse-item" href="<?= base_url(); ?>/PenonAktifanFasilitas/PintuEmergency">Pintu Emergency</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/PenonAktifanFasilitas/Hydrant">Hydrant</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/PenonAktifanFasilitas/SmokeHeatDetector">Smoke/Heat Detector</a>
                                <a class="collapse-item" href="<?= base_url(); ?>/PenonAktifanFasilitas/FireAlarm">Fire Alarm</a>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Support
                </div>

                <!-- Nav Item - Tutorial & Penjelasan -->
                <li class="nav-item rounded">
                    <a class="nav-link" target="_blank" href="">
                        <i class="fas fa-video"></i>
                        <span>Tutorial & Penjelasan</span>
                    </a>
                </li>

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center mt-4">
                    <button class="rounded-circle border-0 bg-gradient-peach" id="sidebarToggle"></button>
                </div>

                <!-- Divider -->
                <!-- <hr class="sidebar-divider">

                <div class="row">
                    <div class="col text-center px-0">
                        <img class="img-profile rounded-circle mx-auto w-75" src="<?php base_url(); ?>/img/<?= user()->user_image; ?>">
                    </div>
                    <div class="col my-auto">
                        <a class="nav-link text-left text-gray-900" href="<?= base_url('/view_profile'); ?>" role="button">
                            <h6 class="d-none d-lg-inline font-weight-bold"><?= user()->fullname; ?></h6>
                            <h6 class="d-none d-lg-inline "><u>Settings</u> <i class="fas fa-cog"></i></h6>
                        </a>
                    </div>
                </div> -->
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="background-color: #eaeaea;">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-gradient-peach topbar mb-5 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <h3 class="col-sm-1">
                    <img draggable="false" src="/img/Logo Kalbe trans kecil.png" class="mt-2 img-thumbnail col-auto bg-transparent border-0">
                </h3>

                <!-- <h3 class="font-weight-bold text-gray-900 my-auto ml-4">
                    <span class="">Izin Akses Fasilitas Emergency</span>
                </h3> -->
                <span class="text-white align-text-bottom topbar-divider rounded"></span>

                <h3 class="font-weight-bold text-white my-auto ml-4">
                    <span class=""><?= $title; ?></span>
                </h3>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto mr-5">

                    <!-- <div class="topbar-divider d-none d-sm-block rounded"></div> -->

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow mb-1 card-profile">
                        <a class="nav-link dropdown-toggle my-auto" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-white small"><?= user()->fullname; ?></span>
                            <img class="img-profile rounded-circle" src="<?php base_url(); ?>/img/<?= user()->user_image; ?>">
                            <i class="ml-2 fas fa-angle-down" style="color: #ffffff;"></i>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="/view_profile">
                                <i class="fas fa-user fa-sm fa-fw mr-2" style="color: #ee4d5f;"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="/change-password">
                                <i class="fas fa-key mr-2" style="color: #ee4d5f;"></i>
                                Change Password
                            </a>
                            <a class="dropdown-item" href="/change-email">
                                <i class="fas fa-at mr-2" style="color: #ee4d5f;"></i>
                                Update Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item bg-danger text-white" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2" style="color: #fff;"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                    <!-- Nav Item - Logout -->
                    <!-- <li class="nav-item dropdown no-arrow rounded-circle bg-white">
                        <a class="nav-link text-danger pt-1" data-toggle="modal" data-target="#logoutModal" role="button">
                            <i class="fas fa-power-off"></i>
                        </a>
                    </li> -->
                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <?= $this->renderSection('page-content'); ?>
                <!-- /.container-fluid -->




            </div>
            <!-- End of Main Content -->
        </div>

    </div>
    <!-- End of Content Wrapper -->
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; opl.kalbe.site 2023</span>
                <span class="d-flex justify-content-end">V1.0</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <div class="loader-wrapper row align-items-center justify-content-center">
        <div class="loader">
            <svg role="img" aria-label="Mouth and eyes come from 9:00 and rotate clockwise into position, right eye blinks, then all parts rotate and merge into 3:00" class="smiley" viewBox="0 0 128 128">
                <defs>
                    <clipPath id="smiley-eyes">
                        <circle class="smiley__eye1" cx="64" cy="64" r="8" transform="rotate(-40,64,64) translate(0,-56)" />
                        <circle class="smiley__eye2" cx="64" cy="64" r="8" transform="rotate(40,64,64) translate(0,-56)" />
                    </clipPath>
                    <linearGradient id="smiley-grad" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#000" />
                        <stop offset="100%" stop-color="#fff" />
                    </linearGradient>
                    <mask id="smiley-mask">
                        <rect x="0" y="0" width="128" height="128" fill="url(#smiley-grad)" />
                    </mask>
                </defs>
                <g stroke-linecap="round" stroke-width="12" stroke-dasharray="175.93 351.86">
                    <g>
                        <rect fill="hsl(0, 100%, 83%)" width="128" height="64" clip-path="url(#smiley-eyes)" />
                        <g fill="none" stroke="hsl(0, 100%, 83%)">
                            <circle class="smiley__mouth1" cx="64" cy="64" r="56" transform="rotate(180,64,64)" />
                            <circle class="smiley__mouth2" cx="64" cy="64" r="56" transform="rotate(0,64,64)" />
                        </g>
                    </g>
                    <g mask="url(#smiley-mask)">
                        <rect fill="hsl(0, 100%, 83%)" width="128" height="64" clip-path="url(#smiley-eyes)" />
                        <g fill="none" stroke="hsl(357, 90%, 84%)">
                            <circle class="smiley__mouth1" cx="64" cy="64" r="56" transform="rotate(180,64,64)" />
                            <circle class="smiley__mouth2" cx="64" cy="64" r="56" transform="rotate(0,64,64)" />
                        </g>
                    </g>
                </g>
            </svg>
            <span>Loading...</span>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded-circle" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded">
                <button class="close d-flex justify-content-end mt-3 mr-3" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <img class="img-profile rounded-circle mx-auto d-block w-25" src="<?php base_url(); ?>/img/logout.gif">
                <div class="modal-body h4 text-center mb-0 font-weight-bold text-gray-900">Ready to Leave?</div>
                <h6 class="text-center mt-0 mb-4">You are going to logout from here</h6>
                <a class="btn btn-danger py-2 rounded mx-5 mt-2" href="<?= base_url('logout'); ?>">Yes, Logout</a>
                <button class="btn text-danger border-0 py-2 rounded mx-5 mt-2 mb-4" type="button" data-dismiss="modal">Keep Login</button>
            </div>
        </div>
    </div>

    <script src="<?php base_url(); ?>/js/script.js"></script>
    <script src="<?php base_url(); ?>/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="<?php base_url(); ?>/js/sweetalert2.min.css">

    <!-- Bootstrap core JavaScript-->
    <script src="<?php base_url(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php base_url(); ?>/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php base_url(); ?>/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php base_url(); ?>/js/demo/chart-area-demo.js"></script>
    <script src="<?php base_url(); ?>/js/demo/chart-pie-demo.js"></script>
    <script src="<?php base_url(); ?>/js/demo/chart-bar-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>

    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="<?php base_url(); ?>/js/myalert.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js" integrity="sha512-01CJ9/g7e8cUmY0DFTMcUw/ikS799FHiOA0eyHsUWfOetgbx/t6oV4otQ5zXKQyIrQGTHSmRVPIgrgLcZi/WMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/g/filesaver.js"></script>
    <script>
        $(document).ready(function() {
            $("#downloadOPL").click(function() {
                domtoimage.toBlob(document.getElementById('contentOPL')).then(function(blob) {
                    window.saveAs(blob, "ImageOPL.png")
                })
                let timerInterval
                Swal.fire({
                    title: 'Downloading Content...',
                    html: 'Loading in <b></b> milliseconds.',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('Closed by the timer')
                    }
                })
            })
        })
    </script>

    <!-- <script>
        $(document).ready(function() {
            $('#distribusi').change(function(e) {
                var distribusi = $("#distribusi").val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Users/distribusiUsers'); ?>",
                    data: {
                        distribusi: distribusi
                    },
                    success: function(response) {
                        $("#users").html(response);
                    }
                })
            })
        });
    </script> -->

    <script>
        const tombolError = document.querySelector('#tombolError');
        tombolError.addEventListener('click', function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data Perizinan Yang Akan di Export Masih Kosong',
                showConfirmButton: false,
                timer: 2500,
                customClass: 'animated tada rounded-md'
            });
        });
    </script>
    <script>
        const tombolSuccess = document.querySelector('#tombolSuccess');
        tombolSuccess.addEventListener('click', function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data Perizinan Yang Akan di Export Masih Kosong',
                showConfirmButton: false,
                timer: 2500,
                customClass: 'animated tada rounded-md'
            });
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', 'nav ol li', function() {
            $(this).addClass('active bg-success rounded-sm px-2').siblings().removeClass('active bg-success rounded-sm px-2')
        })
    </script>

    <?php for ($i = 1; $i <= 10; $i++) : ?>
        <script>
            function preview_sebelum<?= $i; ?>() {
                counter += 1;
                const foto_sebelum = document.querySelector('#foto_sebelum<?= $i; ?>');
                const foto_sebelum_label = document.querySelector('#label_sebelum<?= $i; ?>');
                const foto_sebelum_preview = document.querySelector('.sebelum-preview<?= $i; ?>');

                foto_sebelum_label.textContent = foto_sebelum.files[0].name;

                const file_foto_sebelum = new FileReader();
                file_foto_sebelum.readAsDataURL(foto_sebelum.files[0]);

                file_foto_sebelum.onload = function(e) {
                    foto_sebelum_preview.src = e.target.result;
                }
            }
        </script>
    <?php endfor; ?>
    <script>
        function preview_sesudah() {
            const foto_sesudah = document.querySelector('#foto_sesudah');
            const foto_sesudah_label = document.querySelector('#label_sesudah');
            const foto_sesudah_preview = document.querySelector('.sesudah-preview');

            foto_sesudah_label.textContent = foto_sesudah.files[0].name;

            const file_foto_sesudah = new FileReader();
            file_foto_sesudah.readAsDataURL(foto_sesudah.files[0]);

            file_foto_sesudah.onload = function(e) {
                foto_sesudah_preview.src = e.target.result;
            }
        }
    </script>
    <script>
        function preview_foto3() {
            const foto3 = document.querySelector('#foto3');
            const foto3_label = document.querySelector('#label_foto3');
            const foto3_preview = document.querySelector('.foto3-preview');

            foto3_label.textContent = foto3.files[0].name;

            const file_foto3 = new FileReader();
            file_foto3.readAsDataURL(foto3.files[0]);

            file_foto3.onload = function(e) {
                foto3_preview.src = e.target.result;
            }
        }
    </script>
    <script>
        function preview_foto4() {
            const foto4 = document.querySelector('#foto4');
            const foto4_label = document.querySelector('#label_foto4');
            const foto4_preview = document.querySelector('.foto4-preview');

            foto4_label.textContent = foto4.files[0].name;

            const file_foto4 = new FileReader();
            file_foto4.readAsDataURL(foto4.files[0]);

            file_foto4.onload = function(e) {
                foto4_preview.src = e.target.result;
            }
        }
    </script>
    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
        });
    </script>

</body>

</html>