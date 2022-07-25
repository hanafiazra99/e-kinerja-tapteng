<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-data-absen.php";

cek_session();
$user_data = user_data($koneksi);
$data = req_get_where($koneksi, 'absen', 'id = "'.$_GET['key1'].'"');
$data_pegawai = req_get_where($koneksi, 'v_pegawai', 'id = "'.$data['pegawai'].'"'); 
$data_masuk = req_get_where($koneksi, 'absen', 'pegawai = "'.$data['pegawai'].'" AND tanggal = "'.$data['tanggal'].'" AND jenis = "absen" ORDER BY waktu asc limit 1');
$data_pulang = req_get_where($koneksi, 'absen', 'pegawai = "'.$data['pegawai'].'" AND tanggal = "'.$data['tanggal'].'" AND jenis = "absen" ORDER BY waktu desc limit 1');
$breadcrumb = array($data['tanggal'], $data_pegawai['nama']);
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
                        <h3 class="box-title">Detail Absen</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:20%">Tanggal</th>
                                <td><?php echo content_tgl_indo($data['tanggal']); ?></td>
                            </tr>
							<tr>
								<th>Masuk</th>
								<td>
									<?php echo $data_masuk['waktu']; ?><br>
									<img style="height: 200px;" src="<?php echo BASE_URL . 'api/storage/app/absen/'.$data_pegawai['id'].'/' . $data_masuk['berkas']; ?>"><br>
									<a href="http://www.google.com/maps/place/<?php echo $data_masuk['latitude'].','.$data_masuk['longitude']; ?>" target="_blank"><?php echo $data_masuk['latitude'].', '.$data_masuk['longitude']; ?></a>
								</td>
							</tr>
                            <tr>
								<th>Pulang</th>
								<td>
									<?php echo $data_pulang['waktu']; ?><br>
									<img style="height: 200px;" src="<?php echo BASE_URL . 'api/storage/app/absen/'.$data_pegawai['id'].'/' . $data_pulang['berkas']; ?>"><br>
									<a href="http://www.google.com/maps/place/<?php echo $data_pulang['latitude'].','.$data_pulang['longitude']; ?>" target="_blank"><?php echo $data_pulang['latitude'].', '.$data_pulang['longitude']; ?></a>
								</td>
							</tr>
							<tr>
                                <th>Nama</th>
                                <td>
									<?php echo $data_pegawai['nama']; ?><br>
									<img style="height: 200px;" src="<?php echo RESOURCES_URL . 'img/pegawai/' . $data_pegawai['foto']; ?>">
								</td>
                            </tr>
							<tr>
                                <th>OPD</th>
                                <td><?php echo $data_pegawai['opd_nama']; ?></td>
                            </tr>
							<tr>
                                <th>Unit Organisasi</th>
                                <td><?php echo $data_pegawai['unit_organisasi_nama']; ?></td>
                            </tr>
							<tr>
                                <th>Status Kepegawaian</th>
                                <td><?php echo $data_pegawai['status_kepegawaian']; ?></td>
                            </tr>
                          	<tr>
                                <th>Nomor HP</th>
                                <td><?php echo $data_pegawai['no_hp']; ?></td>
                            </tr>
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
echo '<script src="' . RESOURCES_URL . 'js-for/absensi/data-absen/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>