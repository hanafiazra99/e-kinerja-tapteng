<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-opd.php";

cek_session();
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], SIMPEG_URL . 'opd/');
check_page_request($_GET['key2'], SIMPEG_URL . 'opd/');
$data = req_get_where($koneksi, 'opd_struktur_organisasi', 'id = "' . $_GET['key2'] . '"');
$data_opd = req_get_where($koneksi, 'opd', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'opd/');
$breadcrumb = array($data_opd['nama'], 'Struktur Organisasi', $data['nama_jabatan'], 'Sunting');
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
                        <h3 class="box-title">Sunting Data</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <form class="form-horizontal" id="FormSuntingStrukturOrganisasi" method="post" action="<?php echo SIMPEG_URL;?>controllers/c-opd.php" enctype="multipart/form-data">
                    <div class="box-body">
                            <div class="form-group">
                                <label for="nama_jabatan" class="col-sm-2 control-label">Nama Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data['id'];?>" readonly />
                                    <input type="hidden" class="form-control" id="opd" name="opd" value="<?php echo $data['opd'];?>" readonly />
                                    <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Nama Jabatan" value="<?php echo $data['nama_jabatan'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kelas_jabatan" class="col-sm-2 control-label">Kelas Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kelas_jabatan" name="kelas_jabatan" placeholder="Kelas Jabatan" value="<?php echo $data['kelas_jabatan'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Atasan</label>
                                <div class="col-sm-10">
                                    <?php
                                        echo component_select_option_where($koneksi, 'opd_struktur_organisasi', 'id', 'nama_jabatan', 'atasan', 'Atasan', $data['atasan'], 'opd = "'.$data_opd['id'].'"');
                                    ?>
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolSuntingStrukturOrganisasi" name="TombolSuntingStrukturOrganisasi">Simpan</button>
                                    <a href="<?php echo SIMPEG_URL.'opd/'.$data['opd'].'/';?>" class="btn btn-sm btn-default" >Batal</a>
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
                var BASE_URL = "'.BASE_URL.'";
                var SIMPEG_URL = "'.SIMPEG_URL.'";
                var RESOURCES_URL = "'.RESOURCES_URL.'";
            </script>
         ';
    template_js();
    echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/opd/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
    ?>
</body>

</html>