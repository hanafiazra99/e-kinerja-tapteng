<?php
require "../../../../app/config.php";
require "../../../../app/models.php";
require "../../../../app/autentikasi.php";
require "../../../../app/component.php";
// echo '<table border = 1>';
// echo '<tr><td>Tanggal</td><td>Nama Libur</td></tr>';
// var_dump($decoded);
// echo $decoded[0]->holiday_date;
$check = req_data_where($koneksi,'absen_hari_libur',' year(tanggal) = '.date("Y"));
if(!empty($check)){
    pop_up_direct(BASE_URL, ABSENSI_URL . 'jadwal/hari-libur/', 'Berhasil', 'Sudah ditambah data libur pada tahun ' . date('Y'), 'modal-success');
}
for ($month = 1; $month <= 12; $month++) {

    $response = file_get_contents('https://api-harilibur.vercel.app/api?month=' . $month . '&year=' . date("Y"));
    $decoded = json_decode($response);
    for ($i = 0; $i < sizeof($decoded); $i++) {
        $proses_check = array();
        if ($decoded[$i]->is_national_holiday) {

            $data = array($decoded[$i]->holiday_date, $decoded[$i]->holiday_name);
            $field = array('tanggal', 'nama_libur');
            array_push($proses_check, submit_data($koneksi, $data, $field, 'absen_hari_libur'));
        }
    }
}
if (!in_array("fail", $proses_check)) {
    pop_up_direct(BASE_URL, ABSENSI_URL . 'jadwal/hari-libur/', 'Berhasil', 'Berhasil menambah data libur pada tahun ' . date('Y'), 'modal-success');
} else {
    pop_up_direct(BASE_URL, ABSENSI_URL . 'jadwal/hari-libur/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
}
// foreach($decoded as $data){
//     print_r('<tr><td>'.$data->holiday_date.'</td><td>'.$data['holiday_name'].'</td></tr>') ;
// }
// echo '</table>';
