<?php
function page_title()
{
    return 'Perubahan Data';
}

function portal_id()
{
    return '13';
}

if (isset($_POST['TombolTambahUsulanPegawaiIdentitas'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/img/pegawai');
    $path_thumb = cek_folder('../../resources/img/pegawai/thumb/');

    if ($_FILES['foto']['name'] != '') {
        $ekstensi = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('F', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $path . $nama_file)) {
            createThumbnail($nama_file, $path . $nama_file, 300, $path_thumb);
            $foto = $nama_file;
        } else {
            $foto = $_POST['foto_lama'];
        }
    } else {
        $foto = $_POST['foto_lama'];
    }

    $data = array($_POST['id'], $_POST['nama'], $_POST['gelar_depan'], $_POST['gelar_belakang'], $_POST['tempat_lahir'], $_POST['tgl_lahir'], $_POST['jenis_kelamin'], $_POST['agama'], $_POST['no_hp'], $_POST['status_kepegawaian'], $_POST['kedudukan_pegawai'], $_POST['status_perkawinan'], $_POST['golongan_darah'], $_POST['npwp'], $_POST['opd'], $_POST['unit_organisasi'], $foto, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'nama', 'gelar_depan', 'gelar_belakang', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'agama', 'no_hp', 'status_kepegawaian', 'kedudukan_pegawai', 'status_perkawinan', 'golongan_darah', 'npwp', 'opd', 'unit_organisasi', 'foto', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    $data = array($_POST['id'], $_POST['provinsi'], $_POST['kabkot'], $_POST['kecamatan'], $_POST['keldes'], $_POST['rt'], $_POST['rw'], $_POST['kode_pos'], $_POST['alamat']);
    $field = array('id', 'provinsi', 'kabkot', 'kecamatan', 'keldes', 'rt', 'rw', 'kode_pos', 'alamat');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_alamat'));

    if ($_POST['status_kepegawaian'] != '3') {
        $data = array($_POST['id'], $_POST['nip'], $_POST['jenis_kepegawaian'], $_POST['no_karpeg'], $_POST['no_askes'], $_POST['no_taspen'], $_POST['no_karissu']);
        $field = array('id', 'nip', 'jenis_kepegawaian', 'no_karpeg', 'no_askes', 'no_taspen', 'no_karissu');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_asn'));
    } else {
        $data = array($_POST['id'], $_POST['tmt'], $_POST['pendidikan_terakhir'], $_POST['jabatan']);
        $field = array('id', 'tmt', 'pendidikan_terakhir', 'jabatan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_honorer'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/identitas-pegawai/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/identitas-pegawai/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanPengangkatanCPNS'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['id'] . '/');

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

    $masa_kerja = ($_POST['masa_kerja_tahun'] * 12) + $_POST['masa_kerja_bulan'];
    $data = array($_POST['id'], $_POST['no_nota_bkn'], $_POST['tgl_nota_bkn'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $masa_kerja, $_POST['pgr'], $_POST['tmt'], $file_sk, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'no_nota_bkn', 'tgl_nota_bkn', 'pym', 'no_sk', 'tgl_sk', 'masa_kerja', 'pgr', 'tmt', 'file_sk', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pengangkatan_cpns'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-kepegawaian/pengangkatan-cpns/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-kepegawaian/pengangkatan-cpns/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanPengangkatanPNS'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['id'] . '/');

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

    $data = array($_POST['id'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['pgr'], $_POST['tmt'], $_POST['sumpah'], $file_sk, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'sumpah', 'file_sk', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pengangkatan_pns'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-kepegawaian/pengangkatan-pns/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-kepegawaian/pengangkatan-pns/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanPGR'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['id'] . '/');

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

    $data = array($_POST['id'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['pgr'], $_POST['tmt'], $file_sk, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'file_sk', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pgr'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-kepegawaian/pgr/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-kepegawaian/pgr/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanKGB'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['id'] . '/');

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

    $masa_kerja = ($_POST['masa_kerja_tahun'] * 12) + $_POST['masa_kerja_bulan'];
    $data = array($_POST['id'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['tmt'], $masa_kerja, $_POST['kantor_pembayaran'], $file_sk, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'masa_kerja', 'kantor_pembayaran', 'file_sk', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_kgb'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-kepegawaian/kgb/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-kepegawaian/kgb/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanJabatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['id'] . '/');

    if ($_FILES['file_sk_jabatan']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk_jabatan']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk_jabatan"]["tmp_name"], $path . $nama_file)) {
            $file_sk_jabatan = $nama_file;
        } else {
            $file_sk_jabatan = $_POST['file_sk_jabatan_lama'];
        }
    } else {
        $file_sk_jabatan = $_POST['file_sk_jabatan_lama'];
    }

    if ($_FILES['file_sk_pelantikan']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk_pelantikan']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk_pelantikan"]["tmp_name"], $path . $nama_file)) {
            $file_sk_pelantikan = $nama_file;
        } else {
            $file_sk_pelantikan = $_POST['file_sk_pelantikan_lama'];
        }
    } else {
        $file_sk_pelantikan = $_POST['file_sk_pelantikan_lama'];
    }

    $data = array($_POST['id'], $_POST['pym'], $_POST['no_sk_jabatan'], $_POST['tgl_sk_jabatan'], $_POST['jenis_jabatan'], $_POST['eselon'], $_POST['nama_jabatan'], $_POST['tmt'], $_POST['no_sk_pelantikan'], $_POST['tgl_sk_pelantikan'], $_POST['sumpah'], $file_sk_jabatan, $file_sk_pelantikan, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'pym', 'no_sk_jabatan', 'tgl_sk_jabatan', 'jenis_jabatan', 'eselon', 'nama_jabatan', 'tmt', 'no_sk_pelantikan', 'tgl_sk_pelantikan', 'sumpah', 'file_sk_jabatan', 'file_sk_pelantikan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_jabatan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-kepegawaian/jabatan/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-kepegawaian/jabatan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanRiwayatPGR'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['id'] . '/');

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

    $data = array($_POST['id'], $_POST['pegawai'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['pgr'], $_POST['tmt'], $file_sk, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'pegawai', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'file_sk', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_pgr'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-pgr/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-pgr/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanRiwayatKGB'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['id'] . '/');

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

    $masa_kerja = ($_POST['masa_kerja_tahun'] * 12) + $_POST['masa_kerja_bulan'];
    $data = array($_POST['id'], $_POST['pegawai'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['tmt'], $masa_kerja, $_POST['kantor_pembayaran'], $file_sk, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'pegawai', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'masa_kerja', 'kantor_pembayaran', 'file_sk', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_kgb'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-kgb/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-kgb/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanRiwayatJabatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['id'] . '/');

    if ($_FILES['file_sk_jabatan']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk_jabatan']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk_jabatan"]["tmp_name"], $path . $nama_file)) {
            $file_sk_jabatan = $nama_file;
        } else {
            $file_sk_jabatan = $_POST['file_sk_jabatan_lama'];
        }
    } else {
        $file_sk_jabatan = $_POST['file_sk_jabatan_lama'];
    }

    if ($_FILES['file_sk_pelantikan']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sk_pelantikan']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sk_pelantikan"]["tmp_name"], $path . $nama_file)) {
            $file_sk_pelantikan = $nama_file;
        } else {
            $file_sk_pelantikan = $_POST['file_sk_pelantikan_lama'];
        }
    } else {
        $file_sk_pelantikan = $_POST['file_sk_pelantikan_lama'];
    }

    $data = array($_POST['id'], $_POST['pegawai'], $_POST['pym'], $_POST['no_sk_jabatan'], $_POST['tgl_sk_jabatan'], $_POST['jenis_jabatan'], $_POST['eselon'], $_POST['nama_jabatan'], $_POST['tmt'], $_POST['no_sk_pelantikan'], $_POST['tgl_sk_pelantikan'], $_POST['opd'], $file_sk_jabatan, $file_sk_pelantikan, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'pegawai', 'pym', 'no_sk_jabatan', 'tgl_sk_jabatan', 'jenis_jabatan', 'eselon', 'nama_jabatan', 'tmt', 'no_sk_pelantikan', 'tgl_sk_pelantikan', 'opd', 'file_sk_jabatan', 'file_sk_pelantikan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_jabatan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-jabatan/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-jabatan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanRiwayatPendidikanUmum'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['id'] . '/');

    if ($_FILES['file_sttb']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sttb']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sttb"]["tmp_name"], $path . $nama_file)) {
            $file_sttb = $nama_file;
        } else {
            $file_sttb = $_POST['file_sttb_lama'];
        }
    } else {
        $file_sttb = $_POST['file_sttb_lama'];
    }

    $data = array($_POST['id'], $_POST['pegawai'], $_POST['tingkat_pendidikan'], $_POST['jurusan'], $_POST['nama_institusi'], $_POST['nama_kepala_institusi'], $_POST['no_sttb'], $_POST['tgl_sttb'], $file_sttb, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'pegawai', 'tingkat_pendidikan', 'jurusan', 'nama_institusi', 'nama_kepala_institusi', 'no_sttb', 'tgl_sttb', 'file_sttb', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_pendidikan_umum'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-pendidikan-umum/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-pendidikan-umum/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanRiwayatDiklat'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['id'] . '/');

    if ($_FILES['file_sttpp']['name'] != '') {
        $ekstensi = pathinfo($_FILES['file_sttpp']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('D', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["file_sttpp"]["tmp_name"], $path . $nama_file)) {
            $file_sttpp = $nama_file;
        } else {
            $file_sttpp = $_POST['file_sttpp_lama'];
        }
    } else {
        $file_sttpp = $_POST['file_sttpp_lama'];
    }

    $data = array($_POST['id'], $_POST['pegawai'], $_POST['jenis_diklat'], $_POST['nama_diklat'], $_POST['penyelenggara'], $_POST['angkatan'], $_POST['lama_pendidikan_h'], $_POST['lama_pendidikan_j'], $_POST['no_sttpp'], $_POST['tgl_sttpp'], $file_sttpp, date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'pegawai', 'jenis_diklat', 'nama_diklat', 'penyelenggara', 'angkatan', 'lama_pendidikan_h', 'lama_pendidikan_j', 'no_sttpp', 'tgl_sttpp', 'file_sttpp', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_diklat'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-diklat/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-diklat/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanOrangTua'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['nama_a'], $_POST['tempat_lahir_a'], $_POST['tgl_lahir_a'], $_POST['pekerjaan_a'], $_POST['nama_i'], $_POST['tempat_lahir_i'], $_POST['tgl_lahir_i'], $_POST['pekerjaan_i'], date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'nama_a', 'tempat_lahir_a', 'tgl_lahir_a', 'pekerjaan_a', 'nama_i', 'tempat_lahir_i', 'tgl_lahir_i', 'pekerjaan_i', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_ortu'));

    $data = array($_POST['id'], $_POST['provinsi_a'], $_POST['kabkot_a'], $_POST['kecamatan_a'], $_POST['keldes_a'], $_POST['rt_a'], $_POST['rw_a'], $_POST['kode_pos_a'], $_POST['alamat_a'], $_POST['provinsi_i'], $_POST['kabkot_i'], $_POST['kecamatan_i'], $_POST['keldes_i'], $_POST['rt_i'], $_POST['rw_i'], $_POST['kode_pos_i'], $_POST['alamat_i']);
    $field = array('id', 'provinsi_a', 'kabkot_a', 'kecamatan_a', 'keldes_a', 'rt_a', 'rw_a', 'kode_pos_a', 'alamat_a', 'provinsi_i', 'kabkot_i', 'kecamatan_i', 'keldes_i', 'rt_i', 'rw_i', 'kode_pos_i', 'alamat_i');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_ortu_alamat'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-keluarga/orang-tua/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-keluarga/orang-tua/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanMertua'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['nama_a'], $_POST['tempat_lahir_a'], $_POST['tgl_lahir_a'], $_POST['pekerjaan_a'], $_POST['nama_i'], $_POST['tempat_lahir_i'], $_POST['tgl_lahir_i'], $_POST['pekerjaan_i'], date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'nama_a', 'tempat_lahir_a', 'tgl_lahir_a', 'pekerjaan_a', 'nama_i', 'tempat_lahir_i', 'tgl_lahir_i', 'pekerjaan_i', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_mertua'));

    $data = array($_POST['id'], $_POST['provinsi_a'], $_POST['kabkot_a'], $_POST['kecamatan_a'], $_POST['keldes_a'], $_POST['rt_a'], $_POST['rw_a'], $_POST['kode_pos_a'], $_POST['alamat_a'], $_POST['provinsi_i'], $_POST['kabkot_i'], $_POST['kecamatan_i'], $_POST['keldes_i'], $_POST['rt_i'], $_POST['rw_i'], $_POST['kode_pos_i'], $_POST['alamat_i']);
    $field = array('id', 'provinsi_a', 'kabkot_a', 'kecamatan_a', 'keldes_a', 'rt_a', 'rw_a', 'kode_pos_a', 'alamat_a', 'provinsi_i', 'kabkot_i', 'kecamatan_i', 'keldes_i', 'rt_i', 'rw_i', 'kode_pos_i', 'alamat_i');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_mertua_alamat'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-keluarga/mertua/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-keluarga/mertua/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanPasangan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['nama'], $_POST['tempat_lahir'], $_POST['tgl_lahir'], $_POST['no_buku_nikah'], $_POST['tgl_buku_nikah'], $_POST['pendidikan_terakhir'], $_POST['pekerjaan'], date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'nama', 'tempat_lahir', 'tgl_lahir', 'no_buku_nikah', 'tgl_buku_nikah', 'pendidikan_terakhir', 'pekerjaan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pasangan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-keluarga/pasangan/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-keluarga/pasangan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahUsulanAnak'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['pegawai'], $_POST['nama'], $_POST['tempat_lahir'], $_POST['tgl_lahir'], $_POST['jenis_kelamin'], $_POST['status_anak'], $_POST['tunjangan'], $_POST['pendidikan_terakhir'], $_POST['pekerjaan'], date("Y-m-d H:i:s"), 'Dikirim');
    $field = array('id', 'pegawai', 'nama', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'status_anak', 'tunjangan', 'pendidikan_terakhir', 'pekerjaan', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_anak'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-keluarga/anak/usulan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengusulkan perubahan data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'perubahan-data/data-keluarga/anak/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
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
