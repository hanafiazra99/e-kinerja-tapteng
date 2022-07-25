<?php
function page_title()
{
    return 'OPD';
}

function portal_id()
{
    return '27';
}

if (isset($_POST['TombolSuntingBesaranTPP'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['besaran_tpp']);
    $field = array('id', 'besaran_tpp');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'opd_struktur_organisasi'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, TPP_URL . 'opd/' . $_POST['opd'] . '/', 'Berhasil', 'Berhasil mengubah besaran TPP.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, TPP_URL . 'opd/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahTugasTambahan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array(get_id('T', 'T'), $_POST['id_nama_jabatan'], $_POST['tugas_tambahan']);
    $field = array('id', 'nama_jabatan', 'tugas_tambahan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'opd_struktur_organisasi_tugas_tambahan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, TPP_URL . 'opd/' . $_POST['opd'] . '/' . $_POST['id_nama_jabatan'] . '/', 'Berhasil', 'Berhasil menambah tugas tambahan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, TPP_URL . 'opd/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingTugasTambahan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['id_nama_jabatan'], $_POST['tugas_tambahan']);
    $field = array('id', 'nama_jabatan', 'tugas_tambahan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'opd_struktur_organisasi_tugas_tambahan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, TPP_URL . 'opd/' . $_POST['opd'] . '/' . $_POST['id_nama_jabatan'] . '/', 'Berhasil', 'Berhasil mengubah tugas tambahan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, TPP_URL . 'opd/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusTugasTambahan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data_1 = req_get_where($koneksi, 'opd_struktur_organisasi_tugas_tambahan', 'id = "' . $_POST['data'] . '"');
    $data = req_get_where($koneksi, 'opd_struktur_organisasi', 'id = "' . $data_1['nama_jabatan'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'opd_struktur_organisasi_tugas_tambahan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, TPP_URL . 'opd/' . $data['opd'] . '/' . $data['id'] . '/', 'Berhasil', 'Berhasil menghapus Tugas Tambahan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, TPP_URL . 'opd/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['req'])) {
    if ($_POST['req'] == 'Change Select') {
        require "../../app/config.php";
        require "../../app/models.php";
        require "../../app/autentikasi.php";
        require "../../app/component.php";

        echo component_select_option_response_ajax($koneksi, $_POST['table'], $_POST['id'], $_POST['data'], $_POST['where']);
    } else if ($_POST['req'] == 'Modal Konfirmasi') {
        require "../../app/config.php";
        require "../../app/models.php";
        require "../../app/component.php";

        modal_konfirmasi($_POST['judul'], $_POST['form'], TPP_URL . 'controllers/c-opd.php', $_POST['pertanyaan'], $_POST['parameter'], $_POST['data']);
    }
}
