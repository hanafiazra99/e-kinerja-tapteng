$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
})
$(document).ready(function () {
    $('#FormSuntingUsername').bootstrapValidator({
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

    $('#FormSuntingPassword').bootstrapValidator({
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
            password: {
                validators: {
                    notEmpty: {
                        message: 'Form Password Baru Tidak Boleh Kosong'
                    },
                    identical: {
                        field: 'c_password',
                        message: 'Password dan Konfirmasi Password Tidak Sama'
                    }
                }
            },
            c_password: {
                validators: {
                    notEmpty: {
                        message: 'Form Konfirmasi Password Tidak Boleh Kosong'
                    },
                    identical: {
                        field: 'password',
                        message: 'Konfirmasi Password dan Password Tidak Sama'
                    }
                }
            },
        }
    });
});