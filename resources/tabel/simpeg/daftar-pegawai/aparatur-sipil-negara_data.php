<?php
session_start();
require "../../../../app/config.php";

$table = 'cv_asn';
$primaryKey = 'id';

$columns = array(
    array('db' => 'opd_nama', 'dt' => 0),
    array('db' => 'unit_organisasi_nama', 'dt' => 1),
    array('db' => 'nip', 'dt' => 2),
    array('db' => 'nama', 'dt' => 3),
    array('db' => 'status_kepegawaian', 'dt' => 4),
    array('db' => 'nama_jabatan', 'dt' => 5),
    array(
        'db' => 'id',
        'dt' => 6,
        'formatter' => function ($d, $row) {
            return '
                                            <a href="' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                                            ' . ($_SESSION['role'] == '1' ? '<TombolHapus judul="Hapus Pegawai" formreq="HapusPegawai" pertanyaan="Anda Yakin Ingin Menghapus Pegawai Ini?" parameter="id" value="' . $d . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>' : '') . '
										   ';
        },
    ),
);

$whereAll = '';

if (isset($_GET['opd'])) {
    $whereAll .= 'opd_nama = "' . $_GET['opd'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
