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
$data = req_get_where($koneksi_absensi_baru, 'riwayat', 'id = "'.$_GET['key1'].'"');
$data_pegawai = req_get_where($koneksi, 'cv_asn', 'nip = "'.$data['nip'].'"');
$breadcrumb = array('Rekap Izin', $data['tanggal'], $data_pegawai['nama']);
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
                                <th>Nama</th>
                                <td><?php echo $data_pegawai['nama']; ?></td>
                            </tr>
							<tr>
                                <th>NIP</th>
                                <td><?php echo $data_pegawai['nip']; ?></td>
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
                                <th>Jabatan</th>
                                <td><?php echo $data_pegawai['nama_jabatan']; ?></td>
                            </tr>
							<tr>
                                <th>Keterangan</th>
                                <td><?php echo $data['keterangan']; ?></td>
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
echo '<script src="' . RESOURCES_URL . 'js-for/absensi/laporan/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>