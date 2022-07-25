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
check_page_request($_GET['key1'], SKP_URL . 'opd/');
$data = req_get_where($koneksi, 'opd', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SKP_URL . 'opd/');
$breadcrumb = array($data['nama']);
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
                        <h3 class="box-title">Detail OPD</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <th style="width:20%">Nama</th>
                                <td><?php echo $data['nama'];?></td>
                            </tr>
                            <tr>
                                <th>No. Telepon</th>
                                <td><?php echo $data['tlp'];?></td>
                            </tr>
                            <tr>
                                <th>E-Mail</th>
                                <td><?php echo $data['email'] ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?php echo $data['alamat'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="box box-blue collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Tupoksi</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none;">
                        <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">
                            <thead>
                                <tr class="bg-custom">
                                    <th>Tupoksi</th>
                                    <th>Nama Jabatan</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
                var user_opd="' . $user_data['opd'] . '";
                var opd="' . $data['id'] . '";
                var BASE_URL = "'.BASE_URL.'";
                var SKP_URL = "'.SKP_URL.'";
                var RESOURCES_URL = "'.RESOURCES_URL.'";
            </script>
         ';
    template_js();
    echo '
            <script src="' . RESOURCES_URL . 'js-for/skp/opd/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>
         ';
    ?>
</body>

</html>