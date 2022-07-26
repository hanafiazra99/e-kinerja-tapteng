<?php
session_start();
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'v_simpeg_lp_bazzetting';
$primaryKey = 'id';

$columns = array(
    array('db' => 'nama', 'dt' => 0),
    array(
        'db' => 'jumlah_pns',
        'dt' => 1,
    ),
    array('db' => 'IV/d', 'dt' => 2),
    array('db' => 'IV/c', 'dt' => 3),
    array('db' => 'IV/b', 'dt' => 4),
    array('db' => 'IV/a', 'dt' => 5),
    array('db' => 'IV', 'dt' => 6),
    array('db' => 'III/d', 'dt' => 7),
    array('db' => 'III/c', 'dt' => 8),
    array('db' => 'III/b', 'dt' => 9),
    array('db' => 'III/a', 'dt' => 10),
    array('db' => 'III', 'dt' => 11),
    array('db' => 'II/d', 'dt' => 12),
    array('db' => 'II/c', 'dt' => 13),
    array('db' => 'II/b', 'dt' => 14),
    array('db' => 'II/a', 'dt' => 15),
    array('db' => 'II', 'dt' => 16),
    array('db' => 'I/d', 'dt' => 17),
    array('db' => 'I/c', 'dt' => 18),
    array('db' => 'I/b', 'dt' => 19),
    array('db' => 'I/a', 'dt' => 20),
    array('db' => 'I', 'dt' => 21),
);

$whereAll = '';

if (isset($_GET['opd'])) {
    $whereAll .= 'opd = "' . $_GET['opd'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
