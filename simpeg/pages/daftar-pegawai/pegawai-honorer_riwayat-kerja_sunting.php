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
check_page_request($_GET['key2'], SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/');
$data = req_get_where($koneksi, 'pegawai_riwayat_kerja_honorer', 'id = "' . $_GET['key2'] . '"');
$data_pegawai = req_get_where($koneksi, 'pegawai', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/');
$breadcrumb = array('Pegawai Honorer', $data_pegawai['nama'], 'Riwayat Kerja', $data['no_sk'], 'Sunting');
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
                    <form class="form-horizontal" id="FormSuntingRiwayatKerjaHonorer" method="post" action="<?php echo SIMPEG_URL; ?>controllers/c-daftar-pegawai.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="pejabat_menetapkan" class="col-sm-2 control-label">Tahun</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id'];?>" readonly />
                                    <input type="hidden" class="form-control" id="pegawai" name="pegawai" placeholder="" value="<?php echo $data['pegawai'];?>" readonly />
                                    <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Tahun" data-date-format="yyyy" value="<?php echo $data['tahun'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="opd" class="col-sm-2 control-label">OPD</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="opd" name="opd" placeholder="OPD" value="<?php echo $data['opd'];?>" />
                                </div>
                            </div>
							<div class="form-group">
                                <label for="jabatan" class="col-sm-2 control-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" value="<?php echo $data['jabatan'];?>" />
                                </div>
                            </div>
							<div class="form-group">
                                <label for="no_sk" class="col-sm-2 control-label">No. SK</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_sk" name="no_sk" placeholder="Nomor" value="<?php echo $data['jabatan'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="col-sm-2 control-label">File SK<sup><i class="fa fa-info-circle" data-toggle="tooltip" title="Biarkan ini kosong jika anda tidak ingin mengubah nya"></i></sup></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file_sk" name="file_sk" />
									<input type="hidden" class="form-control" id="file_sk_lama" name="file_sk_lama" value="<?php echo $data['file_sk']; ?>" />
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolSuntingRiwayatKerjaHonorer" name="TombolSuntingRiwayatKerjaHonorer">Simpan</button>
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
                var BASE_URL = "'.BASE_URL.'";
                var SIMPEG_URL = "'.SIMPEG_URL.'";
                var RESOURCES_URL = "'.RESOURCES_URL.'";
            </script>
         ';
    template_js();
    echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/daftar-pegawai/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
    ?>
</body>

</html>