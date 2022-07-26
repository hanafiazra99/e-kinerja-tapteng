<?php
require "../../../../app/config.php";
require "../../../../app/models.php";

if (isset($_GET['opd'])) {
    $conn = req_data_where($koneksi, 'cv_c_pegawai_jenis_kepegawaian', 'opd_nama = "' . $_GET['opd'] . '"');
} else {
    $conn = req_data($koneksi, 'cv_c_pegawai_jenis_kepegawaian');
}

$arr_kategori = array();
$arr_nilai = array();

while ($data = mysqli_fetch_array($conn)) {
    $jenis_kepegawaian = ($data['jenis_kepegawaian'] == '' ? 'Tidak Diketahui' : $data['jenis_kepegawaian']);

    if (!in_array($jenis_kepegawaian, $arr_kategori)) {
        array_push($arr_kategori, $jenis_kepegawaian);
        array_push($arr_nilai, 0);
    }

    $key = array_search($jenis_kepegawaian, $arr_kategori);
    $ganti = array($key => $arr_nilai[$key]++);
    array_replace($arr_nilai, $ganti);
}

$chart_data = array();

foreach ($arr_kategori as $key => $kategori) {
    $temp_arr = array($kategori, $arr_nilai[$key]);
    array_push($chart_data, $temp_arr);
}

echo json_encode($chart_data);
