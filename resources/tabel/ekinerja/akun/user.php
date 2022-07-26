<?php
require "../../../../app/config.php";

$table = 'view_akun_user';
$primaryKey = 'id';

$columns = array(
    array('db' => 'nama', 'dt' => 0),
    array('db' => 'username', 'dt' => 1),
    array('db' => 'tlp', 'dt' => 2),
    array('db' => 'role', 'dt' => 3),
    array('db' => 'opd_nama', 'dt' => 4),
    array(
        'db' => 'id',
        'dt' => 5,
        'formatter' => function ($d, $row) {
            return '
											<a href="' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
											<TombolHapus judul="Hapus User" formreq="HapusUser" pertanyaan="Anda Yakin Ingin Menghapus User Ini?" parameter="id" value="' . $d . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>
										   ';
        },
    ),
);

$whereAll = '';

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
