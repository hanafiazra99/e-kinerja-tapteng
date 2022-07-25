<?php
	session_start();
	require "app/config.php";
	require "app/models.php";
	require "app/component.php";
	require "app/autentikasi.php";
	require "app/template.php";

	if(isset($_GET['go']))
	{
	}
	else
	{
		//tujuan($base_url.'cp/beranda/');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			template_title('Direct', BASE_TITLE);
			template_favicon();
			template_meta();
			template_css('base');
		?>
	</head>
	<body class="hold-transition skin-dark sidebar-mini">
		<div class="wrapper">
			<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal" class="modal fade">
				<div class="<?php echo $_GET['status']?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title"><?php echo $_GET['judul']?></h4>
							</div>
							<div class="modal-body">
								<p><?php echo $_GET['isi']?></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">OK</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
			template_js();
		?>

		<script>
			$('#modal').modal('show');
			$("#modal").on("hidden.bs.modal", function () {
				window.location = "<?php echo $_GET['go']?>";
			});
		</script>
	</body>
</html>