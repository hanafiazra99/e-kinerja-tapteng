<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-layanan-kepegawaian.php";

cek_session();
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], SIMPEG_URL . 'layanan-kepegawaian/perencanaan-pemberhentian/pensiun/');
$data = req_get_where($koneksi, 'cv_simpeg_lp_pensiun', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'layanan-kepegawaian/perencanaan-pemberhentian/pensiun/');
$breadcrumb = array('Perencanaan dan Pemberhentian', 'Pensiun', $data['no_sk']);
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
                <div class="row">
                    <div class="col-sm-8">
                        <div class="box box-blue">
                            <div class="box-header with-border">
                                <h3 class="box-title">Detail Data</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:25%">Pangkat/Golongan/Ruang Baru</th>
                                        <td><?php echo $data['pgr_baru']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pangkat/Golongan/Ruang Sebelumnya</th>
                                        <td><?php echo $data['pgr_lama']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>SK</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Pejabat yang Menetapkan</th>
                                        <td><?php echo $data['pym']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. SK</th>
                                        <td><?php echo $data['no_sk']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tgl. SK</th>
                                        <td><?php echo content_tgl_indo($data['tgl_sk']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>TMT</th>
                                        <td><?php echo content_tgl_indo($data['tmt']); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="box-footer">
                                <TombolHapus judul="Hapus Pensiun" formreq="HapusPensiun" pertanyaan="Anda yakin ingin menghapus data pensiun ini?<br>Menghapus data ini akan mengembalikan kedudukan aktif kepada pegawai." parameter="id" value="<?php echo $data['id'] ?>" class="btn btn-sm btn-danger">Hapus</TombolHapus>
                                <a href="../" class="btn btn-sm btn-default">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box box-blue">
                            <div class="box-header with-border">
                                <h3 class="box-title">Data Pegawai</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:30%">NIP</th>
                                            <td><?php echo $data['pegawai_nip']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td><?php echo $data['pegawai_nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>OPD Asal</th>
                                            <td><?php echo $data['opd_asal_nama']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="box box-blue">
                            <div class="box-header with-border">
                                <h3 class="box-title">Catatan Data</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:35%">Waktu Transaksi</th>
                                            <td><?php echo content_tgl_indo(explode(' ', $data['tt'])[0]) . ', ' . explode(' ', $data['tt'])[1]; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                var BASE_URL = "' . BASE_URL . '";
                var SIMPEG_URL = "' . SIMPEG_URL . '";
                var RESOURCES_URL = "' . RESOURCES_URL . '";
            </script>
         ';
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/layanan-kepegawaian/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>