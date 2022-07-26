<?php
	require "../../app/config.php";

	$table = 'ref_jenis_sosial_media';
	$primaryKey = 'id';

	$columns = array(
						array( 'db' => 'label',  'dt' => 0 ),
						array( 'db' => 'id',
							   'dt' => 1,
							   'formatter' => function ($d, $row) {
									return '
											<TombolHapus judul="Hapus Jenis Sosial Media" formreq="HapusJenisSosialMedia" pertanyaan="Anda Yakin Ingin Menghapus Jenis Sosial Media Ini?" parameter="id" value="'.$d.'" class="btn btn-xs btn-danger pull-right"><i class="fa fa-trash-o"></i></TombolHapus>
											<a href="jenis-sosial-media/'.$d.'/sunting/" title="Sunting" class="btn btn-success btn-xs pull-right" style="margin-right: 2px;"><i class="fa fa-edit"></i></a>
										   ';
								}
							 ),
					);

	$whereAll = '';

	require( '../library/datatables/scripts/ssp.class.php' );

	echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
?>