<?php
require "../../../../app/config.php";

$table = 'opd_struktur_organisasi_tugas_tambahan';
$primaryKey = 'id';

$columns = array(
    array('db' => 'tugas_tambahan', 'dt' => 0),
    array(
        'db' => 'id',
        'dt' => 1,
        'formatter' => function ($d, $row) {
            return '
                    <a href="tugas-tambahan/' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                    <TombolHapus judul="Hapus Tugas Tambahan" formreq="HapusTugasTambahan" pertanyaan="Anda Yakin Ingin Menghapus Tugas Tambahan Ini?" parameter="id" value="' . $d . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>
                   ';
        },
    ),
);

$whereAll = '';

if (isset($_GET['nama_jabatan'])) {
    $whereAll .= 'nama_jabatan = "' . $_GET['nama_jabatan'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
