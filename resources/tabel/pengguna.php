<?php
	require "../../app/config.php";
	require "../../app/component.php";

	$table = 'view_user';
	$primaryKey = 'id';

	$columns = array(
						array( 'db' => 'nama',  'dt' => 0 ),
						array( 'db' => 'tlp',  'dt' => 1 ),
						array( 'db' => 'email',  'dt' => 2 ),
						array( 'db' => 'akses',  'dt' => 3 ),
						array( 'db' => 'opd',  'dt' => 4 ),
						array( 'db' => 'id',
							   'dt' => 5,
							   'formatter' => function ($d, $row) {
									return '
											<TombolHapus judul="Hapus Pengguna" formreq="HapusPengguna" pertanyaan="Anda Yakin Ingin Menghapus Pengguna Ini?" parameter="id" value="'.$d.'" class="btn btn-xs btn-danger pull-right"><i class="fa fa-trash-o"></i></TombolHapus>
											<a href="'.$d.'/" title="Detail" class="btn btn-primary btn-xs pull-right" style="margin-right: 2px;"><i class="fa fa-search"></i></a>
										   ';
								}
							 ),
					);

	$whereAll = '';

	require( '../library/datatables/scripts/ssp.class.php' );

	echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
?>