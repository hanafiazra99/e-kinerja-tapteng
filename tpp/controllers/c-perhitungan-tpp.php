<?php
function page_title()
{
    return 'Perhitungan TPP';
}

function portal_id()
{
    return '34';
}

if (isset($_POST['req'])) {
    if ($_POST['req'] == 'Daftar Pegawai TPP') {
        require "../../app/config.php";
        require "../../app/models.php";
        require "../../app/autentikasi.php";
        require "../../app/component.php";

        $get_data = array();

        $conn = req_data_where($koneksi, 'v_pegawai', 'status_kepegawaian != "Pegawai Honorer" AND kedudukan_pegawai = "Aktif" AND opd_id = "' . $_POST['opd'] . '"');
        while ($data = mysqli_fetch_array($conn)) {
            array_push($get_data, $data['id']);
        }

        echo json_encode($get_data);
    } else if ($_POST['req'] == 'Rincian Pegawai TPP') {
        require "../../app/config.php";
        require "../../app/models.php";
        require "../../app/autentikasi.php";
        require "../../app/component.php";

        $data_pegawai = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['pegawai_id'] . '"');
        $data_pegawai_asn = req_get_where($koneksi, 'pegawai_asn', 'id = "' . $_POST['pegawai_id'] . '"');
        $data_pegawai_jabatan = req_get_where($koneksi, 'pegawai_jabatan', 'id = "' . $_POST['pegawai_id'] . '"');
        $data_pegawai_jabatan_v = req_get_where($koneksi, 'v_pegawai_jabatan', 'id = "' . $_POST['pegawai_id'] . '"');
        $data_jabatan = req_get_where($koneksi, 'opd_struktur_organisasi', 'id = "' . $data_pegawai_jabatan['nama_jabatan'] . '"');

        $data_sasaran_bulanan = req_get_where($koneksi, 'v_skp_sasaran_bulanan', 'pegawai = "' . $_POST['pegawai_id'] . '" AND tahun = "' . explode('-', $_POST['periode'])[0] . '" AND bulan = ' . explode('-', $_POST['periode'])[1] . '');
        $data_penilaian_bulanan = req_get_where($koneksi, 'v_skp_penilaian_bulanan', 'id = "' . $data_sasaran_bulanan['id'] . '"');
        $tgl = 10;
        $total_capaian = 0;

        if ($data_penilaian_bulanan['status'] == 'Selesai') {
            $banyak_kegiatan = 0;
            $conn_kegiatan_bulanan = req_data_where($koneksi, 'v_skp_sasaran_bulanan_kegiatan', 'sasaran_bulanan = "' . $data_sasaran_bulanan['id'] . '"');

            while ($data_kegiatan_bulanan = mysqli_fetch_array($conn_kegiatan_bulanan)) {
                $data_penilaian_bulanan_kegiatan = req_get_where($koneksi, 'v_skp_penilaian_bulanan_kegiatan', 'id = "' . $data_kegiatan_bulanan['id'] . '"');

                $n_kuantitas = ($data_penilaian_bulanan_kegiatan['kuantitas'] / $data_kegiatan_bulanan['kuantitas']) * 100;
                $n_kualitas = ($data_penilaian_bulanan_kegiatan['kualitas'] / $data_kegiatan_bulanan['kualitas']) * 100;
                $n_waktu = (((1.76 * 1) - 1) / 1) * 100;
                $n = 3;
                if ($data_kegiatan_bulanan['biaya'] != 0) {
                    $n_biaya = (((1.76 * $data_penilaian_bulanan_kegiatan['biaya']) - $data_kegiatan_bulanan['biaya']) / $data_penilaian_bulanan_kegiatan['biaya']) * 100;
                    $n++;
                } else {
                    $n_biaya = 0;
                }

                $perhitungan = $n_kuantitas + $n_kualitas + $n_waktu + $n_biaya;
                $capaian = $perhitungan / $n;
                $total_capaian += $capaian;

                $banyak_kegiatan++;
            }

            $total_capaian = $total_capaian / $banyak_kegiatan;

            $tgl_penyampaian = explode(' ', $data_penilaian_bulanan['ts'])[0];
            $tgl = (int) explode('-', $tgl_penyampaian)[2];
        }

        $data_pegawai_absensi = req_get_where($koneksi, 'pegawai', 'id = "' . $_POST['pegawai_id'] . '"');
        $conn_jadwal = req_data_where($koneksi, 'v_absen_status_masuk_status_pulang', 'pegawai_id = "' . $data_pegawai_absensi['id'] . '" AND tanggal LIKE "' . $_POST['periode'] . '%"');
        $telat = 0;
        $pulang_cepat = 0;
        $absen = 0;
        $counter = 0;
        while ($data_jadwal = mysqli_fetch_array($conn_jadwal)) {
            if($data_jadwal['status_masuk'] == 'Terlambat'){
                $telat++;
            }

            if($data_jadwal['status_pulang'] == 'Pulang Cepat'){
                $pulang_cepat ++;
            }
            $counter++;
            // $data_harian = req_get_where($koneksi_absensi, 'rekap_harian', 'pegawaiid = "' . $data_pegawai_absensi['id'] . '" AND date = "' . $data_jadwal['date'] . '"');
            // $data_jam_kerja = req_get_where($koneksi_absensi, 'setup_jam_kerja', 'id = "' . $data_jadwal['setup_jam_kerjaid'] . '"');
									
			// if ($data_harian['status'] != 'Hadir') {
            //     $absen++;
                //total alpa = jumlah_absen dikurang jumlah hari kerja 
            // }
			// else {
			// 	if ($data_harian['telat'] == 1) {
			// 		$jam_masuk = strtotime($data_jam_kerja['jam_masuk']);
			// 		$masuk_real = strtotime(explode(' ', $data_harian['masuk']));
			// 		$waktu_telat = abs($masuk_real - $jam_masuk) / 60;
			// 		$telat += $waktu_telat;

            //         // count masuk terlambat
			// 	}

			// 	if ($data_harian['cepat'] == 1) {
			// 		$jam_pulang = strtotime($data_jam_kerja['pulang']);
			// 		$pulang_real = strtotime(explode(' ', $data_harian['pulang']));
			// 		$waktu_cepat = abs($pulang_real - $jam_pulang) / 60;
			// 		$pulang_cepat += $waktu_cepat;

            //         //count pulang cepat
			// 	}
			// }            
        }
        $hari_kerja = req_function($koneksi,"absensi_jumlah_hari_kerja(".$_POST['periode']."-01".")");
        $absen = $hari_kerja['data'] - $counter;
        $p_total_capaian = (($total_capaian <= 50) ? 10 : (($total_capaian >= 50.01 and $total_capaian <= 60) ? 20 : (($total_capaian >= 60.01 and $total_capaian <= 70) ? 25 : (($total_capaian >= 70.01 and $total_capaian <= 80) ? 30 : (($total_capaian > 80) ? 35 : 0)))));
        $p_tgl = ($tgl <= 2 ? 5 : ($tgl == 3 ? 4 : ($tgl == 4 ? 3 : ($tgl == 5 ? 2 : 1))));
        $p_telat = ($telat <= 30 ? 10 : (($telat >= 31 and $telat <= 120) ? 8 : (($telat >= 121 and $telat <= 240) ? 6 : (($telat >= 241 and $telat <= 450) ? 4 : 2))));
        $p_pulang_cepat = ($pulang_cepat <= 30 ? 10 : (($pulang_cepat >= 31 and $pulang_cepat <= 120) ? 8 : (($pulang_cepat >= 121 and $pulang_cepat <= 240) ? 6 : (($pulang_cepat >= 241 and $pulang_cepat <= 450) ? 4 : 2))));
        $p_absen = ($absen == 0 ? 20 : ($absen == 1 ? 15 : ($absen == 2 ? 10 : 5)));
        $p_hukuman = 20;

        $p_tpp_diterima = $p_total_capaian + $p_tgl + $p_telat + $p_pulang_cepat + $p_absen + $p_hukuman;
        $real_diterima = ($data_jabatan['besaran_tpp'] / 100) * $p_tpp_diterima;

        $data_return = array('nip' => $data_pegawai_asn['nip'], 'nama' => $data_pegawai['nama'], 'jabatan' => $data_pegawai_jabatan_v['nama_jabatan'], 'tpp_penuh' => 'Rp. ' . number_format($data_jabatan['besaran_tpp'], 2, ',', '.'), 'capaian_skp' => $p_total_capaian, 'tgl_penyampaian' => $p_tgl, 'telat' => $p_telat, 'pulang_cepat' => $p_pulang_cepat, 'absen' => $p_absen, 'hukuman' => $p_hukuman, 'tpp_diterima' => 'Rp. ' . number_format($real_diterima, 2, ',', '.'));
        echo json_encode($data_return);
    }
}
