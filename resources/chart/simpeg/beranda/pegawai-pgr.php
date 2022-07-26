<?php
require "../../../../app/config.php";
require "../../../../app/models.php";

$where = ($_GET['status_kepegawaian'] == 'ASN' ? '((status_kepegawaian = "Pegawai Negeri Sipil") OR (status_kepegawaian = "Calon Pegawai Negeri Sipil"))' : 'status_kepegawaian = "Pegawai Honorer"');

if (isset($_GET['opd'])) {
    $where .= 'AND opd_nama = "' . $_GET['opd'] . '"';

}

$conn = req_data_where($koneksi, 'cv_c_pegawai_pgr', $where);

$arr_kategori = array();
$arr_nilai = array();

while ($data = mysqli_fetch_array($conn)) {
    $opd = ($data['pgr'] == '' ? 'Tidak Diketahui' : $data['pgr']);

    if (!in_array($opd, $arr_kategori)) {
        array_push($arr_kategori, $opd);
        array_push($arr_nilai, 0);
    }

    $key = array_search($opd, $arr_kategori);
    $ganti = array($key => $arr_nilai[$key]++);
    array_replace($arr_nilai, $ganti);
}

$chart_data = array();

foreach ($arr_kategori as $key => $kategori) {
    $temp_arr = array($kategori, $arr_nilai[$key]);
    array_push($chart_data, $temp_arr);
}

echo json_encode($chart_data);
