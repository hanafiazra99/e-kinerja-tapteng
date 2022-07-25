<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require '../../../resources/plugins/PHPExcel/Classes/PHPExcel.php';

cek_session();
$objPHPExcel = new PHPExcel();


$conn_absen = req_data($koneksi, "v_simpeg_lp_bazzetting ");

$objPHPExcel->getProperties()->setCreator(BASE_TITLE)
    ->setLastModifiedBy(BASE_TITLE)
    ->setTitle("Bazetting Pegawai")
    ->setSubject("Bazetting Pegawai")
    ->setDescription("Bazetting Pegawai")
    ->setKeywords("Bazetting Pegawai")
    ->setCategory("Bazetting Pegawai");

$objPHPExcel->getActiveSheet(0)
    ->getCell('Z1')
    ->setValue('KKA KEPEG-3');


$objPHPExcel->getActiveSheet(0)
    ->getCell('H2')
    ->setValue('DAFTAR');
$objPHPExcel->getActiveSheet(0)
    ->getCell('K2')
    ->setValue(':BAZETTING PEGAWAI');
$objPHPExcel->getActiveSheet(0)
    ->getCell('H3')
    ->setValue('UNIT KERJA');
$objPHPExcel->getActiveSheet(0)
    ->getCell('K3')
    ->setValue(':KABUPATEN TAPANULI TENGAH');
$objPHPExcel->getActiveSheet(0)
    ->getCell('H4')
    ->setValue('T.A');
$objPHPExcel->getActiveSheet(0)
    ->getCell('K4')
    ->setValue(':' . date('Y'));





$style = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => '000000'),
        'size' => 10,
        'name' => 'Arial',
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFFF00'),
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        ),
    ),
);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(40);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('P')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('Q')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('R')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('S')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('T')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('U')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('V')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('W')->setWidth(3);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('X')->setWidth(8);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('Y')->setWidth(14);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('Z')->setWidth(14);


$objPHPExcel->getActiveSheet(0)->getStyle('A6:Z8')->applyFromArray($style);


$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A6:A8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('B6:B8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('C6:C8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('X6:X8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('X6:X8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('Z6:Z8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('D6:W6');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('D7:H7');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('I7:M7');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('N7:R7');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('S7:W7');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('X6:X8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('Y6:Y8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('Z6:Z8');
$style_table_content = array(
    // 'font' => array(
    //     'color' => array('rgb' => '000000'),
    //     'size' => 11,
    //     'name' => 'Calibri',
    // ),
    // 'fill' => array(
    //     'type' => PHPExcel_Style_Fill::FILL_SOLID,
    //     'color' => array('rgb' => 'FFFFFF'),
    // ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        ),
    ),
);

$objPHPExcel->getActiveSheet(0)
    ->getStyle('A6:Z8')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);


$objPHPExcel->getActiveSheet(0)
    ->getCell('A6')
    ->setValue("No");
$objPHPExcel->getActiveSheet(0)
    ->getCell('B6')
    ->setValue("Unit Kerja");
$objPHPExcel->getActiveSheet(0)
    ->getCell('C6')
    ->setValue("Jumlah PNS");
$objPHPExcel->getActiveSheet(0)
    ->getCell('D6')
    ->setValue("Golongan/Ruang");
$objPHPExcel->getActiveSheet(0)
    ->getCell('D7')
    ->setValue("IV");
$objPHPExcel->getActiveSheet(0)
    ->getCell('I7')
    ->setValue("III");
$objPHPExcel->getActiveSheet(0)
    ->getCell('N7')
    ->setValue("II");
$objPHPExcel->getActiveSheet(0)
    ->getCell('S7')
    ->setValue("I");
$objPHPExcel->getActiveSheet(0)
    ->getCell('D8')
    ->setValue("d");
$objPHPExcel->getActiveSheet(0)
    ->getCell('E8')
    ->setValue("c");
$objPHPExcel->getActiveSheet(0)
    ->getCell('F8')
    ->setValue("b");
$objPHPExcel->getActiveSheet(0)
    ->getCell('G8')
    ->setValue("a");
$objPHPExcel->getActiveSheet(0)
    ->getCell('H8')
    ->setValue("JLH");
$objPHPExcel->getActiveSheet(0)
    ->getCell('I8')
    ->setValue("d");
$objPHPExcel->getActiveSheet(0)
    ->getCell('J8')
    ->setValue("c");
$objPHPExcel->getActiveSheet(0)
    ->getCell('K8')
    ->setValue("b");
$objPHPExcel->getActiveSheet(0)
    ->getCell('L8')
    ->setValue("a");
$objPHPExcel->getActiveSheet(0)
    ->getCell('M8')
    ->setValue("JLH");
$objPHPExcel->getActiveSheet(0)
    ->getCell('N8')
    ->setValue("d");
$objPHPExcel->getActiveSheet(0)
    ->getCell('O8')
    ->setValue("c");
$objPHPExcel->getActiveSheet(0)
    ->getCell('P8')
    ->setValue("b");
$objPHPExcel->getActiveSheet(0)
    ->getCell('Q8')
    ->setValue("a");
$objPHPExcel->getActiveSheet(0)
    ->getCell('R8')
    ->setValue("JLH");
$objPHPExcel->getActiveSheet(0)
    ->getCell('S8')
    ->setValue("d");
$objPHPExcel->getActiveSheet(0)
    ->getCell('T8')
    ->setValue("c");
$objPHPExcel->getActiveSheet(0)
    ->getCell('U8')
    ->setValue("b");
$objPHPExcel->getActiveSheet(0)
    ->getCell('V8')
    ->setValue("a");
$objPHPExcel->getActiveSheet(0)
    ->getCell('W8')
    ->setValue("JLH");
$objPHPExcel->getActiveSheet(0)
    ->getCell('X6')
    ->setValue("Peg Abri");
$objPHPExcel->getActiveSheet(0)
    ->getCell('Y6')
    ->setValue("Tenaga Honorer");
$objPHPExcel->getActiveSheet(0)
    ->getCell('Z6')
    ->setValue("Jumlah");



$count = 9;
$no = 1;
//looping
while ($data_absen = mysqli_fetch_array($conn_absen)) {
    $objPHPExcel->getActiveSheet(0)
        ->getCell('A' . $count)
        ->setValue($no);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('B' . $count)
        ->setValue($data_absen['nama']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('C' . $count)
        ->setValue($data_absen['jumlah_pns']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('D' . $count)
        ->setValue($data_absen['IV/d']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('E' . $count)
        ->setValue($data_absen['IV/c']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('F' . $count)
        ->setValue($data_absen['IV/b']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('G' . $count)
        ->setValue($data_absen['IV/a']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('H' . $count)
        ->setValue($data_absen['IV']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('I' . $count)
        ->setValue($data_absen['III/d']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('J' . $count)
        ->setValue($data_absen['III/c']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('K' . $count)
        ->setValue($data_absen['III/b']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('L' . $count)
        ->setValue($data_absen['III/a']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('M' . $count)
        ->setValue($data_absen['III']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('N' . $count)
        ->setValue($data_absen['II/d']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('O' . $count)
        ->setValue($data_absen['II/c']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('P' . $count)
        ->setValue($data_absen['II/b']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('Q' . $count)
        ->setValue($data_absen['II/a']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('R' . $count)
        ->setValue($data_absen['II']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('S' . $count)
        ->setValue($data_absen['I/d']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('T' . $count)
        ->setValue($data_absen['I/c']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('U' . $count)
        ->setValue($data_absen['I/b']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('V' . $count)
        ->setValue($data_absen['I/a']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('W' . $count)
        ->setValue($data_absen['I']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('X' . $count)
        ->setValue("-");
    $objPHPExcel->getActiveSheet(0)
        ->getCell('Y' . $count)
        ->setValue("-");
    $objPHPExcel->getActiveSheet(0)
        ->getCell('Z' . $count)
        ->setValue($data_absen['jumlah_pns']);
    $count ++;
    $no++;
}

//endlooping
$objPHPExcel->getActiveSheet(0)->getStyle('A9:Z' . ($count - 1))->applyFromArray($style_table_content);

$count++;

$objPHPExcel->getActiveSheet(0)
    ->getCell('S' . $count)
    ->setValue('Pandan, ' . content_tgl_indo(date('Y-m-d')) . '');
$objPHPExcel->getActiveSheet(0)
    ->getCell('Q' . ($count + 1))
    ->setValue("a.n");
$objPHPExcel->getActiveSheet(0)
    ->getCell('R' . ($count + 1))
    ->setValue("Plt.");
$objPHPExcel->getActiveSheet(0)
    ->getCell('S' . ($count + 1))
    ->setValue("KEPALA BADAN KEPEGAWAIAN DAN");
$objPHPExcel->getActiveSheet(0)
    ->getCell('S' . ($count + 2))
    ->setValue("PENGEMBANGAN SUMBER DAYA MANUSIA");
$objPHPExcel->getActiveSheet(0)
    ->getCell('S' . ($count + 3))
    ->setValue("KABUPATEN TAPANULI TENGAH");
$objPHPExcel->getActiveSheet(0)
    ->getCell('S' . ($count + 4))
    ->setValue("SEKRETARIS");
$objPHPExcel->getActiveSheet(0)
    ->getCell('S' . ($count + 10))
    ->setValue("KHAIRUL ANWAR PANGGABEAN, S.KOM");
$objPHPExcel->getActiveSheet(0)
    ->getCell('S' . ($count + 11))
    ->setValue("PENATA TK. I");

$objPHPExcel->getActiveSheet(0)
    ->getCell('S' . ($count + 12))
    ->setValue("NIP. 19740530 200903 1 001 ");
$count++;






$objPHPExcel->getActiveSheet(0)->setTitle('Bazetting ',date('Y'));
$nama_file = "Bazetting .xlsx";

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
