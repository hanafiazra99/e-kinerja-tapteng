<?php
function page_title()
{
	return 'Pengaturan';
}

function portal_id()
{
	return '14';
}

if (isset($_POST['TombolTambahAgama'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array('', $_POST['label']);
	$field = array('id', 'label');
	array_push($proses_check, tambah_data($koneksi, $data, $field, 'ref_agama'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil menambah agama.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolSuntingAgama'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array($_POST['id'], $_POST['label']);
	$field = array('id', 'label');
	array_push($proses_check, submit_data($koneksi, $data, $field, 'ref_agama'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil mengubah agama.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolHapusAgama'])) {
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
} else if (isset($_POST['TombolTambahJenisKelamin'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array('', $_POST['label']);
	$field = array('id', 'label');
	array_push($proses_check, tambah_data($koneksi, $data, $field, 'ref_jenis_kelamin'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil menambah jenis kelamin.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolSuntingJenisKelamin'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array($_POST['id'], $_POST['label']);
	$field = array('id', 'label');
	array_push($proses_check, submit_data($koneksi, $data, $field, 'ref_jenis_kelamin'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil mengubah jenis kelamin.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolHapusJenisKelamin'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();
	array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'ref_jenis_kelamin'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil menghapus jenis kelamin.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolTambahGolonganDarah'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array('', $_POST['label']);
	$field = array('id', 'label');
	array_push($proses_check, tambah_data($koneksi, $data, $field, 'ref_golongan_darah'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil menambah golongan darah.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolSuntingGolonganDarah'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array($_POST['id'], $_POST['label']);
	$field = array('id', 'label');
	array_push($proses_check, submit_data($koneksi, $data, $field, 'ref_golongan_darah'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil mengubah golongan darah.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolHapusGolonganDarah'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();
	array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'ref_golongan_darah'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil menghapus golongan darah.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolTambahStatusPerkawinan'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array('', $_POST['label']);
	$field = array('id', 'label');
	array_push($proses_check, tambah_data($koneksi, $data, $field, 'ref_status_perkawinan'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil menambah status perkawinan.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolSuntingStatusPerkawinan'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array($_POST['id'], $_POST['label']);
	$field = array('id', 'label');
	array_push($proses_check, submit_data($koneksi, $data, $field, 'ref_status_perkawinan'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil mengubah status perkawinan.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolHapusStatusPerkawinan'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();
	array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'ref_status_perkawinan'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil menghapus status perkawinan.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolTambahStatusKepegawaian'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array('', $_POST['label']);
	$field = array('id', 'label');
	array_push($proses_check, tambah_data($koneksi, $data, $field, 'ref_status_kepegawaian'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil menambah status kepegawaian.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolSuntingStatusKepegawaian'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array($_POST['id'], $_POST['label']);
	$field = array('id', 'label');
	array_push($proses_check, submit_data($koneksi, $data, $field, 'ref_status_kepegawaian'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil mengubah status kepegawaian.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolHapusStatusKepegawaian'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();
	array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'ref_status_kepegawaian'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil menghapus status kepegawaian.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolTambahKedudukanPegawai'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array('', $_POST['status_kepegawaian'], $_POST['label']);
	$field = array('id', 'status_kepegawaian', 'label');
	array_push($proses_check, tambah_data($koneksi, $data, $field, 'ref_kedudukan_pegawai'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil menambah kedudukan pegawai.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolSuntingKedudukanPegawai'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();

	$data = array($_POST['id'], $_POST['status_kepegawaian'], $_POST['label']);
	$field = array('id', 'status_kepegawaian', 'label');
	array_push($proses_check, submit_data($koneksi, $data, $field, 'ref_kedudukan_pegawai'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil mengubah kedudukan pegawai.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['TombolHapusKedudukanPegawai'])) {
	require "../../app/config.php";
	require "../../app/models.php";
	require "../../app/autentikasi.php";
	require "../../app/component.php";

	foreach ($_POST as $name => $val) {
		$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
	}

	$proses_check = array();
	array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'ref_kedudukan_pegawai'));

	if (!in_array("fail", $proses_check)) {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Berhasil', 'Berhasil menghapus kedudukan pegawai.', 'modal-success');
	} else {
		pop_up_direct(BASE_URL, SIMPEG_URL . 'pengaturan/data-pilihan/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
	}
} else if (isset($_POST['req'])) {
	if ($_POST['req'] == 'Modal Konfirmasi') {
		require "../../app/config.php";
		require "../../app/models.php";
		require "../../app/component.php";

		modal_konfirmasi($_POST['judul'], $_POST['form'], SIMPEG_URL . 'controllers/c-pengaturan.php', $_POST['pertanyaan'], $_POST['parameter'], $_POST['data']);
	}
}
