<?php
require "../../../../app/config.php";

$table = 'cv_pegawai_login';
$primaryKey = 'id';

$columns = array(
    array('db' => 'nama', 'dt' => 0),
    array('db' => 'username', 'dt' => 1),
    array('db' => 'status_kepegawaian', 'dt' => 2),
    array('db' => 'opd_nama', 'dt' => 3),
    array('db' => 'unit_organisasi_nama', 'dt' => 4),
    array(
        'db' => 'id',
        'dt' => 5,
        'formatter' => function ($d, $row) {
            return '
											<a href="' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
										   ';
        },
    ),
);

$whereAll = '';

if (isset($_GET['opd'])) {
    $whereAll .= 'opd_nama = "' . $_GET['opd'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
