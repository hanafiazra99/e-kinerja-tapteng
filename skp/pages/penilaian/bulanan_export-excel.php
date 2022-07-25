<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-sasaran.php";
require '../../../resources/plugins/PHPExcel/Classes/PHPExcel.php';

cek_session();
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], SKP_URL . 'penilaian/');
check_page_request($_GET['key2'], SKP_URL . 'penilaian/');
$data_sasaran = req_get_where($koneksi, 'v_skp_sasaran', 'id = "' . $_GET['key1'] . '"');
$data_sasaran_bulanan = req_get_where($koneksi, 'v_skp_sasaran_bulanan', 'id = "' . $_GET['key2'] . '"');
$data_ttd = req_get_where($koneksi, 'cv_skp_penilaian_bulanan_ttd', 'id = "' . $data_sasaran_bulanan['id'] . '"');
$conn_kegiatan_bulanan = req_data_where($koneksi, 'v_skp_sasaran_bulanan_kegiatan', 'sasaran_bulanan = "' . $data_sasaran_bulanan['id'] . '"');
check_page_request($data_sasaran['id'], SKP_URL . 'penilaian/');
check_page_request($data_sasaran_bulanan['id'], SKP_URL . 'penilaian/');

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator(BASE_TITLE)
    ->setLastModifiedBy(BASE_TITLE)
    ->setTitle("Penilaian Sasaran Kerja Pegawai Negeri Sipil")
    ->setSubject("Penilaian Sasaran Kerja Pegawai Negeri Sipil " . $data_ttd['pegawai_nama'] . "")
    ->setDescription("Penilaian Sasaran Kerja Pegawai Negeri Sipil " . $data_ttd['pegawai_nama'] . " " . content_tgl_indo($data_sasaran['p_awal']) . " - " . content_tgl_indo($data_sasaran['p_akhir']) . " " . content_bulan_indo($data_sasaran_bulanan['bulan']) . " " . $data_sasaran_bulanan['tahun'] . "")
    ->setKeywords("Penilaian Sasaran Kerja Pegawai Negeri Sipil " . $data_ttd['pegawai_nama'] . " " . content_tgl_indo($data_sasaran['p_awal']) . ' - ' . content_tgl_indo($data_sasaran['p_akhir']) . " " . content_bulan_indo($data_sasaran_bulanan['bulan']) . " " . $data_sasaran_bulanan['tahun'] . "")
    ->setCategory("Penilaian Sasaran Kerja Pegawai Negeri Sipil");

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:T1');
$objPHPExcel->getActiveSheet(0)
    ->getCell('A1')
    ->setValue('Penilaian Sasaran Kerja');
$objPHPExcel->getActiveSheet(0)
    ->getStyle('A1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A2:T2');
$objPHPExcel->getActiveSheet(0)
    ->getCell('A2')
    ->setValue($data_ttd['pegawai_nama']);
$objPHPExcel->getActiveSheet(0)
    ->getStyle('A2')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A3:T3');
$objPHPExcel->getActiveSheet(0)
    ->getCell('A3')
    ->setValue(content_bulan_indo($data_sasaran_bulanan['bulan']) . ' ' . $data_sasaran_bulanan['tahun']);
$objPHPExcel->getActiveSheet(0)
    ->getStyle('A3')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$style = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => '000000'),
        'size' => 16,
        'name' => 'Calibri',
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFFFFF'),
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => 'FFFFFF'),
        ),
    ),
);

$objPHPExcel->getActiveSheet(0)->getStyle('A1:A3')->applyFromArray($style);
//End Title

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A7:A8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('B7:D8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('E7:E8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('F7:K7');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('L7:L8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('M7:R7');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('S7:S8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('T7:T8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('F8:G8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('I8:J8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('M8:N8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('P8:Q8');

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A7', 'No.')
    ->setCellValue('B7', 'I. Kegiatan Tugas Jabatan')
    ->setCellValue('E7', 'AK')
    ->setCellValue('F7', 'Target')
    ->setCellValue('L7', 'AK')
    ->setCellValue('M7', 'Realisasi')
    ->setCellValue('S7', 'Perhitungan')
    ->setCellValue('T7', 'Nilai Capaian')
    ->setCellValue('F8', 'Kuantitas/Output')
    ->setCellValue('H8', 'Kualitas/Mutu')
    ->setCellValue('I8', 'Waktu')
    ->setCellValue('K8', 'Biaya')
    ->setCellValue('M8', 'Kuantitas/Output')
    ->setCellValue('O8', 'Kualitas/Mutu')
    ->setCellValue('P8', 'Waktu')
    ->setCellValue('R8', 'Biaya');

$style_table_header = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => '000000'),
        'size' => 11,
        'name' => 'Calibri',
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'a6a6a6'),
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        ),
    ),
);

$objPHPExcel->getActiveSheet(0)->getStyle('A7:T8')->applyFromArray($style_table_header);
//End Table Header

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('B9:D9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('G9:G9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('I9:J9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('M9:N9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('P9:Q9');

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A9', '1')
    ->setCellValue('B9', '2')
    ->setCellValue('E9', '3')
    ->setCellValue('F9', '4')
    ->setCellValue('H9', '5')
    ->setCellValue('I9', '6')
    ->setCellValue('K9', '7')
    ->setCellValue('L9', '8')
    ->setCellValue('M9', '9')
    ->setCellValue('O9', '10')
    ->setCellValue('P9', '11')
    ->setCellValue('R9', '12')
    ->setCellValue('S9', '13')
    ->setCellValue('T9', '14');

$style_table_desc = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    'font' => array(
        'color' => array('rgb' => '000000'),
        'size' => 8,
        'name' => 'Calibri',
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFFFFF'),
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        ),
    ),
);

$objPHPExcel->getActiveSheet(0)->getStyle('A9:T9')->applyFromArray($style_table_desc);
//End Table Desc

$style_table_content = array(
    'font' => array(
        'color' => array('rgb' => '000000'),
        'size' => 11,
        'name' => 'Calibri',
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFFFFF'),
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        ),
    ),
);

$cell_no = 10;
$no = 1;
$total_capaian = 0;
$banyak_kegiatan = 0;
while ($data_kegiatan_bulanan = mysqli_fetch_array($conn_kegiatan_bulanan)) {
    $data_penilaian_bulanan_kegiatan = req_get_where($koneksi, 'v_skp_penilaian_bulanan_kegiatan', 'id = "' . $data_kegiatan_bulanan['id'] . '"');

    $n_kuantitas = ($data_penilaian_bulanan_kegiatan['kuantitas'] / $data_kegiatan_bulanan['kuantitas']) * 100;
    $n_kualitas = ($data_penilaian_bulanan_kegiatan['kualitas'] / $data_kegiatan_bulanan['kualitas']) * 100;
    $n_waktu = (((1.76 * 1) - 1) / 1) * 100;
    $n = 3;
    if ($data_kegiatan_bulanan['biaya'] != 0) {
        $n_biaya = (((1.76 * $data_penilaian_bulanan_kegiatan['biaya']) - $data_kegiatan_bulanan['biaya']) / $data_penilaian_bulanan_kegiatan['biaya']) * 100;
        $n++;
    } else {
        $n_biaya = 0;
    }

    $perhitungan = $n_kuantitas + $n_kualitas + $n_waktu + $n_biaya;
    $capaian = $perhitungan / $n;
    $total_capaian += $capaian;

    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('B' . $cell_no . ':D' . $cell_no . '');

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $cell_no . '', $no)
        ->setCellValue('B' . $cell_no . '', $data_kegiatan_bulanan['kegiatan'])
        ->setCellValue('F' . $cell_no . '', $data_kegiatan_bulanan['kuantitas'])
        ->setCellValue('G' . $cell_no . '', $data_kegiatan_bulanan['output'])
        ->setCellValue('H' . $cell_no . '', $data_kegiatan_bulanan['kualitas'])
        ->setCellValue('I' . $cell_no . '', '1')
        ->setCellValue('J' . $cell_no . '', 'Bulan')
        ->setCellValue('K' . $cell_no . '', $data_kegiatan_bulanan['biaya'])
        ->setCellValue('M' . $cell_no . '', $data_penilaian_bulanan_kegiatan['kuantitas'])
        ->setCellValue('N' . $cell_no . '', $data_kegiatan_bulanan['output'])
        ->setCellValue('O' . $cell_no . '', $data_penilaian_bulanan_kegiatan['kualitas'])
        ->setCellValue('P' . $cell_no . '', '1')
        ->setCellValue('Q' . $cell_no . '', 'Bulan')
        ->setCellValue('R' . $cell_no . '', $data_penilaian_bulanan_kegiatan['biaya'])
        ->setCellValue('S' . $cell_no . '', number_format($perhitungan, 2, ',', '.'))
        ->setCellValue('T' . $cell_no . '', number_format($capaian, 2, ',', '.'));

    $objPHPExcel->getActiveSheet(0)->getStyle('A' . $cell_no . ':T' . $cell_no . '')->applyFromArray($style_table_content);
    $objPHPExcel->getActiveSheet(0)->getStyle('A' . $cell_no . ':T' . $cell_no . '')->getAlignment()->setWrapText(true);
    $cell_no++;
    $no++;
    $banyak_kegiatan++;
}
$total_capaian = $total_capaian / $banyak_kegiatan;
$data_interval_sebutan = req_get_where($koneksi, 'ref_skp_interval_penilaian', 'min >= ' . $total_capaian . ' AND ' . $total_capaian . ' <= max');
$sebutan_kualitas = ((91 <= $total_capaian and $total_capaian <= 100) ? 'Sangat Baik' : ((76 <= $total_capaian and $total_capaian <= 90) ? 'Baik' : ((61 <= $total_capaian and $total_capaian <= 75) ? 'Cukup' : ((51 <= $total_capaian and $total_capaian <= 60) ? 'Kurang' : 'Buruk'))));
$cell_mark = $cell_no;
$cell_no++;
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A' . $cell_mark . ':S' . $cell_no . '');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A' . $cell_mark . '', 'Nilai Capaian SKP Bulanan')
    ->setCellValue('T' . $cell_mark . '', number_format($total_capaian, 2, ',', '.'))
    ->setCellValue('T' . $cell_no . '', $data_interval_sebutan['label']);

$objPHPExcel->getActiveSheet(0)->getStyle('A' . $cell_mark . ':T' . $cell_no . '')->applyFromArray($style_table_content);
$objPHPExcel->getActiveSheet(0)->getStyle('A' . $cell_mark . ':T' . $cell_no . '')->getAlignment()->setWrapText(true);

$cell_no++;
$cell_no++;

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O' . $cell_no . '', 'Sibolga, ' . date('t', strtotime($data_sasaran_bulanan['tahun'] . '-' . $data_sasaran_bulanan['bulan'] . '-01')) . ' ' . content_bulan_indo($data_sasaran_bulanan['bulan']) . ' ' . $data_sasaran_bulanan['tahun'] . '');
$cell_no++;
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('O' . $cell_no . '', 'Pejabat Penilai,');
$cell_no++;
$cell_no++;
$cell_no++;
$cell_no++;

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('O' . $cell_no . '', $data_ttd['pp_nama']);
$cell_no++;

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('O' . $cell_no . '', $data_ttd['pp_pangkat']);
$cell_no++;

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('O' . $cell_no . '', 'NIP. ' . $data_ttd['pp_nip']);
$cell_no++;

$objPHPExcel->getActiveSheet(0)->setTitle('Penilaian Sasaran Kerja');
$nama_file = "Penilaian SKP Bulanan " . $data_ttd['pegawai_nama'] . " " . content_bulan_indo($data_sasaran_bulanan['bulan']) . " " . $data_sasaran_bulanan['tahun'] . ".xlsx";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nama_file . '"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 10 Jul 2017 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
