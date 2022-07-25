<?php
// $sql_details = array(
// 	'user' => 'semur_sammy',
// 	'pass' => 'Hidup1000Tahun',
// 	'db'   => 'semur_tapteng_ekinerja',
// 	'host' => '156.67.211.198',
// 	'port' => '3306'
// );

$sql_details = array(
	'user' => 'root',
	'pass' => 'password',
	'db'   => 'mily7_ekinerja_new',
	'host' => 'localhost',
	'port' => '3306',
);

$sql_from = array(
	'user' => 'root',
	'pass' => 'password',
	'db'   => 'mily7_ekinerja_new',
	'host' => 'localhost',
	'port' => '3306',
);

$sql_absensi = array(
	'user' => 'root',
	'pass' => 'password',
	'db' => 'mily7_ekinerja_new',
	'host' => 'localhost',
	'port' => '3306',
);

// $sql_details = array(
// 	'user' => 'apof9533_dev',
// 	'pass' => 'blsSlgLBvw5mqs4x',
// 	'db'   => 'apof9533_tapteng_ekinerja',
// 	'host' => '203.175.8.130',
// 	'port' => '3306',
// );

// $sql_from = array(
// 	'user' => 'apof9533_dev',
// 	'pass' => 'blsSlgLBvw5mqs4x',
// 	'db'   => 'apof9533_tapteng_ekinerja',
// 	'host' => '203.175.8.130',
// 	'port' => '3306',
// );

// $sql_absensi = array(
// 	'user' => 'apof9533_dev',
// 	'pass' => 'blsSlgLBvw5mqs4x',
// 	'db'   => 'apof9533_tapteng_ekinerja',
// 	'host' => '203.175.8.130',
// 	'port' => '3306',
// );
error_reporting(0);
$koneksi = new mysqli($sql_details['host'], $sql_details['user'], $sql_details['pass'], $sql_details['db']);
$koneksi_from = new mysqli($sql_from['host'], $sql_from['user'], $sql_from['pass'], $sql_from['db']);
$koneksi_absensi = new mysqli($sql_absensi['host'], $sql_absensi['user'], $sql_absensi['pass'], $sql_absensi['db'], $sql_absensi['port']);

// print_r($koneksi);

// if($koneksi)
// 	echo "koneksi berhasil";
// else
// 	echo "koneksi gagal";

// if($koneksi_from)
// 	echo "koneksi_from berhasil";
// else
// 	echo "koneksi_from gagal";

// if($koneksi_absensi)
// 	echo "koneksi_absensi berhasil";
// else
// 	echo "koneksi_absensi gagal";

define("BASE_URL", "http://localhost/e-kinerja-tapteng/");
define("SIMPEG_URL", "http://localhost/e-kinerja-tapteng/simpeg/");
define("SKP_URL", "http://localhost/e-kinerja-tapteng/skp/");
define("ABSENSI_URL", "http://localhost/e-kinerja-tapteng/absensi/");
define("TPP_URL", "http://localhost/e-kinerja-tapteng/tpp/");
define("RESOURCES_URL", "http://localhost/e-kinerja-tapteng/resources/");

define("BASE_TITLE", "E-Kinerja Tapteng");
define("SIMPEG_TITLE", "Simpeg Tapteng");
define("SKP_TITLE", "SKP Tapteng");
define("ABSENSI_TITLE", "Absensi Tapteng");
define("TPP_TITLE", "TPP Tapteng");

define("A_INSTANSI", "Badan Kepegawaian Daerah");
define("A_DAERAH", "Pemerintah Kabupaten Tapanuli Tengah");

// header('Location: http://e-kinerja.tapteng.go.id/new-one/maintenance/');
