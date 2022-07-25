<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-izin.php";

cek_session();
$user_data = user_data($koneksi);
$breadcrumb = array('Izin', 'Tambah');
$check = ($_SESSION['role'] == '10' ? '' : 'test');
check_page_request($check, ABSENSI_URL . 'izin');
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
                        <h3 class="box-title">Tambah Data</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <form class="form-horizontal" id="FormTambahIzin" method="post" action="<?php echo ABSENSI_URL; ?>controllers/c-izin.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="skpd" class="col-sm-2 control-label">OPD</label>
                                <div class="col-sm-10">
                                    <?php
                                    echo component_select_option($koneksi, 'opd', 'id', 'nama', 'opd', 'OPD', '');
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="skpd" class="col-sm-2 control-label">Pegawai</label>
                                <div class="col-sm-10">
                                    <?php
                                    echo component_select_option_where($koneksi, 'pegawai', 'id', 'nama', 'pegawai', 'Pegawai', '', "opd = ''");
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Jenis Izin</label>
                                <div class="col-sm-10">
                                    <select name="jenis_izin" id="jenis_izin" class="select2 form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Masa Izin</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" data-date-format='yyyy-mm-dd' name="masa_izin" id="reservation">
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label for="npwp" class="col-sm-2 control-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="" />
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolTambahIzin" name="TombolTambahIzin">Simpan</button>
                                    <a href="../../" class="btn btn-sm btn-default">Batal</a>
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
    echo '
            <script>
                var role="' . $_SESSION['role'] . '";
                var user_opd="' . $user_data['opd'] . '";
                var BASE_URL = "' . BASE_URL . '";
                var SIMPEG_URL = "' . SIMPEG_URL . '";
                var ABSENSI_URL = "' . ABSENSI_URL . '";
                var RESOURCES_URL = "' . RESOURCES_URL . '";
            </script>
         ';
    template_js();
    echo '<script src="' . RESOURCES_URL . 'js-for/absensi/data-izin/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
    ?>
</body>

</html>