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
$breadcrumb = array('Aparatur Sipil Negara', 'Tambah');
$check = ($_SESSION['role'] == '10' ? '' : 'test');
check_page_request($check, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/');
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
                    <form class="form-horizontal" id="FormTambahASN" method="post" action="<?php echo SIMPEG_URL; ?>controllers/c-daftar-pegawai.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="status_kepegawaian" class="col-sm-2 control-label">Status Kepegawaian</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="status_kepegawaian" id="status_kepegawaian" data-placeholder="Status Kepegawaian">
                                        <option></option>
                                        <option value="1">Pegawai Negeri Sipil</option>
                                        <option value="2">Calon Pegawai Negeri Sipil</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">NIP</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="" readonly />
                                    <input type="hidden" class="form-control" id="role" name="role" placeholder="" value="<?php echo $_SESSION['role']; ?>" readonly />
                                    <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="col-sm-2 control-label">Foto<sup><i class="fa fa-info-circle" data-toggle="tooltip" title="Biarkan ini kosong jika anda tidak ingin mengubah nya"></i></sup></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="foto" name="foto" />
                                    <input type="hidden" class="form-control" id="foto_lama" name="foto_lama" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gelar" class="col-sm-2 control-label">Gelar</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="gelar_depan" name="gelar_depan" placeholder="Gelar Depan" value="" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang" placeholder="Gelar Belakang" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Tanggal Lahir</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir" data-date-format="yyyy-mm-dd" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_jenis_kelamin', 'id', 'label', 'jenis_kelamin', 'Jenis Kelamin', '');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="agama" class="col-sm-2 control-label">Agama</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_agama', 'id', 'label', 'agama', 'Agama', '');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_hp" class="col-sm-2 control-label">No. Handphone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. Handphone" data-inputmask="'mask': ['9999 9999 999', '9999 9999 9999']" data-mask value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="skpd" class="col-sm-2 control-label">OPD</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option_where($koneksi, 'opd', 'id', 'nama', 'opd', 'OPD', '', ($_SESSION['role'] == '1' ? 'id != ""' : 'id = "' . $user_data['opd_id'] . '"'));
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="skpd" class="col-sm-2 control-label">Unit Organisasi</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option_where($koneksi, 'opd_unit_organisasi', 'id', 'nama', 'unit_organisasi', 'Unit Organisasi', '', "opd = ''");
?>
                                </div>
                            </div>
                            <div class="form-group" id="konten_jenis_kepegawaian">
                                <label for="jenis_kepegawaian" class="col-sm-2 control-label">Jenis Kepegawaian</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_jenis_kepegawaian', 'id', 'label', 'jenis_kepegawaian', 'Jenis Kepegawaian', '');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kedudukan_pegawai" class="col-sm-2 control-label">Kedudukan Pegawai</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option_where($koneksi, 'ref_kedudukan_pegawai', 'id', 'label', 'kedudukan_pegawai', 'Kedudukan Pegawai', '', "status_kepegawaian = ''");
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status_perkawinan" class="col-sm-2 control-label">Status Perkawinan</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_status_perkawinan', 'id', 'label', 'status_perkawinan', 'Status Perkawinan', '');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="provinsi" class="col-sm-2 control-label"></label>
                                <div class="col-sm-5">
                                    <?php
echo component_select_option($koneksi, 'ref_provinsi', 'id', 'nama', 'provinsi', 'Provinsi', '');
?>
                                </div>
                                <div class="col-sm-5">
                                    <?php
echo component_select_option_where($koneksi, 'ref_kabkot', 'id', 'nama', 'kabkot', 'Kabupaten/Kota', '', "provinsi = ''");
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan" class="col-sm-2 control-label"></label>
                                <div class="col-sm-5">
                                    <?php
echo component_select_option_where($koneksi, 'ref_kecamatan', 'id', 'nama', 'kecamatan', 'Kecamatan', '', "kabkot = ''");
?>
                                </div>
                                <div class="col-sm-5">
                                    <?php
echo component_select_option_where($koneksi, 'ref_keldes', 'id', 'nama', 'keldes', 'Kelurahan/Desa', '', "kecamatan = ''");
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="rt" name="rt" placeholder="RT" value="" />
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="rw" name="rw" placeholder="RW" value="" />
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Kode Pos" value="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="golongan_darah" class="col-sm-2 control-label">Golongan Darah</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_golongan_darah', 'id', 'label', 'golongan_darah', 'Golongan Darah', '');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_karpeg" class="col-sm-2 control-label">No. KARPEG</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_karpeg" name="no_karpeg" placeholder="No. KARPEG" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_askes" class="col-sm-2 control-label">No. Kartu ASKES</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_askes" name="no_askes" placeholder="No. Kartu ASKES" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_taspen" class="col-sm-2 control-label">No. Kartu TASPEN</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_taspen" name="no_taspen" placeholder="No. Kartu TASPEN" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_karissu" class="col-sm-2 control-label">No. KARIS/KARSU</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_karissu" name="no_karissu" placeholder="No. KARIS/KARSU" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="npwp" class="col-sm-2 control-label">NPWP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP" value="" />
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolTambahASN" name="TombolTambahASN">Simpan</button>
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