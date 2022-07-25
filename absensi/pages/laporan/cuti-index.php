<?php

session_start();

require "../../../app/config.php";

require "../../../app/models.php";

require "../../../app/component.php";

require "../../../app/autentikasi.php";

require "../../../app/template.php";

require "../../controllers/c-laporan.php";



cek_session();

$user_data = user_data($koneksi);

$conn = req_data_where($koneksi_absensi_baru, 'riwayat', 'jenis = "sakit" order by tanggal desc, nip asc');

$breadcrumb = array('Rekap Cuti');

?>

<!DOCTYPE html>

<html>



<head>

	<?php

template_title(page_title(), BASE_TITLE);

template_favicon();

template_meta();

template_css('app');

?>

</head>



<body class="hold-transition skin-custom sidebar-mini">

	<div class="se-pre-con"></div>

	<div class="wrapper">

		<?php

template_header($user_data, $koneksi, ABSENSI_TITLE);

template_navigasi(page_title(), $koneksi, 'absensi', ABSENSI_URL);

?>



		<div class="content-wrapper">

			<section class="content-header">

				<h1>

					<?php

template_page_header($koneksi, portal_id());

?>

				</h1>

				<ol class="breadcrumb">

					<?php

template_breadcrumb($koneksi, portal_id(), $breadcrumb);

?>

				</ol>

			</section>



			<section class="content">

				<div class="box box-blue">

                    <div class="box-header with-border">

                        <h3 class="box-title">Daftar Data</h3>

                        <div class="box-tools pull-right">

                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                        </div>

                    </div>

                    <div class="box-body">

                        <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">

                            <thead>

                                <tr class="bg-custom">

                                    <th>OPD</th>

                                    <th>Unit Organisasi</th>

                                    <th>NIP</th>

                                    <th>Nama</th>

                                    <th>Tanggal</th>

                                    <th>Jabatan</th>

                                    <th></th>

                                </tr>

                            </thead>

							<tbody>

								<?php

									$nip = '';

									while($data = mysqli_fetch_array($conn)){

										$data_pegawai = req_get_where($koneksi, 'cv_asn', 'nip = "'.$data['nip'].'"');

										if($data['nip'] != $nip){

											echo '

													<tr>

														<td>'.$data_pegawai['opd_nama'].'</td>

														<td>'.$data_pegawai['unit_organisasi_nama'].'</td>

														<td>'.$data_pegawai['nip'].'</td>

														<td>'.$data_pegawai['nama'].'</td>

														<td>'.$data['tanggal'].'</td>

														<td>'.$data_pegawai['nama_jabatan'].'</td>

														<td>

															<a href="'.$data['id'].'/" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a>

														</td>

													</tr>

												 ';

										}

										$nip = $data['nip'];

									}

								?>

							</tbody>

                        </table>

                    </div>

                </div>

			</section>

		</div>

		<?php

template_footer(ABSENSI_TITLE);

?>

	</div>

	<?php

echo '

	<script>

		var role="' . $_SESSION['role'] . '";

		var user_opd="' . $user_data['opd'] . '";

		var BASE_URL = "' . BASE_URL . '";

		var ABSENSI_URL = "' . ABSENSI_URL . '";

		var RESOURCES_URL = "' . RESOURCES_URL . '";

	</script>

 ';

template_js();

echo '<script src="' . RESOURCES_URL . 'js-for/absensi/laporan/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';

?>

</body>



</html>