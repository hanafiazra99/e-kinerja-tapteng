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
check_page_request($_GET['key1'], SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-keluar-antar-daerah/');
$data = req_get_where($koneksi, 'v_simpeg_lp_mutasi_keluar_daerah', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-keluar-antar-daerah/');
$breadcrumb = array('PKMJ', 'Mutasi Keluar Antar Daerah', $data['no_sk']);
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
                        <table class="table">
                            <tr>
                                <th style="width:20%">NIP</th>
                                <td><?php echo $data['pegawai_nip']; ?></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td><?php echo $data['pegawai_nama']; ?></td>
                            </tr>
                            <tr>
                                <th>OPD Asal</th>
                                <td><?php echo $data['opd_asal_nama'] ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Instansi Asal</th>
                                <td><?php echo $data['jenis_instansi'] ?></td>
                            </tr>
                            <tr>
                                <th>Instansi Asal</th>
                                <td><?php echo $data['instansi'] ?></td>
                            </tr>
                            <tr>
                                <th>Pejabat Yang Menetapkan</th>
                                <td><?php echo $data['pym'] ?></td>
                            </tr>
                            <tr>
                                <th>SK</th>
                                <td>
                                    <i>Nomor:</i> <?php echo $data['no_sk']; ?><br>
                                    <i>Tanggal:</i> <?php echo content_tgl_indo($data['tgl_sk']); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Dokumen SK</th>
                                <td>
                                    <?php echo ($data['file_sk'] != '' ? 'Ada' : 'Tidak Ada'); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>TMT</th>
                                <td>
                                    <?php echo content_tgl_indo($data['tmt']); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Waktu Transaksi</th>
                                <td>
                                    <?php echo content_tgl_indo(explode(' ', $data['tt'])[0]) . '<br><i>' . explode(' ', $data['tt'])[1] . '</i>'; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="box-footer">
                        <a href="sunting/" class="btn btn-sm btn-success">Sunting</a>
                        <TombolHapus judul="Hapus Mutasi Keluar Antar Daerah" formreq="HapusMutasiKeluarDaerah" pertanyaan="Anda yakin ingin menghapus data mutasi ini?<br>Menghapus data akan mengembalikan data pegawai." parameter="id" value="<?php echo $data['id'] ?>" class="btn btn-sm btn-danger">Hapus</TombolHapus>
                        <a href="../" class="btn btn-sm btn-default">Kembali</a>
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