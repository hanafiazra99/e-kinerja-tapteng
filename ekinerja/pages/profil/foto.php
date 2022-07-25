<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-profil.php";

cek_session();
$user_data = user_data($koneksi);
$user_data = user_data($koneksi);
check_page_request($_SESSION['id'], BASE_URL . 'akun/pegawai/');
$data_akun = req_get_where($koneksi, 'app_login', 'id = "' . $_SESSION['id'] . '"');
check_page_request($_SESSION['id'], BASE_URL . 'akun/pegawai/');
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

<style>
	.tooltip{
		width: 350px;
	}
</style>
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
                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sunting Data</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <form class="form-horizontal" id="FormSuntingFoto" method="post" action="<?php echo BASE_URL; ?>ekinerja/controllers/c-profil.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="icon" class="col-sm-2 control-label">Foto<sup><i class="fa fa-info-circle" data-toggle="tooltip" title="Silahkan Pilih File Dengan Rasio Ukuran 1:1. Contoh 250px x 250px."></i></sup></label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_SESSION['id'];?>" />
									<input type="file" class="form-control" id="foto" name="foto" />
                                    <input type="hidden" class="form-control" id="foto_lama" name="foto_lama" value="<?php echo $_SESSION['foto']; ?>" />
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolSuntingFoto" name="TombolSuntingFoto">Simpan</button>
                                    <a href="../" class="btn btn-sm btn-default">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <?php
template_footer(BASE_TITLE);
?>
    </div>
    <?php
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/ekinerja/profil/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>