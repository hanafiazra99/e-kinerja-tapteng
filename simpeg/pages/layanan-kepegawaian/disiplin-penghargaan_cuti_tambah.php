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
$breadcrumb = array('Disiplin dan Penghargaan', 'Cuti', 'Tambah');
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
                    <form role="form" class="form-horizontal" name="FormTambahCuti" id="FormTambahCuti" method="post" action="<?php echo SIMPEG_URL; ?>controllers/c-layanan-kepegawaian.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">OPD</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" name="konfirmasi" id="konfirmasi" value="<?php echo ($_SESSION['akses'] == '10' ? 'Menunggu Verifikasi' : 'Disetujui') ?>">
                                    <?php
                                    echo component_select_option_where($koneksi, 'opd', 'id', 'nama', 'opd', 'Pilih OPD', '', ($_SESSION['role'] == '1' ? 'id != ""' : 'id = "' . $user_data['opd_id'] . '"'));
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">Pegawai</label>
                                <div class="col-sm-10">
                                    <?php
                                    echo component_select_option_where($koneksi, 'pegawai', 'id', 'nama', 'pegawai', 'Pegawai', '', "id = ''");
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Jenis Cuti</label>
                                <div class="col-sm-10">
                                    <select name="jenis_cuti" id="jenis_cuti" class="select2 form-control">
                                        <option value="Cuti Tahunan">Cuti Tahunan</option>
                                        <option value="Cuti Alasan Penting">Cuti Alasan Penting</option>
                                        <option value="Cuti Besar">Cuti Besar</option>
                                        <option value="Cuti Sakit">Cuti Sakit</option>
                                        <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                                        <option value="Cuti Di Luar Tanggungan Negara">Cuti Di Luar Tanggungan Negara</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tgl." class="col-sm-2 control-label">Tgl. Mulai - Selesai</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_mulai" name="tgl_mulai" placeholder="Tanggal Mulai" data-date-format="yyyy-mm-dd" value="" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_selesai" name="tgl_selesai" placeholder="Tanggal Selesai" data-date-format="yyyy-mm-dd" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sk_pns" class="col-sm-2 control-label">Surat Keputusan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_sk" name="no_sk" placeholder="Nomor" value="" /><br>
                                    <input type="text" class="form-control" id="pyb" name="pyb" placeholder="Pejabat yang berwenang" value="" /><br>
                                    <input type="text" class="form-control" id="nama_pyb" name="nama_pyb" placeholder="Nama Pejabat" value="" /><br>
                                    <input type="text" class="form-control" id="nip_pyb" name="nip_pyb" placeholder="NIP Pejabat" value="" /><br>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="sk_pns" class="col-sm-2 control-label">Surat Permohonan</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file_sk" name="file_sk" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolTambahCuti" name="TombolTambahCuti">Simpan</button>
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