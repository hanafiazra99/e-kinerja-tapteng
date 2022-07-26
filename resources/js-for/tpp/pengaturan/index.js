$('#daftar_data_l1').DataTable({
	"processing": true,
	"serverSide": true,
	"ordering": false,
	"ajax": RESOURCES_URL + "tabel/tpp/pengaturan/pengaturan-persentase.php",
	lengthMenu: [
		[5, 10, 25, 100, -1],
		[5, 10, 25, 100, "All"]
	],
	pageLength: 5,
	dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
		'<"columns row"<"column col-sm-12"tr>>,' +
		'<"columns row"<"column col-sm-12"p>>',
	buttons: [],
});
$('#daftar_data_l2').DataTable({
	"processing": true,
	"serverSide": true,
	"ordering": false,
	"ajax": RESOURCES_URL + "tabel/tpp/pengaturan/pengaturan-indikator-penilaian-sasaran-kerja.php",
	lengthMenu: [
		[5, 10, 25, 100, -1],
		[5, 10, 25, 100, "All"]
	],
	pageLength: 5,
	dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
		'<"columns row"<"column col-sm-12"tr>>,' +
		'<"columns row"<"column col-sm-12"p>>',
	buttons: [],
});
$('#daftar_data_l3').DataTable({
	"processing": true,
	"serverSide": true,
	"ordering": false,
	"ajax": RESOURCES_URL + "tabel/tpp/pengaturan/pengaturan-indikator-ketepatan-waktu-sasaran-kerja.php",
	lengthMenu: [
		[5, 10, 25, 100, -1],
		[5, 10, 25, 100, "All"]
	],
	pageLength: 5,
	dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
		'<"columns row"<"column col-sm-12"tr>>,' +
		'<"columns row"<"column col-sm-12"p>>',
	buttons: [],
});
$('#daftar_data_l4').DataTable({
	"processing": true,
	"serverSide": true,
	"ordering": false,
	"ajax": RESOURCES_URL + "tabel/tpp/pengaturan/pengaturan-indikator-ketepatan-masuk-kerja.php",
	lengthMenu: [
		[5, 10, 25, 100, -1],
		[5, 10, 25, 100, "All"]
	],
	pageLength: 5,
	dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
		'<"columns row"<"column col-sm-12"tr>>,' +
		'<"columns row"<"column col-sm-12"p>>',
	buttons: [],
});
$('#daftar_data_l5').DataTable({
	"processing": true,
	"serverSide": true,
	"ordering": false,
	"ajax": RESOURCES_URL + "tabel/tpp/pengaturan/pengaturan-indikator-ketepatan-pulang-kerja.php",
	lengthMenu: [
		[5, 10, 25, 100, -1],
		[5, 10, 25, 100, "All"]
	],
	pageLength: 5,
	dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
		'<"columns row"<"column col-sm-12"tr>>,' +
		'<"columns row"<"column col-sm-12"p>>',
	buttons: [],
});
$('#daftar_data_l6').DataTable({
	"processing": true,
	"serverSide": true,
	"ordering": false,
	"ajax": RESOURCES_URL + "tabel/tpp/pengaturan/pengaturan-indikator-hukuman-disiplin.php",
	lengthMenu: [
		[5, 10, 25, 100, -1],
		[5, 10, 25, 100, "All"]
	],
	pageLength: 5,
	dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
		'<"columns row"<"column col-sm-12"tr>>,' +
		'<"columns row"<"column col-sm-12"p>>',
	buttons: [],
});
$('#daftar_data_l7').DataTable({
	"processing": true,
	"serverSide": true,
	"ordering": false,
	"ajax": RESOURCES_URL + "tabel/tpp/pengaturan/pengaturan-indikator-tidak-hadir-kerja.php",
	lengthMenu: [
		[5, 10, 25, 100, -1],
		[5, 10, 25, 100, "All"]
	],
	pageLength: 5,
	dom: '<"columns row"<"column col-sm-6"><"column col-sm-6 text-right"B>>,' +
		'<"columns row"<"column col-sm-12"tr>>,' +
		'<"columns row"<"column col-sm-12"p>>',
	buttons: [],
});