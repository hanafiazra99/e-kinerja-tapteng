<?php
	require "../../app/config.php";

	$table = 'h_ref_kedudukan_pegawai';
	$primaryKey = 'id';

	$columns = array(
						array( 'db' => 'status_kepegawaian',  'dt' => 0 ),
						array( 'db' => 'label',  'dt' => 1 ),
						array( 'db' => 'id',
							   'dt' => 2,
							   'formatter' => function ($d, $row) {
									return '
											<a href="kedudukan-pegawai/'.$d.'/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
											<TombolHapus judul="Hapus Keududukan Pegawai" formreq="HapusKeududukanPegawai" pertanyaan="Anda Yakin Ingin Menghapus Keududukan Pegawai Ini?" parameter="id" value="'.$d.'" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></TombolHapus>
										   ';
								}
							 ),
					);

	$whereAll = '';

	require( '../library/datatables/scripts/ssp.class.php' );

	echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
?>