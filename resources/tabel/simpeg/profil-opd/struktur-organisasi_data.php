<?php
require "../../../../app/config.php";

$table = 'v_opd_struktur_organisasi';
$primaryKey = 'id';

$columns = array(
    array('db' => 'nama_jabatan',  'dt' => 0),
    array('db' => 'atasan',  'dt' => 1),
    array(
        'db' => 'id',
        'dt' => 2,
        'formatter' => function ($d, $row) {
            return '
                                            <a href="struktur-organisasi/' . $d . '/" title="Detail" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                                            <a href="struktur-organisasi/' . $d . '/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                            <TombolHapus judul="Hapus Struktur Organisasi" formreq="HapusStrukturOrganisasi" pertanyaan="Anda Yakin Ingin Menghapus Struktur Organisasi Ini?" parameter="id" value="'.$d.'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>
										   ';
        }
    ),
);

$whereAll = '';

if (isset($_GET['opd'])) {
    $whereAll .= 'opd_id = "' . $_GET['opd'] . '"';
}

require('../../../library/datatables/scripts/ssp.class.php');

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
