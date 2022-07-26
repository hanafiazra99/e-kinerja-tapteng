<?php
	require "../../../../app/config.php";

	$table = 'tpp_pengaturan_indikator_ketepatan_waktu_sasaran_kerja';
	$primaryKey = 'id';

	$columns = array(
						array( 'db' => 'batas_bawah',  'dt' => 0 ),
						array( 'db' => 'batas_atas',  'dt' => 1 ),
						array( 'db' => 'bobot',  'dt' => 2 ),
						array( 'db' => 'id',
							   'dt' => 3,
							   'formatter' => function ($d, $row) {
									return '
											<a href="indikator-ketepatan-waktu-sasaran-kerja/'.$d.'/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
											';
								}
							 ),
					);

	$whereAll = '';

	require '../../../library/datatables/scripts/ssp.class.php';

	echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
?>

