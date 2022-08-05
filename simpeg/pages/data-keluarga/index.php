<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-data-keluarga.php";

cek_session();
$user_data = user_data($koneksi);
$data_ortu = req_get_where($koneksi, 'v_pegawai_ortu', 'id = "' . $_SESSION['id'] . '"');
$data_ortu_alamat = req_get_where($koneksi, 'v_pegawai_ortu_alamat', 'id = "' . $_SESSION['id'] . '"');
$data_mertua = req_get_where($koneksi, 'v_pegawai_mertua', 'id = "' . $_SESSION['id'] . '"');
$data_mertua_alamat = req_get_where($koneksi, 'v_pegawai_mertua_alamat', 'id = "' . $_SESSION['id'] . '"');
$data_pasangan = req_get_where($koneksi, 'v_pegawai_pasangan', 'id = "' . $_SESSION['id'] . '"');
$breadcrumb = array();
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
                        <h3 class="box-title">Data Keluarga</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#ct_k_ortu" data-toggle="tab">Orang Tua</a></li>
                            <li><a href="#ct_k_mertua" data-toggle="tab">Mertua</a></li>
                            <li><a href="#ct_k_pasangan" data-toggle="tab">Pasangan</a></li>
                            <li><a href="#ct_k_anak" data-toggle="tab">Anak</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="ct_k_ortu">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="lead">Data Ayah</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:25%">Nama</th>
                                                    <td><?php echo $data_ortu['nama_a']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Tanggal Lahir</th>
                                                    <td>
                                                        <?php echo $data_ortu['tempat_lahir_a']; ?>,
                                                        <?php echo content_tgl_indo($data_ortu['tgl_lahir_a']); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <td><?php echo $data_ortu['pekerjaan_a']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>
                                                        <?php echo $data_ortu_alamat['alamat_a']; ?><br>
                                                        <?php echo ($data_ortu_alamat['rt_a'] != '' ? 'RT ' . ucwords(strtolower($data_ortu_alamat['rt_a'])) . '' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['rw_a'] != '' ? 'RW ' . ucwords(strtolower($data_ortu_alamat['rw_a'])) . '' : ''); ?><br>
                                                        <?php echo ($data_ortu_alamat['keldes_a'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['keldes_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['kecamatan_a'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['kecamatan_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['kabkot_a'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['kabkot_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['provinsi_a'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['provinsi_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['kode_pos_a'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['kode_pos_a'])) . '<br>' : ''); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <a href="<?php echo SIMPEG_URL . 'perubahan-data/data-keluarga/orang-tua/' . $_SESSION['id'] . '/usulkan/' ?>" class="btn btn-sm btn-success">Sunting</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="lead">Data Ibu</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:25%">Nama</th>
                                                    <td><?php echo $data_ortu['nama_i']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Tanggal Lahir</th>
                                                    <td>
                                                        <?php echo $data_ortu['tempat_lahir_i']; ?>,
                                                        <?php echo content_tgl_indo($data_ortu['tgl_lahir_i']); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <td><?php echo $data_ortu['pekerjaan_i']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>
                                                        <?php echo $data_ortu_alamat['alamat_i']; ?><br>
                                                        <?php echo ($data_ortu_alamat['rt_i'] != '' ? 'RT ' . ucwords(strtolower($data_ortu_alamat['rt_i'])) . '' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['rw_i'] != '' ? 'RW ' . ucwords(strtolower($data_ortu_alamat['rw_i'])) . '' : ''); ?><br>
                                                        <?php echo ($data_ortu_alamat['keldes_i'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['keldes_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['kecamatan_i'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['kecamatan_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['kabkot_i'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['kabkot_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['provinsi_i'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['provinsi_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['kode_pos_i'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['kode_pos_i'])) . '<br>' : ''); ?>
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_k_mertua">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="lead">Data Ayah Mertua</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:25%">Nama</th>
                                                    <td><?php echo $data_mertua['nama_a']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Tanggal Lahir</th>
                                                    <td>
                                                        <?php echo $data_mertua['tempat_lahir_a']; ?>,
                                                        <?php echo content_tgl_indo($data_mertua['tgl_lahir_a']); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <td><?php echo $data_mertua['pekerjaan_a']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>
                                                        <?php echo $data_mertua_alamat['alamat_a']; ?><br>
                                                        <?php echo ($data_mertua_alamat['rt_a'] != '' ? 'RT ' . ucwords(strtolower($data_mertua_alamat['rt_a'])) . '' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['rw_a'] != '' ? 'RW ' . ucwords(strtolower($data_mertua_alamat['rw_a'])) . '' : ''); ?><br>
                                                        <?php echo ($data_mertua_alamat['keldes_a'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['keldes_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['kecamatan_a'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['kecamatan_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['kabkot_a'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['kabkot_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['provinsi_a'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['provinsi_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['kode_pos_a'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['kode_pos_a'])) . '<br>' : ''); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <a href="<?php echo SIMPEG_URL . 'perubahan-data/data-keluarga/mertua/' . $_SESSION['id'] . '/usulkan/' ?>" class="btn btn-sm btn-success">Sunting</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="lead">Data Ibu Mertua</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:25%">Nama</th>
                                                    <td><?php echo $data_mertua['nama_i']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Tanggal Lahir</th>
                                                    <td>
                                                        <?php echo $data_mertua['tempat_lahir_i']; ?>,
                                                        <?php echo content_tgl_indo($data_mertua['tgl_lahir_i']); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <td><?php echo $data_mertua['pekerjaan_i']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>
                                                        <?php echo $data_mertua_alamat['alamat_i']; ?><br>
                                                        <?php echo ($data_mertua_alamat['rt_i'] != '' ? 'RT ' . ucwords(strtolower($data_mertua_alamat['rt_i'])) . '' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['rw_i'] != '' ? 'RW ' . ucwords(strtolower($data_mertua_alamat['rw_i'])) . '' : ''); ?><br>
                                                        <?php echo ($data_mertua_alamat['keldes_i'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['keldes_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['kecamatan_i'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['kecamatan_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['kabkot_i'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['kabkot_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['provinsi_i'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['provinsi_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['kode_pos_i'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['kode_pos_i'])) . '<br>' : ''); ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_k_pasangan">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Nama</th>
                                            <td><?php echo $data_pasangan['nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tempat Tanggal Lahir</th>
                                            <td>
                                                <?php echo $data_pasangan['tempat_lahir']; ?>,
                                                <?php echo content_tgl_indo($data_pasangan['tgl_lahir']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Buku Nikah</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_pasangan['no_buku_nikah']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_pasangan['tgl_buku_nikah']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pendidikan</th>
                                            <td><?php echo $data_pasangan['pendidikan_terakhir']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pekerjaan</th>
                                            <td><?php echo $data_pasangan['pekerjaan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a href="<?php echo SIMPEG_URL . 'perubahan-data/data-keluarga/pasangan/' . $_SESSION['id'] . '/usulkan/' ?>" class="btn btn-sm btn-success">Sunting</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_k_anak">
                                <table id="daftar_data_6" style="width: 100%;" class="table table-bordered table-fix-last">
                                    <thead>
                                        <tr class="bg-custom">
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Status Anak</th>
                                            <th>Status Tunjangan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
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
		var pegawai="' . $_SESSION['id'] . '";
		var BASE_URL = "' . BASE_URL . '";
		var SIMPEG_URL = "' . SIMPEG_URL . '";
		var RESOURCES_URL = "' . RESOURCES_URL . '";
	</script>
 ';
    template_js();
    echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/data-keluarga/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
    ?>
</body>

</html>