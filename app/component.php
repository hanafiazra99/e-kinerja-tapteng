<?php
function modal_konfirmasi($judul, $form, $action, $pertanyaan, $parameter, $data)
{
	echo '
				<div class="">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">' . $judul . '</h4>
							</div>
							<form class="form-horizontal" id="Form' . $form . '" method="post" action="' . $action . '">
								<div class="modal-body">
									' . $pertanyaan . '
									<input type="hidden" name="data" id="data" value="' . $data . '">
									<input type="hidden" name="id" id="id" value="' . $parameter . '">
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-sm btn-primary" name="Tombol' . $form . '" id="Tombol' . $form . '">Ya</button>
									<button type="button" class="btn btn-sm" data-dismiss="modal">Tidak</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			 ';
}

function modal_preview_foto($judul, $keterangan, $path)
{
	echo '
				<div class="">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">' . $judul . '</h4>
							</div>
							<div class="modal-body text-justify">
								<img src="' . $path . '" class="fit-image"></img>
								<p>' . $keterangan . '</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-sm" data-dismiss="modal">Tutup</button>
							</div>
						</div>
					</div>
				</div>
			 ';
}

function modal_preview_file($judul, $path)
{
	echo '
				<div class="">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">' . $judul . '</h4>
							</div>
							<div class="modal-body text-center">
								<iframe src="https://docs.google.com/viewer?url=' . $path . '&embedded=true" frameborder="0" height="600px" width="100%"></iframe>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-sm" data-dismiss="modal">Tutup</button>
							</div>
						</div>
					</div>
				</div>
			 ';
}

function modal_tambah_referensi($judul, $form, $action, $field)
{
	echo '
				<div class="">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">' . $judul . '</h4>
							</div>
							<form class="form-horizontal" id="Form' . $form . '" method="post" action="' . $action . '">
								<div class="modal-body">
									<div class="form-group">
										<label for="nama" class="col-sm-2 control-label">' . $field . '</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="data" id="data" value="">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-sm btn-primary" name="Tombol' . $form . '" id="Tombol' . $form . '">Simpan</button>
									<button type="button" class="btn btn-sm" data-dismiss="modal">Batal</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			 ';
}

function modal_sunting_data($judul, $form, $action, $parameter_pengenal, $data_pengenal, $parameter_diganti, $data_diganti, $field)
{
	echo '
				<div class="">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">' . $judul . '</h4>
							</div>
							<form class="form-horizontal" id="Form' . $form . '" method="post" action="' . $action . '">
								<div class="modal-body">
									<div class="form-group">
										<label for="nama" class="col-sm-2 control-label">' . $field . '</label>
										<div class="col-sm-10">
											<input type="hidden" name="parameter_pengenal" id="parameter_pengenal" value="' . $parameter_pengenal . '">
											<input type="hidden" name="data_pengenal" id="data_pengenal" value="' . $data_pengenal . '">
											<input type="hidden" name="parameter_diganti" id="parameter_diganti" value="' . $parameter_diganti . '">
											<input type="text" class="form-control" name="data_diganti" id="data_diganti" value="' . $data_diganti . '">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-sm btn-primary" name="Tombol' . $form . '" id="Tombol' . $form . '">Simpan</button>
									<button type="button" class="btn btn-sm" data-dismiss="modal">Batal</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			 ';
}

function modal_ubah_status_pendaftaran($judul, $form, $action, $parameter_pengenal, $data_pengenal, $parameter_diganti, $data_diganti, $field)
{
	echo '
				<div class="">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title">' . $judul . '</h4>
							</div>
							<form class="form-horizontal" id="Form' . $form . '" method="post" action="' . $action . '">
								<div class="modal-body">
									<div class="form-group">
										<label for="nama" class="col-sm-2 control-label">' . $field . '</label>
										<div class="col-sm-10">
											<input type="hidden" name="parameter_pengenal" id="parameter_pengenal" value="' . $parameter_pengenal . '">
											<input type="hidden" name="data_pengenal" id="data_pengenal" value="' . $data_pengenal . '">
											<input type="hidden" name="parameter_diganti" id="parameter_diganti" value="' . $parameter_diganti . '">
											<input type="text" class="form-control" name="data_diganti" id="data_diganti" value="' . $data_diganti . '">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-sm btn-primary" name="Tombol' . $form . '" id="Tombol' . $form . '">Simpan</button>
									<button type="button" class="btn btn-sm" data-dismiss="modal">Batal</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			 ';
}

function component_select_option($koneksi, $table, $id, $data, $form_value, $placeholder, $current)
{
	$conn_select = req_data($koneksi, $table);
	$select = '
					<select class="form-control select2" style="width: 100%;" name="' . $form_value . '" id="' . $form_value . '" data-placeholder="' . $placeholder . '">
						<option></option>
				  ';

	while ($data_select = mysqli_fetch_array($conn_select)) {
		$select .= '
						<option value="' . $data_select[$id] . '" ' . ($data_select[$id] == $current ? 'selected' : '') . '>' . $data_select[$data] . '</option>
					   ';
	}

	$select .= '
					</select>
				   ';

	return $select;
}

function component_select_option_custom_field($koneksi, $table, $id, $data, $form_value, $placeholder, $current, $connector)
{
	$conn_select = req_data($koneksi, $table);
	$select = '
					<select class="form-control select2" style="width: 100%;" name="' . $form_value . '" id="' . $form_value . '" data-placeholder="' . $placeholder . '">
						<option></option>
				  ';

	while ($data_select = mysqli_fetch_array($conn_select)) {

		$label = '';
		foreach ($data as $key => $value) {
			$label .= $data_select[$data[$key]] . $connector[$key];
		}

		$select .= '
						<option value="' . $data_select[$id] . '" ' . ($data_select[$id] == $current ? 'selected' : '') . '>' . $label . '</option>
					   ';
	}

	$select .= '
					</select>
				   ';

	return $select;
}

function component_select_option_with_blank($koneksi, $table, $id, $data, $form_value, $placeholder, $current)
{
	$conn_select = req_data($koneksi, $table);
	$select = '
					<select class="form-control select2" style="width: 100%;" name="' . $form_value . '" id="' . $form_value . '" data-placeholder="' . $placeholder . '">
						<option></option>
						<option value=" ">Tidak Ada</option>
				  ';

	while ($data_select = mysqli_fetch_array($conn_select)) {
		$select .= '
						<option value="' . $data_select[$id] . '" ' . ($data_select[$id] == $current ? 'selected' : '') . '>' . $data_select[$data] . '</option>
					   ';
	}

	$select .= '
					</select>
				   ';

	return $select;
}

function component_select_option_where($koneksi, $table, $id, $data, $form_value, $placeholder, $current, $where)
{
	$conn_select = req_data_where($koneksi, $table, $where);
	$select = '
					<select class="form-control select2" style="width: 100%;" name="' . $form_value . '" id="' . $form_value . '" data-placeholder="' . $placeholder . '">
						<option></option>
				  ';

	while ($data_select = mysqli_fetch_array($conn_select)) {
		$select .= '
						<option value="' . $data_select[$id] . '" ' . ($data_select[$id] == $current ? 'selected' : '') . '>' . $data_select[$data] . '</option>
					   ';
	}

	$select .= '
					</select>
				   ';

	return $select;
}

function component_select_option_response_ajax($koneksi, $table, $id, $data, $where)
{
	$conn_select = req_data_where($koneksi, $table, $where);
	$option = '
					<option></option>
				  ';

	while ($data_select = mysqli_fetch_array($conn_select)) {
		$option .= '
						<option value="' . $data_select[$id] . '">' . $data_select[$data] . '</option>
					   ';
	}

	return $option;
}

function content_select_table($koneksi, $table, $data, $label, $placeholder)
{
	$conn_select = req_data($koneksi, $table);

	$select = '<select class="form-control select2" style="width: 100%;" name="' . $label . '" id="' . $label . '" data-placeholder="' . $placeholder . '"><option></option>';

	while ($data_select = mysqli_fetch_array($conn_select)) {
		$select .= '<option value="' . $data_select[$data] . '">' . $data_select[$data] . '</option>';
	}

	$select .= '</select>';

	return $select;
}

function content_tgl_indo($tgl)
{
	if ($tgl == '0000-00-00') {
		$tgl_indo = 'Format Tanggal Tidak Tepat';
	} else {
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		$bulan = substr($tgl, 5, 2);

		if ($bulan == '') {
			$exec_bulan = '';
		} else {
			$bulan = intval($bulan);
			$exec_bulan = $BulanIndo[$bulan - 1];
		}

		$tgl_indo = substr($tgl, 8, 2) . " " . $exec_bulan . " " . substr($tgl, 0, 4);
	}

	return $tgl_indo;
}

function content_bulan_indo($bulan)
{
	if ($bulan == '0') {
		$exec_bulan = 'Format Bulan Tidak Tepat';
	} else {
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		if ($bulan == '') {
			$exec_bulan = '';
		} else {
			$bulan = intval($bulan);
			$exec_bulan = $BulanIndo[$bulan - 1];
		}
	}

	return $exec_bulan;
}

function pop_up_direct($base_url, $link, $judul, $isi, $status)
{
	echo '
				<script>
					document.location.href = "' . $base_url . 'link.php?go=' . $link . '&&judul=' . $judul . '&&isi=' . $isi . '&&status=' . $status . '";
				</script>
			 ';
}

function content_huruf_kapital_awal_kata($string)
{
	return ucwords(strtolower($string));
}

function konversi($x)
{
	$x = abs($x);
	$angka = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	$temp = "";

	if ($x < 12) {
		$temp = " " . $angka[$x];
	} else if ($x < 20) {
		$temp = konversi($x - 10) . " Belas";
	} else if ($x < 100) {
		$temp = konversi($x / 10) . " Puluh" . konversi($x % 10);
	} else if ($x < 200) {
		$temp = " seratus" . konversi($x - 100);
	} else if ($x < 1000) {
		$temp = konversi($x / 100) . " Ratus" . konversi($x % 100);
	} else if ($x < 2000) {
		$temp = " Seribu" . konversi($x - 1000);
	} else if ($x < 1000000) {
		$temp = konversi($x / 1000) . " Ribu" . konversi($x % 1000);
	} else if ($x < 1000000000) {
		$temp = konversi($x / 1000000) . " Juta" . konversi($x % 1000000);
	} else if ($x < 1000000000000) {
		$temp = konversi($x / 1000000000) . " Milyar" . konversi($x % 1000000000);
	}

	return $temp;
}

function tkoma($x)
{
	$str = stristr($x, ".");
	$ex = explode('.', $x);

	if (($ex[1] / 10) >= 1) {
		$a = abs($ex[1]);
	} else {
		$a = '';
	}

	$string = array("Nol", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	$temp = "";

	$a2 = $ex[1] / 10;
	$pjg = strlen($str);
	$i = 1;

	if ($a >= 1 && $a < 12) {
		$temp .= " " . $string[$a];
	} else if ($a > 12 && $a < 20) {
		$temp .= konversi($a - 10) . " Belas";
	} else if ($a > 20 && $a < 100) {
		$temp .= konversi($a / 10) . " Puluh" . konversi($a % 10);
	} else {
		if ($a2 < 1) {
			while ($i < $pjg) {
				$char = substr($str, $i, 1);
				$i++;
				$temp .= " " . $string[$char];
			}
		}
	}

	return $temp;
}

function terbilang($x)
{
	if ($x < 0) {
		$hasil = "Minus " . trim(konversi($x));
	} else {
		$poin = trim(tkoma($x));
		$hasil = trim(konversi($x));
	}

	if ($poin) {
		$hasil = $hasil . " Koma " . $poin;
	} else {
		$hasil = $hasil;
	}

	return $hasil;
}

function formatSizeUnits($file)
{
	$handle = fopen($file, "r");
	$contents = fread($handle, filesize($file));
	$bytes = filesize($file);
	if ($bytes >= 1073741824) {
		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
	} elseif ($bytes >= 1048576) {
		$bytes = number_format($bytes / 1048576, 2) . ' MB';
	} elseif ($bytes >= 1024) {
		$bytes = number_format($bytes / 1024, 2) . ' KB';
	} elseif ($bytes > 1) {
		$bytes = $bytes . ' bytes';
	} elseif ($bytes == 1) {
		$bytes = $bytes . ' byte';
	} else {
		$bytes = '0 bytes';
	}

	return $bytes;
}

function content_masa_kerja($masa_kerja)
{
	$tahun = $masa_kerja / 12;
	$bulan = $masa_kerja % 12;

	$data = array('tahun' => (int) $tahun, 'bulan' => $bulan);

	return $data;
}


function jumlah_hari_kerja($bulan)
{
	$tanggal = explode("-",$bulan);
	$kalender = CAL_GREGORIAN;
	$bulan = $tanggal[1];
	$tahun = $tanggal[0];
	$hari = cal_days_in_month($kalender, $bulan, $tahun);
	

	$awal_cuti = "01-".$tanggal[1]."-".$tanggal[0];
	$akhir_cuti = $hari."-".$tanggal[1]."-".$tanggal[0];

	// tanggalnya diubah formatnya ke Y-m-d 
	$awal_cuti = date_create_from_format('d-m-Y', $awal_cuti);
	$awal_cuti = date_format($awal_cuti, 'Y-m-d');
	$awal_cuti = strtotime($awal_cuti);

	$akhir_cuti = date_create_from_format('d-m-Y', $akhir_cuti);
	$akhir_cuti = date_format($akhir_cuti, 'Y-m-d');
	$akhir_cuti = strtotime($akhir_cuti);

	$haricuti = array();
	$sabtuminggu = array();

	for ($i = $awal_cuti; $i <= $akhir_cuti; $i += (60 * 60 * 24)) {
		if (date('w', $i) !== '0' && date('w', $i) !== '6') {
			$haricuti[] = $i;
		} else {
			$sabtuminggu[] = $i;
		}
	}
	$jumlah_cuti = count($haricuti);
	$jumlah_sabtuminggu = count($sabtuminggu);
	$abtotal = $jumlah_cuti + $jumlah_sabtuminggu;
	return $jumlah_cuti;
	
}
