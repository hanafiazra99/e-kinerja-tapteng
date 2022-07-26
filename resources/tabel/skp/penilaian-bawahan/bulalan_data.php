<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'cv_skp_penilaian_bulanan';
$primaryKey = 'id';

$columns = array(
    array(
        'db' => 'bulan',
        'dt' => 0,
        'formatter' => function ($d, $row) {
            return content_bulan_indo($d);
        },
    ),
    array(
        'db' => 'banyak_kegiatan',
        'dt' => 1,
        'formatter' => function ($d, $row) {
            return $d . ' Kegiatan';
        },
    ),
    array('db' => 'status', 'dt' => 2),
    array(
        'db' => 'id',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            return '
                    <a href="bulanan/' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                   ';
        },
    ),
);

$whereAll = 'status != "Belum Disampaikan"';

if (isset($_GET['sasaran'])) {
    $whereAll .= 'AND sasaran = "' . $_GET['sasaran'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
