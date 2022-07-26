function callTable(filter) {
    var tanggal;
    if ($("#tanggal").val() == "") {
        var d = new Date();
        var strDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
        $("#tanggal").val(strDate);
        tanggal = strDate;
    } else {
        tanggal = $("#tanggal").val();
    }
    var table1 = $('#daftar_data_1').DataTable({
        "processing": true,
        "serverSide": true,
        "bDestroy": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/absensi/data-absen/data.php" + "?tanggal=" + tanggal + filter,
        lengthMenu: [
            [5, 10, 25, 100, -1],
            [5, 10, 25, 100, "All"]
        ],
        pageLength: 10,
        dom: '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right"B>>,' +
            '<"columns row"<"column col-sm-12"tr>>,' +
            '<"columns row"<"column col-sm-12 text-center"i>>,' +
            '<"columns row"<"column col-sm-12"<"text-center"p>>>',
        buttons: [{
            extend: 'excelHtml5',
            title: 'Data Absen',
            className: 'btn btn-sm btn-primary ',
            text: 'Export Excel',
            exportOptions: {
                modifier: {
                    search: 'applied',
                    page: 'all',
                    order: 'applied'
                }
            },
            init: function (api, node, config) {
                $(node).removeClass('btn-default')
            },
            customizeData: function (data) {
                for (var i = 0; i < data.body.length; i++) {
                    for (var j = 0; j < data.body[i].length; j++) {
                        data.body[i][j] = '\u200C' + data.body[i][j];
                    }
                }
            }
        }],
    });


}
$('#tanggal').datepicker({
    language: 'id',
});
$(document).ready(function () {
    $('.select2').select2();
    if (role != 1) {
        callTable((role == '10' ? "&opd=" + user_opd : (role == '15' ? "&unit_organisasi=" + user_unit_organisasi : "")));
    }
    $('#daftar_data_1 thead th').each(function () {
        var title = $(this).text();
        if (title !== '') {
            $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });
    if (role == 1) {
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

    }
    $("#tanggal").change(function () {
        if (role != 1) {
            callTable((role == '10' ? "&opd=" + user_opd : (role == '15' ? "&unit_organisasi=" + user_unit_organisasi : "")));
        } else {
            callTable("&opd=" + $("#opd option:selected").text() + "&unit_organisasi=" + $("#unit_organisasi option:selected").text());
        }
    })
    $('#daftar_data_1').DataTable().columns().every(function () {
        var table = this;
        $('input', this.header()).on('keyup change', function () {
            if (table.search() !== this.value) {
                table.search(this.value).draw();
            }
        });
        $('select', this.header()).on('change', function () {
            if (table.search() !== this.value) {
                table.search(this.value).draw();
            }
        });
    });

});