<?php
function page_title()
{
    return 'Beranda';
}

function portal_id()
{
    return '19';
}

if (isset($_POST['req'])) {
    if ($_POST['req'] == 'Change Select') {
        require "../../app/config.php";
        require "../../app/models.php";
        require "../../app/autentikasi.php";
        require "../../app/component.php";

        echo component_select_option_response_ajax($koneksi, $_POST['table'], $_POST['id'], $_POST['data'], $_POST['where']);
    } else if ($_POST['req'] == 'Modal Konfirmasi') {
        require "../../app/config.php";
        require "../../app/models.php";
        require "../../app/component.php";

        modal_konfirmasi($_POST['judul'], $_POST['form'], SIMPEG_URL . 'controllers/c-daftar-pegawai.php', $_POST['pertanyaan'], $_POST['parameter'], $_POST['data']);
    }
}
