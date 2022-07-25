<?php
function page_title()
{
    return 'Pengaturan';
}

function portal_id()
{
    return '34';
}

if (isset($_POST['TombolSuntingPersentase'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['persentase_tpp_maksimal']);
    $field = array('id', 'persentase_tpp_maksimal');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'tpp_pengaturan_persentase'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Berhasil', 'Berhasil mengubah persentase.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}else if (isset($_POST['TombolSuntingIndikatorPenilaianSasaranKerja'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['batas_bawah'], $_POST['batas_atas'],$_POST['bobot']);
    $field = array('id', 'batas_bawah','batas_atas','bobot');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'tpp_pengaturan_indikator_penilaian_sasaran_kerja'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Berhasil', 'Berhasil mengubah pengaturan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}else if (isset($_POST['TombolSuntingIndikatorWaktuPenilaianSasaranKerja'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['batas_bawah'], $_POST['batas_atas'],$_POST['bobot']);
    $field = array('id', 'batas_bawah','batas_atas','bobot');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'tpp_pengaturan_indikator_ketepatan_waktu_sasaran_kerja'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Berhasil', 'Berhasil mengubah pengaturan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}else if (isset($_POST['TombolSuntingIndikatorKetepatanMasukKerja'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['batas_bawah'], $_POST['batas_atas'],$_POST['bobot']);
    $field = array('id', 'batas_bawah','batas_atas','bobot');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'tpp_pengaturan_indikator_ketepatan_masuk_kerja'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Berhasil', 'Berhasil mengubah pengaturan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}else if (isset($_POST['TombolSuntingIndikatorKetepatanPulangKerja'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['batas_bawah'], $_POST['batas_atas'],$_POST['bobot']);
    $field = array('id', 'batas_bawah','batas_atas','bobot');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'tpp_pengaturan_indikator_ketepatan_pulang_kerja'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Berhasil', 'Berhasil mengubah pengaturan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}else if (isset($_POST['TombolSuntingIndikatorHukumanDisiplin'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['batas_bawah'], $_POST['batas_atas'],$_POST['bobot']);
    $field = array('id', 'batas_bawah','batas_atas','bobot');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'tpp_pengaturan_indikator_hukuman_disiplin'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Berhasil', 'Berhasil mengubah pengaturan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}else if (isset($_POST['TombolSuntingIndikatorTidakHadirKerja'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['batas_bawah'], $_POST['batas_atas'],$_POST['bobot']);
    $field = array('id', 'batas_bawah','batas_atas','bobot');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'tpp_pengaturan_indikator_tidak_hadir_kerja'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Berhasil', 'Berhasil mengubah pengaturan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, TPP_URL . 'pengaturan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}