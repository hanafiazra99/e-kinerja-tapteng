<?php
	require "../../../../app/config.php";

	$table = 'v_tpp_pengaturan_persentase';
	$primaryKey = 'id';

	$columns = array(
						array( 'db' => 'label',  'dt' => 0 ),
						array( 'db' => 'persentase_tpp_maksimal',  'dt' => 1 ),
						array( 'db' => 'id',
							   'dt' => 2,
							   'formatter' => function ($d, $row) {
									return '
											<a href="persentase/'.$d.'/sunting/" title="Sunting" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
											';
								}
							 ),
					);

	$whereAll = '';

	require '../../../library/datatables/scripts/ssp.class.php';

	echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
?>

