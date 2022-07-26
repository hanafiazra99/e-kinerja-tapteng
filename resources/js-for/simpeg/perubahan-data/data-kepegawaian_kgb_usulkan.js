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
    $('#FormTambahUsulanKGB').bootstrapValidator({
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
});