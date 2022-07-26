<?php
	require "../../app/config.php";
	require "../../app/component.php";

	$table = 'view_link';
	$primaryKey = 'id';

	$columns = array(
						array( 'db' => 'judul',  'dt' => 0 ),
						array( 'db' => 'kategori',  'dt' => 1 ),
						array( 'db' => 'uc',  'dt' => 2 ),
						array( 'db' => 'doc',
							   'dt' => 3,
							   'formatter' => function ($d, $row) {
									return content_tgl_indo(explode(' ', $d)[0]);
								}
							 ),
						array( 'db' => 'status',  'dt' => 4 ),
						array( 'db' => 'id',
							   'dt' => 5,
							   'formatter' => function ($d, $row) {
									return '
											<TombolHapus judul="Hapus Link" formreq="HapusLink" pertanyaan="Anda Yakin Ingin Menghapus Link Ini?" parameter="id" value="'.$d.'" class="btn btn-xs btn-danger pull-right"><i class="fa fa-trash-o"></i></TombolHapus>
											<a href="'.$d.'/sunting/" title="Sunting" class="btn btn-success btn-xs pull-right" style="margin-right: 2px;"><i class="fa fa-edit"></i></a>
											<a href="'.$d.'/" title="Sunting" class="btn btn-primary btn-xs pull-right" style="margin-right: 2px;"><i class="fa fa-search"></i></a>
										   ';
								}
							 ),
					);

	$whereAll = '';

	require( '../library/datatables/scripts/ssp.class.php' );

	echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
?>