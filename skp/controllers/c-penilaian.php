<?php
function page_title()
{
    return 'Penilaian';
}

function portal_id()
{
    return '30';
}

if (isset($_POST['TombolSuntingPenilaianBulanan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = array($_POST['data_pengenal'], $_POST['data_diganti']);
    $field = array($_POST['parameter_pengenal'], $_POST['parameter_diganti']);
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_penilaian_bulanan_kegiatan'));

    $data_sasaran_bulanan_kegiatan = req_get_where($koneksi, 'skp_sasaran_bulanan_kegiatan', 'id = "' . $_POST['data_pengenal'] . '"');
    $data_sasaran_bulanan = req_get_where($koneksi, 'skp_sasaran_bulanan', 'id = "' . $data_sasaran_bulanan_kegiatan['sasaran_bulanan'] . '"');

    $data = array($data_sasaran_bulanan['id'], 'NULL', 'NULL', '1');
    $field = array('id', 'ts', 'tr', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_penilaian_bulanan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'penilaian/' . $data_sasaran_bulanan['sasaran'] . '/bulanan/' . $data_sasaran_bulanan['id'] . '/', 'Berhasil', 'Berhasil Mengubah Nilai.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'penilaian/' . $data_sasaran_bulanan['sasaran'] . '/bulanan/' . $data_sasaran_bulanan['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSampaikanPenilaianBulanan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data_sasaran_bulanan = req_get_where($koneksi, 'skp_sasaran_bulanan', 'id = "' . $_POST['data'] . '"');

    $data = array($_POST['data'], date("Y-m-d H:i:s"), '2');
    $field = array('id', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_penilaian_bulanan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'penilaian/' . $data_sasaran_bulanan['sasaran'] . '/bulanan/' . $data_sasaran_bulanan['id'] . '/', 'Berhasil', 'Berhasil menyerahkan Penilaian Bulanan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'penilaian/' . $data_sasaran_bulanan['sasaran'] . '/bulanan/' . $data_sasaran_bulanan['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSampaikanPenilaian'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data_sasaran_bulanan = req_get_where($koneksi, 'skp_sasaran_bulanan', 'id = "' . $_POST['data'] . '"');

    $data = array($_POST['data'], date("Y-m-d H:i:s"), '2');
    $field = array('id', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_penilaian'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'penilaian/' . $data_sasaran_bulanan['sasaran'] . '/bulanan/' . $data_sasaran_bulanan['id'] . '/', 'Berhasil', 'Berhasil menyerahkan Penilaian Bulanan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'penilaian/' . $data_sasaran_bulanan['sasaran'] . '/bulanan/' . $data_sasaran_bulanan['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
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

        modal_konfirmasi($_POST['judul'], $_POST['form'], SKP_URL . 'controllers/c-penilaian.php', $_POST['pertanyaan'], $_POST['parameter'], $_POST['data']);
    } else if ($_POST['req'] == 'Modal Sunting Data') {
        require "../../app/config.php";
        require "../../app/models.php";
        require "../../app/component.php";

        modal_sunting_data($_POST['judul'], $_POST['form'], SKP_URL . 'controllers/c-penilaian.php', $_POST['parameter_pengenal'], $_POST['data_pengenal'], $_POST['parameter_diganti'], $_POST['data_diganti'], $_POST['field']);
    }
}
