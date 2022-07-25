<?php
function page_title()
{
    return 'Akun';
}

function page_id()
{
    return '2';
}

if (isset($_POST['TombolTambahUser'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('U', 'R');
    $password = get_password($_POST['password']);

    $data = array($id, $_POST['nama'], $_POST['tlp'], $_POST['email'], $_POST['alamat'], $_POST['opd'], $_POST['unit_organisasi']);
    $field = array('id', 'nama', 'tlp', 'email', 'alamat', 'opd', 'unit_organisasi');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'user'));

    $data = array($id, $_POST['username'], $password, $_POST['role'], 'admin.png', 'y');
    $field = array('id', 'username', 'password', 'role', 'foto', 'soa');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'app_login'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, BASE_URL . 'akun/user/' . $id . '/sunting/', 'Berhasil', 'Berhasil mengubah identitas.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, BASE_URL . 'akun/user/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolUserSuntingIdentitas'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['nama'], $_POST['tlp'], $_POST['email'], $_POST['alamat']);
    $field = array('id', 'nama', 'tlp', 'email', 'alamat');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'user'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, BASE_URL . 'akun/user/' . $id . '/sunting/', 'Berhasil', 'Berhasil mengubah identitas.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, BASE_URL . 'akun/user/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolUserSuntingUsername'])) {
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
        pop_up_direct(BASE_URL, BASE_URL . 'akun/user/' . $_POST['id'] . '/sunting/', 'Berhasil', 'Berhasil mengubah username.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, BASE_URL . 'akun/user/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolUserSuntingPassword'])) {
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
        pop_up_direct(BASE_URL, BASE_URL . 'akun/user/' . $_POST['id'] . '/sunting/', 'Berhasil', 'Berhasil mengubah password.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, BASE_URL . 'akun/user/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolPegawaiSuntingUsername'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['username'], '100', 'admin.png');
    $field = array('id', 'username', 'role', 'foto');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'app_login'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, BASE_URL . 'akun/pegawai/' . $_POST['id'] . '/sunting/', 'Berhasil', 'Berhasil mengubah username.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, BASE_URL . 'akun/pegawai/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolPegawaiSuntingPassword'])) {
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
        pop_up_direct(BASE_URL, BASE_URL . 'akun/pegawai/' . $_POST['id'] . '/sunting/', 'Berhasil', 'Berhasil mengubah password.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, BASE_URL . 'akun/pegawai/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['req'])) {
    if ($_POST['req'] == 'Modal Konfirmasi') {
        require "../../app/config.php";
        require "../../app/models.php";
        require "../../app/component.php";

        modal_konfirmasi($_POST['judul'], $_POST['form'], SIMPEG_URL . 'controllers/c-pengaturan.php', $_POST['pertanyaan'], $_POST['parameter'], $_POST['data']);
    }
}
