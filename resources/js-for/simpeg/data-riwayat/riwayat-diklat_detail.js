$(document).ready(function () {
    $(document).on('click', 'TombolLihatFile', function () {
        var req = "Modal View File";
        var judul = $(this).attr("judul");
        var file = $(this).attr("file");
        $.ajax({
            type: "post",
            url: SIMPEG_URL + "controllers/c-daftar-pegawai.php",
            data: {
                req: req,
                judul: judul,
                file: file
            },
            cache: false,
            success: function (msg) {
                $("#modal").html(msg);
                $("#modal").modal("show");
            }
        });
    });
});