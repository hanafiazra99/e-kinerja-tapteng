<?php 
function page_title()
{
    return 'Jadwal Hari Kerja';
}

function portal_id()
{
    return '23';
}


if (isset($_POST['TombolSuntingJamKerja'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";
	
	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array($_POST['id'], date('h:i', strtotime($_POST['awal-jam-masuk'])),date('h:i', strtotime($_POST['toleransi-jam-masuk'])),date('h:i', strtotime($_POST['akhir-jam-masuk'])));
	// 
	$field = array('id', 'awal_masuk','toleransi_masuk','akhir_masuk');
	array_push($proses_check, submit_data($koneksi, $data, $field, 'absen_jam_masuk'));
	// var_dump($proses_check);
	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, ABSENSI_URL . 'jadwal/jam-kerja/', 'Berhasil', 'Berhasil mengubah jam kerja.', 'modal-success');
	} else {
		
		pop_up_direct(BASE_URL, ABSENSI_URL . 'jadwal/jam-kerja/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolHapusJamKerja'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();
	array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'ref_agama'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil menghapus agama.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} 
?>