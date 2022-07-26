$(document).ready(function () {
  function newexportaction(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one("preXhr", function (e, s, data) {
      // Just this once, load all data from the server...
      data.start = 0;
      data.length = 2147483647;
      dt.one("preDraw", function (e, settings) {
        // Call the original action function
        if (button[0].className.indexOf("buttons-copy") >= 0) {
          $.fn.dataTable.ext.buttons.copyHtml5.action.call(
            self,
            e,
            dt,
            button,
            config
          );
        } else if (button[0].className.indexOf("buttons-excel") >= 0) {
          $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)
            ? $.fn.dataTable.ext.buttons.excelHtml5.action.call(
                self,
                e,
                dt,
                button,
                config
              )
            : $.fn.dataTable.ext.buttons.excelFlash.action.call(
                self,
                e,
                dt,
                button,
                config
              );
        } else if (button[0].className.indexOf("buttons-csv") >= 0) {
          $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config)
            ? $.fn.dataTable.ext.buttons.csvHtml5.action.call(
                self,
                e,
                dt,
                button,
                config
              )
            : $.fn.dataTable.ext.buttons.csvFlash.action.call(
                self,
                e,
                dt,
                button,
                config
              );
        } else if (button[0].className.indexOf("buttons-pdf") >= 0) {
          $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config)
            ? $.fn.dataTable.ext.buttons.pdfHtml5.action.call(
                self,
                e,
                dt,
                button,
                config
              )
            : $.fn.dataTable.ext.buttons.pdfFlash.action.call(
                self,
                e,
                dt,
                button,
                config
              );
        } else if (button[0].className.indexOf("buttons-print") >= 0) {
          $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
        }
        dt.one("preXhr", function (e, s, data) {
          // DataTables thinks the first item displayed is index 0, but we're not drawing that.
          // Set the property to what it was before exporting.
          settings._iDisplayStart = oldStart;
          data.start = oldStart;
        });
        // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
        setTimeout(dt.ajax.reload, 0);
        // Prevent rendering of the full data to the DOM
        return false;
      });
    });
    // Requery the server with the new one-time export settings
    dt.ajax.reload();
  }

  $("#daftar_data_1 thead th").each(function () {
    var title = $(this).text();

    if (title !== "") {
      $(this).html(
        title +
          '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' +
          title +
          '" />'
      );
    } else {
      $(this).html("");
    }
  });

  var table1 = $("#daftar_data_1").DataTable({
    processing: true,
    serverSide: true,
    ordering: false,
    ajax:
      RESOURCES_URL +
      "tabel/simpeg/daftar-pegawai/pegawai-pppk_data.php" +
      (role == "10" ? "?opd=" + user_opd : ""),
    lengthMenu: [
      [5, 10, 25, 100, -1],
      [5, 10, 25, 100, "All"],
    ],
    pageLength: 10,
    dom:
      '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right"' +
      (role == "10" ? "" : "B") +
      ">>," +
      '<"columns row"<"column col-sm-12"tr>>,' +
      '<"columns row"<"column col-sm-12 text-center"i>>,' +
      '<"columns row"<"column col-sm-12"<"text-center"p>>>',
    buttons: [
      {
        className: "btn btn-sm btn-primary ",
        text: "Tambah Data",
        action: function (e, dt, node, config) {
          document.location.href =
            SIMPEG_URL + "daftar-pegawai/pegawai-pppk/tambah/";
        },
        init: function (api, node, config) {
          $(node).removeClass("btn-default");
        },
      },
      {
        extend: "csv",
        className: "btn btn-success btn-sm",
        text: "Export Excel",
        titleAttr: "Excel",
        action: newexportaction,
        init: function (api, node, config) {
          $(node).removeClass("btn-default");
        },
      },
    ],
  });

  table1.columns().every(function () {
    var table = this;
    $("input", this.header()).on("keyup change", function () {
      if (table.search() !== this.value) {
        table.search(this.value).draw();
      }
    });
    $("select", this.header()).on("change", function () {
      if (table.search() !== this.value) {
        table.search(this.value).draw();
      }
    });
  });

  $(document).on("click", "TombolHapus", function () {
    var req = "Modal Konfirmasi";
    var judul = $(this).attr("judul");
    var form = $(this).attr("formreq");
    var pertanyaan = $(this).attr("pertanyaan");
    var parameter = $(this).attr("parameter");
    var data = $(this).attr("value");
    $.ajax({
      type: "post",
      url: SIMPEG_URL + "controllers/c-daftar-pegawai.php",
      data: {
        req: req,
        judul: judul,
        form: form,
        pertanyaan: pertanyaan,
        parameter: parameter,
        data: data,
      },
      cache: false,
      success: function (msg) {
        $("#modal").html(msg);
        $("#modal").modal("show");
      },
    });
  });
});
