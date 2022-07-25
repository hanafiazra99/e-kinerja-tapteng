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
$data = req_get_where($koneksi, 'pegawai_pengangkatan_pns', 'id = "' . $_GET['key1'] . '"');
$data_pegawai = req_get_where($koneksi, 'pegawai', 'id = "' . $_GET['key1'] . '"');
check_page_request($data_pegawai['id'], SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/');
$breadcrumb = array('Aparatur Sipil Negara', $data_pegawai['nama'], 'Pengangkatan PNS', 'Sunting');
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
                    <form class="form-horizontal" id="FormSuntingPengangkatanPNS" method="post" action="<?php echo SIMPEG_URL; ?>controllers/c-daftar-pegawai.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="pejabat_menetapkan" class="col-sm-2 control-label">Pejabat Yang Menetapkan</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data_pegawai['id'];?>" readonly />
                                    <input type="text" class="form-control" id="pym" name="pym" placeholder="Pejabat Yang Menetapkan" value="<?php echo $data['pym']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sk_pns" class="col-sm-2 control-label">SK</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="no_sk" name="no_sk" placeholder="Nomor" value="<?php echo $data['no_sk']?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_sk" name="tgl_sk" placeholder="Tanggal" data-date-format="yyyy-mm-dd" value="<?php echo $data['tgl_sk']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="col-sm-2 control-label">Dokumen SK<sup><i class="fa fa-info-circle" data-toggle="tooltip" title="Biarkan ini kosong jika anda tidak ingin mengubah nya"></i></sup></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file_sk" name="file_sk" />
                                    <input type="hidden" class="form-control" id="file_sk_lama" name="file_sk_lama" value="<?php echo $data['file_sk']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pangkat_golongan_ruang" class="col-sm-2 control-label">Pangkat/Golongan/Ruang</label>
                                <div class="col-sm-10">
                                    <?php
                                        echo component_select_option_custom_field($koneksi, 'ref_pgr', 'id', array('pangkat', 'golongan', 'ruang'), 'pgr', 'Pangkat Golongan Ruang', $data['pgr'], array('/', '/', ''))
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tmt_pns" class="col-sm-2 control-label">TMT</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tmt" name="tmt" placeholder="TMT PNS" data-date-format="yyyy-mm-dd" value="<?php echo $data['tmt']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pangkat_golongan_ruang" class="col-sm-2 control-label">Sumpah</label>
                                <div class="col-sm-10">
                                    <?php
                                        echo component_select_option($koneksi, 'ref_sumpah_pns', 'id', 'label', 'sumpah', 'Sumpah', $data['sumpah']);
                                    ?>
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolSuntingPengangkatanPNS" name="TombolSuntingPengangkatanPNS">Simpan</button>
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