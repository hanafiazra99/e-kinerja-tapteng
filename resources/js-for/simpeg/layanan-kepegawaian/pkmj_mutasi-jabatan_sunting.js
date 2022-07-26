$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
})
$("#file_sk_jabatan").fileinput({
    language: "id",
    uploadUrl: "#",
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-xs btn-success",
    removeClass: "btn btn-xs btn-default",
    allowedFileExtensions: ['pdf'],
    previewFileIcon: "<i class=fa fa-file-image></i>",
    overwriteInitial: false,
    initialPreviewAsData: false
});
$("#file_sk_pelantikan").fileinput({
    language: "id",
    uploadUrl: "#",
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-xs btn-success",
    removeClass: "btn btn-xs btn-default",
    allowedFileExtensions: ['pdf'],
    previewFileIcon: "<i class=fa fa-file-image></i>",
    overwriteInitial: false,
    initialPreviewAsData: false
});
$('#tgl_sk_jabatan').datepicker({
    autoclose: true,
    language: 'id'
});
$('#tgl_sk_pelantikan').datepicker({
    autoclose: true,
    language: 'id'
});
$('#tmt').datepicker({
    autoclose: true,
    language: 'id'
});
$(document).ready(function () {
    $(".select2").select2();
    $('#FormSuntingMutasiJabatan').bootstrapValidator({
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

    $("#opd").change(function () {
        var req = "Change Select";
        var table = "pegawai";
        var id = "id";
        var data = "nama";
        var opd = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL + "controllers/c-layanan-kepegawaian.php",
            data: {
                req: req,
                table: table,
                id: id,
                data: data,
                where: 'opd="' + opd + '"'
            },
            cache: false,
            success: function (msg) {
                $("#pegawai").html(msg);
            }
        });
    });
    $("#opd_baru").change(function () {
        var req = "Change Select";
        var table = "opd_struktur_organisasi";
        var id = "id";
        var data = "nama_jabatan";
        var opd = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL + "controllers/c-layanan-kepegawaian.php",
            data: {
                req: req,
                table: table,
                id: id,
                data: data,
                where: 'opd="' + opd + '"'
            },
            cache: false,
            success: function (msg) {
                $("#jabatan_baru").html(msg);
            }
        });
    });
    $("#opd_baru").change(function () {
        var req = "Change Select";
        var table = "opd_unit_organisasi";
        var id = "id";
        var data = "nama";
        var opd = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL + "controllers/c-layanan-kepegawaian.php",
            data: {
                req: req,
                table: table,
                id: id,
                data: data,
                where: 'opd="' + opd + '"'
            },
            cache: false,
            success: function (msg) {
                $("#unit_organisasi_baru").html(msg);
            }
        });
    });
});