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
check_page_request($_GET['key1'], SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/');
$data = req_get_where($koneksi, 'v_pegawai', 'id = "' . $_GET['key1'] . '"');
$data_honorer = req_get_where($koneksi, 'v_pegawai_honorer', 'id = "' . $_GET['key1'] . '"');
$data_alamat = req_get_where($koneksi, 'v_pegawai_alamat', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/');
$breadcrumb = array('Pegawai Honorer', $data['nama']);
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
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Nama</th>
                                            <td><?php echo $data['nama']; ?></td>
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
                                            <th>Unit Organisasi</th>
                                            <td><?php echo $data['unit_organisasi_nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status Kepegawaian</th>
                                            <td><?php echo $data['status_kepegawaian']; ?></td>
                                        </tr>
                                        <tr>
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
                                            <th>TMT</th>
                                            <td><?php echo content_tgl_indo($data_honorer['tmt']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pendidikan Terakhir</th>
                                            <td><?php echo $data_honorer['pendidikan_terakhir']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jabatan</th>
                                            <td><?php echo $data_honorer['nama_jabatan']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Golongan Darah</th>
                                            <td><?php echo $data['golongan_darah']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>NPWP</th>
                                            <td><?php echo $data['npwp']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-2 text-right">
                                <img style="width: 100%;" src="<?php echo RESOURCES_URL . 'img/pegawai/' . $data['foto']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="sunting/" class="btn btn-sm btn-success">Sunting</a>
                    </div>
                </div>
				
				<div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Riwayat Kerja</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">
							<thead>
								<tr class="bg-custom">
									<th>Tahun</th>
									<th>OPD</th>
									<th>Jabatan</th>
									<th>No. SK</th>
									<th></th>
								</tr>
							</thead>
						</table>
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
                var pegawai="' . $data['id'] . '";
                var BASE_URL = "' . BASE_URL . '";
                var SIMPEG_URL = "' . SIMPEG_URL . '";
                var RESOURCES_URL = "' . RESOURCES_URL . '";
            </script>
         ';
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/daftar-pegawai/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>