<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-pengaturan.php";

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
template_header($user_data, $koneksi, TPP_TITLE);
template_navigasi(page_title(), $koneksi, 'tpp', TPP_URL);
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
                <div class="row">
					<div class="col-sm-6">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Persentase TPP</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_l1" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Status Kepegawaian</th>
                                            <th>TPP Maksimal Diterima</th>
                                            <th></th>
										</tr>
                                    </thead>
                                    
								</table>
							</div>
						</div>
                    </div>

                    <div class="col-sm-6">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Indikator Penilaian Sasaran Kerja Pegawai</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_l2" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Batas Bawah</th>
                                            <th>Batas Atas</th>
                                            <th>Bobot</th>
                                            <th></th>
										</tr>
                                    </thead>
                                    
								</table>
							</div>
						</div>
                    </div>

                    <div class="col-sm-6">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Indikator Ketepatan Waktu Penyampaian Penilaian Sasaran Kerja Pegawai</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_l3" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Batas Bawah</th>
                                            <th>Batas Atas</th>
                                            <th>Bobot</th>
                                            <th></th>
										</tr>
                                    </thead>
                                    
								</table>
							</div>
						</div>
                    </div>

                    <div class="col-sm-6">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Indikator Ketepatan Waktu Masuk Kerja</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_l4" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Batas Bawah</th>
                                            <th>Batas Atas</th>
                                            <th>Bobot</th>
                                            <th></th>
										</tr>
                                    </thead>
                                    
								</table>
							</div>
						</div>
                    </div>

                    <div class="col-sm-6">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Indikator Ketepatan Waktu Pulang Kerja</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_l5" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Batas Bawah</th>
                                            <th>Batas Atas</th>
                                            <th>Bobot</th>
                                            <th></th>
										</tr>
                                    </thead>
                                    
								</table>
							</div>
						</div>
                    </div>

                    <div class="col-sm-6">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Indikator Hukuman Disiplin</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_l6" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Tingkat Hukuman</th>
                                            <th>Jenis Hukuman</th>
                                            <th>Bobot</th>
                                            <th></th>
										</tr>
                                    </thead>
                                    
								</table>
							</div>
						</div>
                    </div>

                    <div class="col-sm-6">
						<div class="box box-blue">
							<div class="box-header with-border">
								<h3 class="box-title">Indikator Tidak Hadir Kerja</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<table id="daftar_data_l7" style="width: 100%;" class="table table-bordered table-fix-last">
									<thead>
										<tr class="bg-custom">
											<th>Batas Bawah</th>
                                            <th>Batas Atas</th>
											<th>Bobot</th><th></th>
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
echo '
        <script>
            var BASE_URL = "' . BASE_URL . '";
            var TPP_URL = "' . TPP_URL . '";
            var RESOURCES_URL = "' . RESOURCES_URL . '";
        </script>
     ';
template_footer(TPP_TITLE);
?>
	</div>
<?php
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/tpp/pengaturan/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>