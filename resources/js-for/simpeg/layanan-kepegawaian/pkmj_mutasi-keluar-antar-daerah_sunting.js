$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
})
$("#file_sk").fileinput({
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
$('#tgl_sk').datepicker({
    autoclose: true,
    language: 'id'
});
$('#tmt').datepicker({
    autoclose: true,
    language: 'id'
});
$(document).ready(function () {
    $(".select2").select2();
    $('#FormSuntingMutasiKeluarDaerah').bootstrapValidator({
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
    $("#jenis_instansi").change(function () {
        var req = "Change Select";
        var jenis_instansi = $(this).val();
        if (jenis_instansi == '1') {
            var table = "ref_kementerian";
            var id = "id";
            var data = "nama";
            var where = "id != ''";
        } else if (jenis_instansi == '2') {
            var table = "ref_provinsi";
            var id = "id";
            var data = "nama";
            var where = "id != ''";
        } else if (jenis_instansi == '3') {
            var table = "ref_kabkot";
            var id = "id";
            var data = "nama";
            var where = "id != ''";
        }
        $.ajax({
            type: "post",
            url: SIMPEG_URL + "controllers/c-layanan-kepegawaian.php",
            data: {
                req: req,
                table: table,
                id: id,
                data: data,
                where: where
            },
            cache: false,
            success: function (msg) {
                $("#instansi").html(msg);
            }
        });
    });
});