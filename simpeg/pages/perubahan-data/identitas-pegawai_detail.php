<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-perubahan-data.php";

cek_session();
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], SIMPEG_URL . 'perubahan-data/identitas-pegawai/');
$data = req_get_where($koneksi, 'v_u_pegawai', 'id = "' . $_GET['key1'] . '"');
$data_alamat = req_get_where($koneksi, 'v_u_pegawai_alamat', 'id = "' . $_GET['key1'] . '"');
$data_asn = req_get_where($koneksi, 'v_u_pegawai_asn', 'id = "' . $_GET['key1'] . '"');
$data_honorer = req_get_where($koneksi, 'v_u_pegawai_honorer', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'perubahan-data/identitas-pegawai/');
$breadcrumb = array('Identitas Pegawai', 'Usulan', $data['nama']);
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
                        <h3 class="box-title">Usulan Perubahan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:25%">Nama</th>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td rowspan="21" class="text-right">
                                        <img src="<?php echo RESOURCES_URL . 'img/pegawai/' . ($data['foto'] != '' ? $data['foto'] : 'default.png') . '' ?>" height="175px">
                                    </td>
                                </tr>
                                <tr <?php echo ($data['status_kepegawaian'] == 'Pegawai Honorer' ? 'style="display: none;"' : ''); ?>>
                                    <th>NIP</th>
                                    <td><?php echo $data_asn['nip']; ?></td>
                                </tr>
                                <tr>
                                    <th>Gelar Depan</th>
                                    <td><?php echo $data['gelar_depan']; ?></td>
                                </tr>
                                <tr>
                                    <th>Gelar Belakang</th>
                                    <td><?php echo $data['gelar_belakang']; ?></td>
                                </tr>
                                <tr>
                                    <th>Tampat Tanggal Lahir</th>
                                    <td><?php echo $data['tempat_lahir']; ?>, <?php echo content_tgl_indo($data['tgl_lahir']) ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td><?php echo $data['jenis_kelamin']; ?></td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td><?php echo $data['agama']; ?></td>
                                </tr>
                                <tr>
                                    <th>No. Handphone</th>
                                    <td><?php echo $data['no_hp']; ?></td>
                                </tr>
                                <tr>
                                    <th>OPD</th>
                                    <td><?php echo $data['opd_nama']; ?></td>
                                </tr>
                                <tr>
                                    <th>Status Kepegawaian</th>
                                    <td><?php echo $data['status_kepegawaian']; ?></td>
                                </tr>
                                <tr <?php echo ($data['status_kepegawaian'] == 'Pegawai Honorer' ? 'style="display: none;"' : ''); ?>>
                                    <th>Jenis Kepegawaian</th>
                                    <td><?php echo $data_asn['jenis_kepegawaian']; ?></td>
                                </tr>
                                <tr <?php echo ($data['status_kepegawaian'] == 'Pegawai Honorer' ? 'style="display: none;"' : ''); ?>>
                                    <th>Kedudukan Pegawai</th>
                                    <td><?php echo $data['kedudukan_pegawai']; ?></td>
                                </tr>
                                <tr>
                                    <th>Status Perkawinan</th>
                                    <td><?php echo $data['status_perkawinan']; ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>
                                        <?php echo $data_alamat['alamat']; ?><br>
                                        <?php echo ($data_alamat['rt'] != '' ? 'RT ' . ucwords(strtolower($data_alamat['rt'])) . '' : ''); ?>
                                        <?php echo ($data_alamat['rw'] != '' ? 'RW ' . ucwords(strtolower($data_alamat['rw'])) . '' : ''); ?><br>
                                        <?php echo ($data_alamat['keldes'] != '' ? 'Kelurahan ' . ucwords(strtolower($data_alamat['keldes'])) . '' : ''); ?><br>
                                        <?php echo ($data_alamat['kecamatan'] != '' ? 'Kecamatan ' . ucwords(strtolower($data_alamat['kecamatan'])) . '' : ''); ?><br>
                                        <?php echo ($data_alamat['kabkot'] != '' ? '' . ucwords(strtolower($data_alamat['kabkot'])) . '<br>' : ''); ?>
                                        <?php echo ($data_alamat['provinsi'] != '' ? '' . ucwords(strtolower($data_alamat['provinsi'])) . '<br>' : ''); ?>
                                        <?php echo ($data_alamat['kode_pos'] != '' ? '' . ucwords(strtolower($data_alamat['kode_pos'])) . '' : ''); ?><br>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Golongan Darah</th>
                                    <td><?php echo $data['golongan_darah']; ?></td>
                                </tr>
                                <tr <?php echo ($data['status_kepegawaian'] == 'Pegawai Honorer' ? 'style="display: none;"' : ''); ?>>
                                    <th>No. KARPEG</th>
                                    <td><?php echo $data_asn['no_karpeg']; ?></td>
                                </tr>
                                <tr <?php echo ($data['status_kepegawaian'] == 'Pegawai Honorer' ? 'style="display: none;"' : ''); ?>>
                                    <th>No. Kartu ASKES</th>
                                    <td><?php echo $data_asn['no_askes']; ?></td>
                                </tr>
                                <tr <?php echo ($data['status_kepegawaian'] == 'Pegawai Honorer' ? 'style="display: none;"' : ''); ?>>
                                    <th>No. Kartu TASPEN</th>
                                    <td><?php echo $data_asn['no_taspen']; ?></td>
                                </tr>
                                <tr <?php echo ($data['status_kepegawaian'] == 'Pegawai Honorer' ? 'style="display: none;"' : ''); ?>>
                                    <th>No. KARIS/KARSU</th>
                                    <td><?php echo $data_asn['no_karissu']; ?></td>
                                </tr>
                                <tr <?php echo ($data['status_kepegawaian'] != 'Pegawai Honorer' ? 'style="display: none;"' : ''); ?>>
                                    <th>TMT</th>
                                    <td><?php echo content_tgl_indo($data_honorer['tmt']); ?></td>
                                </tr>
                                <tr <?php echo ($data['status_kepegawaian'] != 'Pegawai Honorer' ? 'style="display: none;"' : ''); ?>>
                                    <th>TMT</th>
                                    <td><?php echo $data_honorer['pendidikan_terakhir']; ?></td>
                                </tr>
                                <tr <?php echo ($data['status_kepegawaian'] != 'Pegawai Honorer' ? 'style="display: none;"' : ''); ?>>
                                    <th>TMT</th>
                                    <td><?php echo $data_honorer['nama_jabatan']; ?></td>
                                </tr>
                                <tr>
                                    <th>NPWP</th>
                                    <td><?php echo $data['npwp']; ?></td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr>
                                    <th style="width:25%">Status</th>
                                    <td><?php echo $data['status']; ?></td>
                                </tr>
                                <tr>
                                    <th>Waktu Kirim</th>
                                    <td><?php echo content_tgl_indo(explode(' ', $data['ts'])[0]) . ', ' . explode(' ', $data['ts'])[1]; ?></td>
                                </tr>
                                <tr <?php echo ($data['status'] == 'Dikirim' ? 'style="display: none;"' : ''); ?>>
                                    <th>Waktu Terima</th>
                                    <td><?php echo content_tgl_indo(explode(' ', $data['tr'])[0]) . ', ' . explode(' ', $data['tr'])[1]; ?></td>
                                </tr>
                                <tr <?php echo ($data['status'] == 'Ditolak' ? '' : 'style="display: none;"'); ?>>
                                    <th>Alasan</th>
                                    <td><?php echo $data['alasan']; ?></td>
                                </tr>
                            </table>
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
echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/perubahan-data/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>