<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-data-riwayat.php";

cek_session();
$user_data = user_data($koneksi);
$data_pengangkatan_cpns = req_get_where($koneksi, 'v_pegawai_pengangkatan_cpns', 'id = "' . $_SESSION['id'] . '"');
$data_pengangkatan_pns = req_get_where($koneksi, 'v_pegawai_pengangkatan_pns', 'id = "' . $_SESSION['id'] . '"');
$data_jabatan = req_get_where($koneksi, 'v_pegawai_jabatan', 'id = "' . $_SESSION['id'] . '"');
$data_pgr = req_get_where($koneksi, 'v_pegawai_pgr', 'id = "' . $_SESSION['id'] . '"');
$data_kgb = req_get_where($koneksi, 'v_pegawai_kgb', 'id = "' . $_SESSION['id'] . '"');
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
                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Riwayat</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#ct_r_pgr" data-toggle="tab">Riwayat Pangkat Golongan Ruang</a></li>
                            <li><a href="#ct_r_kgb" data-toggle="tab">Riwayat Kenaikan Gaji Berkala</a></li>
                            <li><a href="#ct_r_jabatan" data-toggle="tab">Riwayat Jabatan</a></li>
                            <li><a href="#ct_r_pendidikan_umum" data-toggle="tab">Riwayat Pendidikan Umum</a></li>
                            <li><a href="#ct_r_diklat" data-toggle="tab">Riwayat Diklat</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="ct_r_pgr">
                                <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">
                                    <thead>
                                        <tr class="bg-custom">
                                            <th>Pejabat Yang Menetapkan</th>
                                            <th>No. SK</th>
                                            <th>Pangkat/Golongan/Ruang</th>
                                            <th>TMT</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane" id="ct_r_kgb">
                                <table id="daftar_data_2" style="width: 100%;" class="table table-bordered table-fix-last">
                                    <thead>
                                        <tr class="bg-custom">
                                            <th>Pejabat Yang Menetapkan</th>
                                            <th>No. SK</th>
                                            <th>TMT</th>
                                            <th>Kantor Pembayaran</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane" id="ct_r_jabatan">
                                <table id="daftar_data_3" style="width: 100%;" class="table table-bordered table-fix-last">
                                    <thead>
                                        <tr class="bg-custom">
                                            <th>Pejabat Yang Menetapkan</th>
                                            <th>No. SK Jabatan</th>
                                            <th>Eselon</th>
                                            <th>Nama Jabatan</th>
                                            <th>TMT</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane" id="ct_r_pendidikan_umum">
                                <table id="daftar_data_4" style="width: 100%;" class="table table-bordered table-fix-last">
                                    <thead>
                                        <tr class="bg-custom">
                                            <th>Nama Institusi</th>
                                            <th>Tingkat Pendidikan</th>
                                            <th>Jurusan</th>
                                            <th>No. STTB</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane" id="ct_r_diklat">
                                <table id="daftar_data_5" style="width: 100%;" class="table table-bordered table-fix-last">
                                    <thead>
                                        <tr class="bg-custom">
                                            <th>Jenis Diklat</th>
                                            <th>Nama Diklat</th>
                                            <th>Penyelenggara</th>
                                            <th>No. STTPP</th>
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
template_footer(SIMPEG_TITLE);
?>
	</div>
	<?php
echo '
	<script>
		var role="' . $_SESSION['role'] . '";
		var pegawai="' . $_SESSION['id'] . '";
		var BASE_URL = "' . BASE_URL . '";
		var SIMPEG_URL = "' . SIMPEG_URL . '";
		var RESOURCES_URL = "' . RESOURCES_URL . '";
	</script>
 ';
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/data-riwayat/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>