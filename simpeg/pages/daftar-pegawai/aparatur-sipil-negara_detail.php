<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-daftar-pegawai.php";

cek_session();
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/');
$data = req_get_where($koneksi, 'v_pegawai', 'id = "' . $_GET['key1'] . '"');
$data_asn = req_get_where($koneksi, 'v_pegawai_asn', 'id = "' . $_GET['key1'] . '"');
$data_alamat = req_get_where($koneksi, 'v_pegawai_alamat', 'id = "' . $_GET['key1'] . '"');
$data_pengangkatan_cpns = req_get_where($koneksi, 'v_pegawai_pengangkatan_cpns', 'id = "' . $_GET['key1'] . '"');
$data_pengangkatan_pns = req_get_where($koneksi, 'v_pegawai_pengangkatan_pns', 'id = "' . $_GET['key1'] . '"');
$data_jabatan = req_get_where($koneksi, 'v_pegawai_jabatan', 'id = "' . $_GET['key1'] . '"');
$data_pgr = req_get_where($koneksi, 'v_pegawai_pgr', 'id = "' . $_GET['key1'] . '"');
$data_kgb = req_get_where($koneksi, 'v_pegawai_kgb', 'id = "' . $_GET['key1'] . '"');
$data_ortu = req_get_where($koneksi, 'v_pegawai_ortu', 'id = "' . $_GET['key1'] . '"');
$data_ortu_alamat = req_get_where($koneksi, 'v_pegawai_ortu_alamat', 'id = "' . $_GET['key1'] . '"');
$data_mertua = req_get_where($koneksi, 'v_pegawai_mertua', 'id = "' . $_GET['key1'] . '"');
$data_mertua_alamat = req_get_where($koneksi, 'v_pegawai_mertua_alamat', 'id = "' . $_GET['key1'] . '"');
$data_pasangan = req_get_where($koneksi, 'v_pegawai_pasangan', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'daftar-pegawai/aparatur-sipil-negara/');
$breadcrumb = array('Aparatur Sipil Negara', $data['nama']);
?>
<!DOCTYPE html>
<html>

<head>
    <?php
template_title(page_title(), BASE_TITLE);
template_favicon();
template_meta();
template_css('app');
?>
</head>

<body class="hold-transition skin-custom sidebar-mini">
    <div class="se-pre-con"></div>
    <div class="wrapper">
        <?php
template_header($user_data, $koneksi, SIMPEG_TITLE);
template_navigasi(page_title(), $koneksi, 'simpeg', SIMPEG_URL);
?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?php
template_page_header($koneksi, portal_id());
?>
                </h1>
                <ol class="breadcrumb">
                    <?php
template_breadcrumb($koneksi, portal_id(), $breadcrumb);
?>
                </ol>
            </section>

            <section class="content">
                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Kepegawaian</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#ct_identitas_pegawai" data-toggle="tab">Identitas Pegawai</a></li>
                            <li><a href="#ct_pengangkatan_cpns" data-toggle="tab">Pengangkatan CPNS</a></li>
                            <li><a href="#ct_pengangkatan_pns" data-toggle="tab">Pengangkatan PNS</a></li>
                            <li><a href="#ct_jabatan" data-toggle="tab">Jabatan</a></li>
                            <li><a href="#ct_pgr" data-toggle="tab">Pangkat Golongan Ruang</a></li>
                            <li><a href="#ct_kgb" data-toggle="tab">Kenaikan Gaji Berkala</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="ct_identitas_pegawai">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:25%">NIP</th>
                                                    <td><?php echo $data_asn['nip']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Nama</th>
                                                    <td><?php echo $data['nama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Gelar Depan</th>
                                                    <td><?php echo $data['gelar_depan']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Gelar Belakang</th>
                                                    <td><?php echo $data['gelar_belakang']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tampat Tanggal Lahir</th>
                                                    <td><?php echo $data['tempat_lahir']; ?>, <?php echo content_tgl_indo($data['tgl_lahir']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Kelamin</th>
                                                    <td><?php echo $data['jenis_kelamin']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Agama</th>
                                                    <td><?php echo $data['agama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>No. Handphone</th>
                                                    <td><?php echo $data['no_hp']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>OPD</th>
                                                    <td><?php echo $data['opd_nama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Unit Organisasi</th>
                                                    <td><?php echo $data['unit_organisasi_nama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Status Kepegawaian</th>
                                                    <td><?php echo $data['status_kepegawaian']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Kepegawaian</th>
                                                    <td><?php echo $data_asn['jenis_kepegawaian']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Kedudukan Pegawai</th>
                                                    <td><?php echo $data['kedudukan_pegawai']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Status Perkawinan</th>
                                                    <td><?php echo $data['status_perkawinan']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>
                                                        <?php echo $data_alamat['alamat']; ?><br>
                                                        <?php echo ($data_alamat['rt'] != '' ? 'RT ' . ucwords(strtolower($data_alamat['rt'])) . '' : ''); ?>
                                                        <?php echo ($data_alamat['rw'] != '' ? 'RW ' . ucwords(strtolower($data_alamat['rw'])) . '' : ''); ?><br>
                                                        <?php echo ($data_alamat['keldes'] != '' ? 'Kelurahan ' . ucwords(strtolower($data_alamat['keldes'])) . '' : ''); ?><br>
                                                        <?php echo ($data_alamat['kecamatan'] != '' ? 'Kecamatan ' . ucwords(strtolower($data_alamat['kecamatan'])) . '' : ''); ?><br>
                                                        <?php echo ($data_alamat['kabkot'] != '' ? '' . ucwords(strtolower($data_alamat['kabkot'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_alamat['provinsi'] != '' ? '' . ucwords(strtolower($data_alamat['provinsi'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_alamat['kode_pos'] != '' ? '' . ucwords(strtolower($data_alamat['kode_pos'])) . '' : ''); ?><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Golongan Darah</th>
                                                    <td><?php echo $data['golongan_darah']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>No. KARPEG</th>
                                                    <td><?php echo $data_asn['no_karpeg']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>No. Kartu ASKES</th>
                                                    <td><?php echo $data_asn['no_askes']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>No. Kartu TASPEN</th>
                                                    <td><?php echo $data_asn['no_taspen']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>No. KARIS/KARSU</th>
                                                    <td><?php echo $data_asn['no_karissu']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>NPWP</th>
                                                    <td><?php echo $data['npwp']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <?php echo ($_SESSION['role'] == '1' ? '<a href="identitas-pegawai/sunting/" class="btn btn-sm btn-success">Sunting</a>' : ''); ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-right">
                                        <img style="width: 100%;" src="<?php echo RESOURCES_URL . 'img/pegawai/' . $data['foto']; ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="ct_pengangkatan_cpns">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Nota Persetujuan BKN</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_pengangkatan_cpns['no_nota_bkn']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_pengangkatan_cpns['tgl_nota_bkn']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pejabat Yang Menetapkan</th>
                                            <td><?php echo $data_pengangkatan_cpns['pym']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>SK</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_pengangkatan_cpns['no_sk']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_pengangkatan_cpns['tgl_sk']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen SK</th>
                                            <td>
                                                <?php echo ($data_pengangkatan_cpns['file_sk'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$data['id'].'/'.$data_pengangkatan_cpns['file_sk'].'" class="btn btn-primary btn-sm">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Masa Kerja</th>
                                            <td><?php echo content_masa_kerja($data_pengangkatan_cpns['masa_kerja'])['tahun'] . ' Tahun ' . content_masa_kerja($data_pengangkatan_cpns['masa_kerja'])['bulan'] . ' Bulan'; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pangkat/Golongan/Ruang</th>
                                            <td><?php echo $data_pengangkatan_cpns['pgr']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>TMT CPNS</th>
                                            <td><?php echo content_tgl_indo($data_pengangkatan_cpns['tmt']); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <?php echo ($_SESSION['role'] == '1' ? '<a href="pengangkatan-cpns/sunting/" class="btn btn-sm btn-success">Sunting</a>' : ''); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_pengangkatan_pns">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Pejabat Yang Menetapkan</th>
                                            <td><?php echo $data_pengangkatan_pns['pym']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>SK</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_pengangkatan_pns['no_sk']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_pengangkatan_pns['tgl_sk']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen SK</th>
                                            <td>
                                                <?php echo ($data_pengangkatan_pns['file_sk'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$data['id'].'/'.$data_pengangkatan_pns['file_sk'].'" class="btn btn-primary btn-sm">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pangkat/Golongan Ruang</th>
                                            <td><?php echo $data_pengangkatan_pns['pgr']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>TMT PNS</th>
                                            <td><?php echo content_tgl_indo($data_pengangkatan_pns['tmt']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Sumpah/Janji PNS</th>
                                            <td><?php echo $data_pengangkatan_pns['sumpah']; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <?php echo ($_SESSION['role'] == '1' ? '<a href="pengangkatan-pns/sunting/" class="btn btn-sm btn-success">Sunting</a>' : ''); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_jabatan">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Pejabat Yang Menetapkan</th>
                                            <td><?php echo $data_jabatan['pym']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>SK Jabatan</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_jabatan['no_sk_jabatan']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_jabatan['tgl_sk_jabatan']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen SK Jabatan</th>
                                            <td>
                                                <?php echo ($data_jabatan['file_sk_jabatan'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$data['id'].'/'.$data_jabatan['file_sk_jabatan'].'" class="btn btn-primary btn-sm">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Jabatan</th>
                                            <td><?php echo $data_jabatan['jenis_jabatan']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Eselon</th>
                                            <td><?php echo $data_jabatan['eselon']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Jabatan</th>
                                            <td><?php echo $data_jabatan['nama_jabatan']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>TMT Jabatan</th>
                                            <td><?php echo content_tgl_indo($data_jabatan['tmt']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>SK Pelantikan</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_jabatan['no_sk_pelantikan']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_jabatan['tgl_sk_pelantikan']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen SK Pelantikan</th>
                                            <td>
                                                <?php echo ($data_jabatan['file_sk_pelantikan'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$data['id'].'/'.$data_jabatan['file_sk_pelantikan'].'" class="btn btn-primary btn-sm">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Sumpah Jabatan</th>
                                            <td><?php echo $data_jabatan['sumpah']; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <?php echo ($_SESSION['role'] == '1' ? '<a href="jabatan/sunting/" class="btn btn-sm btn-success">Sunting</a>' : ''); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_pgr">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Pejabat Yang Menetapkan</th>
                                            <td><?php echo $data_pgr['pym']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>SK</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_pgr['no_sk']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_pgr['tgl_sk']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen SK</th>
                                            <td>
                                                <?php echo ($data_pgr['file_sk'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$data['id'].'/'.$data_pgr['file_sk'].'" class="btn btn-primary btn-sm">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pangkat/Golongan/Ruang</th>
                                            <td><?php echo $data_pgr['pgr']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>TMT</th>
                                            <td><?php echo content_tgl_indo($data_pgr['tmt']); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <?php echo ($_SESSION['role'] == '1' ? '<a href="pgr/sunting/" class="btn btn-sm btn-success">Sunting</a>' : ''); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_kgb">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Pejabat Yang Menetapkan</th>
                                            <td><?php echo $data_kgb['pym']; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="width:25%">SK</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_kgb['no_sk']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_kgb['tgl_sk']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen SK</th>
                                            <td>
                                                <?php echo ($data_kgb['file_sk'] != '' ? '<TombolLihatFile judul="Dokumen SK" file="'.RESOURCES_URL.'dokumen/'.$data['id'].'/'.$data_kgb['file_sk'].'" class="btn btn-primary btn-sm">Lihat</TombolLihatFile>' : 'Tidak Ada'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>TMT</th>
                                            <td><?php echo content_tgl_indo($data_kgb['tmt']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Masa Kerja</th>
                                            <td><?php echo content_masa_kerja($data_kgb['masa_kerja'])['tahun'] . ' Tahun ' . content_masa_kerja($data_kgb['masa_kerja'])['bulan'] . ' Bulan'; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Kantor Pembayaran Gaji</th>
                                            <td><?php echo $data_kgb['kantor_pembayaran']; ?></td>
                                        </tr>
                                        <td colspan="2">
                                            <?php echo ($_SESSION['role'] == '1' ? '<a href="kgb/sunting/" class="btn btn-sm btn-success">Sunting</a>' : ''); ?>
                                        </td>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Riwayat</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#ct_r_pgr" data-toggle="tab">Riwayat Pangkat Golongan Ruang</a></li>
                            <li><a href="#ct_r_kgb" data-toggle="tab">Riwayat Kenaikan Gaji Berkala</a></li>
                            <li><a href="#ct_r_jabatan" data-toggle="tab">Riwayat Jabatan</a></li>
                            <li><a href="#ct_r_pendidikan_umum" data-toggle="tab">Riwayat Pendidikan Umum</a></li>
                            <li><a href="#ct_r_diklat" data-toggle="tab">Riwayat Diklat</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="ct_r_pgr">
                                <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">
                                    <thead>
                                        <tr class="bg-custom">
                                            <th>Pejabat Yang Menetapkan</th>
                                            <th>No. SK</th>
                                            <th>Pangkat/Golongan/Ruang</th>
                                            <th>TMT</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane" id="ct_r_kgb">
                                <table id="daftar_data_2" style="width: 100%;" class="table table-bordered table-fix-last">
                                    <thead>
                                        <tr class="bg-custom">
                                            <th>Pejabat Yang Menetapkan</th>
                                            <th>No. SK</th>
                                            <th>TMT</th>
                                            <th>Kantor Pembayaran</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane" id="ct_r_jabatan">
                                <table id="daftar_data_3" style="width: 100%;" class="table table-bordered table-fix-last">
                                    <thead>
                                        <tr class="bg-custom">
                                            <th>Pejabat Yang Menetapkan</th>
                                            <th>No. SK Jabatan</th>
                                            <th>Eselon</th>
                                            <th>Nama Jabatan</th>
                                            <th>TMT</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane" id="ct_r_pendidikan_umum">
                                <table id="daftar_data_4" style="width: 100%;" class="table table-bordered table-fix-last">
                                    <thead>
                                        <tr class="bg-custom">
                                            <th>Nama Institusi</th>
                                            <th>Tingkat Pendidikan</th>
                                            <th>Jurusan</th>
                                            <th>No. STTB</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane" id="ct_r_diklat">
                                <table id="daftar_data_5" style="width: 100%;" class="table table-bordered table-fix-last">
                                    <thead>
                                        <tr class="bg-custom">
                                            <th>Jenis Diklat</th>
                                            <th>Nama Diklat</th>
                                            <th>Penyelenggara</th>
                                            <th>No. STTPP</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Keluarga</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#ct_k_ortu" data-toggle="tab">Orang Tua</a></li>
                            <li><a href="#ct_k_mertua" data-toggle="tab">Mertua</a></li>
                            <li><a href="#ct_k_pasangan" data-toggle="tab">Pasangan</a></li>
                            <li><a href="#ct_k_anak" data-toggle="tab">Anak</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="ct_k_ortu">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="lead">Data Ayah</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:25%">Nama</th>
                                                    <td><?php echo $data_ortu['nama_a']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Tanggal Lahir</th>
                                                    <td>
                                                        <?php echo $data_ortu['tempat_lahir_a']; ?>,
                                                        <?php echo content_tgl_indo($data_ortu['tgl_lahir_a']); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <td><?php echo $data_ortu['pekerjaan_a']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>
                                                        <?php echo $data_ortu_alamat['alamat_a']; ?><br>
                                                        <?php echo ($data_ortu_alamat['rt_a'] != '' ? 'RT ' . ucwords(strtolower($data_ortu_alamat['rt_a'])) . '' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['rw_a'] != '' ? 'RW ' . ucwords(strtolower($data_ortu_alamat['rw_a'])) . '' : ''); ?><br>
                                                        <?php echo ($data_ortu_alamat['keldes_a'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['keldes_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['kecamatan_a'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['kecamatan_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['kabkot_a'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['kabkot_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['provinsi_a'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['provinsi_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['kode_pos_a'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['kode_pos_a'])) . '<br>' : ''); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <?php echo ($_SESSION['role'] == '1' ? '<a href="orang-tua/sunting/" class="btn btn-sm btn-success">Sunting</a>' : ''); ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="lead">Data Ibu</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:25%">Nama</th>
                                                    <td><?php echo $data_ortu['nama_i']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Tanggal Lahir</th>
                                                    <td>
                                                        <?php echo $data_ortu['tempat_lahir_i']; ?>,
                                                        <?php echo content_tgl_indo($data_ortu['tgl_lahir_i']); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <td><?php echo $data_ortu['pekerjaan_i']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>
                                                        <?php echo $data_ortu_alamat['alamat_i']; ?><br>
                                                        <?php echo ($data_ortu_alamat['rt_i'] != '' ? 'RT ' . ucwords(strtolower($data_ortu_alamat['rt_i'])) . '' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['rw_i'] != '' ? 'RW ' . ucwords(strtolower($data_ortu_alamat['rw_i'])) . '' : ''); ?><br>
                                                        <?php echo ($data_ortu_alamat['keldes_i'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['keldes_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['kecamatan_i'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['kecamatan_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['kabkot_i'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['kabkot_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['provinsi_i'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['provinsi_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_ortu_alamat['kode_pos_i'] != '' ? '' . ucwords(strtolower($data_ortu_alamat['kode_pos_i'])) . '<br>' : ''); ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_k_mertua">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="lead">Data Ayah Mertua</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:25%">Nama</th>
                                                    <td><?php echo $data_mertua['nama_a']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Tanggal Lahir</th>
                                                    <td>
                                                        <?php echo $data_mertua['tempat_lahir_a']; ?>,
                                                        <?php echo content_tgl_indo($data_mertua['tgl_lahir_a']); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <td><?php echo $data_mertua['pekerjaan_a']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>
                                                        <?php echo $data_mertua_alamat['alamat_a']; ?><br>
                                                        <?php echo ($data_mertua_alamat['rt_a'] != '' ? 'RT ' . ucwords(strtolower($data_mertua_alamat['rt_a'])) . '' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['rw_a'] != '' ? 'RW ' . ucwords(strtolower($data_mertua_alamat['rw_a'])) . '' : ''); ?><br>
                                                        <?php echo ($data_mertua_alamat['keldes_a'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['keldes_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['kecamatan_a'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['kecamatan_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['kabkot_a'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['kabkot_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['provinsi_a'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['provinsi_a'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['kode_pos_a'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['kode_pos_a'])) . '<br>' : ''); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <?php echo ($_SESSION['role'] == '1' ? '<a href="mertua/sunting/" class="btn btn-sm btn-success">Sunting</a>' : ''); ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="lead">Data Ibu Mertua</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:25%">Nama</th>
                                                    <td><?php echo $data_mertua['nama_i']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Tanggal Lahir</th>
                                                    <td>
                                                        <?php echo $data_mertua['tempat_lahir_i']; ?>,
                                                        <?php echo content_tgl_indo($data_mertua['tgl_lahir_i']); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <td><?php echo $data_mertua['pekerjaan_i']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>
                                                        <?php echo $data_mertua_alamat['alamat_i']; ?><br>
                                                        <?php echo ($data_mertua_alamat['rt_i'] != '' ? 'RT ' . ucwords(strtolower($data_mertua_alamat['rt_i'])) . '' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['rw_i'] != '' ? 'RW ' . ucwords(strtolower($data_mertua_alamat['rw_i'])) . '' : ''); ?><br>
                                                        <?php echo ($data_mertua_alamat['keldes_i'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['keldes_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['kecamatan_i'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['kecamatan_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['kabkot_i'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['kabkot_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['provinsi_i'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['provinsi_i'])) . '<br>' : ''); ?>
                                                        <?php echo ($data_mertua_alamat['kode_pos_i'] != '' ? '' . ucwords(strtolower($data_mertua_alamat['kode_pos_i'])) . '<br>' : ''); ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_k_pasangan">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Nama</th>
                                            <td><?php echo $data_pasangan['nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tempat Tanggal Lahir</th>
                                            <td>
                                                <?php echo $data_pasangan['tempat_lahir']; ?>,
                                                <?php echo content_tgl_indo($data_pasangan['tgl_lahir']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Buku Nikah</th>
                                            <td>
                                                <i>Nomor:</i> <?php echo $data_pasangan['no_buku_nikah']; ?><br>
                                                <i>Tanggal:</i> <?php echo content_tgl_indo($data_pasangan['tgl_buku_nikah']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pendidikan</th>
                                            <td><?php echo $data_pasangan['pendidikan_terakhir']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pekerjaan</th>
                                            <td><?php echo $data_pasangan['pekerjaan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <?php echo ($_SESSION['role'] == '1' ? '<a href="pasangan/sunting/" class="btn btn-sm btn-success">Sunting</a>' : ''); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="ct_k_anak">
                                <table id="daftar_data_6" style="width: 100%;" class="table table-bordered table-fix-last">
                                    <thead>
                                        <tr class="bg-custom">
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Status Anak</th>
                                            <th>Status Tunjangan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
template_footer(SIMPEG_TITLE);
?>
    </div>
    <?php
echo '
            <script>
                var role="' . $_SESSION['role'] . '";
                var user_opd="' . $user_data['opd'] . '";
                var pegawai="' . $data['id'] . '";
                var BASE_URL = "' . BASE_URL . '";
                var SIMPEG_URL = "' . SIMPEG_URL . '";
                var RESOURCES_URL = "' . RESOURCES_URL . '";
            </script>
         ';
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/daftar-pegawai/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>