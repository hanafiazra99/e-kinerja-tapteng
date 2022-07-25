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
check_page_request($_GET['key1'], SIMPEG_URL . 'perubahan-data/jabatan/');
$data = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $_GET['key1'] . '"');
$data_pegawai = req_get_where($koneksi, 'pegawai', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'perubahan-data/jabatan/');
$breadcrumb = array('Data Pegawai', 'Jabatan', $data_pegawai['nama'], 'Usulkan');
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
                    <form class="form-horizontal" id="FormTambahUsulanJabatan" method="post" action="<?php echo SIMPEG_URL;?>controllers/c-perubahan-data.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="pejabat_menetapkan" class="col-sm-2 control-label">Pejabat Yang Menetapkan</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id'];?>" readonly />
                                    <input type="text" class="form-control" id="pym" name="pym" placeholder="Pejabat Yang Menetapkan" value="<?php echo $data['pym']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sk_pns" class="col-sm-2 control-label">SK Jabatan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="no_sk_jabatan" name="no_sk_jabatan" placeholder="Nomor" value="<?php echo $data['no_sk_jabatan']?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_sk_jabatan" name="tgl_sk_jabatan" placeholder="Tanggal" data-date-format="yyyy-mm-dd" value="<?php echo $data['tgl_sk_jabatan']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="col-sm-2 control-label">File SK Jabatan<sup><i class="fa fa-info-circle" data-toggle="tooltip" title="Biarkan ini kosong jika anda tidak ingin mengubah nya"></i></sup></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file_sk_jabatan" name="file_sk_jabatan" />
                                    <input type="hidden" class="form-control" id="file_sk_jabatan_lama" name="file_sk_jabatan_lama" value="<?php echo $data['file_sk_jabatan']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jenis_jabatan" class="col-sm-2 control-label">Jenis Jabatan</label>
                                <div class="col-sm-10">
                                    <?php
                                        echo component_select_option($koneksi, 'ref_jenis_jabatan', 'id', 'label', 'jenis_jabatan', 'Jenis Jabatan', $data['jenis_jabatan']);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="eselon" class="col-sm-2 control-label">Eselon</label>
                                <div class="col-sm-10">
                                    <?php
                                        echo component_select_option($koneksi, 'ref_eselon', 'id', 'label', 'eselon', 'Eselon', $data['eselon']);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_jabatan" class="col-sm-2 control-label">Nama Jabatan</label>
                                <div class="col-sm-10">
                                    <?php
                                        echo component_select_option_where($koneksi, 'opd_struktur_organisasi', 'id', 'nama_jabatan', 'nama_jabatan', 'Nama Jabatan', $data['nama_jabatan'], 'opd = "'.$data_pegawai['opd'].'"');
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
                                <label for="sk_pelantikan" class="col-sm-2 control-label">SK Pelantikan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="no_sk_pelantikan" name="no_sk_pelantikan" placeholder="Nomor" value="<?php echo $data['no_sk_pelantikan']?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_sk_pelantikan" name="tgl_sk_pelantikan" placeholder="Tanggal" data-date-format="yyyy-mm-dd" value="<?php echo $data['tgl_sk_pelantikan']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file_sk_pelantikan" class="col-sm-2 control-label">File SK Pelantikan<sup><i class="fa fa-info-circle" data-toggle="tooltip" title="Biarkan ini kosong jika anda tidak ingin mengubah nya"></i></sup></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file_sk_pelantikan" name="file_sk_pelantikan" />
                                    <input type="hidden" class="form-control" id="file_sk_pelantikan_lama" name="file_sk_pelantikan_lama" value="<?php echo $data['file_sk_pelantikan']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pangkat_golongan_ruang" class="col-sm-2 control-label">Sumpah</label>
                                <div class="col-sm-10">
                                    <?php
                                        echo component_select_option($koneksi, 'ref_sumpah_jabatan', 'id', 'label', 'sumpah', 'Sumpah', $data['sumpah']);
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolTambahUsulanJabatan" name="TombolTambahUsulanJabatan">Simpan</button>
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