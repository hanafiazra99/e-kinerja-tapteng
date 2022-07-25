<?php

session_start();

require "../../../app/config.php";

require "../../../app/models.php";

require "../../../app/component.php";

require "../../../app/autentikasi.php";

require "../../../app/template.php";

require "../../controllers/c-data-absen.php";



cek_session();

$user_data = user_data($koneksi);

//$conn = req_data_where($koneksi, 'v_absen', 'jenis = "absen"');

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

        template_header($user_data, $koneksi, ABSENSI_TITLE);

        template_navigasi(page_title(), $koneksi, 'absensi', ABSENSI_URL);

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
                        <h3 class="box-title">
                            Filter Data
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
                            <?php
                            if ($_SESSION['role'] == 1) :
                            ?>
                                <div class="form-group" id="content_for_opd" style="">
                                    <label for="nama" class="col-sm-2 control-label">OPD </label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo component_select_option($koneksi, 'opd', 'id', 'nama', 'opd', 'OPD', '');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group" id="content_for_unit_organisasi" style="">
                                    <label for="nama" class="col-sm-2 control-label">Unit Organisasi</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo component_select_option($koneksi, 'opd_unit_organisasi', 'id', 'nama', 'unit_organisasi', 'Unit Organisasi', '');
                                        ?>
                                    </div>
                                </div>
                            <?php
                            endif;
                            ?>
                            <div class="form-group" id="content_for_unit_organisasi" style="">
                                <label for="nama" class="col-sm-2 control-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="text" id="tanggal" name="tanggal" class="form-control" data-date-format='yyyy-mm-dd'>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="box box-blue">

                    <div class="box-header with-border">

                        <h3 class="box-title">Daftar Data</h3>

                        <div class="box-tools pull-right">

                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                        </div>

                    </div>

                    <div class="box-body">

                        <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">

                            <thead>

                                <tr class="bg-custom">

                                    <th>OPD</th>

                                    <th>Unit Organisasi</th>

                                    <th>NIP</th>

                                    <th>Nama</th>

                                    <th>Jabatan</th>

                                    <th>Tanggal</th>

                                    <th>Waktu Masuk</th>

                                    <th>Status Masuk</th>

                                    <th>Waktu Pulang</th>

                                    <th>Status Pulang</th>

                                </tr>

                            </thead>



                        </table>

                    </div>

                </div>

            </section>

        </div>

        <?php

        template_footer(ABSENSI_TITLE);

        ?>

    </div>

    <?php

    echo '

	<script>

		var role="' . $_SESSION['role'] . '";

		var user_opd="' . $user_data['opd'] . '";
	
		var user_unit_organisasi="' . $user_data['unit_organisasi'] . '";

		var BASE_URL = "' . BASE_URL . '";

		var ABSENSI_URL = "' . ABSENSI_URL . '";

        var SIMPEG_URL = "' . SIMPEG_URL . '";

		var RESOURCES_URL = "' . RESOURCES_URL . '";

	</script>

 ';

    template_js();

    echo '<script src="' . RESOURCES_URL . 'js-for/absensi/data-absen/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';

    ?>

</body>



</html>