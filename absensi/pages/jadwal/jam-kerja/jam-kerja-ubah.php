<?php
	session_start();
	require "../../../../app/config.php";
	require "../../../../app/models.php";
	require "../../../../app/component.php";
	require "../../../../app/autentikasi.php";
	require "../../../../app/template.php";
	require "../../../controllers/c-jam-kerja.php";
	
	cek_session();
	$user_data = user_data($koneksi);
	check_page_request($_GET['key1'], ABSENSI_URL . 'jadwal/jam-kerja/');
	$data = req_get_where($koneksi, 'absen_jam_masuk', 'id = "' . $_GET['key1'] . '"');
	$breadcrumb = array('Jadwal', 'Jam Kerja', 'Ubah');
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
							<h3 class="box-title">Sunting Data</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<form class="form-horizontal" id="FormSuntingJamKerja" method="post" action="<?php echo ABSENSI_URL;?>controllers/c-jam-kerja.php" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="label" class="col-sm-2 control-label">Hari </label>
									<div class="col-sm-10">
										<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data['id']; ?>" readonly/>
										<input type="text" class="form-control" id="label" readonly  placeholder="Hari" value="<?= $data['hari']?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="label" class="col-sm-2 control-label">Awal Jam Masuk</label>
									<div class="col-sm-10">
										
										<input type="time" class="form-control" id="awal-jam-masuk" name="awal-jam-masuk" placeholder="Awal Jam Masuk" value="<?= $data['awal_masuk']?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="label" class="col-sm-2 control-label">Toleransi Jam Masuk</label>
									<div class="col-sm-10">
										<input type="time" class="form-control" id="toleransi-jam-masuk" name="toleransi-jam-masuk" placeholder="Toleransi Jam Masuk" value="<?= $data['toleransi_masuk']?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="label" class="col-sm-2 control-label">Akhir Jam Masuk</label>
									<div class="col-sm-10">
										
										<input type="time" class="form-control" id="akhir-jam-masuk" name="akhir-jam-masuk" placeholder="Akhir Jam Masuk" value="<?= $data['akhir_masuk']?>" />
									</div>
								</div>
								
								<div class="form-group">
									<label for="nama_kegiatan" class="col-sm-2 control-label"></label>
									<div class="col-sm-10">
										<input type="checkbox" name="check_form" id="check_form" value="y" class="flat-red" /> <i>Saya sudah mengisi data semua data dengan benar</i>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<div class="form-group">
									<div class="col-sm-2"></div>
									<div class="col-sm-10">
										<button type="submit" class="btn btn-sm btn-primary" id="TombolSuntingJamKerja" name="TombolSuntingJamKerja">Simpan</button>
										<a href="<?php echo ABSENSI_URL.'jadwal/hari-kerja/';?>" class="btn btn-sm btn-default" >Batal</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</section>
			</div>
			<?php
				template_footer(ABSENSI_TITLE);
			?>
		</div>
		<?php
			template_js();
			echo '<script src="'.RESOURCES_URL.'js-for/absensi/jadwal/jam-kerja/'.basename($_SERVER['PHP_SELF'], '.php').'.js"></script>';
		?>
	</body>
</html>
