<?php
session_start();
require "../../../../app/config.php";

$table = 'v_absensi_shift_pegawai';
$primaryKey = 'id';

$columns = array(
    array('db' => 'opd_nama', 'dt' => 0),
    array('db' => 'unit_organisasi_nama', 'dt' => 1),
    array('db' => 'pegawai_nip', 'dt' => 2),
    array('db' => 'pegawai_nama', 'dt' => 3),
    array('db' => 'tanggal', 'dt' => 4),
    array('db' => 'Shift', 'dt' => 5),
    array(
        'db' => 'id',
        'dt' => 6,
        'formatter' => function ($d, $row) {
            return '
                        <a href="' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs pull-right" style="margin-right: 2px;"><i class="fa fa-edit"></i></a>
                       ';
        }
    ),
);

$whereAll = '';

if (isset($_GET['opd'])) {
    $whereAll .= 'opd_nama = "' . $_GET['opd'] . '"';
} else if (isset($_GET['unit_organisasi'])) {
    $whereAll .= 'unit_organisasi_nama = "' . $_GET['unit_organisasi'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
