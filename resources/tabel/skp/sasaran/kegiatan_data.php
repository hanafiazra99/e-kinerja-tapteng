<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'v_skp_sasaran_kegiatan';
$primaryKey = 'id';

$columns = array(
    array('db' => 'kegiatan', 'dt' => 0),
    array(
        'db' => 'kuantitas',
        'dt' => 1,
        'formatter' => function ($d, $row) {
            return number_format($d, 2, ',', '.');
        },
    ),
    array('db' => 'output', 'dt' => 2),
    array(
        'db' => 'kualitas',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            return number_format($d, 2, ',', '.');
        },
    ),
    array(
        'db' => 'waktu',
        'dt' => 4,
        'formatter' => function ($d, $row) {
            return $d . ' Bulan';
        },
    ),
    array(
        'db' => 'biaya',
        'dt' => 5,
        'formatter' => function ($d, $row) {
            return 'Rp. ' . number_format($d, 2, ',', '.');
        },
    ),
    array(
        'db' => 'id',
        'dt' => 6,
        'formatter' => function ($d, $row) {
            return '
                    <a href="kegiatan/' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                    ' . ($_GET['status'] == 'Dibuat' ? '<a href="kegiatan/' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>' : ($_GET['status'] == 'Ditolak' ? '<a href="kegiatan/' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>' : '')) . '
                    ' . ($_GET['status'] == 'Dibuat' ? '<TombolHapus judul="Hapus Kegiatan" formreq="HapusSasaranKegiatan" pertanyaan="Anda Yakin Ingin Menghapus Kegiatan Ini?" parameter="id" value="' . $d . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>' : ($_GET['status'] == 'Ditolak' ? '<TombolHapus judul="Hapus Kegiatan" formreq="HapusSasaranKegiatan" pertanyaan="Anda Yakin Ingin Menghapus Kegiatan Ini?" parameter="id" value="' . $d . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>' : '')) . '
                   ';
        },
    ),
);

$whereAll = '';

if (isset($_GET['sasaran'])) {
    $whereAll .= 'sasaran = "' . $_GET['sasaran'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
