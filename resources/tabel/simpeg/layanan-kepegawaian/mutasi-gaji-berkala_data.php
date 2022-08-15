<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'v_simpeg_lp_mutasi_kgb';
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
    array('db' => 'status', 'dt' => 4),
    array(
        'db' => 'id',
        'dt' => 5,
        'formatter' => function ($d, $row) {
            return '
                    <a href="' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                   ';
        },
    ),
);

$whereAll = '';

if (isset($_GET['opd'])) {
    $whereAll .= 'opd_asal_nama = "' . $_GET['opd'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
