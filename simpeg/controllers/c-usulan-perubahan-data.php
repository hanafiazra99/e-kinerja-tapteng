<?php
function page_title()
{
    return 'Usulan Perubahan Data';
}

function portal_id()
{
    return '12';
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

if (isset($_POST['TombolVerifikasiIdentitasPegawai'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['nama'], $data1['gelar_depan'], $data1['gelar_belakang'], $data1['tempat_lahir'], $data1['tgl_lahir'], $data1['jenis_kelamin'], $data1['agama'], $data1['no_hp'], $data1['status_kepegawaian'], $data1['kedudukan_pegawai'], $data1['status_perkawinan'], $data1['golongan_darah'], $data1['npwp'], $data1['opd'], $data1['unit_organisasi'], $data1['foto']);
        $field = array('id', 'nama', 'gelar_depan', 'gelar_belakang', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'agama', 'no_hp', 'status_kepegawaian', 'kedudukan_pegawai', 'status_perkawinan', 'golongan_darah', 'npwp', 'opd', 'unit_organisasi', 'foto');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

        if ($data1['status_kepegawaian'] == '3') {
            $data1 = req_get_where($koneksi, 'usulan_pegawai_honorer', 'id = "' . $_POST['id'] . '"');
            $data = array($data1['id'], $data1['tmt'], $data1['pendidikan_terakhir'], $data1['jabatan']);
            $field = array('id', 'tmt', 'pendidikan_terakhir', 'jabatan');
            array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_honorer'));
        } else if ($data1['status_kepegawaian'] == '1' or $data1['status_kepegawaian'] == '2') {
            $data1 = req_get_where($koneksi, 'usulan_pegawai_asn', 'id = "' . $_POST['id'] . '"');
            $data = array($data1['id'], $data1['nip'], $data1['jenis_kepegawaian'], $data1['no_karpeg'], $data1['no_askes'], $data1['no_taspen'], $data1['no_karissu']);
            $field = array('id', 'nip', 'jenis_kepegawaian', 'no_karpeg', 'no_askes', 'no_taspen', 'no_karissu');
            array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_asn'));
        }

        $data1 = req_get_where($koneksi, 'usulan_pegawai_alamat', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['provinsi'], $data1['kabkot'], $data1['kecamatan'], $data1['keldes'], $data1['rt'], $data1['rw'], $data1['kode_pos'], $data1['alamat']);
        $field = array('id', 'provinsi', 'kabkot', 'kecamatan', 'keldes', 'rt', 'rw', 'kode_pos', 'alamat');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_alamat'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/identitas-pegawai/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/identitas-pegawai/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiPengangkatanCPNS'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_pengangkatan_cpns'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_pengangkatan_cpns', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['no_nota_bkn'], $data1['tgl_nota_bkn'], $data1['pym'], $data1['no_sk'], $data1['tgl_sk'], $data1['masa_kerja'], $data1['pgr'], $data1['tmt'], $data1['file_sk']);
        $field = array('id', 'no_nota_bkn', 'tgl_nota_bkn', 'pym', 'no_sk', 'tgl_sk', 'masa_kerja', 'pgr', 'tmt', 'file_sk');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pengangkatan_cpns'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_pengangkatan_cpns'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-kepegawaian/pengangkatan-cpns/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-kepegawaian/pengangkatan-cpns/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiPengangkatanPNS'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_pengangkatan_pns'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_pengangkatan_pns', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['pym'], $data1['no_sk'], $data1['tgl_sk'], $data1['pgr'], $data1['tmt'], $data1['sumpah'], $data1['file_sk']);
        $field = array('id', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'sumpah', 'file_sk');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pengangkatan_pns'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_pengangkatan_pns'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-kepegawaian/pengangkatan-pns/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-kepegawaian/pengangkatan-pns/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiPGR'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_pgr'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_pgr', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['pym'], $data1['no_sk'], $data1['tgl_sk'], $data1['pgr'], $data1['tmt'], $data1['file_sk']);
        $field = array('id', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'file_sk');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pgr'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_pgr'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-kepegawaian/pgr/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-kepegawaian/pgr/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiKGB'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_kgb'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_kgb', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['pym'], $data1['no_sk'], $data1['tgl_sk'], $data1['tmt'], $data1['masa_kerja'], $data1['kantor_pembayaran'], $data1['file_sk']);
        $field = array('id', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'masa_kerja', 'kantor_pembayaran', 'file_sk');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_kgb'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_kgb'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-kepegawaian/kgb/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-kepegawaian/kgb/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiJabatan'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_jabatan'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_jabatan', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['pym'], $data1['no_sk_jabatan'], $data1['tgl_sk_jabatan'], $data1['jenis_jabatan'], $data1['eselon'], $data1['nama_jabatan'], $data1['tmt'], $data1['no_sk_pelantikan'], $data1['tgl_sk_pelantikan'], $data1['sumpah'], $data1['file_sk_jabatan'], $data1['file_sk_pelantikan']);
        $field = array('id', 'pym', 'no_sk_jabatan', 'tgl_sk_jabatan', 'jenis_jabatan', 'eselon', 'nama_jabatan', 'tmt', 'no_sk_pelantikan', 'tgl_sk_pelantikan', 'sumpah', 'file_sk_jabatan', 'file_sk_pelantikan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_jabatan'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_jabatan'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-kepegawaian/jabatan/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-kepegawaian/jabatan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiRiwayatPGR'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_riwayat_pgr'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_riwayat_pgr', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['pegawai'], $data1['pym'], $data1['no_sk'], $data1['tgl_sk'], $data1['pgr'], $data1['tmt'], $data1['file_sk']);
        $field = array('id', 'pegawai', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'file_sk');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_pgr'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_riwayat_pgr'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-riwayat/riwayat-pgr/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-riwayat/riwayat-pgr/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiRiwayatKGB'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_riwayat_kgb'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_riwayat_kgb', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['pegawai'], $data1['pym'], $data1['no_sk'], $data1['tgl_sk'], $data1['tmt'], $data1['masa_kerja'], $data1['kantor_pembayaran'], $data1['file_sk']);
        $field = array('id', 'pegawai', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'masa_kerja', 'kantor_pembayaran', 'file_sk');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_kgb'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_riwayat_kgb'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-riwayat/riwayat-kgb/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-riwayat/riwayat-kgb/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiRiwayatJabatan'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_riwayat_jabatan'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_riwayat_jabatan', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['pegawai'], $data1['pym'], $data1['no_sk_jabatan'], $data1['tgl_sk_jabatan'], $data1['jenis_jabatan'], $data1['eselon'], $data1['nama_jabatan'], $data1['tmt'], $data1['no_sk_pelantikan'], $data1['tgl_sk_pelantikan'], $data1['opd'], $data1['file_sk_jabatan'], $data1['file_sk_pelantikan']);
        $field = array('id', 'pegawai', 'pym', 'no_sk_jabatan', 'tgl_sk_jabatan', 'jenis_jabatan', 'eselon', 'nama_jabatan', 'tmt', 'no_sk_pelantikan', 'tgl_sk_pelantikan', 'opd', 'file_sk_jabatan', 'file_sk_pelantikan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_jabatan'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_riwayat_jabatan'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-riwayat/riwayat-jabatan/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-riwayat/riwayat-jabatan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiRiwayatPendidikanUmum'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_riwayat_pendidikan_umum'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_riwayat_pendidikan_umum', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['pegawai'], $data1['tingkat_pendidikan'], $data1['jurusan'], $data1['nama_institusi'], $data1['nama_kepala_institusi'], $data1['no_sttb'], $data1['tgl_sttb'], $data1['file_sttb']);
        $field = array('id', 'pegawai', 'tingkat_pendidikan', 'jurusan', 'nama_institusi', 'nama_kepala_institusi', 'no_sttb', 'tgl_sttb', 'file_sttb');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_pendidikan_umum'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_riwayat_pendidikan_umum'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-riwayat/riwayat-pendidikan-umum/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-riwayat/riwayat-pendidikan-umum/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiRiwayatDiklat'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_riwayat_diklat'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_riwayat_diklat', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['pegawai'], $data1['jenis_diklat'], $data1['nama_diklat'], $data1['penyelenggara'], $data1['angkatan'], $data1['lama_pendidikan_h'], $data1['lama_pendidikan_j'], $data1['no_sttpp'], $data1['tgl_sttpp'], $data1['file_sttpp']);
        $field = array('id', 'pegawai', 'jenis_diklat', 'nama_diklat', 'penyelenggara', 'angkatan', 'lama_pendidikan_h', 'lama_pendidikan_j', 'no_sttpp', 'tgl_sttpp', 'file_sttpp');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_diklat'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_riwayat_diklat'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-riwayat/riwayat-diklat/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-riwayat/riwayat-diklat/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiOrangTua'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_ortu'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_ortu', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['nama_a'], $data1['tempat_lahir_a'], $data1['tgl_lahir_a'], $data1['pekerjaan_a'], $data1['nama_i'], $data1['tempat_lahir_i'], $data1['tgl_lahir_i'], $data1['pekerjaan_i']);
        $field = array('id', 'nama_a', 'tempat_lahir_a', 'tgl_lahir_a', 'pekerjaan_a', 'nama_i', 'tempat_lahir_i', 'tgl_lahir_i', 'pekerjaan_i');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_ortu'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_ortu'));

        $data1 = req_get_where($koneksi, 'usulan_pegawai_ortu_alamat', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['provinsi_a'], $data1['kabkot_a'], $data1['kecamatan_a'], $data1['keldes_a'], $data1['rt_a'], $data1['rw_a'], $data1['kode_pos_a'], $data1['alamat_a'], $data1['provinsi_i'], $data1['kabkot_i'], $data1['kecamatan_i'], $data1['keldes_i'], $data1['rt_i'], $data1['rw_i'], $data1['kode_pos_i'], $data1['alamat_i']);
        $field = array('id', 'provinsi_a', 'kabkot_a', 'kecamatan_a', 'keldes_a', 'rt_a', 'rw_a', 'kode_pos_a', 'alamat_a', 'provinsi_i', 'kabkot_i', 'kecamatan_i', 'keldes_i', 'rt_i', 'rw_i', 'kode_pos_i', 'alamat_i');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_ortu_alamat'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_ortu_alamat'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-keluarga/orang-tua/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-keluarga/orang-tua/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiMertua'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_mertua'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_mertua', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['nama_a'], $data1['tempat_lahir_a'], $data1['tgl_lahir_a'], $data1['pekerjaan_a'], $data1['nama_i'], $data1['tempat_lahir_i'], $data1['tgl_lahir_i'], $data1['pekerjaan_i']);
        $field = array('id', 'nama_a', 'tempat_lahir_a', 'tgl_lahir_a', 'pekerjaan_a', 'nama_i', 'tempat_lahir_i', 'tgl_lahir_i', 'pekerjaan_i');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_mertua'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_mertua'));

        $data1 = req_get_where($koneksi, 'usulan_pegawai_mertua_alamat', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['provinsi_a'], $data1['kabkot_a'], $data1['kecamatan_a'], $data1['keldes_a'], $data1['rt_a'], $data1['rw_a'], $data1['kode_pos_a'], $data1['alamat_a'], $data1['provinsi_i'], $data1['kabkot_i'], $data1['kecamatan_i'], $data1['keldes_i'], $data1['rt_i'], $data1['rw_i'], $data1['kode_pos_i'], $data1['alamat_i']);
        $field = array('id', 'provinsi_a', 'kabkot_a', 'kecamatan_a', 'keldes_a', 'rt_a', 'rw_a', 'kode_pos_a', 'alamat_a', 'provinsi_i', 'kabkot_i', 'kecamatan_i', 'keldes_i', 'rt_i', 'rw_i', 'kode_pos_i', 'alamat_i');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_mertua_alamat'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_mertua_alamat'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-keluarga/mertua/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-keluarga/mertua/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiPasangan'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_pasangan'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_pasangan', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['nama'], $data1['tempat_lahir'], $data1['tgl_lahir'], $data1['no_buku_nikah'], $data1['tgl_buku_nikah'], $data1['pendidikan_terakhir'], $data1['pekerjaan']);
        $field = array('id', 'nama', 'tempat_lahir', 'tgl_lahir', 'no_buku_nikah', 'tgl_buku_nikah', 'pendidikan_terakhir', 'pekerjaan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pasangan'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_pasangan'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-keluarga/pasangan/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-keluarga/pasangan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolVerifikasiAnak'])) {
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
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_anak'));
    } else {
        $data1 = req_get_where($koneksi, 'usulan_pegawai_anak', 'id = "' . $_POST['id'] . '"');
        $data = array($data1['id'], $data1['pegawai'], $data1['nama'], $data1['tempat_lahir'], $data1['tgl_lahir'], $data1['jenis_kelamin'], $data1['status_anak'], $data1['tunjangan'], $data1['pendidikan_terakhir'], $data1['pekerjaan']);
        $field = array('id', 'pegawai', 'nama', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'status_anak', 'tunjangan', 'pendidikan_terakhir', 'pekerjaan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_anak'));

        array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'usulan_pegawai_anak'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-keluarga/anak/', 'Berhasil', 'Berhasil memverifikasi usulan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'usulan-perubahan-data/data-keluarga/anak/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['req'])) {
    if ($_POST['req'] == 'Change Select') {
        require "../../app/config.php";
        require "../../app/models.php";
        require "../../app/autentikasi.php";
        require "../../app/component.php";

        echo component_select_option_response_ajax($koneksi, $_POST['table'], $_POST['id'], $_POST['data'], $_POST['where']);
    }
}
