<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-profil-opd.php";

cek_session();
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], SIMPEG_URL . 'opd/');
$data = req_get_where($koneksi, 'opd_unit_organisasi', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'opd/');
$breadcrumb = array('Unit Organisasi', $data['nama'], 'Sunting');
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
                    <form class="form-horizontal" id="FormSuntingUnitOrganisasi" method="post" action="<?php echo SIMPEG_URL;?>controllers/c-profil-opd.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="label" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data['id'];?>" readonly />
                                    <input type="hidden" class="form-control" id="opd" name="opd" value="<?php echo $data['opd'];?>" readonly />
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $data['nama']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tlp" class="col-sm-2 control-label">No. Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tlp" name="tlp" placeholder="No. Telepon" value="<?php echo $data['tlp']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">E-Mail</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="E-Mail" value="<?php echo $data['email']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"><?php echo $data['alamat']; ?></textarea>
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolSuntingUnitOrganisasi" name="TombolSuntingUnitOrganisasi">Simpan</button>
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