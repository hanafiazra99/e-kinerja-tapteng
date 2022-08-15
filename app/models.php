<?php
	function req_data($koneksi, $table)
	{
		$query = "select * from ".$table."";
		$conn = mysqli_query($koneksi, $query);
		
		return $conn;
	}

	function fetch_all($koneksi,$query){
		$collection = array();
		$conn = mysqli_query($koneksi, $query);
		while($data = mysqli_fetch_array($conn)){
			$collection[] = $data;
		}
		return $collection;
	}
	
	function req_function($koneksi,$func){
		$query = "select ".$func." as data";
		$conn = mysqli_query($koneksi, $query);
		$data = mysqli_fetch_array($conn);
		return $data;
	}

	function req_data_where($koneksi, $table, $where)
	{
		$query = "select * from ".$table." where ".$where."";
		$conn = mysqli_query($koneksi, $query);
		
		return $conn;
	}
	
	function req_data_where_limit($koneksi, $table, $where, $start, $limit)
	{
		$query = "select * from ".$table." where ".$where." limit ".$start.", ".$limit."";
		$conn = mysqli_query($koneksi, $query);
		
		return $conn;
	}
	
	function req_data_where_order($koneksi, $table, $where, $order, $sort)
	{
		$query = "select * from ".$table." where ".$where." order by ".$order." ".$sort."";
		$conn = mysqli_query($koneksi, $query);
		
		return $conn;
	}
	
	function req_data_where_order_limit($koneksi, $table, $where, $order, $sort, $start, $limit)
	{
		$query = "select * from ".$table." where ".$where." order by ".$order." ".$sort." limit ".$start.", ".$limit."";
		$conn = mysqli_query($koneksi, $query);
		
		return $conn;
	}
	
	function req_get_where($koneksi, $table, $where)
	{
		$query = "select * from ".$table." where ".$where."";
		$conn = mysqli_query($koneksi, $query);
		if(!$conn)
		{
			echo '<p style="color: blue">'.mysqli_error($koneksi).'</p>';
			echo '<p style="color: red;">'.$query.'</p>';
		}
		$data = mysqli_fetch_array($conn);
		return $data;
	}
	
	function tambah_data($koneksi, $data, $field, $table)
	{
		$banyak_data = count($data);
		$values = "";
		
		for($i = 0; $i < $banyak_data; $i++)
		{
			$values .= "".$field[$i]." = '".$data[$i]."',";
		}
		$values = rtrim($values, ', ');
		$query = "insert into ".$table." set ".$values."";
		
		if(mysqli_query($koneksi, $query))
		{
			$proses = 'success';
		}
		else
		{
			$proses = 'fail';
		}
		
		return $proses;
	}
	
	function cek_data($koneksi, $field, $value, $tabel)
	{
		$query = "select * from ".$tabel." where ".$field." = '".$value."'";
		$conn = mysqli_query($koneksi, $query);

		if(mysqli_num_rows($conn) != 1)
		{
			$query = "insert into ".$tabel." set ".$field." = '".$value."'";
			
			mysqli_query($koneksi, $query);
		}
	}
	
	function submit_data($koneksi, $data, $field, $table)
	{
		if($data[0] != '')
		{
			cek_data($koneksi, $field[0], $data[0], $table);
		}
		
		$banyak_data = count($data);
		$values = "";
		
		for($i = 1; $i < $banyak_data; $i++)
		{
			$values .= "".$field[$i]." = '".$data[$i]."',";
		}
		$values = rtrim($values, ', ');
		$query = "update ".$table." set ".$values." where ".$field[0]." = '".$data[0]."'";
		
		if(mysqli_query($koneksi, $query))
		{
			$proses = 'success';
		}
		else
		{
			$proses = 'fail';
			
		}
		
		return $proses;
	}
	
	function hapus_data($koneksi, $data, $field, $table)
	{
		$query = "delete from ".$table." where ".$field." = '".$data."'";
		
		if(mysqli_query($koneksi, $query))
		{
			$proses = 'success';
		}
		else
		{
			$proses = 'fail';
		}
		
		return $proses;
	}
?>