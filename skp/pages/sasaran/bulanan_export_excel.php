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
check_page_request($_GET['key1'], SKP_URL . 'sasaran/');
check_page_request($_GET['key2'], SKP_URL . 'sasaran/');
$data = req_get_where($koneksi, 'v_skp_sasaran_bulanan', 'id = "' . $_GET['key2'] . '"');
$data_sasaran = req_get_where($koneksi, 'v_skp_sasaran', 'id = "' . $_GET['key1'] . '"');
$data_ttd = req_get_where($koneksi, 'cv_skp_sasaran_bulanan_ttd', 'id = "' . $data['id'] . '"');
$conn_kegiatan = req_data_where($koneksi, 'v_skp_sasaran_bulanan_kegiatan', 'sasaran_bulanan = "' . $data['id'] . '"');
check_page_request($data['id'], SKP_URL . 'sasaran/');

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator(BASE_TITLE)
    ->setLastModifiedBy(BASE_TITLE)
    ->setTitle("Sasaran Kerja Pegawai Negeri Sipil " . $data_ttd['pegawai_nama'] . " " . content_bulan_indo($data['bulan']) . "  " . $data['tahun'] . "")
    ->setSubject($data_ttd['pegawai_nama'])
    ->setDescription("Sasaran Kerja Pegawai Negeri Sipil " . $data_ttd['pegawai_nama'] . " " . content_tgl_indo($data_sasaran['p_awal']) . " - " . content_tgl_indo($data_sasaran['p_akhir']) . " " . content_bulan_indo($data['bulan']) . " - " . $data['tahun'] . "")
    ->setKeywords("Sasaran Kerja Pegawai Negeri Sipil " . content_tgl_indo($data_sasaran['p_awal']) . " - " . content_tgl_indo($data_sasaran['p_akhir']) . "")
    ->setCategory("Sasaran Kerja Pegawai Negeri Sipil Bulanan");

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:N1');
$objPHPExcel->getActiveSheet(0)
    ->getCell('A1')
    ->setValue('Sasaran Kerja');
$objPHPExcel->getActiveSheet(0)
    ->getStyle('A1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A2:N2');
$objPHPExcel->getActiveSheet(0)
    ->getCell('A2')
    ->setValue('Pegawai Negeri Sipil');
$objPHPExcel->getActiveSheet(0)
    ->getStyle('A2')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A3:N3');
$objPHPExcel->getActiveSheet(0)
    ->getCell('A3')
    ->setValue(content_bulan_indo($data['bulan']) . ' ' . $data['tahun']);
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
    ->mergeCells('B4:E4');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('G4:N4');

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A4', 'No.')
    ->setCellValue('B4', 'I. Pejabat Penilai')
    ->setCellValue('F4', 'No. ')
    ->setCellValue('G4', 'II. Pegawai Negeri Sipil Yang Dinilai');

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

$objPHPExcel->getActiveSheet(0)->getStyle('A4:N4')->applyFromArray($style_table_header);
//End Table Header

for ($i = 5; $i <= 9; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('B' . $i . ':C' . $i . '');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('D' . $i . ':E' . $i . '');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('G' . $i . ':I' . $i . '');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('J' . $i . ':N' . $i . '');
}

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A5', '1')
    ->setCellValue('B5', 'Nama')
    ->setCellValue('D5', $data_ttd['pp_nama'])
    ->setCellValue('F5', '1')
    ->setCellValue('G5', 'Nama')
    ->setCellValue('J5', $data_ttd['pegawai_nama'])
    ->setCellValue('A6', '2')
    ->setCellValue('B6', 'NIP')
    ->setCellValue('D6', $data_ttd['pp_nip'])
    ->setCellValue('F6', '2')
    ->setCellValue('G6', 'NIP')
    ->setCellValue('J6', $data_ttd['pegawai_nip'])
    ->setCellValue('A7', '3')
    ->setCellValue('B7', 'Pangkat/Gol.Ruang')
    ->setCellValue('D7', $data_ttd['pp_pangkat'] . '/(' . $data_ttd['pp_golongan'] . '/' . $data_ttd['pp_ruang'] . ')')
    ->setCellValue('F7', '3')
    ->setCellValue('G7', 'Pangkat/Gol.Ruang')
    ->setCellValue('J7', $data_ttd['pegawai_pangkat'] . '/(' . $data_ttd['pegawai_golongan'] . '/' . $data_ttd['pegawai_ruang'] . ')')
    ->setCellValue('A8', '4')
    ->setCellValue('B8', 'Jabatan')
    ->setCellValue('D8', $data_ttd['pp_jabatan'])
    ->setCellValue('F8', '4')
    ->setCellValue('G8', 'Jabatan')
    ->setCellValue('J8', $data_ttd['pegawai_jabatan'])
    ->setCellValue('A9', '5')
    ->setCellValue('B9', 'Unit Kerja')
    ->setCellValue('D9', $data_ttd['pp_opd'])
    ->setCellValue('F9', '5')
    ->setCellValue('G9', 'Unit Kerja')
    ->setCellValue('J9', $data_ttd['pegawai_opd']);

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

$objPHPExcel->getActiveSheet(0)->getStyle('A5:N9')->applyFromArray($style_table_content);
$objPHPExcel->getActiveSheet(0)->getStyle('A5:N9')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(-1);
//End Table Content

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A10:A11');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('B10:E11');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('F10:F11');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('G10:N10');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('G11:H11');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('I11:J11');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('K11:L11');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('M11:N11');

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A10', 'No.')
    ->setCellValue('B10', 'III. Kegiatan Tugas Jabatan')
    ->setCellValue('F10', 'AK*')
    ->setCellValue('G10', 'Target')
    ->setCellValue('G11', 'Kuantitas/Output')
    ->setCellValue('I11', 'Kualitas/Mutu')
    ->setCellValue('K11', 'Waktu')
    ->setCellValue('M11', 'Biaya');

$objPHPExcel->getActiveSheet(0)->getStyle('A10:N11')->applyFromArray($style_table_header);
//End Table Header

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('B12:E12');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('G12:H12');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('I12:J12');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('K12:L12');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('M12:N12');

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A12', '1')
    ->setCellValue('B12', '2')
    ->setCellValue('F12', '3')
    ->setCellValue('G12', '4')
    ->setCellValue('I12', '5')
    ->setCellValue('K12', '6')
    ->setCellValue('M12', '7');

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

$objPHPExcel->getActiveSheet(0)->getStyle('A12:N12')->applyFromArray($style_table_desc);
//End Table Desc

$cell_no = 13;
$no = 1;
while ($data_kegiatan = mysqli_fetch_array($conn_kegiatan)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('B' . $cell_no . ':E' . $cell_no . '');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('I' . $cell_no . ':J' . $cell_no . '');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('M' . $cell_no . ':N' . $cell_no . '');

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $cell_no . '', $no)
        ->setCellValue('B' . $cell_no . '', $data_kegiatan['kegiatan'])
        ->setCellValue('G' . $cell_no . '', $data_kegiatan['kuantitas'])
        ->setCellValue('H' . $cell_no . '', $data_kegiatan['output'])
        ->setCellValue('I' . $cell_no . '', $data_kegiatan['kualitas'])
        ->setCellValue('K' . $cell_no . '', '1')
        ->setCellValue('L' . $cell_no . '', 'Bulan')
        ->setCellValue('M' . $cell_no . '', $data_kegiatan['biaya']);

    $objPHPExcel->getActiveSheet(0)->getStyle('A' . $cell_no . ':N' . $cell_no . '')->applyFromArray($style_table_content);
    $objPHPExcel->getActiveSheet(0)->getStyle('A' . $cell_no . ':N' . $cell_no . '')->getAlignment()->setWrapText(true);
    $cell_no++;
    $no++;
}
$cell_mark = $cell_no;
$cell_no++;

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $cell_no . '', 'Sibolga, ' . content_tgl_indo($data['ts']) . '');
$cell_no++;
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('C' . $cell_no . '', 'Pejabat Penilai,')
    ->setCellValue('H' . $cell_no . '', 'Pegawai Negeri Sipil Yang Dinilai,');
$cell_no++;
$cell_no++;
$cell_no++;
$cell_no++;

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('C' . $cell_no . '', $data_ttd['pp_nama'])
    ->setCellValue('H' . $cell_no . '', $data_ttd['pegawai_nama']);
$cell_no++;

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('C' . $cell_no . '', $data_ttd['pp_pangkat'])
    ->setCellValue('H' . $cell_no . '', $data_ttd['pegawai_pangkat']);
$cell_no++;

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('C' . $cell_no . '', 'NIP. ' . $data_ttd['pp_nip'])
    ->setCellValue('H' . $cell_no . '', 'NIP. ' . $data_ttd['pegawai_nip']);
$cell_no++;

$objPHPExcel->getActiveSheet(0)->setTitle('Sasaran Kerja');
$nama_file = "SKP Bulanan " . $data_ttd['pegawai_nip'] . " " . content_bulan_indo($data['bulan']) . " " . $data['tahun'] . ".xlsx";

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
