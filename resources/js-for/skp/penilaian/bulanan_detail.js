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
        "serverSide": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/skp/penilaian/bulanan_kegiatan_data.php?sasaran_bulanan=" + sasaran_bulanan + "&&status=" + status,
        lengthMenu: [
            [5, 10, 25, 100, -1],
            [5, 10, 25, 100, "All"]
        ],
        pageLength: 10,
        dom: '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right">>,' +
            '<"columns row"<"column col-sm-12"tr>>,' +
            '<"columns row"<"column col-sm-12 text-center"i>>,' +
            '<"columns row"<"column col-sm-12"<"text-center"p>>>',
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

    $(document).on('click', 'TombolSampaikanPenilaianBulanan', function () {
        var req = "Modal Konfirmasi";
        var judul = $(this).attr("judul");
        var form = $(this).attr("formreq");
        var pertanyaan = $(this).attr("pertanyaan");
        var parameter = $(this).attr("parameter");
        var data = $(this).attr("value");
        $.ajax({
            type: "post",
            url: SKP_URL + "controllers/c-penilaian.php",
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

    $(document).on('click', 'SuntingNilai', function () {
        var req = "Modal Sunting Data";
        var judul = $(this).attr("judul");
        var form = $(this).attr("formreq");
        var parameter_pengenal = $(this).attr("parameter_pengenal");
        var data_pengenal = $(this).attr("data_pengenal");
        var parameter_diganti = $(this).attr("parameter_diganti");
        var data_diganti = $(this).attr("data_diganti");
        var field = $(this).attr("fieldreq");
        $.ajax({
            type: "post",
            url: SKP_URL + "controllers/c-penilaian.php",
            data: {
                req: req,
                judul: judul,
                form: form,
                parameter_pengenal: parameter_pengenal,
                data_pengenal: data_pengenal,
                parameter_diganti: parameter_diganti,
                data_diganti: data_diganti,
                field: field
            },
            cache: false,
            success: function (msg) {
                $("#modal").html(msg);
                $("#modal").modal("show");
            }
        });
    });
});