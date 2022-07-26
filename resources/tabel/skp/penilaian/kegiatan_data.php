<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

//$table = 'v_skp_sasaran_kegiatan';
$table = 'cv_skp_sasaran_realisasi';
$primaryKey = 'id';

$columns = array(
    array('db' => 'kegiatan', 'dt' => 0),
    array(
        'db' => 'kuantitas',
        'dt' => 1,
        'formatter' => function ($d, $row) {
            return number_format($row[2], 2, ',', '.') . '/' . number_format($d, 2, ',', '.');
        },
    ),
    array(
        'db' => 'r_kuantitas',
        'dt' => 2,
        'formatter' => function ($d, $row) {
            return number_format($d, 2, ',', '.');
        },
    ),
    array('db' => 'output', 'dt' => 3),
    array(
        'db' => 'kualitas',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return number_format($row[5], 2, ',', '.') . '/' . number_format($d, 2, ',', '.');
        },
    ),
    array(
        'db' => 'r_kualitas',
        'dt' => 5,
        'formatter' => function ($d, $row) {
            return number_format($d, 2, ',', '.');
        },
    ),
    array(
        'db' => 'waktu',
        'dt' => 6,
        'formatter' => function ($d, $row) {
            return $row[7] . ' Bulan/' . $d . ' Bulan';
        },
    ),
    array(
        'db' => 'r_waktu',
        'dt' => 7,
        'formatter' => function ($d, $row) {
            return $d . ' Bulan';
        },
    ),
    array(
        'db' => 'biaya',
        'dt' => 8,
        'formatter' => function ($d, $row) {
            return number_format($row[9], 2, ',', '.') . '/Rp. ' . number_format($d, 2, ',', '.');
        },
    ),
    array(
        'db' => 'r_biaya',
        'dt' => 9,
        'formatter' => function ($d, $row) {
            return 'Rp. ' . number_format($d, 2, ',', '.');
        },
    ),
);

$whereAll = '';

if (isset($_GET['sasaran'])) {
    $whereAll .= 'sasaran = "' . $_GET['sasaran'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
