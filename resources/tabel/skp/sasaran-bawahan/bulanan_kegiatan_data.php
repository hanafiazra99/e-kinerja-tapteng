<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'v_skp_sasaran_bulanan_kegiatan';
$primaryKey = 'id';

$columns = array(
    array('db' => 'kegiatan', 'dt' => 0),
    array('db' => 'kuantitas', 'dt' => 1),
    array('db' => 'kualitas', 'dt' => 2),
    array(
        'db' => 'biaya',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            return 'Rp. ' . number_format($d, 2, ',', '.');
        },
    ),
    array(
        'db' => 'id',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return '
                    <a href="kegiatan/' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                   ';
        },
    ),
);

$whereAll = '';

if (isset($_GET['sasaran_bulanan'])) {
    $whereAll .= 'sasaran_bulanan = "' . $_GET['sasaran_bulanan'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
