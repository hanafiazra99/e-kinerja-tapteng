<?php
function page_title()
{
    return 'Sasaran Bawahan';
}

function portal_id()
{
    return '31';
}

function check_status($koneksi, $table, $id)
{
    $data = req_get_where($koneksi, $table, 'id = "' . $id . '"');

    if ($data['status'] == '2') {
        $data = array($id, '3', date("Y-m-d H:i:s"));
        $field = array('id', 'status', 'tr');
        submit_data($koneksi, $data, $field, $table);
    }
}

if (isset($_POST['TombolVerifikasiSasaran'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    if ($_POST['tindakan'] == 'Ditolak') {
        $data = array($_POST['id'], '5', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran'));
    } else {
        $data = array($_POST['id'], '4');
        $field = array('id', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran'));

        $data_sasaran = req_get_where($koneksi, 'skp_sasaran', 'id = "' . $_POST['id'] . '"');
        $data_h = req_get_where($koneksi, 'cv_helper_skp', 'id = "' . $data_sasaran['pegawai'] . '"');
        $data_pegawai = req_get_where($koneksi, 'pegawai', 'id = "' . $data_h['id'] . '"');
        $data_pegawai_jabatan = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $data_h['id'] . '"');
        $data_pegawai_pgr = req_get_where($koneksi, 'pegawai_pgr', 'id = "' . $data_h['id'] . '"');
        $data_pp = req_get_where($koneksi, 'pegawai', 'id = "' . $data_h['pp'] . '"');
        $data_pp_jabatan = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $data_h['pp'] . '"');
        $data_pp_pgr = req_get_where($koneksi, 'pegawai_pgr', 'id = "' . $data_h['pp'] . '"');
        $data_app = req_get_where($koneksi, 'pegawai', 'id = "' . $data_h['app'] . '"');
        $data_app_jabatan = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $data_h['app'] . '"');
        $data_app_pgr = req_get_where($koneksi, 'pegawai_pgr', 'id = "' . $data_h['app'] . '"');

        $data = array($_POST['id'], $data_pegawai['id'], $data_pp['id'], $data_app['id'], $data_pegawai_pgr['pgr'], $data_pp_pgr['pgr'], $data_app_pgr['pgr'], $data_pegawai_jabatan['nama_jabatan'], $data_pp_jabatan['nama_jabatan'], $data_app_jabatan['nama_jabatan'], $data_pegawai['opd'], $data_pp['opd'], $data_app['opd']);
        $field = array('id', 'pegawai', 'pp', 'app', 'pegawai_pgr', 'pp_pgr', 'app_pgr', 'pegawai_jabatan', 'pp_jabatan', 'app_jabatan', 'pegawai_opd', 'pp_opd', 'app_opd');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_ttd'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran-bawahan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran-bawahan/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiSasaranBulanan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data_sasaran_bulanan = req_get_where($koneksi, 'skp_sasaran_bulanan', 'id = "' . $_POST['id'] . '"');
    $data_sasaran = req_get_where($koneksi, 'skp_sasaran', 'id = "' . $data_sasaran_bulanan['sasaran'] . '"');

    if ($_POST['tindakan'] == 'Ditolak') {
        $data = array($_POST['id'], '5', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_bulanan'));
    } else {
        $data = array($_POST['id'], '4');
        $field = array('id', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_bulanan'));

        $data_h = req_get_where($koneksi, 'cv_helper_skp', 'id = "' . $data_sasaran['pegawai'] . '"');
        $data_pegawai = req_get_where($koneksi, 'pegawai', 'id = "' . $data_h['id'] . '"');
        $data_pegawai_jabatan = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $data_h['id'] . '"');
        $data_pegawai_pgr = req_get_where($koneksi, 'pegawai_pgr', 'id = "' . $data_h['id'] . '"');
        $data_pp = req_get_where($koneksi, 'pegawai', 'id = "' . $data_h['pp'] . '"');
        $data_pp_jabatan = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $data_h['pp'] . '"');
        $data_pp_pgr = req_get_where($koneksi, 'pegawai_pgr', 'id = "' . $data_h['pp'] . '"');
        $data_app = req_get_where($koneksi, 'pegawai', 'id = "' . $data_h['app'] . '"');
        $data_app_jabatan = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $data_h['app'] . '"');
        $data_app_pgr = req_get_where($koneksi, 'pegawai_pgr', 'id = "' . $data_h['app'] . '"');

        $data = array($_POST['id'], $data_pegawai['id'], $data_pp['id'], $data_app['id'], $data_pegawai_pgr['pgr'], $data_pp_pgr['pgr'], $data_app_pgr['pgr'], $data_pegawai_jabatan['nama_jabatan'], $data_pp_jabatan['nama_jabatan'], $data_app_jabatan['nama_jabatan'], $data_pegawai['opd'], $data_pp['opd'], $data_app['opd']);
        $field = array('id', 'pegawai', 'pp', 'app', 'pegawai_pgr', 'pp_pgr', 'app_pgr', 'pegawai_jabatan', 'pp_jabatan', 'app_jabatan', 'pegawai_opd', 'pp_opd', 'app_opd');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_bulanan_ttd'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran-bawahan/' . $data_sasaran['id'] . '/bulanan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran-bawahan/' . $data_sasaran['id'] . '/bulanan/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}
