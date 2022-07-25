<?php
session_start();
require "../../../app/config.php";

$query = "update app_session_login set status = 'n' where id_user = '" . $_SESSION['id'] . "'";
$conn = mysqli_query($koneksi, $query);

session_destroy();

echo '
        <script>
            document.location.href = "' . BASE_URL . '";
        </script>
     ';
