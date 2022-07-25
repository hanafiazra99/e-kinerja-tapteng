<?php
function page_title()
{
    return 'Daftar Pegawai';
}

function portal_id()
{
    return '4';
}

if (isset($_POST['TombolTambahASN'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('P', 'I');
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

    $data = array($id, $_POST['nama'], $_POST['gelar_depan'], $_POST['gelar_belakang'], $_POST['tempat_lahir'], $_POST['tgl_lahir'], $_POST['jenis_kelamin'], $_POST['agama'], $_POST['no_hp'], $_POST['status_kepegawaian'], $_POST['kedudukan_pegawai'], $_POST['status_perkawinan'], $_POST['golongan_darah'], $_POST['npwp'], $_POST['opd'], $_POST['unit_organisasi'], $foto);
    $field = array('id', 'nama', 'gelar_depan', 'gelar_belakang', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'agama', 'no_hp', 'status_kepegawaian', 'kedudukan_pegawai', 'status_perkawinan', 'golongan_darah', 'npwp', 'opd', 'unit_organisasi', 'foto');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    $data = array($id, $_POST['provinsi'], $_POST['kabkot'], $_POST['kecamatan'], $_POST['keldes'], $_POST['rt'], $_POST['rw'], $_POST['kode_pos'], $_POST['alamat']);
    $field = array('id', 'provinsi', 'kabkot', 'kecamatan', 'keldes', 'rt', 'rw', 'kode_pos', 'alamat');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_alamat'));

    $data = array($id, $_POST['nip'], $_POST['jenis_kepegawaian'], $_POST['no_karpeg'], $_POST['no_askes'], $_POST['no_taspen'], $_POST['no_karissu']);
    $field = array('id', 'nip', 'jenis_kepegawaian', 'no_karpeg', 'no_askes', 'no_taspen', 'no_karissu');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_asn'));

    if ($_POST['role'] != '1') {
        $data = array($id, $_POST['nama'], $_POST['gelar_depan'], $_POST['gelar_belakang'], $_POST['tempat_lahir'], $_POST['tgl_lahir'], $_POST['jenis_kelamin'], $_POST['agama'], $_POST['no_hp'], $_POST['status_kepegawaian'], $_POST['kedudukan_pegawai'], $_POST['status_perkawinan'], $_POST['golongan_darah'], $_POST['npwp'], $_POST['opd'], $_POST['unit_organisasi'], $foto, date("Y-m-d H:i:s"), 'Dikirim');
        $field = array('id', 'nama', 'gelar_depan', 'gelar_belakang', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'agama', 'no_hp', 'status_kepegawaian', 'kedudukan_pegawai', 'status_perkawinan', 'golongan_darah', 'npwp', 'opd', 'unit_organisasi', 'foto', 'ts', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai'));

        $data = array($id, $_POST['provinsi'], $_POST['kabkot'], $_POST['kecamatan'], $_POST['keldes'], $_POST['rt'], $_POST['rw'], $_POST['kode_pos'], $_POST['alamat']);
        $field = array('id', 'provinsi', 'kabkot', 'kecamatan', 'keldes', 'rt', 'rw', 'kode_pos', 'alamat');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_alamat'));

        $data = array($id, $_POST['nip'], $_POST['jenis_kepegawaian'], $_POST['no_karpeg'], $_POST['no_askes'], $_POST['no_taspen'], $_POST['no_karissu']);
        $field = array('id', 'nip', 'jenis_kepegawaian', 'no_karpeg', 'no_askes', 'no_taspen', 'no_karissu');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_asn'));
    }
    
    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $id . '/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $id . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingIdentitasPegawai'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/img/pegawai/');
    $path_thumb = cek_folder('../../resources/img/pegawai/thumb/');

    if ($_FILES['foto']['name'] != '') {
        $ekstensi = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nama_file = "" . get_id('F', 'P') . "." . $ekstensi . "";

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $path . $nama_file)) {
            createThumbnail($nama_file, $path . $nama_file, 300, $path_thumb);
            $foto = $nama_file;
        } else {
            pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada upload foto, laporkan ini pada pihak pengembang.', 'modal-danger');
        }
    } else {
        $foto = '';
    }

    $data = array($_POST['id'], $_POST['nama'], $_POST['gelar_depan'], $_POST['gelar_belakang'], $_POST['tempat_lahir'], $_POST['tgl_lahir'], $_POST['jenis_kelamin'], $_POST['agama'], $_POST['no_hp'], $_POST['status_kepegawaian'], $_POST['kedudukan_pegawai'], $_POST['status_perkawinan'], $_POST['golongan_darah'], $_POST['npwp'], $_POST['opd'], $_POST['unit_organisasi'], $foto);
    $field = array('id', 'nama', 'gelar_depan', 'gelar_belakang', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'agama', 'no_hp', 'status_kepegawaian', 'kedudukan_pegawai', 'status_perkawinan', 'golongan_darah', 'npwp', 'opd', 'unit_organisasi', 'foto');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    $data = array($_POST['id'], $_POST['provinsi'], $_POST['kabkot'], $_POST['kecamatan'], $_POST['keldes'], $_POST['rt'], $_POST['rw'], $_POST['kode_pos'], $_POST['alamat']);
    $field = array('id', 'provinsi', 'kabkot', 'kecamatan', 'keldes', 'rt', 'rw', 'kode_pos', 'alamat');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_alamat'));

    $data = array($_POST['id'], $_POST['nip'], $_POST['jenis_kepegawaian'], $_POST['no_karpeg'], $_POST['no_askes'], $_POST['no_taspen'], $_POST['no_karissu']);
    $field = array('id', 'nip', 'jenis_kepegawaian', 'no_karpeg', 'no_askes', 'no_taspen', 'no_karissu');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_asn'));
    
    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingPengangkatanCPNS'])) {
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
    $data = array($_POST['id'], $_POST['no_nota_bkn'], $_POST['tgl_nota_bkn'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $masa_kerja, $_POST['pgr'], $_POST['tmt'], $file_sk);
    $field = array('id', 'no_nota_bkn', 'tgl_nota_bkn', 'pym', 'no_sk', 'tgl_sk', 'masa_kerja', 'pgr', 'tmt', 'file_sk');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pengangkatan_cpns'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingPengangkatanPNS'])) {
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

    $data = array($_POST['id'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['pgr'], $_POST['tmt'], $_POST['sumpah'], $file_sk);
    $field = array('id', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'sumpah', 'file_sk');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pengangkatan_pns'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingJabatan'])) {
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

    $data = array($_POST['id'], $_POST['pym'], $_POST['no_sk_jabatan'], $_POST['tgl_sk_jabatan'], $_POST['jenis_jabatan'], $_POST['eselon'], $_POST['nama_jabatan'], $_POST['tmt'], $_POST['no_sk_pelantikan'], $_POST['tgl_sk_pelantikan'], $_POST['sumpah'], $file_sk_jabatan, $file_sk_pelantikan);
    $field = array('id', 'pym', 'no_sk_jabatan', 'tgl_sk_jabatan', 'jenis_jabatan', 'eselon', 'nama_jabatan', 'tmt', 'no_sk_pelantikan', 'tgl_sk_pelantikan', 'sumpah', 'file_sk_jabatan', 'file_sk_pelantikan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_jabatan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingPGR'])) {
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

    $data = array($_POST['id'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['pgr'], $_POST['tmt'], $file_sk);
    $field = array('id', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'file_sk');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pgr'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingKGB'])) {
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
    $data = array($_POST['id'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['tmt'], $masa_kerja, $_POST['kantor_pembayaran'], $file_sk);
    $field = array('id', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'masa_kerja', 'kantor_pembayaran', 'file_sk');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_kgb'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahRiwayatPGR'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('P', 'R');
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

    $data = array($id, $_POST['pegawai'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['pgr'], $_POST['tmt'], $file_sk);
    $field = array('id', 'pegawai', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'file_sk');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_pgr'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingRiwayatPGR'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

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

    $data = array($_POST['id'], $_POST['pegawai'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['pgr'], $_POST['tmt'], $file_sk);
    $field = array('id', 'pegawai', 'pym', 'no_sk', 'tgl_sk', 'pgr', 'tmt', 'file_sk');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_pgr'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusRiwayatPGR'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = req_get_where($koneksi, 'pegawai_riwayat_pgr', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'pegawai_riwayat_pgr'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $data['pegawai'] . '/', 'Berhasil', 'Berhasil menghapus data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $data['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahRiwayatKGB'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('P', 'R');
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
    $data = array($id, $_POST['pegawai'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['tmt'], $masa_kerja, $_POST['kantor_pembayaran'], $file_sk);
    $field = array('id', 'pegawai', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'masa_kerja', 'kantor_pembayaran', 'file_sk');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_kgb'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingRiwayatKGB'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

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

    $masa_kerja = ($_POST['masa_kerja_tahun'] * 12) + $_POST['masa_kerja_bulan'];
    $data = array($_POST['id'], $_POST['pegawai'], $_POST['pym'], $_POST['no_sk'], $_POST['tgl_sk'], $_POST['tmt'], $masa_kerja, $_POST['kantor_pembayaran'], $file_sk);
    $field = array('id', 'pegawai', 'pym', 'no_sk', 'tgl_sk', 'tmt', 'masa_kerja', 'kantor_pembayaran', 'file_sk');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_kgb'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusRiwayatKGB'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = req_get_where($koneksi, 'pegawai_riwayat_kgb', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'pegawai_riwayat_kgb'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $data['pegawai'] . '/', 'Berhasil', 'Berhasil menghapus data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $data['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahRiwayatJabatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('P', 'R');
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

    $data = array($id, $_POST['pegawai'], $_POST['pym'], $_POST['no_sk_jabatan'], $_POST['tgl_sk_jabatan'], $_POST['jenis_jabatan'], $_POST['eselon'], $_POST['nama_jabatan'], $_POST['tmt'], $_POST['no_sk_pelantikan'], $_POST['tgl_sk_pelantikan'], $file_sk_jabatan, $file_sk_pelantikan);
    $field = array('id', 'pegawai', 'pym', 'no_sk_jabatan', 'tgl_sk_jabatan', 'jenis_jabatan', 'eselon', 'nama_jabatan', 'tmt', 'no_sk_pelantikan', 'tgl_sk_pelantikan', 'file_sk_jabatan', 'file_sk_pelantikan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_jabatan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingRiwayatJabatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

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

    $data = array($_POST['id'], $_POST['pegawai'], $_POST['pym'], $_POST['no_sk_jabatan'], $_POST['tgl_sk_jabatan'], $_POST['jenis_jabatan'], $_POST['eselon'], $_POST['nama_jabatan'], $_POST['tmt'], $_POST['no_sk_pelantikan'], $_POST['tgl_sk_pelantikan'], $file_sk_jabatan, $file_sk_pelantikan);
    $field = array('id', 'pegawai', 'pym', 'no_sk_jabatan', 'tgl_sk_jabatan', 'jenis_jabatan', 'eselon', 'nama_jabatan', 'tmt', 'no_sk_pelantikan', 'tgl_sk_pelantikan', 'file_sk_jabatan', 'file_sk_pelantikan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_jabatan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusRiwayatJabatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = req_get_where($koneksi, 'pegawai_riwayat_jabatan', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'pegawai_riwayat_jabatan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $data['pegawai'] . '/', 'Berhasil', 'Berhasil menghapus data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $data['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahRiwayatPendidikanUmum'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('P', 'R');
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

    $data = array($id, $_POST['pegawai'], $_POST['tingkat_pendidikan'], $_POST['jurusan'], $_POST['nama_institusi'], $_POST['nama_kepala_institusi'], $_POST['no_sttb'], $_POST['tgl_sttb'], $file_sttb);
    $field = array('id', 'pegawai', 'tingkat_pendidikan', 'jurusan', 'nama_institusi', 'nama_kepala_institusi', 'no_sttb', 'tgl_sttb', 'file_sttb');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_pendidikan_umum'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingRiwayatPendidikanUmum'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

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

    $data = array($_POST['id'], $_POST['pegawai'], $_POST['tingkat_pendidikan'], $_POST['jurusan'], $_POST['nama_institusi'], $_POST['nama_kepala_institusi'], $_POST['no_sttb'], $_POST['tgl_sttb'], $file_sttb);
    $field = array('id', 'pegawai', 'tingkat_pendidikan', 'jurusan', 'nama_institusi', 'nama_kepala_institusi', 'no_sttb', 'tgl_sttb', 'file_sttb');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_pendidikan_umum'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusRiwayatPendidikanUmum'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = req_get_where($koneksi, 'pegawai_riwayat_pendidikan_umum', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'pegawai_riwayat_pendidikan_umum'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $data['pegawai'] . '/', 'Berhasil', 'Berhasil menghapus data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $data['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahRiwayatDiklat'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('P', 'R');
    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

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

    $data = array($id, $_POST['pegawai'], $_POST['jenis_diklat'], $_POST['nama_diklat'], $_POST['penyelenggara'], $_POST['angkatan'], $_POST['lama_pendidikan_h'], $_POST['lama_pendidikan_j'], $_POST['no_sttpp'], $_POST['tgl_sttpp'], $file_sttpp);
    $field = array('id', 'pegawai', 'jenis_diklat', 'nama_diklat', 'penyelenggara', 'angkatan', 'lama_pendidikan_h', 'lama_pendidikan_j', 'no_sttpp', 'tgl_sttpp', 'file_sttpp');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_diklat'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingRiwayatDiklat'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $path = cek_folder('../../resources/dokumen/' . $_POST['pegawai'] . '/');

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

    $data = array($_POST['id'], $_POST['pegawai'], $_POST['jenis_diklat'], $_POST['nama_diklat'], $_POST['penyelenggara'], $_POST['angkatan'], $_POST['lama_pendidikan_h'], $_POST['lama_pendidikan_j'], $_POST['no_sttpp'], $_POST['tgl_sttpp'], $file_sttpp);
    $field = array('id', 'pegawai', 'jenis_diklat', 'nama_diklat', 'penyelenggara', 'angkatan', 'lama_pendidikan_h', 'lama_pendidikan_j', 'no_sttpp', 'tgl_sttpp', 'file_sttpp');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_diklat'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusRiwayatDiklat'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = req_get_where($koneksi, 'pegawai_riwayat_diklat', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'pegawai_riwayat_diklat'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $data['pegawai'] . '/', 'Berhasil', 'Berhasil menghapus data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $data['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingOrangTua'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['nama_a'], $_POST['tempat_lahir_a'], $_POST['tgl_lahir_a'], $_POST['pekerjaan_a'], $_POST['nama_i'], $_POST['tempat_lahir_i'], $_POST['tgl_lahir_i'], $_POST['pekerjaan_i']);
    $field = array('id', 'nama_a', 'tempat_lahir_a', 'tgl_lahir_a', 'pekerjaan_a', 'nama_i', 'tempat_lahir_i', 'tgl_lahir_i', 'pekerjaan_i');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_ortu'));

    $data = array($_POST['id'], $_POST['provinsi_a'], $_POST['kabkot_a'], $_POST['kecamatan_a'], $_POST['keldes_a'], $_POST['rt_a'], $_POST['rw_a'], $_POST['kode_pos_a'], $_POST['alamat_a'], $_POST['provinsi_i'], $_POST['kabkot_i'], $_POST['kecamatan_i'], $_POST['keldes_i'], $_POST['rt_i'], $_POST['rw_i'], $_POST['kode_pos_i'], $_POST['alamat_i']);
    $field = array('id', 'provinsi_a', 'kabkot_a', 'kecamatan_a', 'keldes_a', 'rt_a', 'rw_a', 'kode_pos_a', 'alamat_a', 'provinsi_i', 'kabkot_i', 'kecamatan_i', 'keldes_i', 'rt_i', 'rw_i', 'kode_pos_i', 'alamat_i');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_ortu_alamat'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingMertua'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['nama_a'], $_POST['tempat_lahir_a'], $_POST['tgl_lahir_a'], $_POST['pekerjaan_a'], $_POST['nama_i'], $_POST['tempat_lahir_i'], $_POST['tgl_lahir_i'], $_POST['pekerjaan_i']);
    $field = array('id', 'nama_a', 'tempat_lahir_a', 'tgl_lahir_a', 'pekerjaan_a', 'nama_i', 'tempat_lahir_i', 'tgl_lahir_i', 'pekerjaan_i');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_mertua'));

    $data = array($_POST['id'], $_POST['provinsi_a'], $_POST['kabkot_a'], $_POST['kecamatan_a'], $_POST['keldes_a'], $_POST['rt_a'], $_POST['rw_a'], $_POST['kode_pos_a'], $_POST['alamat_a'], $_POST['provinsi_i'], $_POST['kabkot_i'], $_POST['kecamatan_i'], $_POST['keldes_i'], $_POST['rt_i'], $_POST['rw_i'], $_POST['kode_pos_i'], $_POST['alamat_i']);
    $field = array('id', 'provinsi_a', 'kabkot_a', 'kecamatan_a', 'keldes_a', 'rt_a', 'rw_a', 'kode_pos_a', 'alamat_a', 'provinsi_i', 'kabkot_i', 'kecamatan_i', 'keldes_i', 'rt_i', 'rw_i', 'kode_pos_i', 'alamat_i');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_mertua_alamat'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingPasangan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['nama'], $_POST['tempat_lahir'], $_POST['tgl_lahir'], $_POST['no_buku_nikah'], $_POST['tgl_buku_nikah'], $_POST['pendidikan_terakhir'], $_POST['pekerjaan']);
    $field = array('id', 'nama', 'tempat_lahir', 'tgl_lahir', 'no_buku_nikah', 'tgl_buku_nikah', 'pendidikan_terakhir', 'pekerjaan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_pasangan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahAnak'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('P', 'A');

    $data = array($id, $_POST['pegawai'], $_POST['nama'], $_POST['tempat_lahir'], $_POST['tgl_lahir'], $_POST['jenis_kelamin'], $_POST['status_anak'], $_POST['tunjangan'], $_POST['pendidikan_terakhir'], $_POST['pekerjaan']);
    $field = array('id', 'pegawai', 'nama', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'status_anak', 'tunjangan', 'pendidikan_terakhir', 'pekerjaan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_anak'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingAnak'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['id'], $_POST['pegawai'], $_POST['nama'], $_POST['tempat_lahir'], $_POST['tgl_lahir'], $_POST['jenis_kelamin'], $_POST['status_anak'], $_POST['tunjangan'], $_POST['pendidikan_terakhir'], $_POST['pekerjaan']);
    $field = array('id', 'pegawai', 'nama', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'status_anak', 'tunjangan', 'pendidikan_terakhir', 'pekerjaan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_anak'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusAnak'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = req_get_where($koneksi, 'pegawai_anak', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'pegawai_anak'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $data['pegawai'] . '/', 'Berhasil', 'Berhasil menghapus data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/' . $data['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahHonorer'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('P', 'I');
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

    $data = array($id, $_POST['nama'], $_POST['gelar_depan'], $_POST['gelar_belakang'], $_POST['tempat_lahir'], $_POST['tgl_lahir'], $_POST['jenis_kelamin'], $_POST['agama'], $_POST['no_hp'], $_POST['status_kepegawaian'], '13', $_POST['status_perkawinan'], $_POST['golongan_darah'], $_POST['npwp'], $_POST['opd'], $_POST['unit_organisasi'], $foto);
    $field = array('id', 'nama', 'gelar_depan', 'gelar_belakang', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'agama', 'no_hp', 'status_kepegawaian', 'kedudukan_pegawai', 'status_perkawinan', 'golongan_darah', 'npwp', 'opd', 'unit_organisasi', 'foto');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    $data = array($id, $_POST['provinsi'], $_POST['kabkot'], $_POST['kecamatan'], $_POST['keldes'], $_POST['rt'], $_POST['rw'], $_POST['kode_pos'], $_POST['alamat']);
    $field = array('id', 'provinsi', 'kabkot', 'kecamatan', 'keldes', 'rt', 'rw', 'kode_pos', 'alamat');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_alamat'));

    $data = array($id, $_POST['tmt'], $_POST['pendidikan_terakhir'], $_POST['jabatan']);
    $field = array('id', 'tmt', 'pendidikan_terakhir', 'jabatan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_honorer'));

    if ($_POST['role'] != '1') {
        $data = array($id, $_POST['nama'], $_POST['gelar_depan'], $_POST['gelar_belakang'], $_POST['tempat_lahir'], $_POST['tgl_lahir'], $_POST['jenis_kelamin'], $_POST['agama'], $_POST['no_hp'], $_POST['status_kepegawaian'], '13', $_POST['status_perkawinan'], $_POST['golongan_darah'], $_POST['npwp'], $_POST['opd'], $_POST['unit_organisasi'], $foto, date("Y-m-d H:i:s"), 'Dikirim');
        $field = array('id', 'nama', 'gelar_depan', 'gelar_belakang', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'agama', 'no_hp', 'status_kepegawaian', 'kedudukan_pegawai', 'status_perkawinan', 'golongan_darah', 'npwp', 'opd', 'unit_organisasi', 'foto', 'ts', 'status');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai'));

        $data = array($id, $_POST['provinsi'], $_POST['kabkot'], $_POST['kecamatan'], $_POST['keldes'], $_POST['rt'], $_POST['rw'], $_POST['kode_pos'], $_POST['alamat']);
        $field = array('id', 'provinsi', 'kabkot', 'kecamatan', 'keldes', 'rt', 'rw', 'kode_pos', 'alamat');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_alamat'));

        $data = array($id, $_POST['tmt'], $_POST['pendidikan_terakhir'], $_POST['jabatan']);
        $field = array('id', 'tmt', 'pendidikan_terakhir', 'jabatan');
        array_push($proses_check, submit_data($koneksi, $data, $field, 'usulan_pegawai_honorer'));
    }

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/' . $id . '/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/' . $id . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingHonorer'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = $_POST['id'];
    $path = cek_folder('../../resources/img/pegawai/');
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

    $data = array($id, $_POST['nama'], $_POST['gelar_depan'], $_POST['gelar_belakang'], $_POST['tempat_lahir'], $_POST['tgl_lahir'], $_POST['jenis_kelamin'], $_POST['agama'], $_POST['no_hp'], $_POST['status_kepegawaian'], $_POST['status_perkawinan'], $_POST['golongan_darah'], $_POST['npwp'], $_POST['opd'], $_POST['unit_organisasi'], $foto);
    $field = array('id', 'nama', 'gelar_depan', 'gelar_belakang', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'agama', 'no_hp', 'status_kepegawaian', 'status_perkawinan', 'golongan_darah', 'npwp', 'opd', 'unit_organisasi', 'foto');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai'));

    $data = array($id, $_POST['provinsi'], $_POST['kabkot'], $_POST['kecamatan'], $_POST['keldes'], $_POST['rt'], $_POST['rw'], $_POST['kode_pos'], $_POST['alamat']);
    $field = array('id', 'provinsi', 'kabkot', 'kecamatan', 'keldes', 'rt', 'rw', 'kode_pos', 'alamat');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_alamat'));

    $data = array($id, $_POST['tmt'], $_POST['pendidikan_terakhir'], $_POST['jabatan']);
    $field = array('id', 'tmt', 'pendidikan_terakhir', 'jabatan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_honorer'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/' . $id . '/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/' . $id . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahRiwayatKerjaHonorer'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('P', 'R');
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

    $data = array($id, $_POST['pegawai'], $_POST['tahun'], $_POST['opd'], $_POST['jabatan'], $_POST['no_sk'], $file_sk);
    $field = array('id', 'pegawai', 'tahun', 'opd', 'jabatan', 'no_sk', 'file_sk');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_kerja_honorer'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/' . $_POST['pegawai'] . '/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/' . $_POST['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingRiwayatKerjaHonorer'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

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

    $data = array($_POST['id'], $_POST['pegawai'], $_POST['tahun'], $_POST['opd'], $_POST['jabatan'], $_POST['no_sk'], $file_sk);
    $field = array('id', 'pegawai', 'tahun', 'opd', 'jabatan', 'no_sk', 'file_sk');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'pegawai_riwayat_kerja_honorer'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/' . $_POST['pegawai'] . '/riwayat-kerja/'.$_POST['id'].'/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/' . $_POST['pegawai'] . '/riwayat-kerja/'.$_POST['id'].'/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusRiwayatKerjaHonorer'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = req_get_where($koneksi, 'pegawai_riwayat_kerja_honorer', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'pegawai_riwayat_kerja_honorer'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/' . $data['pegawai'] . '/', 'Berhasil', 'Berhasil menghapus data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/' . $data['pegawai'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusPegawai'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'pegawai'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/', 'Berhasil', 'Berhasil menghapus pegawai.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusPegawaiHonorer'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'pegawai'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/', 'Berhasil', 'Berhasil menghapus pegawai.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SIMPEG_URL . 'daftar-pegawai/pegawai-honorer/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
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

        modal_konfirmasi($_POST['judul'], $_POST['form'], SIMPEG_URL . 'controllers/c-daftar-pegawai.php', $_POST['pertanyaan'], $_POST['parameter'], $_POST['data']);
    } else if ($_POST['req'] == 'Modal View File') {
        require "../../app/config.php";
        require "../../app/component.php";

        modal_preview_file($_POST['judul'], $_POST['file']);
    }
}
