<?php
	require "../../app/config.php";

	$table = 'view_ref_kategori';
	$primaryKey = 'id';

	$columns = array(
						array( 'db' => 'label',  'dt' => 0 ),
						array( 'db' => 'banyak_form',  'dt' => 1 ),
						array( 'db' => 'id',
							   'dt' => 2,
							   'formatter' => function ($d, $row) {
									return '
											<TombolHapus judul="Hapus Kategori" formreq="HapusKategori" pertanyaan="Anda Yakin Ingin Menghapus Kategori Ini?" parameter="id" value="'.$d.'" class="btn btn-xs btn-danger pull-right"><i class="fa fa-trash-o"></i></TombolHapus>
											<a href="'.$d.'/sunting/" title="Sunting" class="btn btn-success btn-xs pull-right" style="margin-right: 2px;"><i class="fa fa-edit"></i></a>
										   ';
								}
							 ),
					);

	$whereAll = '';

	require( '../library/datatables/scripts/ssp.class.php' );

	echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
?>