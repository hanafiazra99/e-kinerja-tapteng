<?php
session_start();
require "../../../../app/config.php";

$table = 'cv_simpeg_laporan_pendidikan_terakhir';
$primaryKey = 'id';

$columns = array(
    array('db' => 'nip', 'dt' => 0),
	array('db' => 'nama', 'dt' => 1),
    array('db' => 'status_kepegawaian', 'dt' => 2),
    array('db' => 'opd', 'dt' => 3),
    array('db' => 'pendidikan_terakhir', 'dt' => 4),
);

$whereAll = '';

if (isset($_GET['opd'])) {
    $whereAll .= 'opd = "' . $_GET['opd'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
