<?php
require "../../../../app/config.php";

$table = 'v_pegawai';
$primaryKey = 'id';

$columns = array(
    array('db' => 'opd_nama', 'dt' => 0),
    array('db' => 'unit_organisasi_nama', 'dt' => 1),
    array('db' => 'status_kepegawaian', 'dt' => 2),
    array('db' => 'nama', 'dt' => 3),
    array(
        'db' => 'id',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return '
											<a href="' . $d . '/usulkan/" title="Usulkan" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
										   ';
        },
    ),
);

$whereAll = 'kedudukan_pegawai = "Aktif"';

if (isset($_GET['opd'])) {
    $whereAll .= 'AND opd_nama = "' . $_GET['opd'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
