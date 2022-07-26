<?php
require "../../../../app/config.php";

$table = 'opd_unit_organisasi';
$primaryKey = 'id';

$columns = array(
    array('db' => 'nama',  'dt' => 0),
    array('db' => 'tlp',  'dt' => 1),
    array('db' => 'email',  'dt' => 2),
    array(
        'db' => 'id',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            return '
                                            <a href="unit-organisasi/' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                                            <a href="unit-organisasi/' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                            <TombolHapus judul="Hapus Unit Organisasi" formreq="HapusUnitOrganisasi" pertanyaan="Anda Yakin Ingin Menghapus Unit Organisasi Ini?" parameter="id" value="'.$d.'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>
										   ';
        }
    ),
);

$whereAll = '';

if (isset($_GET['opd'])) {
    $whereAll .= 'opd = "' . $_GET['opd'] . '"';
}

require('../../../library/datatables/scripts/ssp.class.php');

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
