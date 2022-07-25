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
$data = req_get_where($koneksi, 'pegawai_anak ', 'id = "' . $_GET['key2'] . '"');
$data_pegawai = req_get_where($koneksi, 'pegawai', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/');
$breadcrumb = array('Aparatur Sipil Negara', $data_pegawai['nama'], 'Anak', $data['nama'], 'Sunting');
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
                    <form class="form-horizontal" id="FormSuntingAnak" method="post" action="<?php echo SIMPEG_URL; ?>controllers/c-daftar-pegawai.php" enctype="multipart/form-data">
                    <div class="box-body">
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id']; ?>" readonly />
                                    <input type="hidden" class="form-control" id="pegawai" name="pegawai" placeholder="" value="<?php echo $data['pegawai']; ?>" readonly />
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $data['nama']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ttl" class="col-sm-2 control-label">Tempat Tanggal Lahir</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $data['tempat_lahir'] ?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir" data-date-format="yyyy-mm-dd" value="<?php echo $data['tgl_lahir'] ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="col-sm-2 control-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_jenis_kelamin', 'id', 'label', 'jenis_kelamin', 'Jenis Kelamin', $data['jenis_kelamin']);
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status_anak" class="col-sm-2 control-label">Status Anak</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_status_anak', 'id', 'label', 'status_anak', 'Status Anak', $data['status_anak']);
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tunjangan" class="col-sm-2 control-label">Tunjangan</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_tunjangan_anak', 'id', 'label', 'tunjangan', 'Tunjangan', $data['tunjangan']);
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pendidikan_terakhir" class="col-sm-2 control-label">Pendidikan Terakhir</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option_with_blank($koneksi, 'ref_tingkat_pendidikan', 'id', 'label', 'pendidikan_terakhir', 'Pendidikan Terakhir', $data['pendidikan_terakhir']);
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan" class="col-sm-2 control-label">Pekerjaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" value="<?php echo $data['pekerjaan'] ?>" />
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolSuntingAnak" name="TombolSuntingAnak">Simpan</button>
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
echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/daftar-pegawai/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>