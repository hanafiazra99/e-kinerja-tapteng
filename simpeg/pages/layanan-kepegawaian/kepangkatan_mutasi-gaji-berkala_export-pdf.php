<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(0);
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";

require '../../../resources/plugins/PHPExcel/Classes/PHPExcel.php';
require '../../../resources/plugins/phpspreadsheet/vendor/autoload.php';
require "../../../resources/plugins/mpdf/vendor/autoload.php";


cek_session();
$user_data = user_data($koneksi);

$data = req_get_where($koneksi, 'v_simpeg_lp_mutasi_kgb', ' id = "' . $_GET['key1'] . '"');
$data_asn = req_get_where($koneksi, 'pegawai', ' id "' . $data['pegawai_id'] . '"');

$opd = req_get_where($koneksi, 'opd', ' id = "' . $data['opd_asal_id'] . '"');
$kecamatan = req_get_where($koneksi, 'ref_kecamatan', ' id =  "' . $opd['kecamatan'] . '"');
$jabatan = req_get_where($koneksi, 'v_pegawai_jabatan', ' id="' . $data['pegawai_id' . '"']);
$content = '<!DOCTYPE html>
<html>

<head>
    <style>
        .page-break {
            page-break-after: always;
        }

        body {
            font-family: "Times New Roman", Times, serif;
        }

        table {
            border-collapse: collapse !important;
            font-weight: 400;
        }

        td {
            padding: 2px;

        }

        .ttd td {
            border: 1px solid white !important;
        }

        .content td {
            border: 1px solid #2596be;
        }

        th {
            padding: 2px;
        }

        @page {
            margin: 100px 40px;
        }

        

        footer {
            position: fixed;
            bottom: 50px;
            left: 0px;
            right: 0px;
            height: 50px;
        }
    </style>
</head>


<body>
    <div style="position:fixed;top:140px">
        <table style="width: 100%; margin-bottom: 20px; margin-top: -180px;border-bottom: 2px solid black;">
            <tr>
                <td style="width: 15%;"><img src="' . RESOURCES_URL . "/img/logo/logo.png" . '" style="width: 80px;"></td>
                <td style="text-align: center; vertical-align: middle !important;">
                    <font style="font-size: 12pt;">PEMERINTAH
                        KABUPATEN TAPANULI TENGAH
                    </font><br>
                    <font style="font-size: 14pt; font-weight: bold;">' . strtoupper($opd['nama']) . '</font><br>
                    <font style="font-size: 10pt;">' . $opd['alamat'] . ' Telp. ' . $opd['tlp'] . '</font><br>
                    <font style="font-size: 10pt;">' . ($kecamatan['nama'] ?? "") . '  ' . ($opd['kode_pos'] ?? "") . '
                    </font>
                </td>
                <td style="width: 15%;"></td>
            </tr>
        </table>
        
        <table style="width: 100%; margin-bottom: 20px;text-align:left;vertical-align:top" border="0">
            <tr>
                <td width="50%"></td>
                <td width="1%"></td>
                <td style="width: 49%;">' . $kecamatan['nama'] . ', ' . content_tgl_indo($data['tgl_sk']) . '</td>
            </tr>
            <tr>
                <td width="50%"><table style="vertical-align:top"><tr><td>Nomor</td><td>:</td><td>' . $data['no_sk'] . '</td></tr><tr><td>Sifat</td><td>:</td><td>Penting</td></tr><tr><td>Hal</td><td>:</td><td>Kenaikan Gaji Berkala <br>' . $data['pegawai_nama'] . '<br>' . $data['pegawai_nip'] . '</td></tr></table></td>
                <td width="1%">Yth</td>
                <td style="width: 49%;">' . $opd['nama'] . '<br> di ' . $kecamatan['nama'] . '</td>
            </tr>
            <tr>
                <td colspan="3"> Dengan ini diberitahukan bahwa berhubung dengan telah tercapainya masa kerja dan syarat-syarat lainnya kepada <br>
                    <table>
                        <tr>
                            <td>
                            1.
                            </td>
                            <td>
                            Nama
                            </td>
                            <td>
                            :
                            </td>
                            <td>' . $data['pegawai_nama'] . '
                        </td></tr>
                        <tr>
                            <td>
                            2.
                            </td>
                            <td>
                            Tanggal Lahir
                            </td>
                            <td>
                            :
                            </td>
                            <td>' . content_tgl_indo($data_asn['tgl_lahir']) . '
                        </td></tr>
                        <tr>
                            <td>
                            3.
                            </td>
                            <td>
                            Pangkat Gol Ruang
                            </td>
                            <td>
                            :
                            </td>
                            <td>
                            ' . $data['pgr'] . '
                        </td></tr>
                        <tr>
                            <td>
                            4.
                            </td>
                            <td>
                            Kantor Tempat Kerja
                            </td>
                            <td>
                            :
                            </td>
                            <td>' . $data['opd_asal_nama'] . '
                        </td></tr>
                        <tr>
                            <td>
                            5.
                            </td>
                            <td>
                            Gaji Pokok Terakhir
                            </td>
                            <td>
                            :
                            </td>
                            <td>
                        </td></tr>
                        <tr>
                            <td>
                            6.
                            </td>
                            <td>
                            Gaji Pokok Terbaru
                            </td>
                            <td>
                            :
                            </td>
                            <td>' . content_tgl_indo($data['gaji']) . '
                        </td></tr>
                        <tr>
                            <td>
                            7.
                            </td>
                            <td>
                            Bedasarkan Masa Kerja
                            </td>
                            <td>
                            :
                            </td>
                            <td>' . (floor($data['masa_kerja'] / 12)) . " Tahun " . ($data['masa_kerja'] % 12) . ' Bulan
                        </td></tr>
                        <tr>
                            <td>
                            8.
                            </td>
                            <td>
                            Golongan Ruang Gaji
                            </td>
                            <td>
                            :
                            </td>
                            <td>' . $data['pgr'] . '
                        </td></tr>
                        <tr>
                            <td>
                            9.
                            </td>
                            <td>
                            Terhitung Mulai
                            </td>
                            <td>
                            :
                            </td>
                            <td>' . content_tgl_indo($data['tmt']) . '
                        </td></tr>
                        <tr>
                            <td>
                            10.
                            </td>
                            <td>
                            Kenaikan Berikutnya
                            </td>
                            <td>
                            :
                            </td>
                            <td>' . content_tgl_indo(date('Y-m-d', strtotime('+2 years', strtotime($data['tmt'])))) . '
                        </td></tr>
                    </table><br>

                    Sesuai dengan keputusan presiden republik indonesia tentang pedoman pelaksanaan APBN Tahun anggaran 2022 kepada pegawai negeri sipil tersebut dapat dibayarkan penghasilan bedasarkan gaji pokok terbaru
                </td>
            </tr>
        </table>
        <table style="width:100%" border="0">
            <tr>
            <td style="width:55%"></td>
            <td> Pandan, ' . content_tgl_indo($data['tgl_sk']) . '<br>
                ' . $data['pym'] . ' <br>
                TAPANULI TENGAH<br><br><br><br><br><br>





                ' . $data['nama_pym'] . '<br>
                NIP. ' . $data['nip_pym'] . '<br>

            </td>
            </tr>
        
        </table>
        
        
    </div>
    


   


    <footer>
        <table style="width: 100%">

        </table>


        </div>

    </footer>
</body>

</html>
';


$mpdf = new \Mpdf\Mpdf();
$mpdf->AddPage("P", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
$mpdf->SetHTMLHeader('
<div style="text-align: center; font-weight: bold;">' .
    $header
    . '</div>');
$mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%">{DATE j-m-Y}</td>
        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right;"></td>
    </tr>
</table>');
$mpdf->WriteHTML($content);
$mpdf->SetColumns(2, 'J', 3);


$mpdf->Output();
