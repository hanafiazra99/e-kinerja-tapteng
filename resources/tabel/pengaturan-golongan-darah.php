<?php
	require "../../app/config.php";

	$table = 'ref_golongan_darah';
	$primaryKey = 'id';

	$columns = array(
						array( 'db' => 'label',  'dt' => 0 ),
						array( 'db' => 'id',
							   'dt' => 1,
							   'formatter' => function ($d, $row) {
									return '
											<a href="golongan-darah/'.$d.'/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
											<TombolHapus judul="Hapus Golongan Darah" formreq="HapusGolonganDarah" pertanyaan="Anda Yakin Ingin Menghapus Golongan Darah Ini?" parameter="id" value="'.$d.'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>
										   ';
								}
							 ),
					);

	$whereAll = '';

	require( '../library/datatables/scripts/ssp.class.php' );

	echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
?>