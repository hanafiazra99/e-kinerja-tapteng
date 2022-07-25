<?php
    function page_title()
	{
		return 'Login';
	}
	
	if(isset($_POST['TombolLogin']))
	{
		session_start();
		require "../../app/config.php";
		require "../../app/models.php";
		require "../../app/autentikasi.php";
		require "../../app/component.php";
		
		foreach ($_POST as $name => $val)
		{
			$_POST[$name] = mysqli_real_escape_string($koneksi, $_POST[$name]);
		}
		
		$query = "select * from app_login where username = '".$_POST['username']."' and soa = 'y'";
		$conn = mysqli_query($koneksi, $query);
		
		while($data = mysqli_fetch_array($conn))
		{
			if(password_verify($_POST['password'], $data['password']))
			{
				$_SESSION['id'] = $data['id'];
				$_SESSION['role'] = $data['role'];
				$_SESSION['foto'] = $data['foto'];
				
				set_session_time($koneksi, $data['id']);
				
				pop_up_direct(BASE_URL, BASE_URL, 'Login Berhasil', 'Selamat datang.', 'modal-success');
			}
		}
	
		pop_up_direct(BASE_URL, BASE_URL, 'Gagal', 'Kombinasi Username dan Password Tidak Ditemukan.', 'modal-danger');
	}
?>