<?php
function page_title()
{
    return 'Sasaran';
}

function portal_id()
{
    return '29';
}

if (isset($_POST['TombolTambahSasaran'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('S', 'N');
    $data = array($id, $_POST['pegawai'], $_POST['p_awal'], $_POST['p_akhir'], '1');
    $field = array('id', 'pegawai', 'p_awal', 'p_akhir', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/', 'Berhasil', 'Berhasil menambah Sasaran.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahSasaranKegiatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('S', 'K');
    $data = array($id, $_POST['sasaran'], $_POST['kegiatan'], $_POST['kuantitas'], $_POST['output'], $_POST['kualitas'], $_POST['waktu'], $_POST['biaya']);
    $field = array('id', 'sasaran', 'kegiatan', 'kuantitas', 'output', 'kualitas', 'waktu', 'biaya');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_kegiatan'));

    $data = array($_POST['sasaran'], 'NULL', 'NULL', '1');
    $field = array('id', 'ts', 'tr', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['sasaran'] . '/', 'Berhasil', 'Berhasil menambah Sasaran Kegiatan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingSasaranKegiatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = $_POST['id'];
    $data = array($id, $_POST['sasaran'], $_POST['kegiatan'], $_POST['kuantitas'], $_POST['output'], $_POST['kualitas'], $_POST['waktu'], $_POST['biaya']);
    $field = array('id', 'sasaran', 'kegiatan', 'kuantitas', 'output', 'kualitas', 'waktu', 'biaya');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_kegiatan'));

    $data = array($_POST['sasaran'], 'NULL', 'NULL', '1');
    $field = array('id', 'ts', 'tr', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['sasaran'] . '/kegiatan/' . $id . '/', 'Berhasil', 'Berhasil mengubah Sasaran Kegiatan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusSasaranKegiatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['data'], 'NULL', 'NULL', '1');
    $field = array('id', 'ts', 'tr', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran'));

    $data = req_get_where($koneksi, 'skp_sasaran_kegiatan', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'skp_sasaran_kegiatan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $data['sasaran'] . '/', 'Berhasil', 'Berhasil menghapus Sasaran Kegiatan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSerahkanSasaran'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = array($_POST['data'], date("Y-m-d H:i:s"), '2');
    $field = array('id', 'ts', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['data'] . '/', 'Berhasil', 'Berhasil menyerahkan Sasaran.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahSasaranBulanan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = get_id('S', 'B');
    $periode = explode('-', $_POST['periode']);
    $data = array($id, $_POST['sasaran'], $periode[0], $periode[1], '1');
    $field = array('id', 'sasaran', 'tahun', 'bulan', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_bulanan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['sasaran'] . '/', 'Berhasil', 'Berhasil menambah Uraian Bulanan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingSasaranBulanan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $id = $_POST['id'];
    $periode = explode('-', $_POST['periode']);
    $data = array($id, $_POST['sasaran'], $periode[0], $periode[1], '2');
    $field = array('id', 'sasaran', 'tahun', 'bulan', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_bulanan'));

    $d_pegawai = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['pegawai'] . '"');
    $d_pegawai_pgr = req_get_where($koneksi, 'pegawai_pgr', 'id = "' . $_POST['pegawai'] . '"');
    $d_pegawai_jabatan = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $_POST['pegawai'] . '"');
    $d_pp = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['pp'] . '"');
    $d_pp_pgr = req_get_where($koneksi, 'pegawai_pgr', 'id = "' . $_POST['pp'] . '"');
    $d_pp_jabatan = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $_POST['pp'] . '"');

    $data = array($id, $_POST['pegawai'], $d_pegawai_pgr['pgr'], $d_pegawai_jabatan['nama_jabatan'], $d_pegawai['opd'], $_POST['pp'], $d_pp_pgr['pgr'], $d_pp_jabatan['nama_jabatan'], $d_pp['opd']);
    $field = array('id', 'pegawai', 'pegawai_pgr', 'pegawai_jabatan', 'pegawai_opd', 'pp', 'pp_pgr', 'pp_jabatan', 'pp_opd');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_bulanan_data'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['sasaran'] . '/', 'Berhasil', 'Berhasil mengubah Uraian Bulanan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusSasaranBulanan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $data = req_get_where($koneksi, 'skp_sasaran_bulanan', 'id = "' . $_POST['data'] . '"');
    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'skp_sasaran_bulanan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $data['sasaran'] . '/', 'Berhasil', 'Berhasil menghapus Uraian Bulanan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolTambahSasaranBulananKegiatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();

    $conn_sasaran_bulanan_kegiatan = req_data_where($koneksi, 'skp_sasaran_bulanan_kegiatan', 'sasaran_bulanan = "' . $_POST['sasaran_bulanan'] . '" AND kegiatan = "' . $_POST['kegiatan'] . '"');
    $banyak_periode = 1;
    $banyak_kuantitas = $_POST['kuantitas'];
    $data_kegiatan = req_get_where($koneksi, 'skp_sasaran_kegiatan', 'id = "' . $_POST['kegiatan'] . '"');
    $conn_kegiatan_bulanan = req_data_where($koneksi, 'skp_sasaran_bulanan_kegiatan', 'kegiatan = "' . $_POST['kegiatan'] . '"');
    while ($data_kegiatan_bulanan = mysqli_fetch_array($conn_kegiatan_bulanan)) {
        $banyak_periode += 1;
        $banyak_kuantitas += $data_kegiatan_bulanan['kuantitas'];
    }

    if (mysqli_num_rows($conn_sasaran_bulanan_kegiatan) == 0) {
        if ($banyak_periode <= $data_kegiatan['waktu'] and $banyak_kuantitas <= $data_kegiatan['kuantitas']) {
            $id = get_id('B', 'K');
            $data = array($id, $_POST['sasaran_bulanan'], $_POST['kegiatan'], $_POST['kuantitas'], $_POST['kualitas'], $_POST['biaya']);
            $field = array('id', 'sasaran_bulanan', 'kegiatan', 'kuantitas', 'kualitas', 'biaya');
            array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_bulanan_kegiatan'));

            $data = array($id, $_POST['kuantitas'], $_POST['kualitas'], $_POST['biaya']);
            $field = array('id', 'kuantitas', 'kualitas', 'biaya');
            array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_penilaian_bulanan_kegiatan'));

            $data = array($_POST['sasaran_bulanan'], 'NULL', 'NULL', '1');
            $field = array('id', 'ts', 'tr', 'status');
            array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_bulanan'));

            if (!in_array("fail", $proses_check)) {
                pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['sasaran'] . '/bulanan/' . $_POST['sasaran_bulanan'] . '/', 'Berhasil', 'Berhasil membagi kegiatan ke dalam periode bulanan.', 'modal-success');
            } else {
                pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['sasaran'] . '/bulanan/' . $_POST['sasaran_bulanan'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
            }
        } else {
            pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['sasaran'] . '/bulanan/' . $_POST['sasaran_bulanan'] . '/', 'Gagal', 'Pembagian Periode Atau Kuantitas Sudah Melebihi Rencana.', 'modal-danger');
        }
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['sasaran'] . '/bulanan/' . $_POST['sasaran_bulanan'] . '/', 'Gagal', 'Kegiatan yang dipilih sudah ada pada periode.', 'modal-danger');
    }
} else if (isset($_POST['TombolSuntingSasaranBulananKegiatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    array_push($proses_check, hapus_data($koneksi, $_POST['id'], 'id', 'skp_sasaran_bulanan_kegiatan'));
    $conn_sasaran_bulanan_kegiatan = req_data_where($koneksi, 'skp_sasaran_bulanan_kegiatan', 'sasaran_bulanan = "' . $_POST['sasaran_bulanan'] . '" AND kegiatan = "' . $_POST['kegiatan'] . '"');
    $banyak_periode = 1;
    $banyak_kuantitas = $_POST['kuantitas'];
    $data_kegiatan = req_get_where($koneksi, 'skp_sasaran_kegiatan', 'id = "' . $_POST['kegiatan'] . '"');
    $conn_kegiatan_bulanan = req_data_where($koneksi, 'skp_sasaran_bulanan_kegiatan', 'kegiatan = "' . $_POST['kegiatan'] . '"');
    while ($data_kegiatan_bulanan = mysqli_fetch_array($conn_kegiatan_bulanan)) {
        $banyak_periode += 1;
        $banyak_kuantitas += $data_kegiatan_bulanan['kuantitas'];
    }

    if (mysqli_num_rows($conn_sasaran_bulanan_kegiatan) == 0) {
        if ($banyak_periode <= $data_kegiatan['waktu'] and $banyak_kuantitas <= $data_kegiatan['kuantitas']) {
            $id = $_POST['id'];
            $data = array($id, $_POST['sasaran_bulanan'], $_POST['kegiatan'], $_POST['kuantitas'], $_POST['kualitas'], $_POST['biaya']);
            $field = array('id', 'sasaran_bulanan', 'kegiatan', 'kuantitas', 'kualitas', 'biaya');
            array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_bulanan_kegiatan'));

            $data = array($id, $_POST['kuantitas'], $_POST['kualitas'], $_POST['biaya']);
            $field = array('id', 'kuantitas', 'kualitas', 'biaya');
            array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_penilaian_bulanan_kegiatan'));

            $data = array($_POST['sasaran_bulanan'], 'NULL', 'NULL', '1');
            $field = array('id', 'ts', 'tr', 'status');
            array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_bulanan'));

            if (!in_array("fail", $proses_check)) {
                pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['sasaran'] . '/bulanan/' . $_POST['sasaran_bulanan'] . '/kegiatan/' . $_POST['id'] . '/', 'Berhasil', 'Berhasil mengubah uraian kegiatan pada periode bulanan.', 'modal-success');
            } else {
                pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['sasaran'] . '/bulanan/' . $_POST['sasaran_bulanan'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
            }
        } else {
            pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['sasaran'] . '/bulanan/' . $_POST['sasaran_bulanan'] . '/', 'Gagal', 'Pembagian Periode Atau Kuantitas Sudah Melebihi Rencana.', 'modal-danger');
        }
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $_POST['sasaran'] . '/bulanan/' . $_POST['sasaran_bulanan'] . '/', 'Gagal', 'Kegiatan yang dipilih sudah ada pada periode.', 'modal-danger');
    }
} else if (isset($_POST['TombolHapusSasaranBulananKegiatan'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data_sasaran_bulanan_kegiatan = req_get_where($koneksi, 'skp_sasaran_bulanan_kegiatan', 'id = "' . $_POST['data'] . '"');
    $data_sasaran_bulanan = req_get_where($koneksi, 'skp_sasaran_bulanan', 'id = "' . $data_sasaran_bulanan_kegiatan['sasaran_bulanan'] . '"');

    $data = array($data_sasaran_bulanan['id'], 'NULL', 'NULL', '1');
    $field = array('id', 'ts', 'tr', 'status');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_bulanan'));

    array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'skp_sasaran_bulanan_kegiatan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $data_sasaran_bulanan['sasaran'] . '/bulanan/' . $data_sasaran_bulanan['id'] . '/', 'Berhasil', 'Berhasil menghapus Kegiatan.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $data_sasaran_bulanan['sasaran'] . '/bulanan/' . $data_sasaran_bulanan['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
} else if (isset($_POST['TombolSerahkanSasaranBulanan'])) {
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
    array_push($proses_check, submit_data($koneksi, $data, $field, 'skp_sasaran_bulanan'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $data_sasaran_bulanan['sasaran'] . '/bulanan/' . $data_sasaran_bulanan['id'] . '/', 'Berhasil', 'Berhasil menyerahkan Sasaran.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, SKP_URL . 'sasaran/' . $data_sasaran_bulanan['sasaran'] . '/bulanan/' . $data_sasaran_bulanan['id'] . '/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
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

        modal_konfirmasi($_POST['judul'], $_POST['form'], SKP_URL . 'controllers/c-sasaran.php', $_POST['pertanyaan'], $_POST['parameter'], $_POST['data']);
    }
}
