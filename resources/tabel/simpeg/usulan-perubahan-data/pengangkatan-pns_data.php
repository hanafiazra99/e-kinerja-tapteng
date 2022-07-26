<?php
require "../../../../app/config.php";

$table = 'v_u_pegawai_pengangkatan_pns';
$primaryKey = 'id';

$columns = array(
    array('db' => 'opd', 'dt' => 0),
    array('db' => 'unit_organisasi', 'dt' => 1),
    array('db' => 'pegawai_nip', 'dt' => 2),
    array('db' => 'pegawai_nama', 'dt' => 3),
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
    $whereAll .= 'opd_nama = "' . $_GET['opd'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
