<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-beranda.php";

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
	?>
</head>

<body class="hold-transition skin-custom sidebar-mini">
	<div class="se-pre-con"></div>
	<div class="wrapper">
		<?php
		template_header($user_data, $koneksi, SKP_TITLE);
		template_navigasi(page_title(), $koneksi, 'skp', SKP_URL);
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

			</section>
		</div>
		<?php
		template_footer(SKP_TITLE);
		?>
	</div>
	<?php
	template_js();
	?>
</body>

</html>