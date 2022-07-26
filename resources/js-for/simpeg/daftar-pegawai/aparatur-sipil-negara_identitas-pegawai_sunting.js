$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
})
// $("#foto").fileinput({
//     language: "id",
//     uploadUrl: "#",
//     uploadAsync: true,
//     showUpload: false,
//     showCaption: false,
//     browseClass: "btn btn-xs btn-success",
//     removeClass: "btn btn-xs btn-default",
//     allowedFileExtensions: ['jpg', 'jpeg'],
//     previewFileIcon: "<i class=fa fa-file-image></i>",
//     overwriteInitial: false,
//     initialPreviewAsData: false
// });
$('#tgl_lahir').datepicker({
    autoclose: true,
    language: 'id'
});
$('#tmt').datepicker({
    autoclose: true,
    language: 'id'
});
$(document).ready(function () {
    $(".select2").select2();
    $('#FormSuntingIdentitasPegawai').bootstrapValidator({
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

    $("#provinsi").change(function(){
        var req = "Change Select";
        var table = "ref_kabkot";
        var id = "id";
        var data = "nama";
        var provinsi = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL+"controllers/c-perubahan-data.php",
            data: {req : req, table : table, id : id, data : data, where : 'provinsi="'+provinsi+'"'},
            cache: false,
            success: function(msg){
                $("#kabkot").html(msg);
            }
        });
    });
    $("#kabkot").change(function(){
        var req = "Change Select";
        var table = "ref_kecamatan";
        var id = "id";
        var data = "nama";
        var kabkot = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL+"controllers/c-perubahan-data.php",
            data: {req : req, table : table, id : id, data : data, where : 'kabkot="'+kabkot+'"'},
            cache: false,
            success: function(msg){
                $("#kecamatan").html(msg);
            }
        });
    });
    $("#kecamatan").change(function(){
        var req = "Change Select";
        var table = "ref_keldes";
        var id = "id";
        var data = "nama";
        var kecamatan = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL+"controllers/c-perubahan-data.php",
            data: {req : req, table : table, id : id, data : data, where : 'kecamatan="'+kecamatan+'"'},
            cache: false,
            success: function(msg){
                $("#keldes").html(msg);
            }
        });
    });
    $("#opd").change(function(){
        var req = "Change Select";
        var table = "opd_unit_organisasi";
        var id = "id";
        var data = "nama";
        var opd = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL+"controllers/c-daftar-pegawai.php",
            data: {req : req, table : table, id : id, data : data, where : 'opd="'+opd+'"'},
            cache: false,
            success: function(msg){
                $("#unit_organisasi").html(msg);
            }
        });
    });
});