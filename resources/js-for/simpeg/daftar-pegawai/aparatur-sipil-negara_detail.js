$(document).ready(function () {
    $('#daftar_data_1 thead th').each(function () {
        var title = $(this).text();

        if (title !== '') {
            $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    $('#daftar_data_2 thead th').each(function () {
        var title = $(this).text();

        if (title !== '') {
            $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    $('#daftar_data_3 thead th').each(function () {
        var title = $(this).text();

        if (title !== '') {
            $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    $('#daftar_data_4 thead th').each(function () {
        var title = $(this).text();

        if (title !== '') {
            $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    $('#daftar_data_5 thead th').each(function () {
        var title = $(this).text();

        if (title !== '') {
            $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    $('#daftar_data_6 thead th').each(function () {
        var title = $(this).text();

        if (title !== '') {
            $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    var table1 = $('#daftar_data_1').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/simpeg/daftar-pegawai/riwayat-pgr_data.php?pegawai=" + pegawai,
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
                document.location.href = SIMPEG_URL + 'daftar-pegawai/aparatur-sipil-negara/' + pegawai + '/riwayat-pgr/tambah/';
            },
            init: function (api, node, config) {
                $(node).removeClass('btn-default')
            }
        }],
    });

    var table2 = $('#daftar_data_2').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/simpeg/daftar-pegawai/riwayat-kgb_data.php?pegawai=" + pegawai,
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
                document.location.href = SIMPEG_URL + 'daftar-pegawai/aparatur-sipil-negara/' + pegawai + '/riwayat-kgb/tambah/';
            },
            init: function (api, node, config) {
                $(node).removeClass('btn-default')
            }
        }],
    });

    var table3 = $('#daftar_data_3').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/simpeg/daftar-pegawai/riwayat-jabatan_data.php?pegawai=" + pegawai,
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
                document.location.href = SIMPEG_URL + 'daftar-pegawai/aparatur-sipil-negara/' + pegawai + '/riwayat-jabatan/tambah/';
            },
            init: function (api, node, config) {
                $(node).removeClass('btn-default')
            }
        }],
    });

    var table4 = $('#daftar_data_4').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/simpeg/daftar-pegawai/riwayat-pendidikan-umum_data.php?pegawai=" + pegawai,
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
                document.location.href = SIMPEG_URL + 'daftar-pegawai/aparatur-sipil-negara/' + pegawai + '/riwayat-pendidikan-umum/tambah/';
            },
            init: function (api, node, config) {
                $(node).removeClass('btn-default')
            }
        }],
    });

    var table5 = $('#daftar_data_5').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/simpeg/daftar-pegawai/riwayat-diklat_data.php?pegawai=" + pegawai,
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
                document.location.href = SIMPEG_URL + 'daftar-pegawai/aparatur-sipil-negara/' + pegawai + '/riwayat-diklat/tambah/';
            },
            init: function (api, node, config) {
                $(node).removeClass('btn-default')
            }
        }],
    });

    var table6 = $('#daftar_data_6').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/simpeg/daftar-pegawai/anak_data.php?pegawai=" + pegawai,
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

    table2.columns().every(function () {
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

    table3.columns().every(function () {
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

    table4.columns().every(function () {
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

    table5.columns().every(function () {
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

    $(document).on('click', 'TombolHapus', function () {
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
                data: data
            },
            cache: false,
            success: function (msg) {
                $("#modal").html(msg);
                $("#modal").modal("show");
            }
        });
    });

    $(document).on('click', 'TombolLihatFile', function () {
        var req = "Modal View File";
        var judul = $(this).attr("judul");
        var file = $(this).attr("file");
        $.ajax({
            type: "post",
            url: SIMPEG_URL + "controllers/c-daftar-pegawai.php",
            data: {
                req: req,
                judul: judul,
                file: file
            },
            cache: false,
            success: function (msg) {
                $("#modal").html(msg);
                $("#modal").modal("show");
            }
        });
    });
});