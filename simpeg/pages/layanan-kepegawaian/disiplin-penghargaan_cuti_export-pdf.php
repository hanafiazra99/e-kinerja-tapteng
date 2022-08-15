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

$data = req_get_where($koneksi, 'v_simpeg_lp_cuti', ' id = "' . $_GET['key1'] . '"');


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
    
    <table style="width: 100%; margin-bottom: 20px;text-align:center">
        <tr>
            <td style="width: 100%;"><b><u>Surat Izin ' . ($data['jenis_cuti'] ?? '') . '</u></b></td>
        </tr>
        <tr>
            <td style="width: 100%;"><b><u>Nomor : ' . ($data['no_sk'] ?? '') . '</u></b></td>
        </tr>
    </table>
    
    <table style="vertical-align:top" >
        <tr>
            <td style="vertical-align:top">1.</td>
            <td>Diberikan Cuti Alasan Penting kepada Aparatur Sipil Negara : <br>
                <table >
                    <tr>
                        <td width="30%">
                        Nama
                        </td>
                        <td width="1px">
                        :
                        </td>
                        <td>
                        <b>' . $data['pegawai_nama'] . '</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        N I P
                        </td>
                        <td>
                        :
                        </td>
                        <td>
                        ' . $data['pegawai_nip'] . '
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Pangkat/Gol. Ruang
                        </td>
                        <td>
                        :
                        </td>
                        <td>
                        '.$data['pgr'].'
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Jabatan	
                        </td>
                        <td>
                        :
                        </td>
                        <td>
                        ' . $jabatan['nama_jabatan'] . '
                        </td>
                    </tr>
                    <tr>
                        <td>
                        Unit Kerja
                        </td>
                        <td>
                        :
                        </td>
                        <td>
                        '.$data['opd_asal_nama'].'
                        </td>
                    </tr>
                    <tr>
                        <td>
                        
                        </td>
                        <td>
                        
                        </td>
                        <td>
                        Kabupaten Tapanuli Tengah
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                        terhitung  mulai  tanggal ' . content_tgl_indo($data['tgl_mulai']) . ' s/d ' . content_tgl_indo($data['tgl_selesai']) . ', dengan  ketentuan  sebagai berikut:<br>
                            <table style="vertical-align:top">
                                <tr>
                                    <td>a.</td>
                                    <td>Sebelum menjalankan Cuti Alasan Penting wajib  menyerahkan  pekerjaannya kepada  Atasan Langsungnya atau Pejabat lain yang dihunjuk.</td>
                                </tr>
                                <tr>
                                    <td>b.</td>
                                    <td>Setelah selesai menjalankan Cuti Alasan Penting wajib melaporkan diri kepada  atasan langsungnya dan bekerja kembali sebagaimana biasa.</td>
                                </tr>
                            </table>
                        
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Demikian Surat Izin Cuti Alasan Penting ini dibuat untuk dapat digunakan sebagaimana mestinya.-</td>
        </tr>
    </table>
    <table style="width:100%" border="0">
        <tr>
        <td style="width:55%"></td>
        <td> Pandan, ' . content_tgl_indo($data['tgl_mulai']) . '<br>
            KEPALA BADAN KEPEGAWAIAN DAERAH <br>
            TAPANULI TENGAH<br><br><br><br><br><br>





            YETTY SEMBIRING, S.STP, MM<br>
            PEMBINA <br>
            NIP. 19790528 199803 2 003<br>

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
