<?php
session_start();
require "../../../../app/config.php";

$table = 'v_absensi_cuti';
$primaryKey = 'id';

$columns = array(
    array('db' => 'opd_nama', 'dt' => 0),
	array('db' => 'unit_organisasi_nama', 'dt' => 1),
    array('db' => 'pegawai_nip', 'dt' => 2),
    array('db' => 'pegawai_nama', 'dt' => 3),
    array('db' => 'nama_jabatan', 'dt' => 4),
    array('db' => 'tanggal_awal', 'dt' => 5),
    array('db' => 'keterangan', 'dt' => 6),
    
);

$whereAll = '';

if (isset($_GET['opd'])) {
    $whereAll .= 'opd_nama = "' . $_GET['opd'] . '"';
} else if (isset($_GET['unit_organisasi'])) {
    $whereAll .= 'unit_organisasi_nama = "' . $_GET['unit_organisasi'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
