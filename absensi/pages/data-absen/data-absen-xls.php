<?php
header("Content-Description: Download file excel");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_absen_".date("d-m-Y").".xls");
header("Pragma: public");
header("Expires: 0");

require "../../../app/config.php";
require "../../../app/models.php";

cek_session();
$tanggal = date('Y-m-d');
$data_riwayat = req_get_where($koneksi_absensi_baru, 'riwayat', 'tanggal = "'.$tanggal.'" AND jenis = "absen" ORDER BY nip');

?>
<div style="text-align: center;"><strong>
    <?php
        echo "DAFTAR HADIR PEGAWAI<br>";
        echo "Tanggal " . $tanggal;
    ?>
</strong></div>
<div>
<table id="tablerinci" cellpadding="2px" cellspacing="2px" width="2500px">
    <thead>
    <tr id="headerrinci">
        <th width="30px">No.</th>
        <th width="120px">NIP</th>
        <th width="240px">Nama</th>
        <th width="60px">IN</th>
        <th width="60px">OUT</th>
        <th width="150px">Koordinat</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $start_no = 0;
    foreach ($data_riwayat as $riwayat){
        $data_pegawai = req_get_where($koneksi, 'cv_asn', 'nip = "'.$riwayat['nip'].'" ');

        $start_no++;
        $class = $start_no%2;
        echo "
                                <tr>
                                    <td align='center'>".$start_no."</td>
                                    <td>".$riwayat['nip']."</td>
                                    <td>".$data_pegawai['nama']."</td>
                                    <td>".$riwayat['waktu']."</td>
                                    <td>".$riwayat['waktu']."</td>
                                    <td>".$riwayat['latitude'].", ".$riwayat['logitude']."</td>
                                </tr>
                            ";
        #}
    }
    ?>
    </tbody>
</table>