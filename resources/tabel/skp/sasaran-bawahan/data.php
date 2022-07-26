<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'cv_skp_sasaran';
$primaryKey = 'id';

$columns = array(
    array('db' => 'pegawai_nip', 'dt' => 0),
    array('db' => 'pegawai_nama', 'dt' => 1),
    array('db' => 'pegawai_jabatan', 'dt' => 2),
    array(
        'db' => 'periode',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            return content_tgl_indo(explode('|', $d)[0]) . ' - ' . content_tgl_indo(explode('|', $d)[1]);
        },
    ),
    array(
        'db' => 'banyak_kegiatan',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return $d . ' Kegiatan';
        },
    ),
    array('db' => 'status', 'dt' => 5),
    array(
        'db' => 'id',
        'dt' => 6,
        'formatter' => function ($d, $row) {
            return '
                                            <a href="' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
										   ';
        },
    ),
);

$whereAll = 'status != "Dibuat" ';

if (isset($_GET['pp'])) {
    $whereAll .= 'AND pp = "' . $_GET['pp'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
