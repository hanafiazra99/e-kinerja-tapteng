<?php
function cek_session()
{
    if (empty($_SESSION['id'])) {
        tujuan(BASE_URL . 'login/');
    }
}

function tujuan($link)
{
    echo '
				<script>
					document.location.href = "' . $link . '";
				</script>
			 ';
}

function level_akses()
{
    if ($_SESSION['role'] == '0') {
        $option = ucwords("Super Admin");
    } else if ($_SESSION['role'] == '1') {
        $option = ucwords("Admin");
    } else if ($_SESSION['role'] == '11') {
        $option = ucwords("Operator Sekolah");
    } else if ($_SESSION['role'] == '4') {
        $option = ucwords("Operator SKPD");
    } else if ($_SESSION['role'] == '25') {
        $option = ucwords("Operator Absensi Rumah Sakit");
    } else {
        $option = ucwords('Peserta');
    }

    return $option;
}

function level_role_option($role)
{
    if ($role == '0') {
        $option = ucwords("Super Admin");
    } else if ($role == '1') {
        $option = ucwords("Admin");
    } else if ($role == '10') {
        $option = ucwords("Operator OPD");
    } else if ($role == '15') {
        $option = ucwords("Operator Unit Organisasi");
    } else if ($_SESSION['role'] == '25') {
        $option = ucwords("Operator Absensi Rumah Sakit");
    } else {
        $option = ucwords('Pegawai');
    }

    return $option;
}

function user_data($koneksi)
{
    if ($_SESSION['role'] == 0) {
        $user_data = req_get_where($koneksi, 'view_user', 'id = "' . $_SESSION['id'] . '"');
    } else if ($_SESSION['role'] == 1) {
        $user_data = req_get_where($koneksi, 'view_user', 'id = "' . $_SESSION['id'] . '"');
    } else if ($_SESSION['role'] == 10) {
        $user_data = req_get_where($koneksi, 'view_user', 'id = "' . $_SESSION['id'] . '"');
    } else if ($_SESSION['role'] == 15) {
        $user_data = req_get_where($koneksi, 'view_user', 'id = "' . $_SESSION['id'] . '"');
    } else if ($_SESSION['role'] == 25) {
        $user_data = req_get_where($koneksi, 'view_user', 'id = "' . $_SESSION['id'] . '"');
    } else if ($_SESSION['role'] == 100) {
        $user_data = req_get_where($koneksi, 'v_pegawai', 'id = "' . $_SESSION['id'] . '"');
    }

    return $user_data;
}

function get_password($password)
{
    $options = [
        'cost' => 12,
    ];

    $get_password = password_hash($password, PASSWORD_BCRYPT, $options);

    return $get_password;
}

function auntentikasi_role_operator($base_url)
{
    if ($_SESSION['role'] != '1') {
        tujuan($base_url . 'pages/beranda/');
    }
}

function set_session_time($koneksi, $user)
{
    cek_session_list($koneksi, $user);

    $query = "update app_session_login set terakhir = now(), status = 'y' where id = '" . $user . "'";
    mysqli_query($koneksi, $query);
}

function cek_session_list($koneksi, $user)
{
    $query = "select * from app_session_login where id = '" . $user . "'";
    $conn = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($conn) == 0) {
        $query1 = "insert into app_session_login values('" . $user . "', now(), 'y')";
        mysqli_query($koneksi, $query1);
    }
}

function reset_session_time($koneksi)
{
    $query_filter = "select * from app_session_login where status = 'y'";
    $conn_filter = mysqli_query($koneksi, $query_filter);

    while ($data_filter = mysqli_fetch_array($conn_filter)) {
        $last = strtotime($data_filter['terakhir']);
        $now = strtotime(date("Y-m-d H:i:s"));
        $interval = $now - $last;

        if ($interval > 60) {
            $query = "update app_session_login set status = 'n' where id = '" . $data_filter['id'] . "'";
            $conn = mysqli_query($koneksi, $query);
        }
    }
}

function check_page_request($data, $link)
{
    if ($data == '') {
        tujuan($link);
    }
}

function get_id($depan, $belakang)
{
    $id = str_replace("-", "", date("H-i-s-Y-m-d"));
    $random = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
    return $depan . $id . $belakang . $random;
}

function cek_folder($path)
{
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    return $path;
}

/*function ftp_cek_folder($path)
{
$path = explode("/", $path);
$conn_id = @ftp_connect(FTP_HOST);
$currPath = '';
if (!$conn_id) {
return false;
}
if (@ftp_login($conn_id, FTP_USERNAME, FTP_PASSWORD)) {
foreach ($path as $dir) {
if (!$dir) {
continue;
}
$currPath .= "/" . trim($dir);
if (!@ftp_chdir($conn_id, $currPath)) {
if (!@ftp_mkdir($conn_id, $currPath)) {
@ftp_close($conn_id);
return false;
}
@ftp_chmod($conn_id, 0777, $currPath);
}
}
}
@ftp_close($conn_id);
return $currPath . '/';
}*/

function createThumbnail($nama_file, $pathToImage, $thumbWidth, $path_thumb)
{
    $result = 'Failed';
    if (is_file($pathToImage)) {
        $info = pathinfo($pathToImage);
        $extension = strtolower($info['extension']);
        if (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {
            switch ($extension) {
                case 'jpg':
                    $img = imagecreatefromjpeg($pathToImage);
                    break;
                case 'jpeg':
                    $img = imagecreatefromjpeg($pathToImage);
                    break;
                case 'png':
                    $img = imagecreatefrompng($pathToImage);
                    break;
                case 'gif':
                    $img = imagecreatefromgif($pathToImage);
                    break;
                default:
                    $img = imagecreatefromjpeg($pathToImage);
            }

            $width = imagesx($img);
            $height = imagesy($img);

            $new_width = $thumbWidth;
            $new_height = floor($height * ($thumbWidth / $width));

            $tmp_img = imagecreatetruecolor($new_width, $new_height);

            imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            $path = $path_thumb . $nama_file . "";
            imagejpeg($tmp_img, $path, 150);
        } else {
            $result = 'Failed|Not an accepted image type (JPG, PNG, GIF).';
        }
    } else {
        $result = 'Failed|Image file does not exist.';
    }

    //return $result;
}
