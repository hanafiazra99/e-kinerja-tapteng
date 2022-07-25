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
template_css('base');
?>
</head>

<body class="hold-transition skin-custom sidebar-mini">
	<div class="se-pre-con"></div>
	<div class="wrapper">
		<?php
template_header_ekinerja();
template_navigasi_ekinerja(page_title(), $koneksi, $user_data);
?>

		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					<?php template_page_header($koneksi, page_id());?>
				</h1>
				<ol class="breadcrumb">
					<?php template_breadcrumb($koneksi, page_id(), $breadcrumb);?>
				</ol>
			</section>

			<section class="content">
				<div class="row">
					<div class="col-lg-3 col-xs-6">
						<div class="small-box bg-green">
							<div class="inner">
								<h3>Simpeg</h3>
								<p>Sistem Informasi<br>Manajemen Kepegawaian</p>
							</div>
							<div class="icon">
								<i class="fa fa-vcard"></i>
							</div>
							<a href="<?php echo SIMPEG_URL; ?>" target="blank" class="small-box-footer">
								<b>Masuk</b>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-xs-6">
						<div class="small-box bg-teal">
							<div class="inner">
								<h3>SKP</h3>
								<p>Sasaran Kinerja<br>Pegawai</p>
							</div>
							<div class="icon">
								<i class="fa fa-list-alt"></i>
							</div>
							<a href="<?php echo SKP_URL; ?>" target="blank" class="small-box-footer">
								<b>Masuk</b>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-xs-6">
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3>Absensi</h3>
								<p>Absensi<br>Terintegrasi</p>
							</div>
							<div class="icon">
								<i class="fa fa-calendar-check-o"></i>
							</div>
							<a href="<?php echo ABSENSI_URL; ?>" target="blank" class="small-box-footer">
								<b>Masuk</b>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-xs-6">
						<div class="small-box bg-light-blue">
							<div class="inner">
								<h3>TPP</h3>
								<p>Tambahan Penghasilan<br>Pegawai</p>
							</div>
							<div class="icon">
								<i class="fa fa-money"></i>
							</div>
							<a href="<?php echo TPP_URL; ?>" target="blank" class="small-box-footer">
								<b>Masuk</b>
							</a>
						</div>
					</div>
				</div>
				<div class="box box-blue">
					<div class="box-header with-border">
						<h3 class="box-title">Kata Sambutan Kepala Badan Kepegawaian</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<blockquote>
						</blockquote>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Berita dan Informasi</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
							</div>
						</div>
						<div>
							<div>
			</section>
		</div>
		<?php
template_footer(BASE_TITLE);
?>
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal" class="modal fade">
			<div class="modal-default">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title">Informasi</h4>
						</div>
						<div class="modal-body">
							<p>Aplikasi Ini Sedang Dalam Masa Pengembangan</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary pull-left" data-dismiss="modal">OK</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
template_js();
?>
</body>

</html>