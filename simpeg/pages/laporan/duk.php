<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-laporan.php";

cek_session();
$user_data = user_data($koneksi);
$breadcrumb = array('Daftar Urut Kepangkatan');
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
                    <form action="duk/excel" method="post">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Export Excel
                            </h3>
                            <div class="box-tools pull-right">
                                <button type="button" data-widget="collapse" class="btn btn-box-tool">
                                    <i class="fa fa-minus">

                                    </i>
                                </button>
                            </div>
                        </div>

                        <div class="box-body">

                            <div class="form-horizontal">

                                <div class="form-group" id="content_for_opd" style="">
                                    <label for="nama" class="col-sm-2 control-label">OPD </label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo component_select_option($koneksi, 'opd', 'id', 'nama', 'opd', 'OPD', '');
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Data</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="daftar_data_1" style="width: 100%;" class="table table-bordered">
                                <thead>
                                    <tr class="bg-custom">
                                        <th>NIP</th>
                                        <th>Gelar Depan</th>
                                        <th>Nama</th>
                                        <th>Gelar Belakang</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Pangkat Golongan Ruang</th>
                                        <th>TMT Pangkat Golongan Ruang</th>
                                        <th>Nama Jabatan</th>
                                        <th>Eselon</th>
                                        <th>Jenis Jabatan</th>
                                        <th>TMT Jabatan</th>
                                        <th>Masa Kerja</th>
                                        <th>OPD</th>
                                        <th>Jenjang</th>
                                        <th>Jurusan</th>
                                        <th>Tahun Lulus</th>
                                        <th>Status Kepegawaian</th>
                                    </tr>
                                </thead>
                            </table>
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
		var user_opd="' . $user_data['opd'] . '";
		var BASE_URL = "' . BASE_URL . '";
		var SIMPEG_URL = "' . SIMPEG_URL . '";
		var RESOURCES_URL = "' . RESOURCES_URL . '";
	</script>
 ';
    template_js();
    echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/laporan/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
    ?>
</body>

</html>