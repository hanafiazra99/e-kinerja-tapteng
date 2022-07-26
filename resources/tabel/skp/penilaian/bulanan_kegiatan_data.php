<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'v_skp_penilaian_bulanan_kegiatan';
$primaryKey = 'id';

$columns = array(
    array('db' => 'kegiatan', 'dt' => 0),
    array(
        'db' => 'kuantitas',
        'dt' => 1,
        'formatter' => function ($d, $row) {
            if ($_GET['status'] == 'Belum Disampaikan' or $_GET['status'] == 'Ditolak') {
                return '<SuntingNilai judul="Sunting Kuantitas" formreq="SuntingPenilaianBulanan" parameter_pengenal="id" data_pengenal="' . $row[4] . '" parameter_diganti="kuantitas" data_diganti="' . $d . '" fieldreq="Kuantitas" style="cursor: pointer; border-bottom: 3px dotted #000;">' . number_format($d, 2, ',', '.') . '</SuntingNilai>';
            } else {
                return number_format($d, 2, ',', '.');
            }
        },
    ),
    array('db' => 'kualitas', 'dt' => 2),
    array(
        'db' => 'biaya',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            if ($_GET['status'] == 'Belum Disampaikan' or $_GET['status'] == 'Ditolak') {
                return '<SuntingNilai judul="Sunting Biaya" formreq="SuntingPenilaianBulanan" parameter_pengenal="id" data_pengenal="' . $row[4] . '" parameter_diganti="biaya" data_diganti="' . $d . '" fieldreq="Biaya" style="cursor: pointer; border-bottom: 3px dotted #000;">' . number_format($d, 2, ',', '.') . '</SuntingNilai>';
            } else {
                return number_format($d, 2, ',', '.');
            }
        },
    ),
    array(
        'db' => 'id',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return '';
        },
    ),
);

$whereAll = '';

if (isset($_GET['sasaran_bulanan'])) {
    $whereAll .= 'sasaran_bulanan = "' . $_GET['sasaran_bulanan'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
