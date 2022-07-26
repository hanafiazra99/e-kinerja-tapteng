$(document).ready(function () {
	$('#daftar_data_l1').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		"ajax": RESOURCES_URL + "tabel/pengaturan-agama.php",
		lengthMenu: [
			[5, 10, 25, 100, -1],
			[5, 10, 25, 100, "All"]
		],
		pageLength: 5,
		dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
			'<"columns row"<"column col-sm-12"tr>>,' +
			'<"columns row"<"column col-sm-12"p>>',
		buttons: [{
			className: 'btn btn-sm btn-primary ',
			text: 'Tambah Data',
			action: function (e, dt, node, config) {
				document.location.href = SIMPEG_URL + 'pengaturan/data-pilihan/agama/tambah/';
			},
			init: function (api, node, config) {
				$(node).removeClass('btn-default')
			}
		}],
	});

	$('#daftar_data_l2').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		"ajax": RESOURCES_URL + "tabel/pengaturan-jenis-kelamin.php",
		lengthMenu: [
			[5, 10, 25, 100, -1],
			[5, 10, 25, 100, "All"]
		],
		pageLength: 5,
		dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
			'<"columns row"<"column col-sm-12"tr>>,' +
			'<"columns row"<"column col-sm-12"p>>',
		buttons: [{
			className: 'btn btn-sm btn-primary ',
			text: 'Tambah Data',
			action: function (e, dt, node, config) {
				document.location.href = SIMPEG_URL + 'pengaturan/data-pilihan/jenis-kelamin/tambah/';
			},
			init: function (api, node, config) {
				$(node).removeClass('btn-default')
			}
		}],
	});

	$('#daftar_data_l3').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		"ajax": RESOURCES_URL + "tabel/pengaturan-golongan-darah.php",
		lengthMenu: [
			[5, 10, 25, 100, -1],
			[5, 10, 25, 100, "All"]
		],
		pageLength: 5,
		dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
			'<"columns row"<"column col-sm-12"tr>>,' +
			'<"columns row"<"column col-sm-12"p>>',
		buttons: [{
			className: 'btn btn-sm btn-primary ',
			text: 'Tambah Data',
			action: function (e, dt, node, config) {
				document.location.href = SIMPEG_URL + 'pengaturan/data-pilihan/golongan-darah/tambah/';
			},
			init: function (api, node, config) {
				$(node).removeClass('btn-default')
			}
		}],
	});

	$('#daftar_data_l4').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		"ajax": RESOURCES_URL + "tabel/pengaturan-status-perkawinan.php",
		lengthMenu: [
			[5, 10, 25, 100, -1],
			[5, 10, 25, 100, "All"]
		],
		pageLength: 5,
		dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
			'<"columns row"<"column col-sm-12"tr>>,' +
			'<"columns row"<"column col-sm-12"p>>',
		buttons: [{
			className: 'btn btn-sm btn-primary ',
			text: 'Tambah Data',
			action: function (e, dt, node, config) {
				document.location.href = SIMPEG_URL + 'pengaturan/data-pilihan/status-perkawinan/tambah/';
			},
			init: function (api, node, config) {
				$(node).removeClass('btn-default')
			}
		}],
	});

	$('#daftar_data_m1').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		"ajax": RESOURCES_URL + "tabel/pengaturan-status-kepegawaian.php",
		lengthMenu: [
			[5, 10, 25, 100, -1],
			[5, 10, 25, 100, "All"]
		],
		pageLength: 5,
		dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
			'<"columns row"<"column col-sm-12"tr>>,' +
			'<"columns row"<"column col-sm-12"p>>',
		buttons: [{
			className: 'btn btn-sm btn-primary ',
			text: 'Tambah Data',
			action: function (e, dt, node, config) {
				document.location.href = SIMPEG_URL + 'pengaturan/data-pilihan/status-kepegawaian/tambah/';
			},
			init: function (api, node, config) {
				$(node).removeClass('btn-default')
			}
		}],
	});

	$('#daftar_data_m2').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		"ajax": RESOURCES_URL + "tabel/pengaturan-kedudukan-pegawai.php",
		lengthMenu: [
			[5, 10, 25, 100, -1],
			[5, 10, 25, 100, "All"]
		],
		pageLength: 5,
		dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
			'<"columns row"<"column col-sm-12"tr>>,' +
			'<"columns row"<"column col-sm-12"p>>',
		buttons: [{
			className: 'btn btn-sm btn-primary ',
			text: 'Tambah Data',
			action: function (e, dt, node, config) {
				document.location.href = SIMPEG_URL + 'pengaturan/data-pilihan/kedudukan-pegawai/tambah/';
			},
			init: function (api, node, config) {
				$(node).removeClass('btn-default')
			}
		}],
	});

	$('#daftar_data_m3').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		"ajax": RESOURCES_URL + "tabel/pengaturan-jenis-kepegawaian.php",
		lengthMenu: [
			[5, 10, 25, 100, -1],
			[5, 10, 25, 100, "All"]
		],
		pageLength: 5,
		dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
			'<"columns row"<"column col-sm-12"tr>>,' +
			'<"columns row"<"column col-sm-12"p>>',
		buttons: [{
			className: 'btn btn-sm btn-primary ',
			text: 'Tambah Data',
			action: function (e, dt, node, config) {
				document.location.href = SIMPEG_URL + 'pengaturan/data-pilihan/jenis-kepegawaian/tambah/';
			},
			init: function (api, node, config) {
				$(node).removeClass('btn-default')
			}
		}],
	});

	$('#daftar_data_m4').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		"ajax": RESOURCES_URL + "tabel/pengaturan-jenis-jabatan.php",
		lengthMenu: [
			[5, 10, 25, 100, -1],
			[5, 10, 25, 100, "All"]
		],
		pageLength: 5,
		dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
			'<"columns row"<"column col-sm-12"tr>>,' +
			'<"columns row"<"column col-sm-12"p>>',
		buttons: [{
			className: 'btn btn-sm btn-primary ',
			text: 'Tambah Data',
			action: function (e, dt, node, config) {
				document.location.href = SIMPEG_URL + 'pengaturan/data-pilihan/jenis-jabatan/tambah/';
			},
			init: function (api, node, config) {
				$(node).removeClass('btn-default')
			}
		}],
	});

	$('#daftar_data_r1').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		"ajax": RESOURCES_URL + "tabel/pengaturan-eselon.php",
		lengthMenu: [
			[5, 10, 25, 100, -1],
			[5, 10, 25, 100, "All"]
		],
		pageLength: 5,
		dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
			'<"columns row"<"column col-sm-12"tr>>,' +
			'<"columns row"<"column col-sm-12"p>>',
		buttons: [{
			className: 'btn btn-sm btn-primary ',
			text: 'Tambah Data',
			action: function (e, dt, node, config) {
				document.location.href = SIMPEG_URL + 'pengaturan/data-pilihan/eselon/tambah/';
			},
			init: function (api, node, config) {
				$(node).removeClass('btn-default')
			}
		}],
	});

	$('#daftar_data_r2').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		"ajax": RESOURCES_URL + "tabel/pengaturan-pgr.php",
		lengthMenu: [
			[5, 10, 25, 100, -1],
			[5, 10, 25, 100, "All"]
		],
		pageLength: 5,
		dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
			'<"columns row"<"column col-sm-12"tr>>,' +
			'<"columns row"<"column col-sm-12"p>>',
		buttons: [{
			className: 'btn btn-sm btn-primary ',
			text: 'Tambah Data',
			action: function (e, dt, node, config) {
				document.location.href = SIMPEG_URL + 'pengaturan/data-pilihan/pgr/tambah/';
			},
			init: function (api, node, config) {
				$(node).removeClass('btn-default')
			}
		}],
	});

	$('#daftar_data_r3').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": false,
		"ajax": RESOURCES_URL + "tabel/pengaturan-tingkat-pendidikan.php",
		lengthMenu: [
			[5, 10, 25, 100, -1],
			[5, 10, 25, 100, "All"]
		],
		pageLength: 5,
		dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
			'<"columns row"<"column col-sm-12"tr>>,' +
			'<"columns row"<"column col-sm-12"p>>',
		buttons: [{
			className: 'btn btn-sm btn-primary ',
			text: 'Tambah Data',
			action: function (e, dt, node, config) {
				document.location.href = SIMPEG_URL + 'pengaturan/data-pilihan/tingkat-pendidikan/tambah/';
			},
			init: function (api, node, config) {
				$(node).removeClass('btn-default')
			}
		}],
	});

	$(document).on('click', 'TombolHapus', function () {
		var req = "Modal Konfirmasi";
		var judul = $(this).attr("judul");
		var form = $(this).attr("formreq");
		var pertanyaan = $(this).attr("pertanyaan");
		var parameter = $(this).attr("parameter");
		var data = $(this).attr("value");
		$.ajax({
			type: "post",
			url: SIMPEG_URL + "controllers/c-pengaturan.php",
			data: {
				req: req,
				judul: judul,
				form: form,
				pertanyaan: pertanyaan,
				parameter: parameter,
				data: data
			},
			cache: false,
			success: function (msg) {
				$("#modal").html(msg);
				$("#modal").modal("show");
			}
		});
	});
});