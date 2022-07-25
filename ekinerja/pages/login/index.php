<?php
	session_start();
	require "../../../app/config.php";
	require "../../../app/models.php";
	require "../../../app/component.php";
	require "../../../app/autentikasi.php";
	require "../../../app/template.php";
	require "../../controllers/c-login.php";
	
	reset_session_time($koneksi);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			template_title(page_title(), BASE_TITLE);
			template_favicon();
			template_meta();
			template_css('base');
		?>
	</head>

	<body class="">
		<div class="se-pre-con"></div>
		<div class="login-box">
			<div class="login-logo">
				<img src="<?php echo RESOURCES_URL;?>img/logo/logo-100.png" style="height: 120px; margin-top: 12px;" />
			</div>
			<div class="login-box-body">
				<p class="login-box-msg" style="font-size: 20px !important; font-weight: 900 !important;">
					<?php echo BASE_TITLE;?>
				</p>
				<form action="<?php echo BASE_URL;?>ekinerja/controllers/c-login.php" method="post" id="FormLogin">
					<div class="form-group has-feedback">
						<input type="text" class="form-control" name="username" id="username" placeholder="Username" autofocus>
						<span class="fa fa-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" name="password" id="password" placeholder="Password">
						<span class="fa fa-key form-control-feedback"></span>
					</div>
					<button type="submit" class="btn btn-success btn-block" name="TombolLogin" id="TombolLogin" style="margin-bottom: 10px;">Login</button>
				</form>
			</div>
			<div class="login-footer">
				<center>
					<strong>Copyright &copy; 2019 <br><?php echo A_DAERAH;?></strong> <br>All rights reserved.
				</center>
			</div>
		</div>
		
		<?php
			template_js();
		?>
		
		<script type="text/javascript">
			$(document).ready(function() {
				$(".select2").select2({
					minimumResultsForSearch: -1
				});
				$('#FormLogin').bootstrapValidator({
			        live: 'disabled',
					message: 'This value is not valid',
					fields: {
						username: {
							validators: {
								notEmpty: {
									message: '<b style="color: #FFF;">Form Username Tidak Boleh Kosong</b>'
								}
							}
						},
						password: {
							validators: {
								notEmpty: {
									message: '<b style="color: #FFF;">Form Password Tidak Boleh Kosong</b>'
								}
							}
						}
					}
				});

				// Validate the form manually
				$('#TombolLogin').click(function() {
					$('#FormLogin').bootstrapValidator('validate');
				});
			});
		</script>
	</body>
</html>
