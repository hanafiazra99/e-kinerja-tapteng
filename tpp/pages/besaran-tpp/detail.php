<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-besaran-tpp.php";

cek_session();
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], TPP_URL . 'besaran-tpp/');
$data = req_get_where($koneksi, 'opd_struktur_organisasi', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], TPP_URL . 'besaran-tpp/');
$breadcrumb = array($data['nama_jabatan']);
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
                    <div class="box-header with-border">
                        <h3 class="box-title">Detail OPD</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <th style="width:20%">Nama Jabatan</th>
                                <td><?php echo $data['nama_jabatan']; ?></td>
                            </tr>
                            <tr>
                                <th>Besaran TPP</th>
                                <td><?php echo 'Rp. ' . number_format($data['besaran_tpp'], 2, ',', '.'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Tugas Tambahan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">
                            <thead>
                                <tr class="bg-custom">
                                    <th>Nama Tugas Tambahan</th>
                                    <th></th>
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
            var nama_jabatan="' . $data['id'] . '";
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
echo '<script src="' . RESOURCES_URL . 'js-for/tpp/besaran-tpp/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>