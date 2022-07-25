<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-akun.php";

cek_session();
$user_data = user_data($koneksi);
$breadcrumb = array('User', 'Tambah');
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
            <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Data</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <form class="form-horizontal" id="FormTambahUser" method="post" action="<?php echo BASE_URL; ?>ekinerja/controllers/c-akun.php">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Level Akses</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" name="id" id="id" value="" />
                                    <?php
echo component_select_option_where($koneksi, 'app_role', 'id', 'label', 'role', 'Level Akses', '', 'id != "1000"');
?>
                                </div>
                            </div>
                            <div class="form-group" id="content_for_opd_rs" style="display: none;">
                                <label for="nama" class="col-sm-2 control-label">OPD</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option_where($koneksi, 'opd', 'id', 'nama', 'opd', 'OPD','', ' id="S20181113140442KP7891D" or id="S20181129051707KP7248D" ');
?>
                                </div>
                            </div>
                            <div class="form-group" id="content_for_unit_organisasi_rs" style="display: none;">
                                <label for="nama" class="col-sm-2 control-label">Unit Organisasi</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option_where($koneksi, 'opd_unit_organisasi', 'id', 'nama', 'unit_organisasi', 'Unit Organisasi','', ' opd="S20181113140442KP7891D" or opd="S20181129051707KP7248D"');
?>
                                </div>
                            </div>
                            <div class="form-group" id="content_for_opd" style="display: none;">
                                <label for="nama" class="col-sm-2 control-label">OPD</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'opd', 'id', 'nama', 'opd', 'OPD', '');
?>
                                </div>
                            </div>
                            <div class="form-group" id="content_for_unit_organisasi" style="display: none;">
                                <label for="nama" class="col-sm-2 control-label">Unit Organisasi</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'opd_unit_organisasi', 'id', 'nama', 'unit_organisasi', 'Unit Organisasi', '');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tlp" class="col-sm-2 control-label">No. Handphone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tlp" id="tlp" placeholder="No. Handphone" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">E-Mail</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="E-Mail" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" />
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolTambahUser" name="TombolTambahUser">Simpan</button>
                                    <a href="../../" class="btn btn-sm btn-default">Batal</a>
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
	echo '
			<script>
				var SIMPEG_URL = "' . SIMPEG_URL . '";
			</script>
		 ';
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/ekinerja/akun/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>