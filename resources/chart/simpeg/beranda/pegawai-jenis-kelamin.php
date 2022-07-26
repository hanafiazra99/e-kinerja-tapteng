<?php
require "../../../../app/config.php";
require "../../../../app/models.php";

$where = ($_GET['status_kepegawaian'] == 'ASN' ? '((status_kepegawaian = "Pegawai Negeri Sipil") OR (status_kepegawaian = "Calon Pegawai Negeri Sipil"))' : 'status_kepegawaian = "Pegawai Honorer"');

if (isset($_GET['opd'])) {
    $where .= 'AND opd_nama = "' . $_GET['opd'] . '"';

}

$conn = req_data_where($koneksi, 'cv_c_pegawai_jenis_kelamin', $where);

$arr_kategori = array();
$arr_nilai = array();

while ($data = mysqli_fetch_array($conn)) {
    $jenis_kelamin = ($data['jenis_kelamin'] == '' ? 'Tidak Diketahui' : $data['jenis_kelamin']);

    if (!in_array($jenis_kelamin, $arr_kategori)) {
        array_push($arr_kategori, $jenis_kelamin);
        array_push($arr_nilai, 0);
    }

    $key = array_search($jenis_kelamin, $arr_kategori);
    $ganti = array($key => $arr_nilai[$key]++);
    array_replace($arr_nilai, $ganti);
}

$chart_data = array();

foreach ($arr_kategori as $key => $kategori) {
    $temp_arr = array($kategori, $arr_nilai[$key]);
    array_push($chart_data, $temp_arr);
}

echo json_encode($chart_data);
