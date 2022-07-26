<?php
require "../../../../app/config.php";

$table = 'cv_opd_tupoksi';
$primaryKey = 'id';

$columns = array(
    array('db' => 'nama', 'dt' => 0),
    array('db' => 'tlp', 'dt' => 1),
    array('db' => 'email', 'dt' => 2),
    array('db' => 'banyak_tupoksi', 'dt' => 3),
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
