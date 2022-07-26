<?php
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'cv_skp_sasaran_bulanan';
$primaryKey = 'id';

$columns = array(
    array(
        'db' => 'bulan',
        'dt' => 0,
        'formatter' => function ($d, $row) {
            return content_bulan_indo($d);
        },
    ),
    array(
        'db' => 'banyak_kegiatan',
        'dt' => 1,
        'formatter' => function ($d, $row) {
            return $d . ' Kegiatan';
        },
    ),
    array('db' => 'status', 'dt' => 2),
    array(
        'db' => 'id',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            return '
                    <a href="bulanan/' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                    <a href="bulanan/' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                    <TombolHapus judul="Hapus Uraian Bulanan" formreq="HapusSasaranBulanan" pertanyaan="Anda Yakin Ingin Menghapus Uraian Bulanan Ini?" parameter="id" value="' . $d . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>
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
