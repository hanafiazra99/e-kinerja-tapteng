<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'v_simpeg_lp_masa_persiapan_pensiun';
$primaryKey = 'id';

$columns = array(
    array('db' => 'pegawai_nip', 'dt' => 0),
    array('db' => 'pegawai_nama', 'dt' => 1),
    array('db' => 'opd_asal_nama', 'dt' => 2),
    array('db' => 'nama_jabatan', 'dt' => 3),
    array('db' => 'pgr', 'dt' => 4),
    array(
        'db' => 'id',
        'dt' => 5,
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
