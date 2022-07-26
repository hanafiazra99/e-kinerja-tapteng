<?php
require "../../../../app/config.php";

$table = 'opd_struktur_organisasi';
$primaryKey = 'id';

$columns = array(
    array('db' => 'nama_jabatan', 'dt' => 0),
    array('db' => 'besaran_tpp',
        'dt' => 1,
        'formatter' => function ($d, $row) {
            return 'Rp. ' . number_format($d, 2, ',', '.');
        },
    ),
    array(
        'db' => 'id',
        'dt' => 2,
        'formatter' => function ($d, $row) {
            return '
                    <a href="' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                    <a href="' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
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
