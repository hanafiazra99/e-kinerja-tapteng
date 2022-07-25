<?php

function page_title()

{

    return 'Data Tugas Luar';

}



function portal_id()

{

    return '24';

}
if (isset($_POST['TombolTambahTugasLuar'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $masa_waktu = explode("-",$_POST['masa_tugas_luar']);
    $masa_awal = str_replace("/", "-", $masa_waktu[0]);
    $masa_akhir = str_replace("/", "-", $masa_waktu[1]);
    $data = array($_POST['pegawai'], $masa_awal, $masa_akhir, $_POST['keterangan']);
    $field = array('pegawai', 'tgl_awal', 'tgl_akhir', 'keterangan');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'absensi_jadwal_luar'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, ABSENSI_URL . 'laporan/rekap-tugas-luar', 'Berhasil', 'Berhasil mengubah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, ABSENSI_URL . 'laporan/rekap-tugas-luar', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
    }
}else if (isset($_POST['req'])) {
    if ($_POST['req'] == 'Change Select') {
        require "../../app/config.php";
        require "../../app/models.php";
        require "../../app/autentikasi.php";
        require "../../app/component.php";

        echo component_select_option_response_ajax($koneksi, $_POST['table'], $_POST['id'], $_POST['data'], $_POST['where']);
    } 
}

