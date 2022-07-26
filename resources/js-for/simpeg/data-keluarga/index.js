$(document).ready(function () {
    $('#daftar_data_6 thead th').each(function () {
        var title = $(this).text();

        if (title !== '') {
            $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    var table6 = $('#daftar_data_6').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/simpeg/data-keluarga/anak_data.php?pegawai=" + pegawai,
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
            className: 'btn btn-sm btn-primary ',
            text: 'Tambah Data',
            action: function (e, dt, node, config) {
                document.location.href = SIMPEG_URL + 'daftar-pegawai/aparatur-sipil-negara/' + pegawai + '/anak/tambah/';
            },
            init: function (api, node, config) {
                $(node).removeClass('btn-default')
            }
        }],
    });

    table6.columns().every(function () {
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