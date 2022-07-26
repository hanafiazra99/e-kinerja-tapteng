$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
})

$(document).ready(function () {
    $(".select2").select2();
    $('#FormVerifikasiPengangkatanCPNS').bootstrapValidator({
        live: 'disabled',
        message: 'This value is not valid',
        fields: {
            check_form: {
                validators: {
                    notEmpty: {
                        message: 'Centang bagian ini jika anda sudah mengisi form dengan benar'
                    }
                }
            },
        }
    });
    $("#tindakan").change(function () {
        var tindakan = $(this).val();

        if (tindakan == 'Tidak Setuju') {
            $(".container_alasan").removeAttr("style");
        } else {
            $(".container_alasan").css("display", "none");
        }
    });
	
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