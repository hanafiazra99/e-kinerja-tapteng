<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'v_simpeg_lp_mutasi_masuk_daerah';
$primaryKey = 'id';

$columns = array(
    array('db' => 'nip', 'dt' => 0),
    array('db' => 'nama', 'dt' => 1),
    array('db' => 'instansi', 'dt' => 2),
    array('db' => 'jabatan', 'dt' => 3),
    array(
        'db' => 'id',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return '
                    <a href="' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                   ';
        },
    ),
);

$whereAll = '';

if (isset($_GET['opd'])) {
    $whereAll .= 'opd = "' . $_GET['opd'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
