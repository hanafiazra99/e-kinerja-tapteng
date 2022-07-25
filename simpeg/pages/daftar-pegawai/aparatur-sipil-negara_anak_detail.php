<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-daftar-pegawai.php";

cek_session();
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/');
check_page_request($_GET['key2'], SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/');
$data = req_get_where($koneksi, 'v_pegawai_anak ', 'id = "' . $_GET['key2'] . '"');
$data_pegawai = req_get_where($koneksi, 'pegawai', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/');
$breadcrumb = array('Aparatur Sipil Negara', $data_pegawai['nama'], 'Anak', $data['nama']);
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
                        <h3 class="box-title">Detail Data</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:25%">Nama</th>
                                    <td><?php echo $data['nama'];?></td>
                                </tr>
                                <tr>
                                    <th>Tempat Tanggal Lahir</th>
                                    <td>
                                        <?php echo $data['tempat_lahir'];?>,
                                        <?php echo content_tgl_indo($data['tgl_lahir']);?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td><?php echo $data['jenis_kelamin'] ?></td>
                                </tr>
                                <tr>
                                    <th>Status Anak</th>
                                    <td><?php echo $data['status_anak'] ?></td>
                                </tr>
                                <tr>
                                    <th>Tunjangan</th>
                                    <td><?php echo $data['tunjangan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Pendidikan Terakhir</th>
                                    <td><?php echo $data['pendidikan_terakhir'];?></td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan</th>
                                    <td><?php echo $data['pekerjaan'];?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="sunting/" class="btn btn-sm btn-success">Sunting</a>
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
                var user_opd="' . $user_data['opd'] . '";
                var BASE_URL = "'.BASE_URL.'";
                var SIMPEG_URL = "'.SIMPEG_URL.'";
                var RESOURCES_URL = "'.RESOURCES_URL.'";
            </script>
         ';
    template_js();
    echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/daftar-pegawai/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
    ?>
</body>

</html>