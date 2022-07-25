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


$conn_absen = req_data_where($koneksi, "cv_simpeg_laporan_duk", " opd_id = '" . $_POST['opd'] . "'");
$data_opd = req_get_where($koneksi, 'opd', ' id="' . $_POST['opd'] . '"');
$data_jabatan = req_get_where($koneksi, " v_opd_struktur_organisasi ", ' nama_jabatan = "Kepala ' . $data_opd['nama'] . '"');
$data_kadis = req_get_where($koneksi, "cv_asn", " nama_jabatan_id= '" . $data_jabatan['id'] . "'");
$objPHPExcel->getProperties()->setCreator(BASE_TITLE)
    ->setLastModifiedBy(BASE_TITLE)
    ->setTitle("Daftar Urut Kepangkatan " . $data_opd['nama'])
    ->setSubject("Daftar Urut Kepangkatan " . $data_opd['nama'])
    ->setDescription("Daftar Urut Kepangkatan " . $data_opd['nama'])
    ->setKeywords("Daftar Urut Kepangkatan " . $data_opd['nama'])
    ->setCategory("Daftar Urut Kepangkatan " . $data_opd['nama']);

$objPHPExcel->getActiveSheet(0)
    ->getCell('O1')
    ->setValue('Lampiran I');
$objPHPExcel->getActiveSheet(0)
    ->getCell('P1')
    ->setValue('Surat Sekretaris Daerah Kabupaten Tapanuli Tengah');
$objPHPExcel->getActiveSheet(0)
    ->getCell('P2')
    ->setValue('Nomor');
$objPHPExcel->getActiveSheet(0)
    ->getCell('Q2')
    ->setValue(':');
$objPHPExcel->getActiveSheet(0)
    ->getCell('P3')
    ->setValue('Tanggal');
$objPHPExcel->getActiveSheet(0)
    ->getCell('Q3')
    ->setValue(':');




$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A5:T5');
$objPHPExcel->getActiveSheet(0)
    ->getCell('A5')
    ->setValue('DAFTAR URUT KEPANGKATAN TAHUN ' . date('Y'));
$objPHPExcel->getActiveSheet(0)
    ->getStyle('A5')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A6:T6');
$objPHPExcel->getActiveSheet(0)
    ->getCell('A6')
    ->setValue("UNIT KERJA (" . $data_opd['nama'] . ")");
$objPHPExcel->getActiveSheet(0)
    ->getStyle('A6')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);


$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(4);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(14);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(14);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(5);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(8);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(9);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(8);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setWidth(7);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setWidth(7);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setWidth(7);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setWidth(4);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setWidth(4);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setWidth(6);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setWidth(6);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setWidth(8);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('P')->setWidth(8);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('Q')->setWidth(7);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('R')->setWidth(7);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('S')->setWidth(7);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('T')->setWidth(4);



$style = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => '000000'),
        'size' => 10,
        'name' => 'arial',
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFFF00'),
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '0000000'),
        ),
    ),
);



// $objPHPExcel->getActiveSheet(0)
//     ->getCell('E7')
//     ->setValue(":" . explode(" ", content_tgl_indo($_POST['periode'] . "-01"))[1] . " " . explode(" ", content_tgl_indo($_POST['periode'] . "-01"))[2]);

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A8:A9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('B8:B9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('C8:C9');

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('D8:E8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('G8:H8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('K8:L8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('O8:P8');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('F8:F9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('I8:I9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('J8:J9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('M8:M9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('N8:N9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('Q8:Q9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('R8:R9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('S8:S9');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('T8:T9');

$style_table_content = array(
    // 'font' => array(
    //     'color' => array('rgb' => '000000'),
    //     'size' => 11,
    //     'name' => 'Calibri',
    // ),
    // 'fill' => array(
    //     'type' => PHPExcel_Style_Fill::FILL_SOLID,
    //     'color' => array('rgb' => '#FFFF00'),
    // ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        ),
    ),
);

$objPHPExcel->getActiveSheet(0)
    ->getStyle('A8:T9')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet(0)->getStyle('A8:T9')->applyFromArray($style);

$objPHPExcel->getActiveSheet(0)
    ->getCell('A8')
    ->setValue("No");
$objPHPExcel->getActiveSheet(0)
    ->getCell('B8')
    ->setValue("Nama");
$objPHPExcel->getActiveSheet(0)
    ->getCell('C8')
    ->setValue("NIP");
$objPHPExcel->getActiveSheet(0)
    ->getCell('D8')
    ->setValue("Pangkat");
$objPHPExcel->getActiveSheet(0)
    ->getCell('E9')
    ->setValue("TMT");
$objPHPExcel->getActiveSheet(0)
    ->getCell('D9')
    ->setValue("Gol/Ru");
$objPHPExcel->getActiveSheet(0)
    ->getCell('F8')
    ->setValue("Jabatan");
$objPHPExcel->getActiveSheet(0)
    ->getCell('G8')
    ->setValue("Pendidikan Dasar CPNS");
$objPHPExcel->getActiveSheet(0)
    ->getCell('G9')
    ->setValue("Pendidikan");
$objPHPExcel->getActiveSheet(0)
    ->getCell('H9')
    ->setValue("Jurusan");
$objPHPExcel->getActiveSheet(0)
    ->getCell('I8')
    ->setValue("TMT CPNS");
$objPHPExcel->getActiveSheet(0)
    ->getCell('J8')
    ->setValue("TMT PNS");
$objPHPExcel->getActiveSheet(0)
    ->getCell('K8')
    ->setValue("MKG");
$objPHPExcel->getActiveSheet(0)
    ->getCell('K9')
    ->setValue("Th");
$objPHPExcel->getActiveSheet(0)
    ->getCell('L9')
    ->setValue("Bl");
$objPHPExcel->getActiveSheet(0)
    ->getCell('M8')
    ->setValue("Jenis Kelamin");
$objPHPExcel->getActiveSheet(0)
    ->getCell('N8')
    ->setValue("Agama");
$objPHPExcel->getActiveSheet(0)
    ->getCell('E9')
    ->setValue("TMT");
$objPHPExcel->getActiveSheet(0)
    ->getCell('O8')
    ->setValue("Kualifikasi Pendidikan Terakhir");
$objPHPExcel->getActiveSheet(0)
    ->getCell('O9')
    ->setValue("Pendidikan");
$objPHPExcel->getActiveSheet(0)
    ->getCell('P9')
    ->setValue("Jurusan");
$objPHPExcel->getActiveSheet(0)
    ->getCell('Q8')
    ->setValue("Diklat");
$objPHPExcel->getActiveSheet(0)
    ->getCell('R8')
    ->setValue("Tgl Lahir");
$objPHPExcel->getActiveSheet(0)
    ->getCell('S8')
    ->setValue("Berkala Terakhir");
$objPHPExcel->getActiveSheet(0)
    ->getCell('T8')
    ->setValue("Keterangan");



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
        ->getCell('C' . $count)
        ->setValue($data_absen['nip']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('D' . $count)
        ->setValue($data_absen['pgr']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('E' . $count)
        ->setValue(date("d-m-Y", strtotime($data_absen['tmt_pgr'])));
    $objPHPExcel->getActiveSheet(0)
        ->getCell('F' . $count)
        ->setValue($data_absen['nama_jabatan']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('G' . $count)
        ->setValue($data_absen['tingkat_pendidikan']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('H' . $count)
        ->setValue($data_absen['jurusan']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('I' . $count)
        ->setValue("");
    $objPHPExcel->getActiveSheet(0)
        ->getCell('J' . $count)
        ->setValue("");
    $objPHPExcel->getActiveSheet(0)
        ->getCell('K' . $count)
        ->setValue("");
    $objPHPExcel->getActiveSheet(0)
        ->getCell('L' . $count)
        ->setValue("");
    $objPHPExcel->getActiveSheet(0)
        ->getCell('M' . $count)
        ->setValue($data_absen['jenis_kelamin_id']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('N' . $count)
        ->setValue($data_absen['agama_id']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('O' . $count)
        ->setValue($data_absen['tingkat_pendidikan']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('P' . $count)
        ->setValue($data_absen['jurusan']);
    $objPHPExcel->getActiveSheet(0)
        ->getCell('Q' . $count)
        ->setValue("");
    $objPHPExcel->getActiveSheet(0)
        ->getCell('R' . $count)
        ->setValue(date("d-m-Y", strtotime($data_absen['tgl_lahir'])));
    $objPHPExcel->getActiveSheet(0)
        ->getCell('S' . $count)
        ->setValue(date("d-m-Y", strtotime($data_absen['tgl_sttpp'])));
    $objPHPExcel->getActiveSheet(0)
        ->getCell('T' . $count)
        ->setValue("");




    $count++;
    $no++;
}

//endlooping
$objPHPExcel->getActiveSheet(0)->getStyle('A9:T' . ($count - 1))->applyFromArray($style_table_content);

$count++;
$objPHPExcel->getActiveSheet(0)
    ->getCell('A' . $count)
    ->setValue("Petunjuk Pengisian");

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
        'simbol' => '1',
        'label' => 'Kolom jenis kelamin diisi dengan kode, 1 = Laki-laki, 2 = Perempuan',
    ),
    array(
        'simbol' => '2',
        'label' => 'Tanggal, bulan dan tahun menggunakan format: tanggal-bulan-tahun. Contoh: 31 Desember 2021= 31-12-2021',
    ),
    array(
        'simbol' => '3',
        'label' => 'Kolom Jabatan diisi dengan nama jabatan sesuai dengan SK terakhir.',
    ),
    array(
        'simbol' => '4',
        'label' => 'Kolom Gol/Ruang hanya diisi dengan format IV/a, IV/b, III/d dll tanpa menyebutkan Pangkat',
    ),
    array(
        'simbol' => '5',
        'label' => 'Kolom kualifikasi pendidikan terakhir diisi dengan pendidikan dan jurusan terakhir sesuai dengan SK terakhir',
    ),
    array(
        'simbol' => '6',
        'label' => 'Khusus untuk DUK Kecamatan dan SD',
    ),
    array(
        'simbol' => '',
        'label' => 'a. Pertama, DUK Kecematan dibuat terpisah antara DUK Kantor Camat dan Kelurahan. Masing-msing SD memiliki DUK terpisah.',
    ),
    array(
        'simbol' => '',
        'label' => 'b. Kedua, menggunakan format DUK yang sama, dibuat satu (1) Rekap DUK Kecamatan yang berisi seluruh PNS di kecamatan (kantor camat dan kantor lurah)',
    ),
    array(
        'simbol' => '7',
        'label' => 'Kolom diklat diisi dengan jenis-jenis, Diklat Kepeminpinan (PIM), Diklat teknis (Pengadaan B/J), Diklat fungsioal, dll',
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



$objPHPExcel->getActiveSheet(0)->setTitle('DUK');
$nama_file = "DUK.xlsx";

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
