<?php
session_start();
require "../../../../app/config.php";

$table = 'v_pegawai_riwayat_jabatan';
$primaryKey = 'id';

$columns = array(
    array('db' => 'pym', 'dt' => 0),
    array('db' => 'no_sk_jabatan', 'dt' => 1),
    array('db' => 'eselon', 'dt' => 2),
    array('db' => 'nama_jabatan', 'dt' => 3),
    array('db' => 'tmt', 'dt' => 4),
    array(
        'db' => 'id',
        'dt' => 5,
        'formatter' => function ($d, $row) {
            return '
                    <a href="riwayat-jabatan/' . $d . '/" title="Lihat" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                    ' . ($_SESSION['role'] == '1' ? '<a href="riwayat-jabatan/' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>' : '') . '
                    ' . ($_SESSION['role'] == '1' ? '<TombolHapus judul="Hapus Riwayat Jabatan" formreq="HapusRiwayatJabatan" pertanyaan="Anda Yakin Ingin Menghapus Riwayat Jabatan Ini?" parameter="id" value="' . $d . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>' : '') . '
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
