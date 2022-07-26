$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
})
$('#periode').datepicker({
    autoclose: true,
    format: "yyyy-mm",
    startDate: p_awal,
    endDate: p_akhir,
    startView: 1,
    minViewMode: 1,
    maxViewMode: 2,
    language: 'id'
});
$(document).ready(function () {
    $(".select2").select2();
    $('#FormSuntingSasaranBulanan').bootstrapValidator({
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