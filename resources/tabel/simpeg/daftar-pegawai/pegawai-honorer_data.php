<?php
require "../../../../app/config.php";

$table = 'cv_honorer';
$primaryKey = 'id';

$columns = array(
    array('db' => 'opd_nama', 'dt' => 0),
    array('db' => 'unit_organisasi_nama', 'dt' => 1),
    array('db' => 'nama', 'dt' => 2),
    array('db' => 'nama_jabatan', 'dt' => 3),
    array(
        'db' => 'id',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return '
                                            <a href="' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                                            <TombolHapus judul="Hapus Pegawai Honorer" formreq="HapusPegawaiHonorer" pertanyaan="Anda Yakin Ingin Menghapus Pegawai Ini?" parameter="id" value="' . $d . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>
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
