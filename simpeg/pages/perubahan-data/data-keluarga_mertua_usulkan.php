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
check_page_request($_GET['key1'], SIMPEG_URL . 'perubahan-data/data-keluarga/orang-tua/');
$data = req_get_where($koneksi, 'pegawai_mertua', 'id = "' . $_GET['key1'] . '"');
$data_alamat = req_get_where($koneksi, 'pegawai_mertua_alamat', 'id = "' . $_GET['key1'] . '"');
$data_pegawai = req_get_where($koneksi, 'pegawai', 'id = "' . $_GET['key1'] . '"');
check_page_request($data_pegawai['id'], SIMPEG_URL . 'perubahan-data/data-keluarga/orang-tua/');
$breadcrumb = array('Data Keluarga', 'Mertua', $data_pegawai['nama'], 'Usulkan');
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
                    <form class="form-horizontal" id="FormTambahUsulanMertua" method="post" action="<?php echo SIMPEG_URL;?>controllers/c-perubahan-data.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">
                                    <p class="lead control-label">Data Ayah</p>
                                </label>
                                <div class="col-sm-10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_a" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data_pegawai['id'];?>" readonly />
                                    <input type="text" class="form-control" id="nama_a" name="nama_a" placeholder="Nama" value="<?php echo $data['nama_a'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir_a" class="col-sm-2 control-label">Tempat Tanggal Lahir</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tempat_lahir_a" name="tempat_lahir_a" placeholder="Tempat Lahir" value="<?php echo $data['tempat_lahir_a'];?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_lahir_a" name="tgl_lahir_a" placeholder="Tanggal Lahir" data-date-format="yyyy-mm-dd" value="<?php echo $data['tgl_lahir_a'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan_a" class="col-sm-2 control-label">Pekerjaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pekerjaan_a" name="pekerjaan_a" placeholder="Pekerjaan" value="<?php echo $data['pekerjaan_a'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_a" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alamat_a" id="alamat_a" placeholder="Alamat"><?php echo $data_alamat['alamat_a'];?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="provinsi" class="col-sm-2 control-label"></label>
                                <div class="col-sm-5">
                                    <?php
                                        echo component_select_option($koneksi, 'ref_provinsi', 'id', 'nama', 'provinsi_a', 'Provinsi', $data_alamat['provinsi_a']);
                                    ?>
                                </div>
                                <div class="col-sm-5">
                                    <?php
                                        echo component_select_option_where($koneksi, 'ref_kabkot', 'id', 'nama', 'kabkot_a', 'Kabupaten/Kota', $data_alamat['kabkot_a'], "provinsi = '".$data_alamat['provinsi_a']."'");
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan" class="col-sm-2 control-label"></label>
                                <div class="col-sm-5">
                                    <?php
                                        echo component_select_option_where($koneksi, 'ref_kecamatan', 'id', 'nama', 'kecamatan_a', 'Kecamatan', $data_alamat['kecamatan_a'], "kabkot = '".$data_alamat['kabkot_a']."'");
                                    ?>
                                </div>
                                <div class="col-sm-5">
                                    <?php
                                        echo component_select_option_where($koneksi, 'ref_keldes', 'id', 'nama', 'keldes_a', 'Kelurahan/Desa', $data_alamat['keldes_a'], "kecamatan = '".$data_alamat['kecamatan_a']."'");
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="rt_a" name="rt_a" placeholder="RT" value="<?php echo $data_alamat['rt_a']?>" />
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="rw_a" name="rw_a" placeholder="RW" value="<?php echo $data_alamat['rw_a']?>" />
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="kode_pos_a" name="kode_pos_a" placeholder="Kode Pos" value="<?php echo $data_alamat['kode_pos_a']?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">
                                    <p class="lead control-label">Data Ibu</p>
                                </label>
                                <div class="col-sm-10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_i" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_i" name="nama_i" placeholder="Nama" value="<?php echo $data['nama_i']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir_i" class="col-sm-2 control-label">Tempat Tanggal Lahir</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tempat_lahir_i" name="tempat_lahir_i" placeholder="Tempat Lahir" value="<?php echo $data['tempat_lahir_i']?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_lahir_i" name="tgl_lahir_i" placeholder="Tanggal Lahir" data-date-format="yyyy-mm-dd" value="<?php echo $data['tgl_lahir_i']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan_i" class="col-sm-2 control-label">Pekerjaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pekerjaan_i" name="pekerjaan_i" placeholder="Pekerjaan" value="<?php echo $data['pekerjaan_i']?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_i" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alamat_i" id="alamat_i" placeholder="Alamat"><?php echo $data_alamat['alamat_i']?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="provinsi" class="col-sm-2 control-label"></label>
                                <div class="col-sm-5">
                                    <?php
                                        echo component_select_option($koneksi, 'ref_provinsi', 'id', 'nama', 'provinsi_i', 'Provinsi', $data_alamat['provinsi_i']);
                                    ?>
                                </div>
                                <div class="col-sm-5">
                                    <?php
                                        echo component_select_option_where($koneksi, 'ref_kabkot', 'id', 'nama', 'kabkot_i', 'Kabupaten/Kota', $data_alamat['kabkot_a'], "provinsi = '".$data_alamat['provinsi_i']."'");
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan" class="col-sm-2 control-label"></label>
                                <div class="col-sm-5">
                                    <?php
                                        echo component_select_option_where($koneksi, 'ref_kecamatan', 'id', 'nama', 'kecamatan_i', 'Kecamatan', $data_alamat['kecamatan_i'], "kabkot = '".$data_alamat['kabkot_i']."'");
                                    ?>
                                </div>
                                <div class="col-sm-5">
                                    <?php
                                        echo component_select_option_where($koneksi, 'ref_keldes', 'id', 'nama', 'keldes_i', 'Kelurahan/Desa', $data_alamat['keldes_i'], "kecamatan = '".$data_alamat['kecamatan_i']."'");
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="rt_i" name="rt_i" placeholder="RT" value="<?php echo $data_alamat['rt_i'];?>" />
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="rw_i" name="rw_i" placeholder="RW" value="<?php echo $data_alamat['rw_i'];?>" />
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="kode_pos_i" name="kode_pos_i" placeholder="Kode Pos" value="<?php echo $data_alamat['kode_pos_i'];?>" />
                                        </div>
                                    </div>
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolTambahUsulanMertua" name="TombolTambahUsulanMertua">Simpan</button>
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