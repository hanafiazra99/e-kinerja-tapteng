<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-sasaran.php";

cek_session();
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], SKP_URL . 'sasaran/');
check_page_request($_GET['key2'], SKP_URL . 'sasaran/');
check_page_request($_GET['key3'], SKP_URL . 'sasaran/');
$data = req_get_where($koneksi, 'skp_sasaran_bulanan_kegiatan', 'id = "' . $_GET['key3'] . '"');
$v_data = req_get_where($koneksi, 'v_skp_sasaran_bulanan_kegiatan', 'id = "' . $_GET['key3'] . '"');
$data_sasaran_bulanan = req_get_where($koneksi, 'v_skp_sasaran_bulanan', 'id = "' . $_GET['key2'] . '"');
$data_sasaran = req_get_where($koneksi, 'v_skp_sasaran', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SKP_URL . 'sasaran/');
$breadcrumb = array(content_tgl_indo($data_sasaran['p_awal']) . ' - ' . content_tgl_indo($data_sasaran['p_akhir']), 'Bulanan', content_bulan_indo($data_sasaran_bulanan['bulan']) . ' ' . $data_sasaran_bulanan['tahun'], 'Kegiatan', $v_data['kegiatan'], 'Sunting');
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
template_header($user_data, $koneksi, SKP_TITLE);
template_navigasi(page_title(), $koneksi, 'skp', SKP_URL);
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
                    <form class="form-horizontal" id="FormSuntingSasaranBulananKegiatan" method="post" action="<?php echo SKP_URL; ?>controllers/c-sasaran.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Nama Kegiatan</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="sasaran" name="sasaran" placeholder="" value="<?php echo $data_sasaran['id'] ?>" readonly />
                                    <input type="hidden" class="form-control" id="sasaran_bulanan" name="sasaran_bulanan" placeholder="" value="<?php echo $data_sasaran_bulanan['id'] ?>" readonly />
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id'] ?>" readonly />
<?php
echo component_select_option_where($koneksi, 'v_skp_sasaran_kegiatan', 'id', 'kegiatan', 'kegiatan', 'Kegiatan', $data['kegiatan'], 'sasaran = "' . $data_sasaran['id'] . '"');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kuantitas" class="col-sm-2 control-label">Kuantitas</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kuantitas" id="kuantitas" placeholder="Kuantitas" value="<?php echo $data['kuantitas'] ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kualitas" class="col-sm-2 control-label">Kualitas</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kualitas" id="kualitas" placeholder="Kualitas" value="<?php echo $data['kualitas'] ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="biaya" class="col-sm-2 control-label">Biaya</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="biaya" id="biaya" placeholder="Biaya" value="<?php echo $data['biaya'] ?>" />
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolSuntingSasaranBulananKegiatan" name="TombolSuntingSasaranBulananKegiatan">Simpan</button>
                                    <a href="<?php echo SKP_URL . 'sasaran/' . $data_sasaran['id'] . '/bulanan/' . $data_sasaran_bulanan['id'] . '/'; ?>" class="btn btn-sm btn-default" >Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
			</section>
		</div>
		<?php
template_footer(SKP_TITLE);
?>
	</div>
<?php
echo '
        <script>
            var role="' . $_SESSION['role'] . '";
            var BASE_URL = "' . BASE_URL . '";
            var SKP_URL = "' . SKP_URL . '";
            var RESOURCES_URL = "' . RESOURCES_URL . '";
        </script>
     ';
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/skp/sasaran/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>