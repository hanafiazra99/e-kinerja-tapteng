<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-beranda.php";

cek_session();
$user_data = user_data($koneksi);
$breadcrumb = array();
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
template_header($user_data, $koneksi, SIMPEG_TITLE);
template_navigasi(page_title(), $koneksi, 'simpeg', SIMPEG_URL);
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
				<div class="box box-blue" <?php echo ($_SESSION['role'] == '100' ? 'style="display: none;"' : ''); ?>>
					<div class="box-header with-border">
						<h3 class="box-title">Grafik Status Kepegawaian</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div id="chart_status_kepegawaian" style="height: 400px"></div>
					</div>
				</div>

				<div class="row" <?php echo ($_SESSION['role'] == '100' ? 'style="display: none;"' : ''); ?>>
					<div class="col-sm-6">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Grafik Jenis Kelamin ASN</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div id="chart_jenis_kelamin_asn" style="height: 400px"></div>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Grafik Agama ASN</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div id="chart_agama_asn" style="height: 400px"></div>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Grafik OPD ASN</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div id="chart_opd_asn" style="height: 400px"></div>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Grafik Jenis Kepegawaian</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div id="chart_jenis_kepegawaian" style="height: 400px"></div>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Grafik Jenis Jabatan</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div id="chart_jenis_jabatan_asn" style="height: 400px"></div>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Grafik Pangkat Golongan Ruang</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div id="chart_pgr_asn" style="height: 400px"></div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Grafik Jenis Kelamin Honorer</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div id="chart_jenis_kelamin_honorer" style="height: 400px"></div>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Grafik Agama Honorer</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div id="chart_agama_honorer" style="height: 400px"></div>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Grafik OPD Honorer</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div id="chart_opd_honorer" style="height: 400px"></div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php
template_footer(SIMPEG_TITLE);
?>
	</div>
	<?php
echo '
	<script>
		var role="' . $_SESSION['role'] . '";
		var user_opd="' . ($_SESSION['role'] == '10' ? $user_data['opd'] : $user_data['opd_nama']) . '";
		var BASE_URL = "' . BASE_URL . '";
		var SIMPEG_URL = "' . SIMPEG_URL . '";
		var RESOURCES_URL = "' . RESOURCES_URL . '";
	</script>
 ';
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/beranda/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>