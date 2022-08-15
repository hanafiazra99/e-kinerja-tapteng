<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'cv_simpeg_lp_mutasi_pgr';
$primaryKey = 'id';

$columns = array(
    array('db' => 'pegawai_nip', 'dt' => 0),
    array('db' => 'pegawai_nama', 'dt' => 1),
    array('db' => 'pgr_lama', 'dt' => 2),
    array('db' => 'pgr', 'dt' => 3),
    array(
        'db' => 'tmt',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return content_tgl_indo($d);
        },
    ),
    array('db' => 'status', 'dt' => 5),
    array(
        'db' => 'id',
        'dt' => 6,
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
