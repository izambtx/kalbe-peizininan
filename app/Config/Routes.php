<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/Home', 'Home::home');
$routes->get('/Dashboard', 'Users::index');
$routes->post('/Dashboard', 'Users::index');
$routes->get('/user', 'Home::index');
$routes->get('/view_profile', 'Users::view_profile');

$routes->get('/opl/export', 'Home::export');

$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->post('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/create', 'Admin::create', ['filter' => 'role:admin']);
$routes->get('/admin/(:num)', 'Admin::detail/$1', ['filter' => 'role:admin']);
$routes->post('/admin/(:num)', 'Admin::update/$1', ['filter' => 'role:admin']);
$routes->get('/admin/edit/(:any)', 'Admin::edit/$1', ['filter' => 'role:admin']);
$routes->get('/admin/delete/(:num)', 'Admin::delete/$1', ['filter' => 'role:admin']);
$routes->get('/edit_my_admin', 'Admin::edit_my_admin', ['filter' => 'role:admin']);
$routes->get('/admin/change-password/(:num)', 'Admin::changePassword/$1', ['filter' => 'role:admin']);
$routes->post('/admin/update-password/(:num)', 'Admin::updatePassword/$1', ['filter' => 'role:admin']);

$routes->get('/user', 'Users::index', ['filter' => 'role:user']);
$routes->get('/edit_my_user', 'Users::edit_my_user', ['filter' => 'role:user']);

$routes->get('/change-email', 'Users::editEmail');
$routes->post('/update-email/(:num)', 'Users::updateEmail/$1');
$routes->get('/change-password', 'Users::changePassword');
$routes->post('/update-password', 'Users::updatePassword');
$routes->post('/sendEmail', 'Users::sendEmail');

// ============================== PEMBUAT ===============================================

// ============================== PERMOHONAN ===============================================

$routes->get('/IzinFasilitas/PintuEmergency', 'PintuEmergency::index', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/PintuEmergency', 'PintuEmergency::index', ['filter' => 'role:supervisor']);
$routes->get('/IzinFasilitas/PintuEmergency/CreateIzin', 'PintuEmergency::create', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/PintuEmergency/SaveIzin', 'PintuEmergency::save', ['filter' => 'role:supervisor']);
$routes->get('/IzinFasilitas/PintuEmergency/Details/(:any)', 'PintuEmergency::detail/$1', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/PintuEmergency/Request/(:any)', 'PintuEmergency::request/$1', ['filter' => 'role:supervisor']);
$routes->get('/IzinFasilitas/PintuEmergency/EditIzin/(:any)', 'PintuEmergency::edit/$1', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/PintuEmergency/UpdateIzin/(:any)', 'PintuEmergency::update/$1', ['filter' => 'role:supervisor']);

$routes->get('/IzinFasilitas/Hydrant', 'Hydrant::index');
$routes->post('/IzinFasilitas/Hydrant', 'Hydrant::index');
$routes->get('/IzinFasilitas/Hydrant/CreateIzin', 'Hydrant::create', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/Hydrant/SaveIzin', 'Hydrant::save', ['filter' => 'role:supervisor']);
$routes->get('/IzinFasilitas/Hydrant/Details/(:any)', 'Hydrant::detail/$1', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/Hydrant/Request/(:any)', 'Hydrant::request/$1', ['filter' => 'role:supervisor']);
$routes->get('/IzinFasilitas/Hydrant/EditIzin/(:any)', 'Hydrant::edit/$1', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/Hydrant/UpdateIzin/(:any)', 'Hydrant::update/$1', ['filter' => 'role:supervisor']);

$routes->get('/IzinFasilitas/SmokeHeatDetector', 'SmokeHeatDetector::index');
$routes->post('/IzinFasilitas/SmokeHeatDetector', 'SmokeHeatDetector::index', ['filter' => 'role:supervisor']);
$routes->get('/IzinFasilitas/SmokeHeatDetector/CreateIzin', 'SmokeHeatDetector::create', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/SmokeHeatDetector/SaveIzin', 'SmokeHeatDetector::save', ['filter' => 'role:supervisor']);
$routes->get('/IzinFasilitas/SmokeHeatDetector/Details/(:any)', 'SmokeHeatDetector::detail/$1', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/SmokeHeatDetector/Request/(:any)', 'SmokeHeatDetector::request/$1', ['filter' => 'role:supervisor']);
$routes->get('/IzinFasilitas/SmokeHeatDetector/EditIzin/(:any)', 'SmokeHeatDetector::edit/$1', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/SmokeHeatDetector/UpdateIzin/(:any)', 'SmokeHeatDetector::update/$1', ['filter' => 'role:supervisor']);

$routes->get('/IzinFasilitas/FireAlarm', 'FireAlarm::index');
$routes->post('/IzinFasilitas/FireAlarm', 'FireAlarm::index', ['filter' => 'role:supervisor']);
$routes->get('/IzinFasilitas/FireAlarm/CreateIzin', 'FireAlarm::create', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/FireAlarm/SaveIzin', 'FireAlarm::save', ['filter' => 'role:supervisor']);
$routes->get('/IzinFasilitas/FireAlarm/Details/(:any)', 'FireAlarm::detail/$1', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/FireAlarm/Request/(:any)', 'FireAlarm::request/$1', ['filter' => 'role:supervisor']);
$routes->get('/IzinFasilitas/FireAlarm/EditIzin/(:any)', 'FireAlarm::edit/$1', ['filter' => 'role:supervisor']);
$routes->post('/IzinFasilitas/FireAlarm/UpdateIzin/(:any)', 'FireAlarm::update/$1', ['filter' => 'role:supervisor']);

// ============================== ON/OFF ===============================================

$routes->get('/PenonAktifanFasilitas/PintuEmergency', 'PintuEmergency::listPenonAktifan', ['filter' => 'role:supervisor']);
$routes->post('/PenonAktifanFasilitas/PintuEmergency', 'PintuEmergency::listPenonAktifan', ['filter' => 'role:supervisor']);
$routes->get('/PenonAktifanFasilitas/PintuEmergency/Details/(:any)', 'PintuEmergency::detailPenonAktifan/$1', ['filter' => 'role:supervisor']);
$routes->post('/PenonAktifanFasilitas/PintuEmergency/(:any)', 'PintuEmergency::nonAktif/$1', ['filter' => 'role:supervisor']);
$routes->post('/PenonAktifanFasilitas/aktif/PintuEmergency/(:any)', 'PintuEmergency::Aktif/$1', ['filter' => 'role:supervisor']);

$routes->get('/PenonAktifanFasilitas/Hydrant', 'Hydrant::listPenonAktifan', ['filter' => 'role:supervisor']);
$routes->post('/PenonAktifanFasilitas/Hydrant', 'Hydrant::listPenonAktifan', ['filter' => 'role:supervisor']);
$routes->get('/PenonAktifanFasilitas/Hydrant/Details/(:any)', 'Hydrant::detailPenonAktifan/$1', ['filter' => 'role:supervisor']);
$routes->post('/PenonAktifanFasilitas/Hydrant/(:any)', 'Hydrant::nonAktif/$1', ['filter' => 'role:supervisor']);
$routes->post('/PenonAktifanFasilitas/aktif/Hydrant/(:any)', 'Hydrant::Aktif/$1', ['filter' => 'role:supervisor']);

$routes->get('/PenonAktifanFasilitas/SmokeHeatDetector', 'SmokeHeatDetector::listPenonAktifan', ['filter' => 'role:supervisor']);
$routes->post('/PenonAktifanFasilitas/SmokeHeatDetector', 'SmokeHeatDetector::listPenonAktifan', ['filter' => 'role:supervisor']);
$routes->get('/PenonAktifanFasilitas/SmokeHeatDetector/Details/(:any)', 'SmokeHeatDetector::detailPenonAktifan/$1', ['filter' => 'role:supervisor']);
$routes->post('/PenonAktifanFasilitas/SmokeHeatDetector/(:any)', 'SmokeHeatDetector::nonAktif/$1', ['filter' => 'role:supervisor']);
$routes->post('/PenonAktifanFasilitas/aktif/SmokeHeatDetector/(:any)', 'SmokeHeatDetector::Aktif/$1', ['filter' => 'role:supervisor']);

$routes->get('/PenonAktifanFasilitas/FireAlarm', 'FireAlarm::listPenonAktifan', ['filter' => 'role:supervisor']);
$routes->post('/PenonAktifanFasilitas/FireAlarm', 'FireAlarm::listPenonAktifan', ['filter' => 'role:supervisor']);
$routes->get('/PenonAktifanFasilitas/FireAlarm/Details/(:any)', 'FireAlarm::detailPenonAktifan/$1', ['filter' => 'role:supervisor']);
$routes->post('/PenonAktifanFasilitas/FireAlarm/(:any)', 'FireAlarm::nonAktif/$1', ['filter' => 'role:supervisor']);
$routes->post('/PenonAktifanFasilitas/aktif/FireAlarm/(:any)', 'FireAlarm::Aktif/$1', ['filter' => 'role:supervisor']);

//  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>




// ============================== PENYETUJU ===============================================

// ============================== PERMOHONAN ===============================================

$routes->get('/ApproveFasilitas/PintuEmergency', 'PintuEmergency::listApprover', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ApproveFasilitas/PintuEmergency', 'PintuEmergency::listApprover', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->get('/ApproveFasilitas/PintuEmergency/Details/(:any)', 'PintuEmergency::detailApprover/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ApproveFasilitas/PintuEmergency/approve/(:any)', 'PintuEmergency::approve/$1', ['filter' => 'role:manager']);
$routes->post('/ApproveFasilitas/PintuEmergency/approve2/(:any)', 'PintuEmergency::approve2/$1', ['filter' => 'role:manager']);
$routes->post('/ApproveFasilitas/PintuEmergency/approve3/(:any)', 'PintuEmergency::approve3/$1', ['filter' => 'role:manager']);
$routes->post('/ApproveFasilitas/PintuEmergency/check/(:any)', 'PintuEmergency::engineer/$1', ['filter' => 'role:engineer']);
$routes->post('/ApproveFasilitas/PintuEmergency/read/(:any)', 'PintuEmergency::ohse/$1', ['filter' => 'role:OHSE']);
$routes->post('/ApproveFasilitas/PintuEmergency/agree/(:any)', 'PintuEmergency::ERT/$1', ['filter' => 'role:ERT']);

$routes->get('/ApproveFasilitas/Hydrant', 'Hydrant::listApprover', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ApproveFasilitas/Hydrant', 'Hydrant::listApprover', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->get('/ApproveFasilitas/Hydrant/Details/(:any)', 'Hydrant::detailApprover/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ApproveFasilitas/Hydrant/approve/(:any)', 'Hydrant::approve/$1', ['filter' => 'role:manager']);
$routes->post('/ApproveFasilitas/Hydrant/approve2/(:any)', 'Hydrant::approve2/$1', ['filter' => 'role:manager']);
$routes->post('/ApproveFasilitas/Hydrant/approve3/(:any)', 'Hydrant::approve3/$1', ['filter' => 'role:manager']);
$routes->post('/ApproveFasilitas/Hydrant/check/(:any)', 'Hydrant::engineer/$1', ['filter' => 'role:engineer']);
$routes->post('/ApproveFasilitas/Hydrant/read/(:any)', 'Hydrant::ohse/$1', ['filter' => 'role:OHSE']);
$routes->post('/ApproveFasilitas/Hydrant/agree/(:any)', 'Hydrant::ERT/$1', ['filter' => 'role:ERT']);

$routes->get('/ApproveFasilitas/SmokeHeatDetector', 'SmokeHeatDetector::listApprover', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ApproveFasilitas/SmokeHeatDetector', 'SmokeHeatDetector::listApprover', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->get('/ApproveFasilitas/SmokeHeatDetector/Details/(:any)', 'SmokeHeatDetector::detailApprover/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ApproveFasilitas/SmokeHeatDetector/approve/(:any)', 'SmokeHeatDetector::approve/$1', ['filter' => 'role:manager']);
$routes->post('/ApproveFasilitas/SmokeHeatDetector/approve2/(:any)', 'SmokeHeatDetector::approve2/$1', ['filter' => 'role:manager']);
$routes->post('/ApproveFasilitas/SmokeHeatDetector/approve3/(:any)', 'SmokeHeatDetector::approve3/$1', ['filter' => 'role:manager']);
$routes->post('/ApproveFasilitas/SmokeHeatDetector/check/(:any)', 'SmokeHeatDetector::engineer/$1', ['filter' => 'role:engineer']);
$routes->post('/ApproveFasilitas/SmokeHeatDetector/read/(:any)', 'SmokeHeatDetector::ohse/$1', ['filter' => 'role:OHSE']);
$routes->post('/ApproveFasilitas/SmokeHeatDetector/agree/(:any)', 'SmokeHeatDetector::ERT/$1', ['filter' => 'role:ERT']);

$routes->get('/ApproveFasilitas/FireAlarm', 'FireAlarm::listApprover', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ApproveFasilitas/FireAlarm', 'FireAlarm::listApprover', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->get('/ApproveFasilitas/FireAlarm/Details/(:any)', 'FireAlarm::detailApprover/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ApproveFasilitas/FireAlarm/approve/(:any)', 'FireAlarm::approve/$1', ['filter' => 'role:manager']);
$routes->post('/ApproveFasilitas/FireAlarm/approve2/(:any)', 'FireAlarm::approve2/$1', ['filter' => 'role:manager']);
$routes->post('/ApproveFasilitas/FireAlarm/approve3/(:any)', 'FireAlarm::approve3/$1', ['filter' => 'role:manager']);
$routes->post('/ApproveFasilitas/FireAlarm/check/(:any)', 'FireAlarm::engineer/$1', ['filter' => 'role:engineer']);
$routes->post('/ApproveFasilitas/FireAlarm/read/(:any)', 'FireAlarm::ohse/$1', ['filter' => 'role:OHSE']);
$routes->post('/ApproveFasilitas/FireAlarm/agree/(:any)', 'FireAlarm::ERT/$1', ['filter' => 'role:ERT']);

// ============================== ON/OFF ===============================================

$routes->get('/PengaktifanFasilitas/PintuEmergency', 'PintuEmergency::listPengaktifan', ['filter' => 'role:manager,engineer,OHSE,ERT']);
$routes->post('/PengaktifanFasilitas/PintuEmergency', 'PintuEmergency::listPengaktifan', ['filter' => 'role:manager,engineer,OHSE,ERT']);
$routes->get('/PengaktifanFasilitas/PintuEmergency/Details/(:any)', 'PintuEmergency::detailPengaktifan/$1', ['filter' => 'role:manager,engineer,OHSE,ERT']);
$routes->post('/PengaktifanFasilitas/PintuEmergency/approve/(:any)', 'PintuEmergency::PICPengaktifan/$1', ['filter' => 'role:manager']);
$routes->post('/PengaktifanFasilitas/PintuEmergency/approve2/(:any)', 'PintuEmergency::PICPengaktifan2/$1', ['filter' => 'role:manager']);
$routes->post('/PengaktifanFasilitas/PintuEmergency/approve3/(:any)', 'PintuEmergency::PICPengaktifan3/$1', ['filter' => 'role:manager']);
$routes->post('/PengaktifanFasilitas/PintuEmergency/check/(:any)', 'PintuEmergency::engineerPengaktifan/$1', ['filter' => 'role:engineer']);
$routes->post('/PengaktifanFasilitas/PintuEmergency/agree/(:any)', 'PintuEmergency::ERTPengaktifan/$1', ['filter' => 'role:ERT']);

$routes->get('/PengaktifanFasilitas/Hydrant', 'Hydrant::listPengaktifan', ['filter' => 'role:manager,engineer,OHSE,ERT']);
$routes->post('/PengaktifanFasilitas/Hydrant', 'Hydrant::listPengaktifan', ['filter' => 'role:manager,engineer,OHSE,ERT']);
$routes->get('/PengaktifanFasilitas/Hydrant/Details/(:any)', 'Hydrant::detailPengaktifan/$1', ['filter' => 'role:manager,engineer,OHSE,ERT']);
$routes->post('/PengaktifanFasilitas/Hydrant/approve/(:any)', 'Hydrant::PICPengaktifan/$1', ['filter' => 'role:manager']);
$routes->post('/PengaktifanFasilitas/Hydrant/approve2/(:any)', 'Hydrant::PICPengaktifan2/$1', ['filter' => 'role:manager']);
$routes->post('/PengaktifanFasilitas/Hydrant/approve3/(:any)', 'Hydrant::PICPengaktifan3/$1', ['filter' => 'role:manager']);
$routes->post('/PengaktifanFasilitas/Hydrant/check/(:any)', 'Hydrant::engineerPengaktifan/$1', ['filter' => 'role:engineer']);
$routes->post('/PengaktifanFasilitas/Hydrant/agree/(:any)', 'Hydrant::ERTPengaktifan/$1', ['filter' => 'role:ERT']);

$routes->get('/PengaktifanFasilitas/SmokeHeatDetector', 'SmokeHeatDetector::listPengaktifan', ['filter' => 'role:manager,engineer,OHSE,ERT']);
$routes->post('/PengaktifanFasilitas/SmokeHeatDetector', 'SmokeHeatDetector::listPengaktifan', ['filter' => 'role:manager,engineer,OHSE,ERT']);
$routes->get('/PengaktifanFasilitas/SmokeHeatDetector/Details/(:any)', 'SmokeHeatDetector::detailPengaktifan/$1', ['filter' => 'role:manager,engineer,OHSE,ERT']);
$routes->post('/PengaktifanFasilitas/SmokeHeatDetector/approve/(:any)', 'SmokeHeatDetector::PICPengaktifan/$1', ['filter' => 'role:manager']);
$routes->post('/PengaktifanFasilitas/SmokeHeatDetector/approve2/(:any)', 'SmokeHeatDetector::PICPengaktifan2/$1', ['filter' => 'role:manager']);
$routes->post('/PengaktifanFasilitas/SmokeHeatDetector/approve3/(:any)', 'SmokeHeatDetector::PICPengaktifan3/$1', ['filter' => 'role:manager']);
$routes->post('/PengaktifanFasilitas/SmokeHeatDetector/check/(:any)', 'SmokeHeatDetector::engineerPengaktifan/$1', ['filter' => 'role:engineer']);
$routes->post('/PengaktifanFasilitas/SmokeHeatDetector/agree/(:any)', 'SmokeHeatDetector::ERTPengaktifan/$1', ['filter' => 'role:ERT']);

$routes->get('/PengaktifanFasilitas/FireAlarm', 'FireAlarm::listPengaktifan', ['filter' => 'role:manager,engineer,OHSE,ERT']);
$routes->post('/PengaktifanFasilitas/FireAlarm', 'FireAlarm::listPengaktifan', ['filter' => 'role:manager,engineer,OHSE,ERT']);
$routes->get('/PengaktifanFasilitas/FireAlarm/Details/(:any)', 'FireAlarm::detailPengaktifan/$1', ['filter' => 'role:manager,engineer,OHSE,ERT']);
$routes->post('/PengaktifanFasilitas/FireAlarm/approve/(:any)', 'FireAlarm::PICPengaktifan/$1', ['filter' => 'role:manager']);
$routes->post('/PengaktifanFasilitas/FireAlarm/approve2/(:any)', 'FireAlarm::PICPengaktifan2/$1', ['filter' => 'role:manager']);
$routes->post('/PengaktifanFasilitas/FireAlarm/approve3/(:any)', 'FireAlarm::PICPengaktifan3/$1', ['filter' => 'role:manager']);
$routes->post('/PengaktifanFasilitas/FireAlarm/check/(:any)', 'FireAlarm::engineerPengaktifan/$1', ['filter' => 'role:engineer']);
$routes->post('/PengaktifanFasilitas/FireAlarm/agree/(:any)', 'FireAlarm::ERTPengaktifan/$1', ['filter' => 'role:ERT']);


// ============================== REJECT ===============================================

$routes->post('/RejectFasilitas/1/PintuEmergency/(:any)', 'PintuEmergency::rejected/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/RejectFasilitas/2/PintuEmergency/(:any)', 'PintuEmergency::rejected/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/RejectFasilitas/3/PintuEmergency/(:any)', 'PintuEmergency::rejected/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);

$routes->post('/RejectFasilitas/1/Hydrant/(:any)', 'Hydrant::rejected/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/RejectFasilitas/2/Hydrant/(:any)', 'Hydrant::rejected/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/RejectFasilitas/3/Hydrant/(:any)', 'Hydrant::rejected/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);

$routes->post('/RejectFasilitas/1/SmokeHeatDetector/(:any)', 'SmokeHeatDetector::rejected/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/RejectFasilitas/2/SmokeHeatDetector/(:any)', 'SmokeHeatDetector::rejected/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/RejectFasilitas/3/SmokeHeatDetector/(:any)', 'SmokeHeatDetector::rejected/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);

$routes->post('/RejectFasilitas/1/FireAlarm/(:any)', 'FireAlarm::rejected/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/RejectFasilitas/2/FireAlarm/(:any)', 'FireAlarm::rejected/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/RejectFasilitas/3/FireAlarm/(:any)', 'FireAlarm::rejected/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);

// ============================== RETURN ===============================================

$routes->post('/ReturnFasilitas/1/PintuEmergency/(:any)', 'PintuEmergency::returned/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ReturnFasilitas/2/PintuEmergency/(:any)', 'PintuEmergency::returned/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ReturnFasilitas/3/PintuEmergency/(:any)', 'PintuEmergency::returned/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);

$routes->post('/ReturnFasilitas/1/Hydrant/(:any)', 'Hydrant::returned/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ReturnFasilitas/2/Hydrant/(:any)', 'Hydrant::returned/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ReturnFasilitas/3/Hydrant/(:any)', 'Hydrant::returned/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);

$routes->post('/ReturnFasilitas/1/SmokeHeatDetector/(:any)', 'SmokeHeatDetector::returned/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ReturnFasilitas/2/SmokeHeatDetector/(:any)', 'SmokeHeatDetector::returned/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ReturnFasilitas/3/SmokeHeatDetector/(:any)', 'SmokeHeatDetector::returned/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);

$routes->post('/ReturnFasilitas/1/FireAlarm/(:any)', 'FireAlarm::returned/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ReturnFasilitas/2/FireAlarm/(:any)', 'FireAlarm::returned/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);
$routes->post('/ReturnFasilitas/3/FireAlarm/(:any)', 'FireAlarm::returned/$1', ['filter' => 'role:manager,engineer,ERT,OHSE']);

// ============================== HISTORY ===============================================

$routes->get('/HistoryFasilitas/PintuEmergency', 'PintuEmergency::listHistory');
$routes->post('/HistoryFasilitas/PintuEmergency', 'PintuEmergency::listHistory');

$routes->get('/HistoryFasilitas/Hydrant', 'Hydrant::listHistory');
$routes->post('/HistoryFasilitas/Hydrant', 'Hydrant::listHistory');

$routes->get('/HistoryFasilitas/SmokeHeatDetector', 'SmokeHeatDetector::listHistory');
$routes->post('/HistoryFasilitas/SmokeHeatDetector', 'SmokeHeatDetector::listHistory');

$routes->get('/HistoryFasilitas/FireAlarm', 'FireAlarm::listHistory');
$routes->post('/HistoryFasilitas/FireAlarm', 'FireAlarm::listHistory');

// ============================== EXTEND ===============================================

$routes->get('/ExtendFasilitas/PintuEmergency', 'PintuEmergency::listExtend');
$routes->post('/ExtendFasilitas/PintuEmergency', 'PintuEmergency::listExtend');
$routes->post('/ExtendFasilitas/PintuEmergency/(:any)', 'PintuEmergency::extend/$1');

$routes->get('/ExtendFasilitas/Hydrant', 'Hydrant::listExtend');
$routes->post('/ExtendFasilitas/Hydrant', 'Hydrant::listExtend');
$routes->post('/ExtendFasilitas/Hydrant/(:any)', 'Hydrant::extend/$1');

$routes->get('/ExtendFasilitas/SmokeHeatDetector', 'SmokeHeatDetector::listExtend');
$routes->post('/ExtendFasilitas/SmokeHeatDetector', 'SmokeHeatDetector::listExtend');
$routes->post('/ExtendFasilitas/SmokeHeatDetector/(:any)', 'SmokeHeatDetector::extend/$1');

$routes->get('/ExtendFasilitas/FireAlarm', 'FireAlarm::listExtend');
$routes->post('/ExtendFasilitas/FireAlarm', 'FireAlarm::listExtend');
$routes->post('/ExtendFasilitas/FireAlarm/(:any)', 'FireAlarm::extend/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
