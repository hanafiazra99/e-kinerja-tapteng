<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'cv_skp_penilaian';
$primaryKey = 'id';

$columns = array(
    array(
        'db' => 'periode',
        'dt' => 0,
        'formatter' => function ($d, $row) {
            return content_tgl_indo(explode('|', $d)[0]) . ' - ' . content_tgl_indo(explode('|', $d)[1]);
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
                                            <a href="' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
										   ';
        },
    ),
);

$whereAll = '';

if (isset($_GET['pegawai'])) {
    $whereAll .= 'pegawai_id = "' . $_GET['pegawai'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
