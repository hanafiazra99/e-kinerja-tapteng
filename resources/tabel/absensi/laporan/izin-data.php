<?php
session_start();
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'v_new_absen';
$primaryKey = 'id';

$columns = array(
    
    array('db' => 'nip', 'dt' => 0),
    array('db' => 'nama', 'dt' => 1),

    array(
            'db' => 'bulan', 
            'dt' => 2,
            'formatter' => function ($d, $row) {
                return content_bulan_indo($d)   ;
            },
        ),
    array('db' => 'nama_jabatan', 'dt' => 3),
    array('db' => 'jenis', 'dt' => 4),
    
    
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
$whereAll .= ' jenis="Izin" ';
if (isset($_GET['opd'])) {
    $whereAll .= ' and opd_nama = "' . $_GET['opd'] . '"';
} else if (isset($_GET['unit_organisasi'])) {
    $whereAll .= ' and unit_organisasi_nama = "' . $_GET['unit_organisasi'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
