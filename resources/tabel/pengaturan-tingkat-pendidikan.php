<?php
require "../../app/config.php";

$table = 'ref_tingkat_pendidikan';
$primaryKey = 'id';

$columns = array(
    array('db' => 'label',  'dt' => 0),
    array('db' => 'tingkat',  'dt' => 1),
    array(
        'db' => 'id',
        'dt' => 2,
        'formatter' => function ($d, $row) {
            return '
                    <a href="tingkat-pendidikan/' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                    <TombolHapus judul="Hapus Tingkat Pendidikan" formreq="HapusTingkatPendidikan" pertanyaan="Anda Yakin Ingin Menghapus Tingkat Pendidikan Ini?" parameter="id" value="' . $d . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>
                   ';
        }
    ),
);

$whereAll = '';

require('../library/datatables/scripts/ssp.class.php');

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
