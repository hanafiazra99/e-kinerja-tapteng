<?php
session_start();
require "../../../../../app/config.php";

$table = 'absen_jam_masuk';
$primaryKey = 'id';

$columns = array(
    array('db' => 'hari', 'dt' => 0),
	array('db' => 'awal_masuk', 'dt' => 1),
    array('db' => 'toleransi_masuk', 'dt' => 2),
    array('db' => 'akhir_masuk', 'dt' => 3),
    array( 'db' => 'id',
           'dt' => 4,
           'formatter' => function ($d, $row) {
                return '
                        <a href="'.$d.'/sunting/" title="Sunting" class="btn btn-success btn-xs pull-right" style="margin-right: 2px;"><i class="fa fa-edit"></i></a>
                       ';
            }
         ),
);

$whereAll = '';





// echo json_encode($whereAll);

require '../../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
