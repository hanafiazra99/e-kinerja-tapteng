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
$data = req_get_where($koneksi, 'v_pegawai_riwayat_kgb ', 'id = "' . $_GET['key2'] . '"');
$data_pegawai = req_get_where($koneksi, 'pegawai', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/');
$breadcrumb = array('Aparatur Sipil Negara', $data_pegawai['nama'], 'Riwayat Kenaikan Gaji Berkala', $data['no_sk']);
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
                                    <th style="width:25%">Pejabat Yang Menetapkan</th>
                                    <td><?php echo $data['pym'];?></td>
                                </tr>
                                <tr>
                                    <th>SK</th>
                                    <td>
                                        <i>Nomor:</i> <?php echo $data['no_sk'];?><br>
                                        <i>Tanggal:</i> <?php echo content_tgl_indo($data['tgl_sk']);?><br>
										<i>Dokumen:</i> <?php echo ($data['file_sk'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$data_pegawai['id'].'/'.$data['file_sk'].'" class="btn btn-primary btn-xs">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>TMT</th>
                                    <td><?php echo content_tgl_indo($data['tmt']);?></td>
                                </tr>
                                <tr>
                                    <th>Masa Kerja</th>
                                    <td><?php echo content_masa_kerja($data['masa_kerja'])['tahun'].' Tahun '.content_masa_kerja($data['masa_kerja'])['bulan'].' Bulan';?></td>
                                </tr>
                                <tr>
                                    <th>Kantor Pembayaran</th>
                                    <td><?php echo $data['kantor_pembayaran'];?></td>
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