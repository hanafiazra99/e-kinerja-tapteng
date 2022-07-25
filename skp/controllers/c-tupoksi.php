<?php
    function page_title()
	{
		return 'Tupoksi';
	}
	
	function portal_id()
	{
		return '16';
    }
    
    if(isset($_POST['TombolTambahTupoksi']))
    {
        require "../../app/config.php";
		require "../../app/models.php";
		require "../../app/autentikasi.php";
		require "../../app/component.php";

		foreach ($_POST as $name => $val) {
			$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
		}

        $proses_check = array();
        
        $id = get_id('T', 'J');
        $data = array($id, $_POST['nama_jabatan'], $_POST['tupoksi']);
		$field = array('id', 'nama_jabatan', 'tupoksi');
		array_push($proses_check, submit_data($koneksi, $data, $field, 'opd_struktur_organisasi_tupoksi'));

		if (!in_array("fail", $proses_check)) 
		{
			pop_up_direct(BASE_URL, SKP_URL . 'tupoksi/', 'Berhasil', 'Berhasil menambah Tupoksi.', 'modal-success');
		} 
		else 
		{
			pop_up_direct(BASE_URL, SKP_URL . 'tupoksi/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
		}
	}

	else if(isset($_POST['TombolSuntingTupoksi']))
    {
        require "../../app/config.php";
		require "../../app/models.php";
		require "../../app/autentikasi.php";
		require "../../app/component.php";

		foreach ($_POST as $name => $val) {
			$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
		}

        $proses_check = array();
        
        $data = array($_POST['id'], $_POST['nama_jabatan'], $_POST['tupoksi']);
		$field = array('id', 'nama_jabatan', 'tupoksi');
		array_push($proses_check, submit_data($koneksi, $data, $field, 'opd_struktur_organisasi_tupoksi'));

		if (!in_array("fail", $proses_check)) 
		{
			pop_up_direct(BASE_URL, SKP_URL . 'tupoksi/', 'Berhasil', 'Berhasil mengubah Tupoksi.', 'modal-success');
		} 
		else 
		{
			pop_up_direct(BASE_URL, SKP_URL . 'tupoksi/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
		}
	}

	else if(isset($_POST['TombolHapusTupoksi']))
    {
        require "../../app/config.php";
		require "../../app/models.php";
		require "../../app/autentikasi.php";
		require "../../app/component.php";

		foreach ($_POST as $name => $val) {
			$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
		}

		$proses_check = array();
		array_push($proses_check, hapus_data($koneksi, $_POST['data'], $_POST['id'], 'opd_struktur_organisasi_tupoksi'));

		if (!in_array("fail", $proses_check)) 
		{
			pop_up_direct(BASE_URL, SKP_URL . 'tupoksi/', 'Berhasil', 'Berhasil menghapus Tupoksi.', 'modal-success');
		} 
		else 
		{
			pop_up_direct(BASE_URL, SKP_URL . 'tupoksi/', 'Gagal', 'Terjadi kesalahan pada sistem, laporkan ini pada pihak pengembang.', 'modal-danger');
		}
	}
	
	else if(isset($_POST['req']))
	{
		if($_POST['req'] == 'Change Select')
		{
			require "../../app/config.php";
			require "../../app/models.php";
			require "../../app/autentikasi.php";
			require "../../app/component.php";
			
			echo component_select_option_response_ajax($koneksi, $_POST['table'], $_POST['id'], $_POST['data'], $_POST['where']);
		}

		else if ($_POST['req'] == 'Modal Konfirmasi') {
			require "../../app/config.php";
			require "../../app/models.php";
			require "../../app/component.php";
	
			modal_konfirmasi($_POST['judul'], $_POST['form'], SKP_URL . 'controllers/c-tupoksi.php', $_POST['pertanyaan'], $_POST['parameter'], $_POST['data']);
		}
	}
?>