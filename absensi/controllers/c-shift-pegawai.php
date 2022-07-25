<?php

function page_title()

{

    return 'Data Cuti';

}



function portal_id()

{

    return '39';

}
if (isset($_POST['TombolTambahShiftPegawai'])) {
    require "../../app/config.php";
    require "../../app/models.php";
    require "../../app/autentikasi.php";
    require "../../app/component.php";

    foreach ($_POST as $name => $val) {
        $_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
    }

    $proses_check = array();
    $data = array($_POST['pegawai'], $_POST['tanggal'], $_POST['shift']);
    $field = array('pegawai', 'tanggal', 'shift');
    array_push($proses_check, submit_data($koneksi, $data, $field, 'absen_shift_pegawai'));

    if (!in_array("fail", $proses_check)) {
        pop_up_direct(BASE_URL, ABSENSI_URL . 'shift-pegawai/', 'Berhasil', 'Berhasil menambah data.', 'modal-success');
    } else {
        pop_up_direct(BASE_URL, ABSENSI_URL . 'shift-pegawai/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
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

