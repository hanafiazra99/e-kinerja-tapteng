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
check_page_request($_GET['key1'], SIMPEG_URL . 'perubahan-data/data-keluarga/pasangan/');
$data = req_get_where($koneksi, 'pegawai_pasangan', 'id = "' . $_GET['key1'] . '"');
$data_pegawai = req_get_where($koneksi, 'pegawai', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'perubahan-data/data-keluarga/pasangan/');
$breadcrumb = array('Data Keluarga', 'Pasangan', $data_pegawai['nama'], 'Usulkan');
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
                    <form class="form-horizontal" id="FormTambahUsulanPasangan" method="post" action="<?php echo SIMPEG_URL;?>controllers/c-perubahan-data.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Nama Pasangan</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id'];?>" readonly />
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pasangan" value="<?php echo $data['nama'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tempat_tanggal_lahir" class="col-sm-2 control-label">Tempat Tanggal Lahir</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $data['tempat_lahir'];?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir" data-date-format="yyyy-mm-dd" value="<?php echo $data['tgl_lahir'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="buku_nikah" class="col-sm-2 control-label">Buku Nikah</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="no_buku_nikah" name="no_buku_nikah" placeholder="No. Buku Nikah" value="<?php echo $data['no_buku_nikah'];?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_buku_nikah" name="tgl_buku_nikah" placeholder="Tgl. Buku Nikah" data-date-format="yyyy-mm-dd" value="<?php echo $data['tgl_buku_nikah'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pendidikan" class="col-sm-2 control-label">Pendidikan Terakhir</label>
                                <div class="col-sm-10">
                                    <?php
                                        echo component_select_option($koneksi, 'ref_tingkat_pendidikan', 'id', 'label', 'pendidikan_terakhir', 'Pendidikan Terakhir', $data['pendidikan_terakhir']);
                                    ?>                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan" class="col-sm-2 control-label">Pekerjaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" value="<?php echo $data['pekerjaan'];?>" />
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolTambahUsulanPasangan" name="TombolTambahUsulanPasangan">Simpan</button>
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