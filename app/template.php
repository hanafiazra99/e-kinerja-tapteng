<?php
function template_title($page, $title)
{
    echo '
                <title>' . $page . ' | ' . $title . '</title>
             ';
}

function template_favicon()
{
    echo '
				<link rel="apple-touch-icon" sizes="180x180" href="' . RESOURCES_URL . 'img/fav/apple-touch-icon.png">
				<link rel="icon" type="image/png" sizes="32x32" href="' . RESOURCES_URL . 'img/fav/favicon-32x32.png">
				<link rel="icon" type="image/png" sizes="16x16" href="' . RESOURCES_URL . 'img/fav/favicon-16x16.png">
				<link rel="manifest" href="' . RESOURCES_URL . 'img/fav/site.webmanifest">
				<link rel="mask-icon" href="' . RESOURCES_URL . 'img/fav/safari-pinned-tab.svg" color="#5bbad5">
				<meta name="msapplication-TileColor" content="#da532c">
				<meta name="theme-color" content="#ffffff">
			 ';
}

function template_meta()
{
    echo '
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
				<meta name="description" content="E-Kinerja Pemerintah Kabupaten Tapanuli Tengah">
				<meta name="author" content="Sammy Surbakti">
				<meta name="keyword" content="E-Kinerja Pemerintah Kabupaten Tapanuli Tengah, Pemerintah Kabupaten Tapanuli Tengah, Kabupaten Tapanuli Tengah, Tapanuli Tengah, E-Kinerja, Badan Kepegawai Daerah">
			 ';
}

function template_css($type)
{
    echo '
                <link rel="stylesheet" href="' . RESOURCES_URL . 'library/bootstrap/dist/css/bootstrap.css">
				<link rel="stylesheet" href="' . RESOURCES_URL . 'library/font-awesome/css/font-awesome.min.css">
				<link rel="stylesheet" href="' . RESOURCES_URL . 'library/bootstrap-validator/dist/css/bootstrapValidator.css"/>
				<link rel="stylesheet" href="' . RESOURCES_URL . 'library/Ionicons/css/ionicons.min.css">
				<link rel="stylesheet" href="' . RESOURCES_URL . 'themes/css/' . ($type == 'app' ? 'AdminLTE' : 'AdminLTEBase') . '.css">
				<link rel="stylesheet" href="' . RESOURCES_URL . 'themes/css/skins/_all-skins.css">
				<link rel="stylesheet" href="' . RESOURCES_URL . 'library/jvectormap/jquery-jvectormap.css">
				<link rel="stylesheet" href="' . RESOURCES_URL . 'library/datatables/dataTables.bootstrap.css">
				<link rel="stylesheet" href="' . RESOURCES_URL . 'library/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
				<link rel="stylesheet" href="' . RESOURCES_URL . 'library/bootstrap-daterangepicker/daterangepicker.css">
				<link rel="stylesheet" href="' . RESOURCES_URL . 'plugins/iCheck/all.css">
				<link rel="stylesheet" href="' . RESOURCES_URL . 'library/bootstrap-fileinput/css/fileinput.css" media="all" type="text/css" />
				<link rel="stylesheet" href="' . RESOURCES_URL . 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
				<link rel="stylesheet" href="' . RESOURCES_URL . 'library/select2/dist/css/select2.css">
				<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
             ';
}

function template_js()
{
    echo '
			<script src="' . RESOURCES_URL . 'library/jquery/dist/jquery.min.js"></script>
			<script src="' . RESOURCES_URL . 'library/jquery-ui/jquery-ui.min.js"></script>
			<script src="' . RESOURCES_URL . 'library/bootstrap/dist/js/bootstrap.min.js"></script>
			<script src="' . RESOURCES_URL . 'library/datatables/jquery.dataTables.js"></script>
			<script src="' . RESOURCES_URL . 'library/datatables/dataTables.bootstrap.js"></script>
			<script src="' . RESOURCES_URL . 'library/select2/dist/js/select2.full.min.js"></script>
			<script src="' . RESOURCES_URL . 'library/raphael/raphael.min.js"></script>
			<script src="' . RESOURCES_URL . 'library/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
			<script type="text/javascript" src="' . RESOURCES_URL . 'library/bootstrap-validator/dist/js/bootstrapValidator.js"></script>
			<script src="' . RESOURCES_URL . 'library/jquery-knob/dist/jquery.knob.min.js"></script>
			<script src="' . RESOURCES_URL . 'library/moment/min/moment.min.js"></script>
			<script src="' . RESOURCES_URL . 'library/bootstrap-daterangepicker/daterangepicker.js"></script>
			<script src="' . RESOURCES_URL . 'library/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
			<script src="' . RESOURCES_URL . 'library/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>
			<script src="' . RESOURCES_URL . 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
			<script src="' . RESOURCES_URL . 'library/jquery-slimscroll/jquery.slimscroll.js"></script>
			<script src="' . RESOURCES_URL . 'plugins/iCheck/icheck.min.js"></script>
			<script src="' . RESOURCES_URL . 'library/fastclick/lib/fastclick.js"></script>
			<script src="' . RESOURCES_URL . 'library/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
			<script src="' . RESOURCES_URL . 'library/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
			<script src="' . RESOURCES_URL . 'library/bootstrap-fileinput/js/locales/id.js" type="text/javascript"></script>
			<script src="' . RESOURCES_URL . 'library/bootstrap-fileinput/themes/explorer/theme.js" type="text/javascript"></script>
			<script src="' . RESOURCES_URL . 'themes/js/adminlte.min.js"></script>
			<script src="' . RESOURCES_URL . 'themes/js/demo.js"></script>
			<script src="' . RESOURCES_URL . 'library/ckeditor/ckeditor.js"></script>
			<script src="' . RESOURCES_URL . 'library/datatables/extensions/Buttons/js/dataTables.buttons.js"></script>
			<script src="' . RESOURCES_URL . 'library/datatables/extensions/Buttons/js/buttons.bootstrap.js"></script>
			<script src="' . RESOURCES_URL . 'library/datatables/extensions/JSZip/jszip.js"></script>
			<script src="' . RESOURCES_URL . 'library/datatables/extensions/pdfmake/pdfmake.js"></script>
			<script src="' . RESOURCES_URL . 'library/datatables/extensions/pdfmake/vfs_fonts.js"></script>
			<script src="' . RESOURCES_URL . 'library/datatables/extensions/Buttons/js/buttons.html5.js"></script>
			<script src="' . RESOURCES_URL . 'library/datatables/extensions/Buttons/js/buttons.print.js"></script>
			<script src="' . RESOURCES_URL . 'library/highchart/code/highcharts.js"></script>
			<script src="' . RESOURCES_URL . 'library/highchart/code/highcharts-3d.js"></script>
			<script src="' . RESOURCES_URL . 'library/highchart/code/modules/exporting.js"></script>
			<script src="' . RESOURCES_URL . 'library/highchart/code/modules/export-data.js"></script>
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		 ';
}

function template_header_ekinerja()
{
    echo '
				<header class="main-header" style="z-index: 9999;">
					<nav class="navbar navbar-static-top">
						<div class="navbar-title">
							<div class="col-sm-1 col-xs-12 text-center">
								<img src="' . RESOURCES_URL . 'img/logo/logo.png" style="padding-top: 5px; height: 120px !important;">
							</div>
							<div class="col-sm-10 col-xs-12 text-center">
								<h2 style="color: #FFF; font-size: 2em"><b>
									SISTEM INFORMASI MANAJEMEN KEPEGAWAIAN DAERAH</br>
									BADAN KEPEGAWAIAN DAERAH</br>
									'.strtoupper(A_DAERAH).'
								</b></h2>
							</div>
						</div>
					</nav>
				</header>
			 ';
}

function template_header($data_user, $koneksi, $app)
{
    $option = level_role_option($_SESSION['role']);

    echo '
				<header class="main-header">
					<a href="' . BASE_URL . '" class="logo">
						<span class="logo-mini">
							<img src="' . RESOURCES_URL . 'img/logo/logo-48.png" />
						</span>
						<span class="logo-lg">
							<b>' . $app . '</b>
						</span>
					</a>

					<nav class="navbar navbar-static-top">
						<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
							<span class="sr-only">Toggle navigation</span>
						</a>
						<div class="navbar-title">
						</div>
						<div class="navbar-custom-menu">
							<ul class="nav navbar-nav">

								<li class="dropdown user user-menu">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<img src="' . RESOURCES_URL . 'img/user/' . ($_SESSION['foto'] == '' ? 'admin.png' : $_SESSION['foto']) . '" class="user-image" alt="User Image">
										<span class="hidden-xs">' . ($data_user['nama'] == '' ? 'Tanpa Nama' : $data_user['nama']) . '</span>
									</a>
									<ul class="dropdown-menu">
										<li class="user-header">
											<img src="' . RESOURCES_URL . 'img/user/' . ($_SESSION['foto'] == '' ? 'admin.png' : $_SESSION['foto']) . '" class="img-circle" alt="User Image">
											<p>
												' . $data_user['nama'] . '<br>
												' . $option . '
											</p>
										</li>
										<li class="user-footer">
											<div class="pull-left">
												<a href="' . BASE_URL . 'profil/" class="btn btn-primary btn-flat">Profil</a>
											</div>
											<div class="pull-right">
												<a href="' . BASE_URL . 'keluar/" class="btn btn-danger btn-flat">Keluar</a>
											</div>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</nav>
				</header>
			 ';
}

function template_navigasi_ekinerja($lokasi, $koneksi, $data_user)
{
    $conn_navigasi = req_data_where($koneksi, 'h_app_navigasi', 'role = "' . $_SESSION['role'] . '" AND navigasi_app = "ekinerja"');
    $navigasi = '';

    $option = level_role_option($_SESSION['role']);

    while ($data_navigasi = mysqli_fetch_array($conn_navigasi)) {
        $conn_subnavigasi = req_data_where($koneksi, 'h_app_subnavigasi', 'role = "' . $_SESSION['role'] . '" AND navigasi = "' . $data_navigasi['navigasi_id'] . '"');
        $banyak_sub = mysqli_num_rows($conn_subnavigasi);

        if ($banyak_sub == 0) {
            $subnavigasi = '';
        } else {
            $subnavigasi = template_subnavigasi_ekinerja($koneksi, $data_navigasi['navigasi_id'], $_SESSION['role'], $data_navigasi['navigasi_link']);
        }

        $navigasi .= '
							<li class="' . ($banyak_sub == 0 ? '' : 'dropdown') . ' messages-menu">
								<a href="' . ($banyak_sub == 0 ? BASE_URL . $data_navigasi['navigasi_link'] : '#') . '" class="' . ($banyak_sub == 0 ? '' : 'dropdown-toggle') . '" ' . ($banyak_sub == 0 ? '' : 'data-toggle="dropdown"') . '>
									<b>' . $data_navigasi['navigasi_label'] . ' ' . ($banyak_sub != 0 ? '<i class="fa fa-angle-down pull-right" style="padding-top: 5px;"></i>' : '') . '</b>
								</a>
								' . $subnavigasi . '
							</li>
						 ';
    }

    echo '
				<header class="main-header">
					<nav class="navbar navbar-static-top" id="this-nav">
						<div class="col-sm-9">
							<div class="navbar-custom-menu" style="float: left !important;">
								<ul class="nav navbar-nav">
									' . $navigasi . '
								</ul>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="navbar-custom-menu">
								<ul class="nav navbar-nav">
									<li class="dropdown user user-menu">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<img src="' . RESOURCES_URL . 'img/user/' . $_SESSION['foto'] . '" class="user-image" alt="User Image" style="border: 3px solid #00A65A !important;">
											<span class="hidden-xs"><b>' . $data_user['nama'] . '</b></span>
										</a>
										<ul class="dropdown-menu">
											<li class="user-header">
												<img src="' . RESOURCES_URL . 'img/user/' . $_SESSION['foto'] . '" class="img-circle" alt="User Image">
												<p>
													' . $data_user['nama'] . '<br>
													' . $option . '
												</p>
											</li>
											<li class="user-footer">
												<div class="pull-left">
													<a href="' . BASE_URL . 'profil/" class="btn btn-default btn-flat">Profil</a>
												</div>
												<div class="pull-right">
													<a href="' . BASE_URL . 'keluar/" class="btn btn-default btn-flat">Keluar</a>
												</div>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</nav>
				</header>
			 ';
}

function template_subnavigasi_ekinerja($koneksi, $navigasi, $role, $link_navigasi)
{
    $conn_subnavigasi = req_data_where($koneksi, 'h_app_subnavigasi', 'role = "' . $role . '" AND navigasi = "' . $navigasi . '"');

    $subnavigasi = '
						<ul class="dropdown-menu" role="menu" style="width: 250px !important; left: 0 !important; right: auto !important;">
					   ';
    while ($data_subnavigasi = mysqli_fetch_array($conn_subnavigasi)) {
        $subnavigasi .= '
								<li>
									<a href="' . BASE_URL . '' . $link_navigasi . '' . $data_subnavigasi['subnavigasi_link'] . '" style="line-height: 2 !important; white-space: normal !important;">' . $data_subnavigasi['subnavigasi_label'] . '</a>
								</li>
							';
    }

    $subnavigasi .= '
						</ul>
					   ';

    return $subnavigasi;
}

function template_navigasi($lokasi, $koneksi, $app, $app_url)
{
    $conn_navigasi = req_data_where($koneksi, 'h_app_navigasi', 'role = "' . $_SESSION['role'] . '" AND navigasi_app = "' . $app . '"');

    echo '
				<aside class="main-sidebar">
					<section class="sidebar">
						<ul class="sidebar-menu" data-widget="tree">
			 ';

    while ($data_navigasi = mysqli_fetch_array($conn_navigasi)) {
        $subnavigasi = template_subnavigasi($koneksi, $app_url, $data_navigasi['navigasi_id'], $_SESSION['role'], $data_navigasi['navigasi_link']);
        $conn_akses_subnavigasi = req_data_where($koneksi, 'h_app_subnavigasi', 'navigasi = "' . $data_navigasi['navigasi_id'] . '" AND role = "' . $_SESSION['role'] . '"');

        echo '
					<li class="' . ($data_navigasi['navigasi_label'] == $lokasi ? 'active' : '') . ' ' . (mysqli_num_rows($conn_akses_subnavigasi) != 0 ? 'treeview' : '') . '">
						<a href="' . (mysqli_num_rows($conn_akses_subnavigasi) != 0 ? '#' : '' . $app_url . '' . $data_navigasi['navigasi_link'] . '') . '">
							<i class="' . $data_navigasi['navigasi_icon'] . '"></i>
							<span>' . $data_navigasi['navigasi_label'] . '</span>
							' . (mysqli_num_rows($conn_akses_subnavigasi) != 0 ? '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>' : '') . '
						</a>
						' . $subnavigasi . '
					</li>
				 ';
    }

    echo '
						</ul>
					</section>
				</aside>
			 ';
}

function template_subnavigasi($koneksi, $app_url, $navigasi, $role, $link)
{
    $conn_subnavigasi = req_data_where($koneksi, 'h_app_subnavigasi', 'role = "' . $_SESSION['role'] . '" AND navigasi = "' . $navigasi . '"');
    $subnavigasi = '';

    if (mysqli_num_rows($conn_subnavigasi) != 0) {
        $subnavigasi .= '
								<ul class="treeview-menu">
							';

        while ($data_subnavigasi = mysqli_fetch_array($conn_subnavigasi)) {
            $lastnavigasi = template_lastnavigasi($koneksi, $app_url, $data_subnavigasi['subnavigasi_id'], $role, $link . $data_subnavigasi['subnavigasi_link']);
            $conn_lastnavigasi = req_data_where($koneksi, 'h_app_lastnavigasi', 'role = "' . $_SESSION['role'] . '" AND subnavigasi = "' . $data_subnavigasi['subnavigasi_id'] . '"');

            $subnavigasi .= '
									<li class="' . (mysqli_num_rows($conn_lastnavigasi) != 0 ? 'treeview' : '') . '">
										<a href="' . (mysqli_num_rows($conn_lastnavigasi) != 0 ? '#' : '' . $app_url . '' . $link . '' . $data_subnavigasi['subnavigasi_link'] . '') . '">
											' . $data_subnavigasi['subnavigasi_label'] . '
											' . (mysqli_num_rows($conn_lastnavigasi) != 0 ? '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>' : '') . '
										</a>
										' . $lastnavigasi . '
									</li>
								';
        }

        $subnavigasi .= '
								</ul>
							';
    }

    return $subnavigasi;
}

function template_lastnavigasi($koneksi, $base_url, $subnavigasi, $role, $link)
{
    $conn_lastnavigasi = req_data_where($koneksi, 'h_app_lastnavigasi', 'role = "' . $_SESSION['role'] . '" AND subnavigasi = "' . $subnavigasi . '"');
    $lastnavigasi = '';

    if (mysqli_num_rows($conn_lastnavigasi) != 0) {
        $lastnavigasi .= '
								<ul class="treeview-menu">
							';

        while ($data_lastnavigasi = mysqli_fetch_array($conn_lastnavigasi)) {
            $lastnavigasi .= '
									<li style="white-space: normal !important;">
										<a href="' . $base_url . '' . $link . '' . $data_lastnavigasi['lastnavigasi_link'] . '">
											' . $data_lastnavigasi['lastnavigasi_label'] . '
										</a>
									</li>
								';
        }

        $lastnavigasi .= '
								</ul>
							';
    }

    return $lastnavigasi;
}

function template_page_header($koneksi, $navigasi)
{
    $data_navigasi = req_get_where($koneksi, 'app_navigasi', 'id = "' . $navigasi . '"');

    $content_header = '
							<i class="' . $data_navigasi['icon'] . '"></i> ' . $data_navigasi['label'] . '
						  ';

    echo $content_header;
}

function template_breadcrumb($koneksi, $navigasi, $breadcrumb)
{
    $data_navigasi = req_get_where($koneksi, 'app_navigasi', 'id = "' . $navigasi . '"');
    $tambahan = '';

    if (count($breadcrumb) != 0) {
        foreach ($breadcrumb as $list) {
            $tambahan .= '<li class="active">' . $list . '</li>';
        }
    }

    if ($data_navigasi['label'] == 'Beranda' or $data_navigasi['label'] == 'Portal') {
        $content_breadcrumb = '
									<li class="active"><i class="fa fa-home"></i> ' . $data_navigasi['label'] . '</li>
									' . $tambahan . '
								  ';
    } else {
        $content_breadcrumb = '
									<li class="active"><i class="fa fa-home"></i> Beranda</li>
									<li class="active"><i class="' . $data_navigasi['icon'] . '"></i> ' . $data_navigasi['label'] . '</li>
									' . $tambahan . '
								  ';
    }

    echo $content_breadcrumb;
}

function template_footer($app_title)
{
    echo '
				<footer class="main-footer bg-custom text-center">
					<b>' . $app_title . '</b> Copyright &copy; 2018 <strong>' . A_DAERAH . '.</strong> All rights reserved.
				</footer>
				<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal" class="modal fade">
				</div>
			 ';
}
