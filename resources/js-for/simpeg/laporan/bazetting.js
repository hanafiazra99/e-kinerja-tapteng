$(document).ready(function () {
  $(".select2").select2();

  var table1 = $("#daftar_data_1").DataTable({
    processing: true,
    serverSide: true,
    ordering: false,
    ajax: RESOURCES_URL + "tabel/simpeg/laporan/bazetting.php",
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
        className: "btn btn-sm btn-success ",
        text: "Export Excel",
        action: function (e, dt, node, config) {
          document.location.href = SIMPEG_URL + "laporan/bazetting/excel";
        },
        init: function (api, node, config) {
          $(node).removeClass("btn-default");
        },
      },
    ],
  });
});
