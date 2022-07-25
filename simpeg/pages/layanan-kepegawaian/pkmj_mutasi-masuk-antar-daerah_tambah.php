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
$breadcrumb = array('PKMJ', 'Mutasi Masuk Antar Daerah', 'Tambah');
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
                        <h3 class="box-title">Tambah Data</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <form role="form" class="form-horizontal" name="FormTambahMutasiMasukDaerah" id="FormTambahMutasiMasukDaerah" method="post" action="<?php echo SIMPEG_URL; ?>controllers/c-layanan-kepegawaian.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">Instansi Asal</label>
                                <div class="col-sm-5">
<?php
echo component_select_option_where($koneksi, 'ref_jenis_instansi', 'id', 'label', 'jenis_instansi', 'Jenis Instansi', '', 'id != ""');
?>

                                </div>
                                <div class="col-sm-5">
<?php
echo component_select_option_where($koneksi, 'ref_provinsi', 'id', 'nama', 'instansi', 'Instansi', '', 'id = ""');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">SK Perpindahan</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" name="pym_perpindahan" id="pym_perpindahan" placeholder="Pejabat Yang Menetapkan"><br>
                                    <input class="form-control" type="text" name="no_sk_perpindahan" id="no_sk_perpindahan" placeholder="Nomor SK"><br>
                                    <input type="text" class="form-control" name="tgl_sk_perpindahan" id="tgl_sk_perpindahan" placeholder="Tanggal SK" /><br>
                                    <input type="text" class="form-control" name="tmt_perpindahan" id="tmt_perpindahan" placeholder="TMT Perpindahan" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" id="file_sk_perpindahan" name="file_sk_perpindahan" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">SK Penempatan</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" name="pym_penempatan" id="pym_penempatan" placeholder="Pejabat Yang Menetapkan"><br>
                                    <input class="form-control" type="text" name="no_sk_penempatan" id="no_sk_penempatan" placeholder="Nomor SK"><br>
                                    <input type="text" class="form-control" name="tgl_sk_penempatan" id="tgl_sk_penempatan" placeholder="Tanggal SK" /><br>
                                    <input type="text" class="form-control" name="tmt_penempatan" id="tmt_penempatan" placeholder="TMT Penempatan" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" id="file_sk_penempatan" name="file_sk_penempatan" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">NIP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="nip" id="nip" placeholder="NIP">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">Pangkat Golongan Ruang</label>
                                <div class="col-sm-10">
<?php
echo component_select_option_custom_field($koneksi, 'ref_pgr', 'id', array('pangkat', 'golongan', 'ruang'), 'pgr', 'Pangkat Golongan Ruang', '', array('/', '/', ''))
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">OPD</label>
                                <div class="col-sm-10">
<?php
echo component_select_option_where($koneksi, 'opd', 'id', 'nama', 'opd', 'OPD', '', 'id != ""');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">Jabatan</label>
                                <div class="col-sm-10">
<?php
echo component_select_option_where($koneksi, 'opd_struktur_organisasi', 'id', 'nama_jabatan', 'nama_jabatan', 'Jabatan Baru', '', 'id = ""');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="username" id="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password">
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolTambahMutasiMasukDaerah" name="TombolTambahMutasiMasukDaerah">Simpan</button>
                                    <a href="../" class="btn btn-sm btn-default">Batal</a>
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
echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/layanan-kepegawaian/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>