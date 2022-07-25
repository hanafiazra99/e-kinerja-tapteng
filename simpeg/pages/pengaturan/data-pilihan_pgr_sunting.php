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
    check_page_request($_GET['key1'], SIMPEG_URL.'pengaturan/data-pilihan/');
	$data = req_get_where($koneksi, 'ref_pgr', 'id = "'.$_GET['key1'].'"');
	check_page_request($data['id'], SIMPEG_URL.'pengaturan/data-pilihan/');
	$breadcrumb = array('Data Pilihan', 'Pangkat Golongan Ruang', $data['pangkat'].'/'.$data['golongan'].'/'.$data['ruang'], 'Sunting');
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
					<div class="box box-blue">
						<div class="box-header with-border">
							<h3 class="box-title">Sunting Data</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<form class="form-horizontal" id="FormSuntingPGR" method="post" action="<?php echo SIMPEG_URL;?>controllers/c-pengaturan.php" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="pangkat" class="col-sm-2 control-label">Pangkat</label>
									<div class="col-sm-10">
										<input type="hidden" class="form-control" id="id" name="id" value="" />
										<input type="text" class="form-control" id="pangkat" name="pangkat" placeholder="Pangkat" value="<?php echo $data['pangkat'];?>" />
									</div>
                                </div>
                                <div class="form-group">
									<label for="golongan" class="col-sm-2 control-label">Golongan</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="golongan" name="golongan" placeholder="Golongan" value="<?php echo $data['golongan'];?>" />
									</div>
                                </div>
                                <div class="form-group">
									<label for="ruang" class="col-sm-2 control-label">Ruang</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="ruang" name="ruang" placeholder="Ruang" value="<?php echo $data['ruang'];?>" />
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
										<button type="submit" class="btn btn-sm btn-primary" id="TombolSuntingPGR" name="TombolSuntingPGR">Simpan</button>
										<a href="<?php echo SIMPEG_URL.'pengaturan/data-pilihan/';?>" class="btn btn-sm btn-default" >Batal</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</section>
			</div>
			<?php
				template_footer(SIMPEG_TITLE);
			?>
		</div>
		<?php
			template_js();
			echo '<script src="'.RESOURCES_URL.'js-for/simpeg/pengaturan/'.basename($_SERVER['PHP_SELF'], '.php').'.js"></script>';
		?>
	</body>
</html>
