<?php
session_start();
require "../../../../../app/config.php";

$table = 'absen_hari_libur';
$primaryKey = 'id';

$columns = array(
    array('db' => 'tanggal', 'dt' => 0),
    array('db' => 'nama_libur', 'dt' => 1),

);

$whereAll = '';





// echo json_encode($whereAll);

require '../../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
