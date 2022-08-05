<?php

function page_title()

{

    return 'Data Cuti';
}



function portal_id()

{

    return '38';
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
    $masa_waktu = explode("-", $_POST['masa_cuti']);
    $masa_awal = str_replace("/", "-", $masa_waktu[0]);
    $masa_akhir = str_replace("/", "-", $masa_waktu[1]);
    $tahun = explode('-', $masa_awal)[0];
    $pegawai = $_POST['pegawai'];



    $jatah_absen = 0;

    for ($i = 1; $i <= 2; $i++) {
        $conn = mysqli_query($koneksi, "SELECT absensi_jumlah_cuti_tahunan('" . $pegawai . "'," . ($tahun - $i) . ") as jumlah_absen");
        $cek_jumlah_absen = mysqli_fetch_array($conn);
        
        if($cek_jumlah_absen['jumlah_absen'] == 0){
            $jatah_absen = $jatah_absen +  $cek_jumlah_absen['jumlah_absen'];
        }else{
            break;
        }
        
    }
    
    $jatah_absen += 12;
    
    $conn = mysqli_query($koneksi, "SELECT absensi_jumlah_cuti_tahunan('" . $pegawai . "'," . $tahun . ") as jumlah_absen");
    $jumlah_absen = mysqli_fetch_array($conn);
    
    if ($jumlah_absen['jumlah_absen'] > $jatah_absen) {
        pop_up_direct(BASE_URL, ABSENSI_URL . 'laporan/rekap-cuti/', 'Gagal', 'Cuti sudah lebih dari 12 dalam setahun.', 'modal-danger');
    }
    
    

    $data = array('', $_POST['pegawai'], $masa_awal, $masa_akhir, $_POST['keterangan']);
    $field = array('id', 'pegawai', 'tgl_awal', 'tgl_akhir', 'keterangan');
    array_push($proses_check, tambah_data($koneksi, $data, $field, 'absensi_cuti'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, ABSENSI_URL . 'laporan/rekap-cuti/', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, ABSENSI_URL . 'laporan/rekap-cuti/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
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
