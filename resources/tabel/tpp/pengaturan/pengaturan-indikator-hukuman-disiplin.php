<?php
	require "../../../../app/config.php";

	$table = 'tpp_pengaturan_indikator_hukuman_disiplin';
	$primaryKey = 'id';

	$columns = array(
						array( 'db' => 'tingkat_hukuman',  'dt' => 0 ),
						array( 'db' => 'jenis_hukuman',  'dt' => 1 ),
						array( 'db' => 'bobot',  'dt' => 2 ),
						array( 'db' => 'id',
							   'dt' => 3,
							   'formatter' => function ($d, $row) {
									return '
											<a href="indikator-ketepatan-pulang-kerja/'.$d.'/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
											';
								}
							 ),
					);

	$whereAll = '';

	require '../../../library/datatables/scripts/ssp.class.php';

	echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
?>

