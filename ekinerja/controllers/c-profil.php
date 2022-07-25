<?php
    function page_title()
	{
		return 'Profil';
	}
	
	function page_id()
	{
		return '33';
	}
	
	if (isset($_POST['TombolSuntingUsername'])) {
    require "../../app/config.php"; 
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['username']);
    $field = array('id', 'username');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'app_login'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, BASE_URL . 'profil/', 'Berhasil', 'Berhasil mengubah username.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, BASE_URL . 'profil/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingPassword'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $password = get_password($_POST['password']);

    $data = array($_POST['id'], $password);
    $field = array('id', 'password');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'app_login'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, BASE_URL . 'profil/', 'Berhasil', 'Berhasil mengubah password.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, BASE_URL . 'profil/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingFoto'])) {
	session_start();
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/img/user/');
	
	if ($_FILES['foto']['name'] != '') {
        $ekstensi = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('F', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $path . $nama_file)) {
            $foto = $nama_file;
        } else {
            $foto = $_POST['foto_lama'];
        }
    } else {
        $foto = $_POST['foto_lama'];
    }
	
    $data = array($_POST['id'], $foto);
    $field = array('id', 'foto');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'app_login'));
	
	$_SESSION['foto'] = $foto;

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, BASE_URL . 'profil/', 'Berhasil', 'Berhasil mengubah foto profil.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, BASE_URL . 'profil/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}
?>