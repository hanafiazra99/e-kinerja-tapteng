$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
  checkboxClass: 'icheckbox_flat-green',
  radioClass   : 'iradio_flat-green'
})
$('.timepicker').timepicker({
      showInputs: false
    })
$(document).ready(function() {
	$('#FormSuntingJamKerja').bootstrapValidator({
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
} ); 