<?php
function page_title()
{
    return 'Profil OPD';
}

function portal_id()
{
    return '18';
}

if (isset($_POST['TombolSuntingOPD'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = $_POST['id'];
    $data = array($id, $_POST['nama'], $_POST['tlp'], $_POST['email'], $_POST['alamat']);
    $field = array('id', 'nama', 'tlp', 'email', 'alamat');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'opd'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Berhasil', 'Berhasil mengubah OPD.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} elseif (isset($_POST['TombolTambahUnitOrganisasi'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('U', 'O');
    $data = array($id, $_POST['opd'], $_POST['nama'], $_POST['tlp'], $_POST['email'], $_POST['alamat']);
    $field = array('id', 'opd', 'nama', 'tlp', 'email', 'alamat');
    array_push($proses_check, tambah_data($koneksi, $data, $field, 'opd_unit_organisasi'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Berhasil', 'Berhasil menambah Unit Organisasi.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} elseif (isset($_POST['TombolSuntingUnitOrganisasi'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = array($_POST['id'], $_POST['opd'], $_POST['nama'], $_POST['tlp'], $_POST['email'], $_POST['alamat']);
    $field = array('id', 'opd', 'nama', 'tlp', 'email', 'alamat');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'opd_unit_organisasi'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Berhasil', 'Berhasil mengubah Unit Organisasi.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} elseif (isset($_POST['TombolHapusUnitOrganisasi'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = req_get_where($koneksi, 'opd_unit_organisasi', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'opd_unit_organisasi'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Berhasil', 'Berhasil menghapus Unit Organisasi.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} elseif (isset($_POST['TombolTambahStrukturOrganisasi'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('S', 'O');
    $data = array($id, $_POST['opd'], $_POST['nama_jabatan'], $_POST['atasan'], $_POST['kelas_jabatan']);
    $field = array('id', 'opd', 'nama_jabatan', 'atasan', 'kelas_jabatan');
    array_push($proses_check, tambah_data($koneksi, $data, $field, 'opd_struktur_organisasi'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Berhasil', 'Berhasil menambah Struktur Organisasi.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} elseif (isset($_POST['TombolSuntingStrukturOrganisasi'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = array($_POST['id'], $_POST['opd'], $_POST['nama_jabatan'], $_POST['atasan'], $_POST['kelas_jabatan']);
    $field = array('id', 'opd', 'nama_jabatan', 'atasan', 'kelas_jabatan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'opd_struktur_organisasi'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Berhasil', 'Berhasil mengubah Struktur Organisasi.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} elseif (isset($_POST['TombolHapusStrukturOrganisasi'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'opd_struktur_organisasi'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Berhasil', 'Berhasil menghapus Struktur Organisasi.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'profil-opd/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} elseif (isset($_POST['req'])) {
    if ($_POST['req'] == 'Change Select') {
        require "../../app/config.php";
        require "../../app/models.php";
        require "../../app/autentikasi.php";
        require "../../app/component.php";

        echo component_select_option_response_ajax($koneksi, $_POST['table'], $_POST['id'], $_POST['data'], $_POST['where']);
    } elseif ($_POST['req'] == 'Modal Konfirmasi') {
        require "../../app/config.php";
        require "../../app/models.php";
        require "../../app/component.php";

        modal_konfirmasi($_POST['judul'], $_POST['form'], SIMPEG_URL . 'controllers/c-profil-opd.php', $_POST['pertanyaan'], $_POST['parameter'], $_POST['data']);
    }
}
