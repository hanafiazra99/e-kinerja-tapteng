<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-perhitungan-tpp.php";

cek_session();
$user_data = user_data($koneksi);
$breadcrumb = array();
$conn_test = req_data_where($koneksi, 'v_test_tpp', 'opd_id = "O05214020190320D1604"');
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
template_header($user_data, $koneksi, TPP_TITLE);
template_navigasi(page_title(), $koneksi, 'tpp', TPP_URL);
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
                    <div id="loader" class="overlay" style="display: none;">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Filter</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <form class="form-horizontal" id="FormFilterPerhitunganTPP" method="post" action="" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama_jabatan" class="col-sm-2 control-label">Periode</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="periode" name="periode" placeholder="Periode" data-date-format="yyyy-mm" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tugas_tambahan" class="col-sm-2 control-label">OPD</label>
                                <div class="col-sm-10">
<?php
echo component_select_option($koneksi, 'opd', 'id', 'nama', 'opd', 'OPD', '');
?>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <TombolFilterPerhitunganTPP type="button" class="btn btn-sm btn-primary" id="TombolFilterPerhitunganTPP" name="TombolFilterPerhitunganTPP">Proses</TombolFilterPerhitunganTPP>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="box box-blue" id="content_data" style="display: none;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Data</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="daftar_data_1" class="table table-bordered">
                            <thead>
                                <tr class="bg-custom">
                                    <th>ID</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>TPP Penuh</th>
                                    <th>Capaian SKP</th>
                                    <th>Penyampaian SKP</th>
                                    <th>Masuk Tepat Waktu</th>
                                    <th>Pulang Tepat Waktu</th>
                                    <th>Kehadiran</th>
                                    <th>Hukumana Disiplin</th>
                                    <th>TPP Dibayarkan</th>
                                </tr>
                            </thead>
                        </table>
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
            var TPP_URL = "' . TPP_URL . '";
            var RESOURCES_URL = "' . RESOURCES_URL . '";
        </script>
     ';
template_footer(TPP_TITLE);
?>
	</div>
	<?php
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/tpp/perhitungan-tpp/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>