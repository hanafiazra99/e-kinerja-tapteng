$(document).ready(function () {
  var table1 = $("#daftar_data_1").DataTable({
    processing: true,
    bDestroy: true,
    serverSide: false,
    ordering: false,
    ajax: RESOURCES_URL + "tabel/absensi/jadwal/hari-libur/data.php",
    lengthMenu: [
      [5, 10, 25, 100, -1],
      [5, 10, 25, 100, "All"],
    ],
    pageLength: 10,
    dom:
      '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right"B>>,' +
      '<"columns row"<"column col-sm-12"tr>>,' +
      '<"columns row"<"column col-sm-12 text-center"i>>,' +
      '<"columns row"<"column col-sm-12"<"text-center"p>>>',
    buttons: [
      {
        className: "btn btn-sm btn-primary ",
        text: "Tambah Data Tahun Ini",
        action: function (e, dt, node, config) {
          document.location.href = ABSENSI_URL + "jadwal/hari-libur/tambah";
        },
        init: function (api, node, config) {
          $(node).removeClass("btn-default");
        },
      },
    ],
  });
});
