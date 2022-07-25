<?php
function page_title()
{
    return 'Layanan Kepegawaian';
}

function portal_id()
{
    return '11';
}

function check_status($koneksi, $table, $id)
{
    $data = req_get_where($koneksi, $table, 'id = "' . $id . '"');

    if ($data['status'] == 'Dikirim') {
        $data = array($id, 'Diperiksa', date("Y-m-d H:i:s"));
        $field = array('id', 'status', 'tr');
        submit_data($koneksi, $data, $field, $table);
    }
}

if (isset($_POST['TombolTambahMutasiJabatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk_jabatan']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk_jabatan']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk_jabatan"]["tmp_name"], $path . $nama_file)) {
            $file_sk_jabatan = $nama_file;
        } else {
            $file_sk_jabatan = '';
        }
    } else {
        $file_sk_jabatan = '';
    }

    if ($_FILES['file_sk_pelantikan']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk_pelantikan']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk_pelantikan"]["tmp_name"], $path . $nama_file)) {
            $file_sk_pelantikan = $nama_file;
        } else {
            $file_sk_pelantikan = '';
        }
    } else {
        $file_sk_pelantikan = '';
    }

    $data_p = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['pegawai'] . '"');
    $data = array($id, $data_p['opd'], $_POST['pegawai'], $_POST['opd_baru'], $_POST['unit_organisasi_baru'], $_POST['pym'], $_POST['no_sk_jabatan'], $_POST['tgl_sk_jabatan'], $_POST['jenis_jabatan'], $_POST['eselon'], $_POST['jabatan_baru'], $_POST['tmt'], $_POST['no_sk_pelantikan'], $_POST['tgl_sk_pelantikan'], $_POST['sumpah'], $file_sk_jabatan, $file_sk_pelantikan, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'opd_asal', 'pegawai', 'opd', 'unit_organisasi', 'pym', 'no_sk_jabatan', 'tgl_sk_jabatan', 'jenis_jabatan', 'eselon', 'nama_jabatan', 'tmt', 'no_sk_pelantikan', 'tgl_sk_pelantikan', 'sumpah', 'file_sk_jabatan', 'file_sk_pelantikan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_jabatan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-jabatan/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-jabatan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingMutasiJabatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = $_POST['id'];
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk_jabatan']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk_jabatan']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk_jabatan"]["tmp_name"], $path . $nama_file)) {
            $file_sk_jabatan = $nama_file;
        } else {
            $file_sk_jabatan = $_POST['file_sk_jabatan_l'];
        }
    } else {
        $file_sk_jabatan = $_POST['file_sk_jabatan_l'];
    }

    if ($_FILES['file_sk_pelantikan']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk_pelantikan']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk_pelantikan"]["tmp_name"], $path . $nama_file)) {
            $file_sk_pelantikan = $nama_file;
        } else {
            $file_sk_pelantikan = $_POST['file_sk_pelantikan_l'];
        }
    } else {
        $file_sk_pelantikan = $_POST['file_sk_pelantikan_l'];
    }

    $data_p = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['pegawai'] . '"');
    $data = array($id, $data_p['opd'], $_POST['pegawai'], $_POST['opd_baru'], $_POST['unit_organisasi_baru'], $_POST['pym'], $_POST['no_sk_jabatan'], $_POST['tgl_sk_jabatan'], $_POST['jenis_jabatan'], $_POST['eselon'], $_POST['jabatan_baru'], $_POST['tmt'], $_POST['no_sk_pelantikan'], $_POST['tgl_sk_pelantikan'], $_POST['sumpah'], $file_sk_jabatan, $file_sk_pelantikan, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'opd_asal', 'pegawai', 'opd', 'unit_organisasi', 'pym', 'no_sk_jabatan', 'tgl_sk_jabatan', 'jenis_jabatan', 'eselon', 'nama_jabatan', 'tmt', 'no_sk_pelantikan', 'tgl_sk_pelantikan', 'sumpah', 'file_sk_jabatan', 'file_sk_pelantikan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_jabatan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-jabatan/' . $id . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-jabatan/' . $id . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusMutasiJabatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data1 = req_get_where($koneksi, 'simpeg_lp_mutasi_jabatan', 'id = "' . $_POST['data'] . '"');
    $data2 = req_get_where($koneksi, 'pegawai_riwayat_jabatan', 'id = "' . $data1['old'] . '"');
    $data3 = req_get_where($koneksi, 'opd_struktur_organisasi', 'nama_jabatan = "' . $data2['nama_jabatan'] . '"');

    $data = array($data1['pegawai'], $data2['pym'], $data2['no_sk_jabatan'], $data2['tgl_sk_jabatan'], $data2['jenis_jabatan'], $data2['eselon'], $data3['id'], $data2['tmt'], $data2['no_sk_pelantikan'], $data2['tgl_sk_pelantikan'], '1', $data2['file_sk_jabatan'], $data2['file_sk_pelantikan']);
    $field = array('id', 'pym', 'no_sk_jabatan', 'tgl_sk_jabatan', 'jenis_jabatan', 'eselon', 'nama_jabatan', 'tmt', 'no_sk_pelantikan', 'tgl_sk_pelantikan', 'sumpah', 'file_sk_jabatan', 'file_sk_pelantikan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_jabatan'));

    $data = array($data1['pegawai'], $data1['opd_asal']);
    $field = array('id', 'opd');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    array_push($proses_check, hapus_data($koneksi, $data1['old'], 'id', 'pegawai_riwayat_jabatan'));
    array_push($proses_check, hapus_data($koneksi, $data1['id'], 'id', 'simpeg_lp_mutasi_jabatan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-jabatan/', 'Berhasil', 'Berhasil menghapus data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-jabatan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiMutasiJabatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    if ($_POST['tindakan'] == 'Tidak Setuju') {
        $data = array($_POST['id'], 'Ditolak', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_jabatan'));
    } else {
        $id_riwayat = get_id('D', 'R');
        $data1 = req_get_where($koneksi, 'simpeg_lp_mutasi_jabatan', 'id = "' . $_POST['id'] . '"');
        $data2 = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $data1['pegawai'] . '"');
        $data3 = req_get_where($koneksi, 'opd_struktur_organisasi', 'id = "' . $data2['nama_jabatan'] . '"');

        $data = array($id_riwayat, $data2['id'], $data2['pym'], $data2['no_sk_jabatan'], $data2['tgl_sk_jabatan'], $data2['jenis_jabatan'], $data2['eselon'], $data3['nama_jabatan'], $data2['tmt'], $data2['no_sk_pelantikan'], $data2['tgl_sk_pelantikan'], $data3['opd'], $data2['file_sk_jabatan'], $data2['file_sk_pelantikan']);
        $field = array('id', 'pegawai', 'pym', 'no_sk_jabatan', 'tgl_sk_jabatan', 'jenis_jabatan', 'eselon', 'nama_jabatan', 'tmt', 'no_sk_pelantikan', 'tgl_sk_pelantikan', 'opd', 'file_sk_jabatan', 'file_sk_pelantikan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_jabatan'));

        $data = array($data1['pegawai'], $data1['pym'], $data1['no_sk_jabatan'], $data1['tgl_sk_jabatan'], $data1['jenis_jabatan'], $data1['eselon'], $data1['nama_jabatan'], $data1['tmt'], $data1['no_sk_pelantikan'], $data1['tgl_sk_pelantikan'], $data1['sumpah'], $data1['file_sk_jabatan'], $data1['file_sk_pelantikan']);
        $field = array('id', 'pym', 'no_sk_jabatan', 'tgl_sk_jabatan', 'jenis_jabatan', 'eselon', 'nama_jabatan', 'tmt', 'no_sk_pelantikan', 'tgl_sk_pelantikan', 'sumpah', 'file_sk_jabatan', 'file_sk_pelantikan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_jabatan'));

        $data = array($data1['pegawai'], $data1['opd'], $data1['unit_organisasi']);
        $field = array('id', 'opd', 'unit_organisasi');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

        $data = array($_POST['id'], $id_riwayat, 'Disetujui');
        $field = array('id', 'old', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_jabatan'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-jabatan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-jabatan/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahMutasiMasukDaerah'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $id_pegawai = get_id('P', 'I');
    $path = cek_folder('../../resources/dokumen/' . $id_pegawai . '/');

    if ($_FILES['file_sk_perpindahan']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk_perpindahan']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk_perpindahan"]["tmp_name"], $path . $nama_file)) {
            $file_sk_perpindahan = $nama_file;
        } else {
            $file_sk_perpindahan = '';
        }
    } else {
        $file_sk_perpindahan = '';
    }

    if ($_FILES['file_sk_penempatan']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk_penempatan']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk_penempatan"]["tmp_name"], $path . $nama_file)) {
            $file_sk_penempatan = $nama_file;
        } else {
            $file_sk_penempatan = '';
        }
    } else {
        $file_sk_penempatan = '';
    }

    $data = array($id, $_POST['jenis_instansi'], $_POST['instansi'], $id_pegawai, $_POST['pym_perpindahan'], $_POST['no_sk_perpindahan'], $_POST['tgl_sk_perpindahan'], $_POST['tmt_perpindahan'], $_POST['pym_penempatan'], $_POST['no_sk_penempatan'], $_POST['tgl_sk_penempatan'], $_POST['tmt_penempatan'], $file_sk_perpindahan, $file_sk_penempatan, $_POST['nip'], $_POST['nama'], $_POST['pgr'], $_POST['nama_jabatan'], $_POST['opd'], date("Y-m-d H:i:s"));
    $field = array('id', 'jenis_instansi', 'instansi', 'pegawai', 'pym_perpindahan', 'no_sk_perpindahan', 'tgl_sk_perpindahan', 'tmt_perpindahan', 'pym_penempatan', 'no_sk_penempatan', 'tgl_sk_penempatan', 'tmt_penempatan', 'file_sk_perpindahan', 'file_sk_penempatan', 'nip', 'nama', 'pgr', 'jabatan', 'opd', 'tt');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_masuk_daerah'));

    $data = array($id_pegawai, $_POST['nama'], '1', '1', $_POST['opd']);
    $field = array('id', 'nama', 'status_kepegawaian', 'kedudukan_pegawai', 'opd');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    $data = array($id_pegawai, $_POST['nip']);
    $field = array('id', 'nip');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_asn'));

    $data = array($id_pegawai, $_POST['pgr']);
    $field = array('id', 'pgr');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pgr'));

    $data = array($id_pegawai, $_POST['nama_jabatan']);
    $field = array('id', 'nama_jabatan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_jabatan'));

    $data = array($id_pegawai, $_POST['username'], get_password($_POST['password']), '100', 'admin.png', 'y');
    $field = array('id', 'username', 'password', 'role', 'foto', 'soa');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'app_login'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-masuk-antar-daerah/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-masuk-antar-daerah/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahMutasiKeluarDaerah'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = '';
        }
    } else {
        $file_sk = '';
    }

    $data = array($id, $_POST['opd'], $_POST['pegawai'], $_POST['jenis_instansi'], $_POST['instansi'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['tmt'], $file_sk, date("Y-m-d H:i:s"));
    $field = array('id', 'opd_asal', 'pegawai', 'jenis_instansi', 'instansi', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'file_sk', 'tt');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_keluar_daerah'));

    $data_p = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['pegawai'] . '"');
    $data_kedudukan = req_get_where($koneksi, 'ref_kedudukan_pegawai', 'status_kepegawaian = "' . $data_p['status_kepegawaian'] . '" AND label = "Pindah Instansi"');

    $data = array($_POST['pegawai'], $data_kedudukan['id']);
    $field = array('id', 'kedudukan_pegawai');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-keluar-antar-daerah/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-keluar-antar-daerah/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingMutasiKeluarDaerah'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = $_POST['id'];
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = $_POST['file_sk_lama'];
        }
    } else {
        $file_sk = $_POST['file_sk_lama'];
    }

    $data = req_get_where($koneksi, 'simpeg_lp_mutasi_keluar_daerah', 'id = "' . $id . '"');
    $data_p = req_get_where($koneksi, 'pegawai', 'id = "' . $data['pegawai'] . '"');
    $data_kedudukan = req_get_where($koneksi, 'ref_kedudukan_pegawai', 'status_kepegawaian = "' . $data_p['status_kepegawaian'] . '" AND label = "Aktif"');

    $data = array($data['pegawai'], $data_kedudukan['id']);
    $field = array('id', 'kedudukan_pegawai');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    $data = array($id, $_POST['opd'], $_POST['pegawai'], $_POST['jenis_instansi'], $_POST['instansi'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['tmt'], $file_sk, date("Y-m-d H:i:s"));
    $field = array('id', 'opd_asal', 'pegawai', 'jenis_instansi', 'instansi', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'file_sk', 'tt');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_keluar_daerah'));

    $data_p = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['pegawai'] . '"');
    $data_kedudukan = req_get_where($koneksi, 'ref_kedudukan_pegawai', 'status_kepegawaian = "' . $data_p['status_kepegawaian'] . '" AND label = "Pindah Instansi"');

    $data = array($_POST['pegawai'], $data_kedudukan['id']);
    $field = array('id', 'kedudukan_pegawai');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-keluar-antar-daerah/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-keluar-antar-daerah/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusMutasiKeluarDaerah'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = req_get_where($koneksi, 'simpeg_lp_mutasi_keluar_daerah', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'simpeg_lp_mutasi_keluar_daerah'));

    $data_p = req_get_where($koneksi, 'pegawai', 'id = "' . $data['pegawai'] . '"');
    $data_kedudukan = req_get_where($koneksi, 'ref_kedudukan_pegawai', 'status_kepegawaian = "' . $data_p['status_kepegawaian'] . '" AND label = "Aktif"');

    $data = array($data['pegawai'], $data_kedudukan['id']);
    $field = array('id', 'kedudukan_pegawai');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-keluar-antar-daerah/', 'Berhasil', 'Berhasil menghapus data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pkmj/mutasi-keluar-antar-daerah/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahMutasiKepangkatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = '';
        }
    } else {
        $file_sk = '';
    }

    $data_p = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['pegawai'] . '"');
    $data_q = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $_POST['pegawai'] . '"');
    $data = array($id, $data_p['opd'], $_POST['pegawai'], $data_q['nama_jabatan'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['pgr'], $_POST['tmt'], $file_sk, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'opd_asal', 'pegawai', 'jabatan', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'file_sk', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_pgr'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/kepangkatan/mutasi-kepangkatan/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/kepangkatan/mutasi-kepangkatan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiMutasiKepangkatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    if ($_POST['tindakan'] == 'Tidak Setuju') {
        $data = array($_POST['id'], 'Ditolak', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_pgr'));
    } else {
        $id_riwayat = get_id('D', 'R');
        $data1 = req_get_where($koneksi, 'simpeg_lp_mutasi_pgr', 'id = "' . $_POST['id'] . '"');
        $data2 = req_get_where($koneksi, 'pegawai_pgr', 'id = "' . $data1['pegawai'] . '"');

        $data = array($id_riwayat, $data2['id'], $data2['pym'], $data2['no_sk'], $data2['tgl_sk'], $data2['pgr'], $data2['tmt'], $data2['file_sk']);
        $field = array('id', 'pegawai', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'file_sk');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_pgr'));

        $data = array($data1['pegawai'], $data1['pym'], $data1['no_sk'], $data1['tgl_sk'], $data1['pgr'], $data1['tmt'], $data1['file_sk']);
        $field = array('id', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'file_sk');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pgr'));

        $data = array($_POST['id'], $id_riwayat, 'Disetujui');
        $field = array('id', 'old', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_pgr'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/kepangkatan/mutasi-kepangkatan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/kepangkatan/mutasi-kepangkatan/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahMutasiGajiBerkala'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = '';
        }
    } else {
        $file_sk = '';
    }

    $masa_kerja = ($_POST['masa_kerja_tahun'] * 12) + $_POST['masa_kerja_bulan'];
    $data_p = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['pegawai'] . '"');
    $data = array($id, $data_p['opd'], $_POST['pegawai'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['tmt'], $masa_kerja, $_POST['kantor_pembayaran'], $file_sk, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'opd_asal', 'pegawai', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'masa_kerja', 'kantor_pembayaran', 'file_sk', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_kgb'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/kepangkatan/mutasi-gaji-berkala/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/kepangkatan/mutasi-gaji-berkala/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiMutasiGajiBerkala'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    if ($_POST['tindakan'] == 'Tidak Setuju') {
        $data = array($_POST['id'], 'Ditolak', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_kgb'));
    } else {
        $id_riwayat = get_id('D', 'R');
        $data1 = req_get_where($koneksi, 'simpeg_lp_mutasi_kgb', 'id = "' . $_POST['id'] . '"');
        $data2 = req_get_where($koneksi, 'pegawai_kgb', 'id = "' . $data1['pegawai'] . '"');

        $data = array($id_riwayat, $data2['id'], $data2['pym'], $data2['no_sk'], $data2['tgl_sk'], $data2['tmt'], $data2['masa_kerja'], $data2['kantor_pembayaran'], $data2['file_sk']);
        $field = array('id', 'pegawai', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'masa_kerja', 'kantor_pembayaran', 'file_sk');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_kgb'));

        $data = array($data1['pegawai'], $data1['pym'], $data1['no_sk'], $data1['tgl_sk'], $data1['tmt'], $data1['masa_kerja'], $data1['kantor_pembayaran'], $data1['file_sk']);
        $field = array('id', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'masa_kerja', 'kantor_pembayaran', 'file_sk');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_kgb'));

        $data = array($_POST['id'], $id_riwayat, 'Disetujui');
        $field = array('id', 'old', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_mutasi_kgb'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/kepangkatan/mutasi-gaji-berkala/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/kepangkatan/mutasi-gaji-berkala/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahIzinBelajar'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = '';
        }
    } else {
        $file_sk = '';
    }

    $data = array($id, $_POST['opd'], $_POST['pegawai'], $_POST['tingkat_pendidikan'], $_POST['institusi'], $_POST['pyb'], $_POST['no_sk'], $_POST['tgl_sk'], $file_sk, $_POST['keterangan'], date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'opd_asal', 'pegawai', 'tingkat_pendidikan', 'institusi', 'pyb', 'no_sk', 'tgl_sk', 'file_sk', 'keterangan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_izin_belajar'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/izin-belajar/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/izin-belajar/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiIzinBelajar'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    if ($_POST['tindakan'] == 'Tidak Setuju') {
        $data = array($_POST['id'], 'Ditolak', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_izin_belajar'));
    } else {
        $id_riwayat = get_id('D', 'R');
        $data1 = req_get_where($koneksi, 'simpeg_lp_izin_belajar', 'id = "' . $_POST['id'] . '"');

        $data = array($data1['pegawai'], '21');
        $field = array('id', 'kedudukan_pegawai');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

        $data = array($_POST['id'], 'Disetujui');
        $field = array('id', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_izin_belajar'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/izin-belajar/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/izin-belajar/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahPenyesuaianIjazah'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sttb']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sttb']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sttb"]["tmp_name"], $path . $nama_file)) {
            $file_sttb = $nama_file;
        } else {
            $file_sttb = '';
        }
    } else {
        $file_sttb = '';
    }

    $data = array($id, $_POST['opd'], $_POST['pegawai'], $_POST['tingkat_pendidikan'], $_POST['jurusan'], $_POST['nama_institusi'], $_POST['nama_kepala_institusi'], $_POST['no_sttb'], $_POST['tgl_sttb'], $file_sttb, $_POST['keterangan'], date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'opd_asal', 'pegawai', 'tingkat_pendidikan', 'jurusan', 'nama_institusi', 'nama_kepala_institusi', 'no_sttb', 'tgl_sttb', 'file_sttb', 'keterangan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_penyesuaian_ijazah'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/penyesuaian-ijazah/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/penyesuaian-ijazah/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiPenyesuaianIjazah'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    if ($_POST['tindakan'] == 'Tidak Setuju') {
        $data = array($_POST['id'], 'Ditolak', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_penyesuaian_ijazah'));
    } else {
        $id_riwayat = get_id('D', 'R');
        $data1 = req_get_where($koneksi, 'simpeg_lp_penyesuaian_ijazah', 'id = "' . $_POST['id'] . '"');

        $data = array($id_riwayat, $data1['pegawai'], $data1['tingkat_pendidikan'], $data1['jurusan'], $data1['nama_institusi'], $data1['nama_kepala_institusi'], $data1['no_sttb'], $data1['tgl_sttb'], $data1['file_sttb']);
        $field = array('id', 'pegawai', 'tingkat_pendidikan', 'jurusan', 'nama_institusi', 'nama_kepala_institusi', 'no_sttb', 'tgl_sttb', 'file_sttb');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_pendidikan_umum'));

        $data = array($_POST['id'], $id_riwayat, 'Disetujui');
        $field = array('id', 'recent', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_penyesuaian_ijazah'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/penyesuaian-ijazah/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/penyesuaian-ijazah/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahPencantumanGelar'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = '';
        }
    } else {
        $file_sk = '';
    }

    $data_p = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['pegawai'] . '"');
    $data = array($id, $_POST['opd'], $_POST['pegawai'], $data_p['gelar_depan'], $data_p['gelar_belakang'], $_POST['gelar_depan'], $_POST['gelar_belakang'], $_POST['pyb'], $_POST['no_sk'], $_POST['tgl_sk'], $file_sk, $_POST['keterangan'], date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'opd_asal', 'pegawai', 'gelar_depan_lama', 'gelar_belakang_lama', 'gelar_depan_baru', 'gelar_belakang_baru', 'pyb', 'no_sk', 'tgl_sk', 'file_sk', 'keterangan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_pencantuman_gelar'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/pencantuman-gelar/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/pencantuman-gelar/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiPencantumanGelar'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    if ($_POST['tindakan'] == 'Tidak Setuju') {
        $data = array($_POST['id'], 'Ditolak', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_pencantuman_gelar'));
    } else {
        $id_riwayat = get_id('D', 'R');
        $data1 = req_get_where($koneksi, 'simpeg_lp_pencantuman_gelar', 'id = "' . $_POST['id'] . '"');

        $data = array($data1['pegawai'], $data1['gelar_depan_baru'], $data1['gelar_belakang_baru']);
        $field = array('id', 'gelar_depan', 'gelar_belakang');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

        $data = array($_POST['id'], 'Disetujui');
        $field = array('id', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_pencantuman_gelar'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/pencantuman-gelar/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/pencantuman-gelar/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahTugasBelajar'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = '';
        }
    } else {
        $file_sk = '';
    }

    $data = array($id, $_POST['opd'], $_POST['pegawai'], $_POST['tingkat_pendidikan'], $_POST['institusi'], $_POST['pyb'], $_POST['no_sk'], $_POST['tgl_sk'], $file_sk, $_POST['keterangan'], date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'opd_asal', 'pegawai', 'tingkat_pendidikan', 'institusi', 'pyb', 'no_sk', 'tgl_sk', 'file_sk', 'keterangan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_tugas_belajar'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/tugas-belajar/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/tugas-belajar/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiTugasBelajar'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    if ($_POST['tindakan'] == 'Tidak Setuju') {
        $data = array($_POST['id'], 'Ditolak', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_tugas_belajar'));
    } else {
        $id_riwayat = get_id('D', 'R');
        $data1 = req_get_where($koneksi, 'simpeg_lp_tugas_belajar', 'id = "' . $_POST['id'] . '"');

        $data = array($data1['pegawai'], '3');
        $field = array('id', 'kedudukan_pegawai');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

        $data = array($_POST['id'], 'Disetujui');
        $field = array('id', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_tugas_belajar'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/tugas-belajar/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/tugas-belajar/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahDiklat'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = '';
        }
    } else {
        $file_sk = '';
    }

    if ($_FILES['file_sttpp']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sttpp']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sttpp"]["tmp_name"], $path . $nama_file)) {
            $file_sttpp = $nama_file;
        } else {
            $file_sttpp = '';
        }
    } else {
        $file_sttpp = '';
    }

    $data = array($id, $_POST['opd'], $_POST['pegawai'], $_POST['jenis_diklat'], $_POST['nama_diklat'], $_POST['penyelenggara'], $_POST['angkatan'], $_POST['lama_pendidikan_h'], $_POST['lama_pendidikan_j'], $_POST['no_sttpp'], $_POST['tgl_sttpp'], $file_sttpp, $_POST['pyb'], $_POST['no_sk'], $_POST['tgl_sk'], $file_sk, $_POST['keterangan'], date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'opd_asal', 'pegawai', 'jenis_diklat', 'nama_diklat', 'penyelenggara', 'angkatan', 'lama_pendidikan_h', 'lama_pendidikan_j', 'no_sttpp', 'tgl_sttpp', 'file_sttpp', 'pyb', 'no_sk', 'tgl_sk', 'file_sk', 'keterangan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_diklat'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/diklat/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/diklat/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiDiklat'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    if ($_POST['tindakan'] == 'Tidak Setuju') {
        $data = array($_POST['id'], 'Ditolak', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_diklat'));
    } else {
        $id_riwayat = get_id('D', 'R');
        $data1 = req_get_where($koneksi, 'simpeg_lp_diklat', 'id = "' . $_POST['id'] . '"');

        $data = array($id_riwayat, $data1['pegawai'], $data1['jenis_diklat'], $data1['nama_diklat'], $data1['penyelenggara'], $data1['angkatan'], $data1['lama_pendidikan_h'], $data1['lama_pendidikan_j'], $data1['no_sttpp'], $data1['tgl_sttpp'], $data1['file_sttpp']);
        $field = array('id', 'pegawai', 'jenis_diklat', 'nama_diklat', 'penyelenggara', 'angkatan', 'lama_pendidikan_h', 'lama_pendidikan_j', 'no_sttpp', 'tgl_sttpp', 'file_sttpp');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_diklat'));

        $data = array($_POST['id'], $id_riwayat, 'Disetujui');
        $field = array('id', 'recent', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_diklat'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/diklat/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/pendidikan-pelatihan/diklat/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahHukumanDisiplin'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = '';
        }
    } else {
        $file_sk = '';
    }

    $diberhentikan = ($_POST['diberhentikan'] == 'Ya' ? 'Ya' : 'Tidak');

    $data = array($id, $_POST['opd'], $_POST['pegawai'], $_POST['tingkat_hukuman'], $diberhentikan, $_POST['pyb'], $_POST['no_sk'], $_POST['tgl_sk'], $file_sk, $_POST['keterangan'], date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'opd_asal', 'pegawai', 'tingkat_hukuman_disiplin', 'diberhentikan', 'pyb', 'no_sk', 'tgl_sk', 'file_sk', 'keterangan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_hukuman_disiplin'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/disiplin-penghargaan/hukuman-disiplin/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/disiplin-penghargaan/hukuman-disiplin/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiHukumanDisiplin'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    if ($_POST['tindakan'] == 'Tidak Setuju') {
        $data = array($_POST['id'], 'Ditolak', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_hukuman_disiplin'));
    } else {
        $data1 = req_get_where($koneksi, 'simpeg_lp_hukuman_disiplin', 'id = "' . $_POST['id'] . '"');

        if ($data1['tingkat_hukuman_disiplin'] == '3' and $data1['diberhentikan'] == 'Ya') {
            $data = array($data1['pegawai'], '22');
            $field = array('id', 'kedudukan_pegawai');
            array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));
        }

        $data = array($_POST['id'], 'Disetujui');
        $field = array('id', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_hukuman_disiplin'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/disiplin-penghargaan/hukuman-disiplin/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/disiplin-penghargaan/hukuman-disiplin/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahSatyalancana'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = '';
        }
    } else {
        $file_sk = '';
    }

    $data = array($id, $_POST['opd'], $_POST['pegawai'], $_POST['kelas_satyalancana'], $_POST['tahun'], $_POST['pyb'], $_POST['no_sk'], $_POST['tgl_sk'], $file_sk, $_POST['keterangan'], date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'opd_asal', 'pegawai', 'kelas_satyalancana', 'tahun', 'pyb', 'no_sk', 'tgl_sk', 'file_sk', 'keterangan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_satyalancana'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/disiplin-penghargaan/satyalancana-karya-satya/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/disiplin-penghargaan/satyalancana-karya-satya/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiSatyalancana'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    if ($_POST['tindakan'] == 'Tidak Setuju') {
        $data = array($_POST['id'], 'Ditolak', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_satyalancana'));
    } else {
        $data = array($_POST['id'], 'Disetujui');
        $field = array('id', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_satyalancana'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/disiplin-penghargaan/satyalancana-karya-satya/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/disiplin-penghargaan/satyalancana-karya-satya/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahCuti'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = '';
        }
    } else {
        $file_sk = '';
    }

    $data = array($id, $_POST['opd'], $_POST['pegawai'], $_POST['lama'], $_POST['tgl_mulai'], $_POST['tgl_selesai'], $_POST['pyb'], $_POST['no_sk'], $_POST['tgl_sk'], $file_sk, $_POST['keterangan'], date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'opd_asal', 'pegawai', 'lama', 'tgl_mulai', 'tgl_selesai', 'pyb', 'no_sk', 'tgl_sk', 'file_sk', 'keterangan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_cuti'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/disiplin-penghargaan/cuti/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/disiplin-penghargaan/cuti/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiCuti'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    if ($_POST['tindakan'] == 'Tidak Setuju') {
        $data = array($_POST['id'], 'Ditolak', $_POST['alasan']);
        $field = array('id', 'status', 'alasan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_cuti'));
    } else {
        $data1 = req_get_where($koneksi, 'simpeg_lp_cuti', 'id = "' . $_POST['id'] . '"');

        $data = array($data1['pegawai'], '2');
        $field = array('id', 'kedudukan_pegawai');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

        $data = array($_POST['id'], 'Disetujui');
        $field = array('id', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_cuti'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/disiplin-penghargaan/cuti/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil memverifikasi data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/disiplin-penghargaan/cuti/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahPensiun'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = '';
        }
    } else {
        $file_sk = '';
    }

    $id_riwayat = get_id('D', 'R');
    $data1 = req_get_where($koneksi, 'pegawai_pgr', 'id = "' . $_POST['pegawai'] . '"');

    $data = array($id_riwayat, $data1['id'], $data1['pym'], $data1['no_sk'], $data1['tgl_sk'], $data1['pgr'], $data1['tmt'], $data1['file_sk']);
    $field = array('id', 'pegawai', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'file_sk');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_pgr'));

    $data = array($_POST['pegawai'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['pgr'], $_POST['tmt'], $file_sk);
    $field = array('id', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'file_sk');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pgr'));

    $data = array($id, $_POST['opd'], $_POST['pegawai'], $_POST['pgr'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['tmt'], $file_sk, $id_riwayat, date("Y-m-d H:i:s"));
    $field = array('id', 'opd_asal', 'pegawai', 'pgr_baru', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'file_sk', 'old', 'tt');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_pensiun'));

    $data = array($_POST['pegawai'], '5');
    $field = array('id', 'kedudukan_pegawai');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/perencanaan-pemberhentian/pensiun/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/perencanaan-pemberhentian/pensiun/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}

if (isset($_POST['TombolTambahMasaPersiapanPensiun'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('L', 'P');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

    if ($_FILES['file_sk']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk"]["tmp_name"], $path . $nama_file)) {
            $file_sk = $nama_file;
        } else {
            $file_sk = '';
        }
    } else {
        $file_sk = '';
    }

    $data_p = req_get_where($koneksi, 'pegawai_pgr', 'id = "' . $_POST['pegawai'] . '"');
    $data_q = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $_POST['pegawai'] . '"');
    $data = array($id, $_POST['opd'], $_POST['pegawai'], $data_p['pgr'], $data_q['nama_jabatan'], $_POST['pyb'], $_POST['no_sk'], $_POST['tgl_sk'], $file_sk, $_POST['keterangan'], date("Y-m-d H:i:s"));
    $field = array('id', 'opd_asal', 'pegawai', 'pgr', 'jabatan', 'pyb', 'no_sk', 'tgl_sk', 'file_sk', 'keterangan', 'tt');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'simpeg_lp_masa_persiapan_pensiun'));

    $data = array($_POST['pegawai'], '23');
    $field = array('id', 'kedudukan_pegawai');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/perencanaan-pemberhentian/masa-persiapan-pensiun/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'layanan-kepegawaian/perencanaan-pemberhentian/masa-persiapan-pensiun/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
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

        modal_konfirmasi($_POST['judul'], $_POST['form'], SIMPEG_URL . 'controllers/c-layanan-kepegawaian.php', $_POST['pertanyaan'], $_POST['parameter'], $_POST['data']);
    }
}