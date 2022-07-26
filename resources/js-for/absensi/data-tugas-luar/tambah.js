

$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
})
$("#berkas").fileinput({
    language: "id",
    uploadUrl: "#",
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-xs btn-success",
    removeClass: "btn btn-xs btn-default",
    allowedFileExtensions: [, 'jpg', 'jpeg'],
    previewFileIcon: "<i class=fa fa-file-image></i>",
    overwriteInitial: false,
    initialPreviewAsData: false
});

$('#reservation').daterangepicker({
    locale: {
        format: 'YYYY/MM/DD'
    }
})

$(document).ready(function () {
    $(".select2").select2();
    $('#FormTambahTugasLuar').bootstrapValidator({
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

    $('#reservation').change(function(){

        console.log($(this).val())
    })
    $("#opd").change(function(){

        var req = "Change Select";
        var table = "pegawai";
        var id = "id";
        var data = "nama";
        var opd = $(this).val();
        $.ajax({
            type: "post",
            url: ABSENSI_URL+"controllers/c-tugas-luar.php",
            data: {req : req, table : table, id : id, data : data, where : 'opd="'+opd+'"'},
            cache: false,
            success: function(msg){
                $("#pegawai").html(msg);
            }
        });
    });
    
});