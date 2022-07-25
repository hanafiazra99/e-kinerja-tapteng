<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-kalender-kerja.php";

cek_session();
$user_data = user_data($koneksi);
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
echo '
		<link rel="stylesheet" href="'.RESOURCES_URL.'library/fullcalendar/dist/fullcalendar.min.css">
		<link rel="stylesheet" href="'.RESOURCES_URL.'library/fullcalendar/dist/fullcalendar.print.min.css" media="print">
	 ';
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
				<div class="box box-primary">
					<div class="box-body no-padding">
						<div id="calendar"></div>
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
		var BASE_URL = "' . BASE_URL . '";
		var ABSENSI_URL = "' . ABSENSI_URL . '";
		var RESOURCES_URL = "' . RESOURCES_URL . '";
	</script>
 ';
template_js();
echo '
		<script src="'.RESOURCES_URL.'library/moment/moment.js"></script>
		<script src="'.RESOURCES_URL.'library/fullcalendar/dist/fullcalendar.min.js"></script>
		<script src="'.RESOURCES_URL.'library/fullcalendar/dist/locale/id.js"></script>
	 ';
echo '<script src="' . RESOURCES_URL . 'js-for/absensi/kalender-kerja/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>