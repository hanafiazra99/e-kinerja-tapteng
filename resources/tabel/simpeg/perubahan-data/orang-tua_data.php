<?php
require "../../../../app/config.php";

$table = 'v_pegawai_ortu';
$primaryKey = 'id';

$columns = array(
    array('db' => 'opd',  'dt' => 0),
    array('db' => 'unit_organisasi',  'dt' => 1),
    array('db' => 'pegawai_nip',  'dt' => 2),
    array('db' => 'pegawai_nama',  'dt' => 3),
    array(
        'db' => 'id',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return '
											<a href="' . $d . '/usulkan/" title="Usulkan" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
										   ';
        }
    ),
);

$whereAll = '';

if (isset($_GET['opd'])) {
    $whereAll .= 'opd = "' . $_GET['opd'] . '"';
}

require('../../../library/datatables/scripts/ssp.class.php');

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
