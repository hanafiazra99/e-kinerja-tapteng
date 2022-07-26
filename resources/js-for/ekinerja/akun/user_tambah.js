$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
})
$(document).ready(function () {
    $(".select2").select2();
    $('#FormTambahUser').bootstrapValidator({
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

    $("#role").change(function () {
        var role = $(this).val();

        if (role == '10') {
            $("#content_for_opd").removeAttr("style");
        } else if (role == '25') {
            $("#content_for_opd_rs").removeAttr("style");
            $("#content_for_unit_organisasi_rs").removeAttr("style");
            $("#content_for_opd").css("display", "none");
            $("#content_for_unit_organisasi").css("display", "none");
        } else if (role == '15') {
            $("#content_for_opd").removeAttr("style");
            $("#content_for_unit_organisasi").removeAttr("style");
        } else {
            $("#content_for_opd").css("display", "none");
            $("#content_for_unit_organisasi").css("display", "none");
        }
    });

    $("#opd").change(function () {
        var req = "Change Select";
        var table = "opd_unit_organisasi";
        var id = "id";
        var data = "nama";
        var opd = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL + "controllers/c-perubahan-data.php",
            data: { req: req, table: table, id: id, data: data, where: 'opd="' + opd + '"' },
            cache: false,
            success: function (msg) {
                $("#unit_organisasi").html(msg);
            }
        });
    });
});