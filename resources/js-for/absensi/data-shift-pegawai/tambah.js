

$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
})
$('#tanggal').datepicker({
    language: 'id',
});



$(document).ready(function () {
    $(".select2").select2();
    $('#FormTambahShiftPegawai').bootstrapValidator({
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
    $("#unit_organisasi").change(function () {

        var req = "Change Select";
        var table = "pegawai";
        var id = "id";
        var data = "nama";
        var unit_organisasi = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL + "controllers/c-perubahan-data.php",
            data: { req: req, table: table, id: id, data: data, where: 'unit_organisasi="' + unit_organisasi + '"' },
            cache: false,
            success: function (msg) {
                $("#pegawai").html(msg);
            }
        });
    });

});