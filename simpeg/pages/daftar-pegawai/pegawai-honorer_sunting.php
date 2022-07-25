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
$data = req_get_where($koneksi, 'pegawai', 'id = "' . $_GET['key1'] . '"');
$data_honorer = req_get_where($koneksi, 'pegawai_honorer', 'id = "' . $_GET['key1'] . '"');
$data_alamat = req_get_where($koneksi, 'pegawai_alamat', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/');
$breadcrumb = array('Pegawai Honorer', $data['nama'], 'Sunting');
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
                    <form class="form-horizontal" id="FormSuntingHonorer" method="post" action="<?php echo SIMPEG_URL; ?>controllers/c-daftar-pegawai.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id'] ?>" readonly />
                                    <input type="hidden" class="form-control" id="status_kepegawaian" name="status_kepegawaian" placeholder="" value="3" readonly />
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $data['nama'] ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="col-sm-2 control-label">Foto</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="foto" name="foto" />
                                    <input type="hidden" class="form-control" id="foto_lama" name="foto_lama" value="<?php echo $data['foto'] ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gelar" class="col-sm-2 control-label">Gelar</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="gelar_depan" name="gelar_depan" placeholder="Gelar Depan" value="<?php echo $data['gelar_depan'] ?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang" placeholder="Gelar Belakang" value="<?php echo $data['gelar_belakang'] ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Tanggal Lahir</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $data['tempat_lahir'] ?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir" data-date-format="yyyy-mm-dd" value="<?php echo $data['tgl_lahir'] ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_jenis_kelamin', 'id', 'label', 'jenis_kelamin', 'Jenis Kelamin', $data['jenis_kelamin']);
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="agama" class="col-sm-2 control-label">Agama</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_agama', 'id', 'label', 'agama', 'Agama', $data['agama']);
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_hp" class="col-sm-2 control-label">No. Handphone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. Handphone" data-inputmask="'mask': ['9999 9999 999', '9999 9999 9999']" data-mask value="<?php echo $data['no_hp'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="skpd" class="col-sm-2 control-label">OPD</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'opd', 'id', 'nama', 'opd', 'OPD', $data['opd']);
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="skpd" class="col-sm-2 control-label">Unit Organisasi</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option_where($koneksi, 'opd_unit_organisasi', 'id', 'nama', 'unit_organisasi', 'Unit Organisasi', $data['unit_organisasi'], "opd = '" . $data['opd'] . "'");
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status_perkawinan" class="col-sm-2 control-label">Status Perkawinan</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_status_perkawinan', 'id', 'label', 'status_perkawinan', 'Status Perkawinan', $data['status_perkawinan']);
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"><?php echo $data_alamat['alamat'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="provinsi" class="col-sm-2 control-label"></label>
                                <div class="col-sm-5">
                                    <?php
echo component_select_option($koneksi, 'ref_provinsi', 'id', 'nama', 'provinsi', 'Provinsi', $data_alamat['provinsi']);
?>
                                </div>
                                <div class="col-sm-5">
                                    <?php
echo component_select_option_where($koneksi, 'ref_kabkot', 'id', 'nama', 'kabkot', 'Kabupaten/Kota', $data_alamat['kabkot'], "provinsi = '" . $data_alamat['provinsi'] . "'");
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan" class="col-sm-2 control-label"></label>
                                <div class="col-sm-5">
                                    <?php
echo component_select_option_where($koneksi, 'ref_kecamatan', 'id', 'nama', 'kecamatan', 'Kecamatan', $data_alamat['kecamatan'], "kabkot = '" . $data_alamat['kabkot'] . "'");
?>
                                </div>
                                <div class="col-sm-5">
                                    <?php
echo component_select_option_where($koneksi, 'ref_keldes', 'id', 'nama', 'keldes', 'Kelurahan/Desa', $data_alamat['keldes'], "kecamatan = '" . $data_alamat['kecamatan'] . "'");
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="rt" name="rt" placeholder="RT" value="<?php echo $data_alamat['rt'] ?>" />
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="rw" name="rw" placeholder="RW" value="<?php echo $data_alamat['rw'] ?>" />
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Kode Pos" value="<?php echo $data_alamat['kode_pos'] ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="golongan_darah" class="col-sm-2 control-label">Golongan Darah</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_golongan_darah', 'id', 'label', 'golongan_darah', 'Golongan Darah', $data['golongan_darah']);
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tmt" class="col-sm-2 control-label">TMT</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tmt" name="tmt" placeholder="TMT" data-date-format="yyyy-mm-dd" value="<?php echo $data_honorer['tmt'] ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pendidikan_terakhir" class="col-sm-2 control-label">Pendidikan Terakhir</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_tingkat_pendidikan', 'id', 'label', 'pendidikan_terakhir', 'Pendidikan Terakhir', $data_honorer['pendidikan_terakhir']);
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jabatan" class="col-sm-2 control-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option_where($koneksi, 'opd_struktur_organisasi', 'id', 'nama_jabatan', 'jabatan', 'Jabatan', $data_honorer['jabatan'], 'opd = "' . $data['opd'] . '"');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="npwp" class="col-sm-2 control-label">NPWP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP" value="<?php echo $data['npwp'] ?>" />
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolSuntingHonorer" name="TombolSuntingHonorer">Simpan</button>
                                    <a href="../../" class="btn btn-sm btn-default">Batal</a>
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