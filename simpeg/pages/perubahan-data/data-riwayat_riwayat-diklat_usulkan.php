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
check_page_request($_GET['key1'], SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-diklat/');
$data = req_get_where($koneksi, 'pegawai_riwayat_diklat', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-diklat/');
$breadcrumb = array('Data Riwayat', 'Riwayat Diklat', $data['no_sttpp'], 'Usulkan');
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
                        <h3 class="box-title">Usulkan Perubahan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <form class="form-horizontal" id="FormTambahUsulanRiwayatDiklat" method="post" action="<?php echo SIMPEG_URL;?>controllers/c-perubahan-data.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="jenis_diklat" class="col-sm-2 control-label">Jenis Diklat</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id'];?>" readonly />
                                    <input type="hidden" class="form-control" id="pegawai" name="pegawai" placeholder="" value="<?php echo $data['pegawai'];?>" readonly />
                                    <?php
                                        echo component_select_option($koneksi, 'ref_jenis_diklat', 'id', 'label', 'jenis_diklat', 'Jenis Diklat', $data['jenis_diklat']);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_diklat" class="col-sm-2 control-label">Nama Diklat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_diklat" id="nama_diklat" placeholder="Nama Diklat" value="<?php echo $data['nama_diklat'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="penyelenggara" class="col-sm-2 control-label">Penyelenggara</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" placeholder="Penyelenggara" value="<?php echo $data['penyelenggara'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="angkatan" class="col-sm-2 control-label">Angkatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="angkatan" name="angkatan" placeholder="Angkatan" value="<?php echo $data['angkatan'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lama_pendidikan" class="col-sm-2 control-label">Lama Pendidikan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="lama_pendidikan_h" name="lama_pendidikan_h" placeholder="Hari" value="<?php echo $data['lama_pendidikan_h'];?>" />
                                    <i class="text-info">Kosongkan jika tidak lebih dari 1 hari</i>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="lama_pendidikan_j" name="lama_pendidikan_j" placeholder="Jam" value="<?php echo $data['lama_pendidikan_j'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sttpp" class="col-sm-2 control-label">STTPP</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="no_sttpp" name="no_sttpp" placeholder="Nomor" value="<?php echo $data['no_sttpp'];?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_sttpp" name="tgl_sttpp" placeholder="Tanggal" data-date-format="yyyy-mm-dd" value="<?php echo $data['tgl_sttpp'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file_sttpp" class="col-sm-2 control-label">File STTPP<sup><i class="fa fa-info-circle" data-toggle="tooltip" title="Biarkan ini kosong jika anda tidak ingin mengubah nya"></i></sup></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file_sttpp" name="file_sttpp" />
                                    <input type="hidden" class="form-control" id="file_sttpp_lama" name="file_sttpp_lama" value="<?php echo $data['file_sttpp']; ?>" />
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolTambahUsulanRiwayatDiklat" name="TombolTambahUsulanRiwayatDiklat">Simpan</button>
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
                var BASE_URL = "'.BASE_URL.'";
                var SIMPEG_URL = "'.SIMPEG_URL.'";
                var RESOURCES_URL = "'.RESOURCES_URL.'";
            </script>
         ';
    template_js();
    echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/perubahan-data/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
    ?>
</body>

</html>