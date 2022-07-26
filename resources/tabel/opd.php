<?php
	require "../../app/config.php";

	$table = 'view_opd';
	$primaryKey = 'id';

	$columns = array(
						array( 'db' => 'jenis_opd',  'dt' => 0 ),
						array( 'db' => 'nama',  'dt' => 1 ),
						array( 'db' => 'id',
							   'dt' => 2,
							   'formatter' => function ($d, $row) {
									return '
											<TombolHapus judul="Hapus OPD" formreq="HapusOPD" pertanyaan="Anda Yakin Ingin Menghapus OPD Ini?" parameter="id" value="'.$d.'" class="btn btn-xs btn-danger pull-right"><i class="fa fa-trash-o"></i></TombolHapus>
											<a href="'.$d.'/sunting/" title="Sunting" class="btn btn-success btn-xs pull-right" style="margin-right: 2px;"><i class="fa fa-edit"></i></a>
										   ';
								}
							 ),
					);

	$whereAll = '';

	require( '../library/datatables/scripts/ssp.class.php' );

	echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
?>