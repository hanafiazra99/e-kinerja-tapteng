<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-data-kepegawaian.php";

cek_session();
$user_data = user_data($koneksi);
$data_pengangkatan_cpns = req_get_where($koneksi, 'v_pegawai_pengangkatan_cpns', 'id = "' . $_SESSION['id'] . '"');
$data_pengangkatan_pns = req_get_where($koneksi, 'v_pegawai_pengangkatan_pns', 'id = "' . $_SESSION['id'] . '"');
$data_jabatan = req_get_where($koneksi, 'v_pegawai_jabatan', 'id = "' . $_SESSION['id'] . '"');
$data_pgr = req_get_where($koneksi, 'v_pegawai_pgr', 'id = "' . $_SESSION['id'] . '"');
$data_kgb = req_get_where($koneksi, 'v_pegawai_kgb', 'id = "' . $_SESSION['id'] . '"');
$breadcrumb = array();
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
                        <h3 class="box-title">Data Kepegawaian</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#ct_pengangkatan_cpns" data-toggle="tab">Pengangkatan CPNS</a></li>
                            <li><a href="#ct_pengangkatan_pns" data-toggle="tab">Pengangkatan PNS</a></li>
                            <li><a href="#ct_jabatan" data-toggle="tab">Jabatan</a></li>
                            <li><a href="#ct_pgr" data-toggle="tab">Pangkat Golongan Ruang</a></li>
                            <li><a href="#ct_kgb" data-toggle="tab">Kenaikan Gaji Berkala</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="ct_pengangkatan_cpns">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Nota Persetujuan BKN</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_pengangkatan_cpns['no_nota_bkn']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_pengangkatan_cpns['tgl_nota_bkn']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pejabat Yang Menetapkan</th>
                                            <td><?php echo $data_pengangkatan_cpns['pym']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>SK</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_pengangkatan_cpns['no_sk']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_pengangkatan_cpns['tgl_sk']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen SK</th>
                                            <td>
                                                <?php echo ($data_pengangkatan_cpns['file_sk'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$_SESSION['id'].'/'.$data_pengangkatan_cpns['file_sk'].'" class="btn btn-primary btn-sm">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Masa Kerja</th>
                                            <td><?php echo content_masa_kerja($data_pengangkatan_cpns['masa_kerja'])['tahun'] . ' Tahun ' . content_masa_kerja($data_pengangkatan_cpns['masa_kerja'])['bulan'] . ' Bulan'; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pangkat/Golongan/Ruang</th>
                                            <td><?php echo $data_pengangkatan_cpns['pgr']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>TMT CPNS</th>
                                            <td><?php echo content_tgl_indo($data_pengangkatan_cpns['tmt']); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_pengangkatan_pns">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Pejabat Yang Menetapkan</th>
                                            <td><?php echo $data_pengangkatan_pns['pym']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>SK</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_pengangkatan_pns['no_sk']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_pengangkatan_pns['tgl_sk']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen SK</th>
                                            <td>
                                                <?php echo ($data_pengangkatan_pns['file_sk'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$_SESSION['id'].'/'.$data_pengangkatan_pns['file_sk'].'" class="btn btn-primary btn-sm">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pangkat/Golongan Ruang</th>
                                            <td><?php echo $data_pengangkatan_pns['pgr']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>TMT PNS</th>
                                            <td><?php echo content_tgl_indo($data_pengangkatan_pns['tmt']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Sumpah/Janji PNS</th>
                                            <td><?php echo $data_pengangkatan_pns['sumpah']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_jabatan">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Pejabat Yang Menetapkan</th>
                                            <td><?php echo $data_jabatan['pym']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>SK Jabatan</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_jabatan['no_sk_jabatan']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_jabatan['tgl_sk_jabatan']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen SK Jabatan</th>
                                            <td>
                                                <?php echo ($data_jabatan['file_sk_jabatan'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$_SESSION['id'].'/'.$data_jabatan['file_sk_jabatan'].'" class="btn btn-primary btn-sm">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Jabatan</th>
                                            <td><?php echo $data_jabatan['jenis_jabatan']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Eselon</th>
                                            <td><?php echo $data_jabatan['eselon']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Jabatan</th>
                                            <td><?php echo $data_jabatan['nama_jabatan']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>TMT Jabatan</th>
                                            <td><?php echo content_tgl_indo($data_jabatan['tmt']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>SK Pelantikan</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_jabatan['no_sk_pelantikan']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_jabatan['tgl_sk_pelantikan']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen SK Pelantikan</th>
                                            <td>
                                                <?php echo ($data_jabatan['file_sk_pelantikan'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$_SESSION['id'].'/'.$data_jabatan['file_sk_pelantikan'].'" class="btn btn-primary btn-sm">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Sumpah Jabatan</th>
                                            <td><?php echo $data_jabatan['sumpah']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_pgr">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Pejabat Yang Menetapkan</th>
                                            <td><?php echo $data_pgr['pym']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>SK</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_pgr['no_sk']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_pgr['tgl_sk']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen SK</th>
                                            <td>
                                                <?php echo ($data_pgr['file_sk'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$_SESSION['id'].'/'.$data_pgr['file_sk'].'" class="btn btn-primary btn-sm">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pangkat/Golongan/Ruang</th>
                                            <td><?php echo $data_pgr['pgr']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>TMT</th>
                                            <td><?php echo content_tgl_indo($data_pgr['tmt']); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_kgb">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Pejabat Yang Menetapkan</th>
                                            <td><?php echo $data_kgb['pym']; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="width:25%">SK</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_kgb['no_sk']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_kgb['tgl_sk']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen SK</th>
                                            <td>
                                                <?php echo ($data_kgb['file_sk'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$_SESSION['id'].'/'.$data_kgb['file_sk'].'" class="btn btn-primary btn-sm">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>TMT</th>
                                            <td><?php echo content_tgl_indo($data_kgb['tmt']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Masa Kerja</th>
                                            <td><?php echo content_masa_kerja($data_kgb['masa_kerja'])['tahun'] . ' Tahun ' . content_masa_kerja($data_kgb['masa_kerja'])['bulan'] . ' Bulan'; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kantor Pembayaran Gaji</th>
                                            <td><?php echo $data_kgb['kantor_pembayaran']; ?></td>
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
		var user_opd="' . $user_data['opd_id'] . '";
		var BASE_URL = "' . BASE_URL . '";
		var SIMPEG_URL = "' . SIMPEG_URL . '";
		var RESOURCES_URL = "' . RESOURCES_URL . '";
	</script>
 ';
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/data-kepegawaian/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>