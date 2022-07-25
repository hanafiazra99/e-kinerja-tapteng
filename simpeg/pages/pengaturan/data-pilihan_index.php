<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-pengaturan.php";

cek_session();
$user_data = user_data($koneksi);
$breadcrumb = array('Data Pilihan');
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
				<div class="row">
					<div class="col-sm-4">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Daftar Agama</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_l1" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Nama</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Daftar Jenis Kelamin</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_l2" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Nama</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Daftar Golongan Darah</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_l3" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Nama</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Daftar Status Perkawinan</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_l4" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Nama</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Daftar Status Kepegawaian</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_m1" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Nama</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Daftar Kedudukan Pegawai</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_m2" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Status Kepegawaian</th>
											<th>Nama</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Daftar Jenis Kepegawaian</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_m3" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Nama</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Daftar Jenis Jabatan</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_m4" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Nama</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Daftar Eselon</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_r1" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Nama</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Daftar Pangkat Golongan Ruang</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_r2" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Pangkat</th>
											<th>Golongan</th>
											<th>Ruang</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>

						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Daftar Tingkat Pendidikan</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_r3" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Nama</th>
											<th>Tingkat</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php
echo '
		<script>
			var role="' . $_SESSION['role'] . '";
			var user_opd="' . $user_data['opd'] . '";
			var BASE_URL = "' . BASE_URL . '";
			var SIMPEG_URL = "' . SIMPEG_URL . '";
			var RESOURCES_URL = "' . RESOURCES_URL . '";
		</script>
	 ';
template_footer(SIMPEG_TITLE);
?>
	</div>
	<?php
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/pengaturan/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>