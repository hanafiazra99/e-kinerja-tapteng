$('#periode').datepicker({
    autoclose: true,
    language: 'id',
    minViewMode: 1,
    maxViewMode: 2,
    startView: 2,
});
$(document).ready(function () {
    $(".select2").select2();
    var table1 = $('#daftar_data_1').DataTable({
        "processing": true,
        "ordering": false,
        lengthMenu: [
            [5, 10, 25, 100, -1],
            [5, 10, 25, 100, "All"]
        ],
        pageLength: -1,
        dom: '<"columns row"<"column col-sm-12"tr>>,' +
            '<"columns row"<"column col-sm-12 text-center"i>>,',
        "columnDefs": [{
            "visible": false,
            "targets": 0
        }]
    });


    $("TombolFilterPerhitunganTPP").click(function () {
        table1.destroy();
        table1 = $('#daftar_data_1').DataTable({
            "processing": true,
            "ordering": false,
            lengthMenu: [
                [5, 10, 25, 100, -1],
                [5, 10, 25, 100, "All"]
            ],
            pageLength: -1,
            dom: '<"columns row"<"column col-sm-12"tr>>,' +
                '<"columns row"<"column col-sm-12 text-center"i>>,',
            "columnDefs": [{
                "visible": false,
                "targets": 0
            }]
        });

        $("#loader").removeAttr("style");
        $("#content_data").removeAttr("style");

        var opd = $('#opd').val();
        $.ajax({
            async: false,
            type: "post",
            dataType: 'JSON',
            url: TPP_URL + "controllers/c-perhitungan-tpp.php",
            data: {
                req: 'Daftar Pegawai TPP',
                opd: opd
            },
            cache: false,
            success: function (data_return) {
                for (var i = 0; i < data_return.length; i++) {
                    var pegawai_id = data_return[i];
                    var periode = $('#periode').val();
                    var nip = null;
                    var nama = null;
                    var jabatan = null;
                    var tpp_penuh = null;
                    var capaian_skp = null;
                    var tgl_penyampaian = null;
                    var telat = null;
                    var pulang_cepat = null;
                    var absen = null;
                    var hukuman = null;
                    var tpp_diterima = null;
                    $.ajax({
                        async: false,
                        type: "post",
                        dataType: 'JSON',
                        url: TPP_URL + "controllers/c-perhitungan-tpp.php",
                        data: {
                            req: 'Rincian Pegawai TPP',
                            pegawai_id: pegawai_id,
                            periode: periode
                        },
                        cache: false,
                        success: function (data_return) {
                            nip = data_return.nip;
                            nama = data_return.nama;
                            jabatan = data_return.jabatan;
                            tpp_penuh = data_return.tpp_penuh;
                            capaian_skp = data_return.capaian_skp;
                            tgl_penyampaian = data_return.tgl_penyampaian;
                            telat = data_return.telat;
                            pulang_cepat = data_return.pulang_cepat;
                            absen = data_return.absen;
                            hukuman = data_return.hukuman;
                            tpp_diterima = data_return.tpp_diterima;
                            //console.log(data_return);
                        }
                    });

                    var rowNode = table1
                        .row.add([pegawai_id, nip, nama, jabatan, tpp_penuh, capaian_skp, tgl_penyampaian, telat, pulang_cepat, absen, hukuman, tpp_diterima])
                        .draw()
                        .node();

                    $(rowNode)
                        .css('color', 'green')
                        .animate({
                            color: 'black'
                        });
                };
            }
        });
        $("#loader").css("display", "none");
    });
});