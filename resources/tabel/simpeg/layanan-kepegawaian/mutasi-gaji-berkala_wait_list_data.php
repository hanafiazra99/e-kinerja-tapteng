<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'v_pegawai_kgb';
$primaryKey = 'id';

$columns = array(
    array('db' => 'pegawai_nip', 'dt' => 0),
    array('db' => 'pegawai_nama', 'dt' => 1),
    array(
        'db' => 'masa_kerja',
        'dt' => 2,
        'formatter' => function ($d, $row) {
            return content_masa_kerja($d)['tahun'] . ' Tahun ' . content_masa_kerja($d)['bulan'] . ' Bulan';
        },
    ),
    array('db' => 'pym', 'dt' => 3),
    array(
        'db' => 'id',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return '
                    <a href="tambah?usulan-pegawai=' . $d . '" title="Detail" class="btn btn-primary btn-xs">Proses</a>
                   ';
        },
    ),
);

$whereAll = '';

$whereAll .= " TIMESTAMPDIFF(MONTH, CURDATE(), rencana) <= 2 ";
if (isset($_GET['opd'])) {
    $whereAll .= ' AND opd = "' . $_GET['opd'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
