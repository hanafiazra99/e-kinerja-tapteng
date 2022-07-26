<?php
session_start();
require "../../../../app/config.php";

$table = 'v_pegawai_anak';
$primaryKey = 'id';

$columns = array(
    array('db' => 'nama', 'dt' => 0),
    array('db' => 'jenis_kelamin', 'dt' => 1),
    array('db' => 'status_anak', 'dt' => 2),
    array('db' => 'tunjangan', 'dt' => 3),
    array(
        'db' => 'id',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return '
                    <a href="anak/' . $d . '/" title="Lihat" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                    ' . ($_SESSION['role'] == '1' ? '<a href="anak/' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>' : '') . '
                    ' . ($_SESSION['role'] == '1' ? '<TombolHapus judul="Hapus Anak" formreq="HapusAnak" pertanyaan="Anda Yakin Ingin Menghapus Anak Ini?" parameter="id" value="' . $d . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>' : '') . '
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
