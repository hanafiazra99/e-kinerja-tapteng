<?php
session_start();
require "../../../../app/config.php";
require "../../../../app/component.php";

$table = 'cv_simpeg_laporan_duk';
$primaryKey = 'id';

$columns = array(
    array('db' => 'nip', 'dt' => 0),
    array('db' => 'gelar_depan', 'dt' => 1),
    array('db' => 'nama', 'dt' => 2),
    array('db' => 'gelar_belakang', 'dt' => 3),
    array('db' => 'jenis_kelamin', 'dt' => 4),
    array('db' => 'pgr', 'dt' => 5),
    array('db' => 'tmt_pgr',
        'dt' => 6,
        'formatter' => function ($d, $row) {
            return content_tgl_indo($d);
        },
    ),
    array('db' => 'nama_jabatan', 'dt' => 7),
    array('db' => 'eselon', 'dt' => 8),
    array('db' => 'jenis_jabatan', 'dt' => 9),
    array('db' => 'tmt_jabatan',
        'dt' => 10,
        'formatter' => function ($d, $row) {
            return content_tgl_indo($d);
        },
    ),
    array('db' => 'masa_kerja',
        'dt' => 11,
        'formatter' => function ($d, $row) {
            return content_masa_kerja($d)['tahun'] . ' Tahun ' . content_masa_kerja($d)['bulan'] . ' Bulan';
        },
    ),
    array('db' => 'opd', 'dt' => 12),
    array('db' => 'tingkat_pendidikan', 'dt' => 13),
    array('db' => 'jurusan', 'dt' => 14),
    array('db' => 'tgl_sttb',
        'dt' => 15,
        'formatter' => function ($d, $row) {
            return substr($d, 0, 4);
        },
    ),
    array('db' => 'status_kepegawaian', 'dt' => 16),
);

$whereAll = '';

if (isset($_GET['opd'])) {
    $whereAll .= 'opd = "' . $_GET['opd'] . '"';
}

require '../../../library/datatables/scripts/ssp.class.php';

echo json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll));
