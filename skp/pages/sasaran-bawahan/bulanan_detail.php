<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-sasaran-bawahan.php";

cek_session();
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], SKP_URL . 'sasaran-bawahan/');
check_page_request($_GET['key2'], SKP_URL . 'sasaran-bawahan/');
check_status($koneksi, 'skp_sasaran_bulanan', $_GET['key2']);
$data = req_get_where($koneksi, 'v_skp_sasaran_bulanan', 'id = "' . $_GET['key2'] . '"');
$data_sasaran = req_get_where($koneksi, 'v_skp_sasaran', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SKP_URL . 'sasaran-bawahan/');
$breadcrumb = array(content_tgl_indo($data_sasaran['p_awal']) . ' - ' . content_tgl_indo($data_sasaran['p_akhir']), 'Bulanan', content_bulan_indo($data['bulan']) . ' ' . $data['tahun']);
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
                        <h3 class="box-title">Detail Uraian Bulanan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:15%">Periode SKP</th>
                                <td><?php echo content_tgl_indo($data_sasaran['p_awal']) . ' - ' . content_tgl_indo($data_sasaran['p_akhir']); ?></td>
                            </tr>
                            <tr>
                                <th>Periode Bulan</th>
                                <td><?php echo content_bulan_indo($data['bulan']) . ' ' . $data['tahun']; ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><?php echo $data['status']; ?></td>
                            </tr>
                            <tr <?php echo ($data['status'] == 'Dibuat' ? 'style="display: none;"' : ''); ?>>
                                <th>Tanggal Diserahkan</th>
                                <td><?php echo content_tgl_indo(explode(' ', $data['ts'])[0]); ?></td>
                            </tr>
                            <tr <?php echo ((($data['status'] == 'Diperiksa') or ($data['status'] == 'Disetujui') or ($data['status'] == 'Ditolak') or ($data['status'] == 'Selesai')) ? '' : 'style="display: none;"'); ?>>
                                <th>Tanggal Terima</th>
                                <td><?php echo content_tgl_indo(explode(' ', $data['tr'])[0]); ?></td>
                            </tr>
                            <tr <?php echo ($data['status'] == 'Ditolak' ? '' : 'style="display: none;"'); ?>>
                                <th>Alasan</th>
                                <td><?php echo $data['alasan']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Kegiatan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">
                            <thead>
                                <tr class="bg-custom">
                                    <th>Nama Kegiatan</th>
                                    <th>Kuantitas</th>
                                    <th>Kualitas</th>
                                    <th>Biaya</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

<?php
if ($data['status'] == 'Diperiksa') {
    ?>
                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Verifikasi Sasaran Bulanan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <form class="form-horizontal" id="FormVerifikasiSasaranBulanan" method="post" action="<?php echo SKP_URL; ?>controllers/c-sasaran-bawahan.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="persetujuan_paraf" class="col-sm-2 control-label">Tindakan</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id'] ?>" readonly />
                                    <select class="select2 form-control" name="tindakan" id="tindakan" data-placeholder="Tindakan">
                                        <option></option>
                                        <option value="Diterima">Diterima</option>
                                        <option value="Ditolak">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group container_alasan" style="display: none;">
                                <label for="alasan" class="col-sm-2 control-label">Alasan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alasan" name="alasan"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <input type="checkbox" name="check_form" id="check_form" value="y" class="flat-red" /> <i>Saya sudah mengisi data semua data dengan benar</i>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolVerifikasiSasaranBulanan" name="TombolVerifikasiSasaranBulanan">Simpan</button>
                                    <a href="../" class="btn btn-sm btn-default">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

<?php
}
?>
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
            var pegawai = "' . $_SESSION['id'] . '";
            var sasaran = "' . $data_sasaran['id'] . '";
            var sasaran_bulanan = "' . $data['id'] . '";
            var bulanan = "' . $data['id'] . '";
            var BASE_URL = "' . BASE_URL . '";
            var SKP_URL = "' . SKP_URL . '";
            var RESOURCES_URL = "' . RESOURCES_URL . '";
        </script>
     ';
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/skp/sasaran-bawahan/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>