<?php
session_start();
require "../../../../app/config.php";

$table = 'pegawai_riwayat_kerja_honorer';
$primaryKey = 'id';

$columns = array(
    array('db' => 'tahun', 'dt' => 0),
    array('db' => 'opd', 'dt' => 1),
    array('db' => 'jabatan', 'dt' => 2),
    array('db' => 'no_sk', 'dt' => 3),
    array(
        'db' => 'id',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return '
                    <a href="riwayat-kerja/' . $d . '/" title="Lihat" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                    ' . ($_SESSION['role'] == '1' ? '<a href="riwayat-kerja/' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>' : '') . '
                    ' . ($_SESSION['role'] == '1' ? '<TombolHapus judul="Hapus Riwayat Kerja Honorer" formreq="HapusRiwayatKerjaHonorer" pertanyaan="Anda Yakin Ingin Menghapus Riwayat Kerja Honorer Ini?" parameter="id" value="' . $d . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>' : '') . '
                   ';
        },
    ),
);

$whereAll = '';

if (isset($_GET['pegawai'])) {
    $whereAll .= 'pegawai = "' . $_GET['pegawai'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
