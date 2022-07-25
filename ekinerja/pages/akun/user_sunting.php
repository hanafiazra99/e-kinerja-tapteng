<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-akun.php";

cek_session();
$user_data = user_data($koneksi);
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], BASE_URL . 'akun/user/');
$data = req_get_where($koneksi, 'user', 'id = "' . $_GET['key1'] . '"');
$data_akun = req_get_where($koneksi, 'app_login', 'id = "' . $_GET['key1'] . '"');
check_page_request($_GET['key1'], BASE_URL . 'akun/user/');
$breadcrumb = array('User', $data['nama']);
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

<body class="hold-transition skin-custom sidebar-mini">
    <div class="se-pre-con"></div>
    <div class="wrapper">
        <?php
        template_header_ekinerja();
        template_navigasi_ekinerja(page_title(), $koneksi, $user_data);
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?php template_page_header($koneksi, page_id()); ?>
                </h1>
                <ol class="breadcrumb">
                    <?php template_breadcrumb($koneksi, page_id(), $breadcrumb); ?>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-green">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo '' . RESOURCES_URL . 'img/user/' . $data_akun['foto'] . ''; ?>" alt="User profile picture">
                                <form id="FormUpload" method="post" action="<?php echo $base_url; ?>controllers/c_profil.php" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" value="<?php echo $_SESSION['id'] ?>" id="user" name="user" readonly />
                                        <!---
											<center>
												<span class="btn fa fa-edit btn-file" title="Ganti"><input type="file" name="file_foto" id="file_foto" /></span>
												<br>
												<div id="content_tombol">
												</div>
											</center>
											--->
                                    </div>
                                </form>
                                <h3 class="profile-username text-center"><?php echo $data['nama']; ?></h3>
                                <p class="text-muted text-center"><?php echo level_role_option($data_akun['role']); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#identitas" data-toggle="tab">Identitas</a></li>
                                <li><a href="#username" data-toggle="tab">Username</a></li>
                                <li><a href="#password" data-toggle="tab">Password</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="identitas">
                                    <form class="form-horizontal" id="FormUserSuntingIdentitas" method="post" action="<?php echo BASE_URL; ?>ekinerja/controllers/c-akun.php">
                                        <div class="form-group">
                                            <label for="nama" class="col-sm-2 control-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo $data['nama']; ?>" />
                                                <input type="hidden" class="form-control" id="role" name="role" placeholder="" value="<?php echo $data_akun['role']; ?>" readonly />
                                                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id']; ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tlp" class="col-sm-2 control-label">No. Telepon</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="tlp" name="tlp" placeholder="No. Telepon" value="<?php echo $data['tlp']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $data['email']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"><?php echo $data['alamat']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <input type="checkbox" name="check_form" id="check_form" value="y" class="flat-red" /> <i>Saya sudah mengisi data semua data dengan benar</i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-sm btn-primary" id="TombolUserSuntingIdentitas" name="TombolUserSuntingIdentitas">Simpan</button>
                                                <button type="reset" class="btn btn-sm btn-default">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="username">
                                    <form class="form-horizontal" id="FormUserSuntingUsername" method="post" action="<?php echo BASE_URL; ?>ekinerja/controllers/c-akun.php">
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id']; ?>" readonly />
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $data_akun['username']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <input type="checkbox" name="check_form" id="check_form" value="y" class="flat-red" /> <i>Saya sudah mengisi data semua data dengan benar</i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-push-2 col-sm-3">
                                                <button type="submit" class="btn btn-sm btn-primary" id="TombolUserSuntingUsername" name="TombolUserSuntingUsername">Simpan</button>
                                                <button type="reset" class="btn btn-sm btn-default">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="password">
                                    <form class="form-horizontal" id="FormUserSuntingPassword" method="post" action="<?php echo BASE_URL; ?>ekinerja/controllers/c-akun.php">
                                        <div class="form-group">
                                            <label for="password" class="col-sm-2 control-label">Password Baru</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id']; ?>" readonly />
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="c_password" class="col-sm-2 control-label">Konfirmasi</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="c_password" name="c_password" placeholder="Konfirmasi Password" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <input type="checkbox" name="check_form" id="check_form" value="y" class="flat-red" /> <i>Saya sudah mengisi data semua data dengan benar</i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-push-2 col-sm-3">
                                                <button type="submit" class="btn btn-sm btn-primary" id="TombolUserSuntingPassword" name="TombolUserSuntingPassword">Simpan</button>
                                                <button type="reset" class="btn btn-sm btn-default">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
        template_footer(BASE_TITLE);
        ?>
    </div>
    <?php
    template_js();
    echo '<script src="' . RESOURCES_URL . 'js-for/ekinerja/akun/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
    ?>
</body>

</html>