$(document).ready(function () {
    $('#daftar_data_1 thead th').each(function () {
        var title = $(this).text();

        if (title !== '') {
            $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    var table1 = $('#daftar_data_1').DataTable({
        "processing": true,
        //"serverSide": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/simpeg/laporan/agama.php" + (role == '10' ? "?opd=" + user_opd : ""),
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
            title: 'Laporan Agama',
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
			customizeData: function(data) {
				for(var i = 0; i < data.body.length; i++) {
					for(var j = 0; j < data.body[i].length; j++) {
						data.body[i][j] = '\u200C' + data.body[i][j];
					}
				}
			}
        }],
    });

    table1.columns().every(function () {
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