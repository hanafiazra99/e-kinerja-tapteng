$(document).ready(function () {
    $(document).on('click', 'TombolHapus', function () {
        var req = "Modal Konfirmasi";
        var judul = $(this).attr("judul");
        var form = $(this).attr("formreq");
        var pertanyaan = $(this).attr("pertanyaan");
        var parameter = $(this).attr("parameter");
        var data = $(this).attr("value");
        $.ajax({
            type: "post",
            url: SIMPEG_URL + "controllers/c-layanan-kepegawaian.php",
            data: {
                req: req,
                judul: judul,
                form: form,
                pertanyaan: pertanyaan,
                parameter: parameter,
                data: data
            },
            cache: false,
            success: function (msg) {
                $("#modal").html(msg);
                $("#modal").modal("show");
            }
        });
    });

    $(document).on('click', 'TombolLihatFile', function () {
        var req = "Modal View File";
        var judul = $(this).attr("judul");
        var file = $(this).attr("file");
        $.ajax({
            type: "post",
            url: SIMPEG_URL + "controllers/c-layanan-kepegawaian.php",
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