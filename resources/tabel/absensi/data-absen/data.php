<?php
session_start();
require "../../../../app/config.php";

$table = 'v_absen_status_masuk_status_pulang';
$primaryKey = 'id';

$columns = array(
    array('db' => 'opd_nama', 'dt' => 0),
	array('db' => 'unit_organisasi_nama', 'dt' => 1),
    array('db' => 'pegawai_nip', 'dt' => 2),
    array('db' => 'pegawai_nama', 'dt' => 3),
    array('db' => 'nama_jabatan', 'dt' => 4),
    array('db' => 'tanggal', 'dt' => 5),
    array('db' => 'waktu_masuk', 'dt' => 6),
    array('db' => 'status_masuk', 'dt' => 7),
    array('db' => 'waktu_pulang', 'dt' => 8),
    array('db' => 'status_pulang', 'dt' => 9),
);

$whereAll = '';


if (isset($_GET['opd'])) {
    $whereAll .= ' opd_nama = "' . $_GET['opd'] . '" ';
    $whereAll .= ' AND tanggal = "' . $_GET['tanggal'] . '" '; 
} else if (isset($_GET['unit_organisasi'])) {
    $whereAll .= ' unit_organisasi_nama = "' . $_GET['unit_organisasi'] . '" '; 
    $whereAll .= ' AND tanggal = "' . $_GET['tanggal'] . '" '; 
}else{
    $whereAll .= ' tanggal = "' . $_GET['tanggal'] . '" '; 
}


require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
