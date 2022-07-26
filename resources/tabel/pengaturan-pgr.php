<?php
require "../../app/config.php";

$table = 'ref_pgr';
$primaryKey = 'id';

$columns = array(
    array('db' => 'pangkat',  'dt' => 0),
    array('db' => 'golongan',  'dt' => 1),
    array('db' => 'ruang',  'dt' => 2),
    array(
        'db' => 'id',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            return '
                    <a href="pgr/' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                    <TombolHapus judul="Hapus Pangkat Golongan Ruang" formreq="HapusPGR" pertanyaan="Anda Yakin Ingin Menghapus Pangkat Golongan Ruang Ini?" parameter="id" value="' . $d . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>
                   ';
        }
    ),
);

$whereAll = '';

require('../library/datatables/scripts/ssp.class.php');

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
