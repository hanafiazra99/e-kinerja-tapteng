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


$conn_absen = req_data_where($koneksi, "v_absen_apel", " periode = '" . $_POST['periode'] . "' AND opd_id = '" . $_POST['opd'] . "'");
$data_opd = req_get_where($koneksi, 'opd', ' id="' . $_POST['opd'] . '"');
$data_jabatan = req_get_where($koneksi, " v_opd_struktur_organisasi ", ' nama_jabatan = "Kepala '.$data_opd['nama'].'"');
$data_kadis = req_get_where($koneksi, "cv_asn", " nama_jabatan_id= '" . $data_jabatan['id'] . "'");
$objPHPExcel->getProperties()->setCreator(BASE_TITLE)
    ->setLastModifiedBy(BASE_TITLE)
    ->setTitle("Rekapitulasi Kehadiran Pegawai Negeri Sipil " . $data_opd['nama'])
    ->setSubject("Rekapitulasi Kehadiran Pegawai Negeri Sipil " . $data_opd['nama'])
    ->setDescription("Rekapitulasi Kehadiran Pegawai Negeri Sipil " . $data_opd['nama'])
    ->setKeywords("Rekapitulasi Kehadiran Pegawai Negeri Sipil " . $data_opd['nama'])
    ->setCategory("Rekapitulasi Kehadiran Pegawai Negeri Sipil " . $data_opd['nama']);

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:P1');
$objPHPExcel->getActiveSheet(0)
    ->getCell('A1')
    ->setValue('PEMERINTAH KABUPATEN TAPANULI TENGAH');
$objPHPExcel->getActiveSheet(0)
    ->getStyle('A1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A2:P2');
$objPHPExcel->getActiveSheet(0)
    ->getCell('A2')
    ->setValue($data_opd['nama']);
$objPHPExcel->getActiveSheet(0)
    ->getStyle('A2')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A3:P3');
$objPHPExcel->getActiveSheet(0)
    ->getCell('A3')
    ->setValue("JL. Dr. F.L. Tobing No.  18 Telp.  0631-372384    PANDAN");
$objPHPExcel->getActiveSheet(0)
    ->getStyle('A3')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(30);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(8);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(32);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(14);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(8);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(8);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setWidth(5);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setWidth(5);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setWidth(5);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setWidth(5);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setWidth(5);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setWidth(5);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setWidth(5);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setWidth(5);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('P')->setWidth(12);




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
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A4:P4');
//End Title
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A5:P5');
$objPHPExcel->getActiveSheet(0)
    ->getCell('A5')
    ->setValue("Rekapitulasi Kehadiran PNS");
$objPHPExcel->getActiveSheet(0)
    ->getStyle('A5')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);


$objPHPExcel->getActiveSheet(0)
    ->getCell('D6')
    ->setValue("Unit Kerja");
$objPHPExcel->getActiveSheet(0)
    ->getCell('E6')
    ->setValue(":" . $data_opd['nama']);

$objPHPExcel->getActiveSheet(0)
    ->getCell('D7')
    ->setValue("Periode");


$objPHPExcel->getActiveSheet(0)
    ->getCell('E7')
    ->setValue(":" . explode(" ", content_tgl_indo($_POST['periode'] . "-01"))[1] . " " . explode(" ", content_tgl_indo($_POST['periode'] . "-01"))[2]);

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A9:A10');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('B9:B10');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('C9:C10');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('D9:D10');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('E9:E10');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('P9:P10');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('F9:G9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('H9:O9');
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
    ->getStyle('A9')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet(0)
    ->getStyle('B9')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet(0)
    ->getStyle('C9')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet(0)
    ->getStyle('D9')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet(0)
    ->getStyle('E9')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet(0)
    ->getStyle('F9')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet(0)
    ->getStyle('H9')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet(0)
    ->getStyle('P9')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);



$objPHPExcel->getActiveSheet(0)
    ->getCell('A9')
    ->setValue("No");
$objPHPExcel->getActiveSheet(0)
    ->getCell('B9')
    ->setValue("Nama/NIP");
$objPHPExcel->getActiveSheet(0)
    ->getCell('C9')
    ->setValue("Golongan");
$objPHPExcel->getActiveSheet(0)
    ->getCell('D9')
    ->setValue("Jabatan");
$objPHPExcel->getActiveSheet(0)
    ->getCell('E9')
    ->setValue("Jumlah Hari Kerja");
$objPHPExcel->getActiveSheet(0)
    ->getCell('F9')
    ->setValue("Jumlah Apel");
$objPHPExcel->getActiveSheet(0)
    ->getCell('H9')
    ->setValue("Tidak Masuk Kantor");
$objPHPExcel->getActiveSheet(0)
    ->getCell('P9')
    ->setValue("Keterangan");
$objPHPExcel->getActiveSheet(0)
    ->getCell('F10')
    ->setValue("Pagi");
$objPHPExcel->getActiveSheet(0)
    ->getCell('G10')
    ->setValue("Sore");
$objPHPExcel->getActiveSheet(0)
    ->getCell('H10')
    ->setValue("H");
$objPHPExcel->getActiveSheet(0)
    ->getCell('I10')
    ->setValue("S");
$objPHPExcel->getActiveSheet(0)
    ->getCell('J10')
    ->setValue("I");
$objPHPExcel->getActiveSheet(0)
    ->getCell('K10')
    ->setValue("DL");
$objPHPExcel->getActiveSheet(0)
    ->getCell('L10')
    ->setValue("C");
$objPHPExcel->getActiveSheet(0)
    ->getCell('M10')
    ->setValue("TB");
$objPHPExcel->getActiveSheet(0)
    ->getCell('N10')
    ->setValue("A");
$objPHPExcel->getActiveSheet(0)
    ->getCell('O10')
    ->setValue("DIK");
$count = 11;
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
        ->getCell('B' . ($count + 1))
        ->setValue('NIP. ' . $data_absen['nip']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('C' . $count)
        ->setValue($data_absen['gr']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('D' . $count)
        ->setValue($data_absen['nama_jabatan']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('E' . $count)
        ->setValue($data_absen['jumlah_hari_kerja']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('F' . $count)
        ->setValue($data_absen['apel_pagi']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('G' . $count)
        ->setValue($data_absen['apel_sore']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('H' . $count)
        ->setValue($data_absen['jumlah_hadir']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('I' . $count)
        ->setValue($data_absen['total_sakit']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('J' . $count)
        ->setValue($data_absen['total_izin']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('K' . $count)
        ->setValue($data_absen['total_tugas_luar']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('L' . $count)
        ->setValue($data_absen['total_cuti']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('M' . $count)
        ->setValue(0);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('N' . $count)
        ->setValue($data_absen['alpa']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('O' . $count)
        ->setValue(0);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('P' . $count)
        ->setValue("");
    $count += 2;
    $no++;
}

//endlooping
$objPHPExcel->getActiveSheet(0)->getStyle('A9:P' . ($count - 1))->applyFromArray($style_table_content);

$count++;
$objPHPExcel->getActiveSheet(0)
    ->getCell('A' . $count)
    ->setValue("Keterangan");
$objPHPExcel->getActiveSheet(0)
    ->getCell('L' . $count)
    ->setValue('Pandan, ' . content_tgl_indo($_POST['periode'] . "-01") . '');
$objPHPExcel->getActiveSheet(0)
    ->getCell('L' . ($count + 1))
    ->setValue("Pimpinan Opd");
$objPHPExcel->getActiveSheet(0)
    ->getCell('L' . ($count + 6))
    ->setValue($data_kadis['nama']);
$objPHPExcel->getActiveSheet(0)
    ->getCell('L' . ($count + 7))
    ->setValue($data_kadis['nip']);
$count++;

$keterangan = array(
    array(
        'simbol' => 'H',
        'label' => ': Hadir',
    ),
    array(
        'simbol' => 'A',
        'label' => ': Alpa',
    ),
    array(
        'simbol' => 'I',
        'label' => ': Izin (Izin sakit dibuktikan dengan surat sakit)',
    ),
    array(
        'simbol' => 'C',
        'label' => ': Cuti ( Cuti dibuktikan dengan surat cuti)',
    ),
    array(
        'simbol' => 'DL',
        'label' => ': Dinas Luar (Dibuktikan dengan SPT)',
    ),
    array(
        'simbol' => 'DIK',
        'label' => ': Diklat (Dibuktikan dengan SPT)',
    ),
    array(
        'simbol' => 'TB',
        'label' => ': Tugas Belajar (Dibuktikan dengan SK Tugas Belaja)',
    ),
);

foreach ($keterangan as $item) {
    $objPHPExcel->getActiveSheet(0)
        ->getCell('A' . $count)
        ->setValue($item['simbol']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('B' . $count)
        ->setValue($item['label']);
    $count++;
}



$objPHPExcel->getActiveSheet(0)->setTitle('Rekapitulasi Absen');
$nama_file = "Rekapitulasi absen .xlsx";

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
