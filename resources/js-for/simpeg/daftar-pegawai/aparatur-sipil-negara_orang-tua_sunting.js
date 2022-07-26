

$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
})
$('#tgl_lahir_a').datepicker({
    autoclose: true,
    language: 'id'
});
$('#tgl_lahir_i').datepicker({
    autoclose: true,
    language: 'id'
});
$(document).ready(function () {
    $(".select2").select2();
    $('#FormSuntingOrangTua').bootstrapValidator({
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

    $("#provinsi_a").change(function(){
        var req = "Change Select";
        var table = "ref_kabkot";
        var id = "id";
        var data = "nama";
        var provinsi = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL+"controllers/c-daftar-pegawai.php",
            data: {req : req, table : table, id : id, data : data, where : 'provinsi="'+provinsi+'"'},
            cache: false,
            success: function(msg){
                $("#kabkot_a").html(msg);
            }
        });
    });
    $("#kabkot_a").change(function(){
        var req = "Change Select";
        var table = "ref_kecamatan";
        var id = "id";
        var data = "nama";
        var kabkot = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL+"controllers/c-daftar-pegawai.php",
            data: {req : req, table : table, id : id, data : data, where : 'kabkot="'+kabkot+'"'},
            cache: false,
            success: function(msg){
                $("#kecamatan_a").html(msg);
            }
        });
    });
    $("#kecamatan_a").change(function(){
        var req = "Change Select";
        var table = "ref_keldes";
        var id = "id";
        var data = "nama";
        var kecamatan = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL+"controllers/c-daftar-pegawai.php",
            data: {req : req, table : table, id : id, data : data, where : 'kecamatan="'+kecamatan+'"'},
            cache: false,
            success: function(msg){
                $("#keldes_a").html(msg);
            }
        });
    });

    $("#provinsi_i").change(function(){
        var req = "Change Select";
        var table = "ref_kabkot";
        var id = "id";
        var data = "nama";
        var provinsi = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL+"controllers/c-daftar-pegawai.php",
            data: {req : req, table : table, id : id, data : data, where : 'provinsi="'+provinsi+'"'},
            cache: false,
            success: function(msg){
                $("#kabkot_i").html(msg);
            }
        });
    });
    $("#kabkot_i").change(function(){
        var req = "Change Select";
        var table = "ref_kecamatan";
        var id = "id";
        var data = "nama";
        var kabkot = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL+"controllers/c-daftar-pegawai.php",
            data: {req : req, table : table, id : id, data : data, where : 'kabkot="'+kabkot+'"'},
            cache: false,
            success: function(msg){
                $("#kecamatan_i").html(msg);
            }
        });
    });
    $("#kecamatan_i").change(function(){
        var req = "Change Select";
        var table = "ref_keldes";
        var id = "id";
        var data = "nama";
        var kecamatan = $(this).val();
        $.ajax({
            type: "post",
            url: SIMPEG_URL+"controllers/c-daftar-pegawai.php",
            data: {req : req, table : table, id : id, data : data, where : 'kecamatan="'+kecamatan+'"'},
            cache: false,
            success: function(msg){
                $("#keldes_i").html(msg);
            }
        });
    });
});