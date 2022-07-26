function pie_chart(chart_values, container_id, label_kategori, label_banyak_data) {
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', label_kategori);
        data.addColumn('number', label_banyak_data);
        data.addRows(chart_values)

        var options = {
            legend: 'bottom',
            chartArea: {
                left: 0,
                top: 0,
                width: '100%',
                height: '75%'
            },
            is3D: true,
            tooltip: {
                trigger: 'selection'
            }
        };

        var container = document.getElementById(container_id);
        var chart = new google.visualization.PieChart(container);

        google.visualization.events.addListener(chart, 'click', clearSelection);
        document.body.addEventListener('click', clearSelection, false);

        chart.draw(data, options);

        function clearSelection(e) {
            if (!container.contains(e.srcElement)) {
                chart.setSelection();
            }
        }
    }

}

$(document).ready(function () {
    $.ajax({
        url: RESOURCES_URL + "chart/simpeg/beranda/pegawai-jenis-kelamin.php?status_kepegawaian=ASN" + (role == '10' ? "?opd=" + user_opd : ""),
        type: "GET",
        dataType: "json",
        success: function (chart_values) {
            var container_id = 'chart_jenis_kelamin_asn';
            var label_kategori = 'Jenis Kelamin';
            var label_banyak_data = 'Banyak Pegawai';
            pie_chart(chart_values, container_id, label_kategori, label_banyak_data);
        }
    });
    $.ajax({
        url: RESOURCES_URL + "chart/simpeg/beranda/pegawai-jenis-kelamin.php?status_kepegawaian=Honorer" + (role == '10' ? "?opd=" + user_opd : ""),
        type: "GET",
        dataType: "json",
        success: function (chart_values) {
            var container_id = 'chart_jenis_kelamin_honorer';
            var label_kategori = 'Jenis Kelamin';
            var label_banyak_data = 'Banyak Pegawai';
            pie_chart(chart_values, container_id, label_kategori, label_banyak_data);
        }
    });
    $.ajax({
        url: RESOURCES_URL + "chart/simpeg/beranda/pegawai-agama.php?status_kepegawaian=ASN" + (role == '10' ? "?opd=" + user_opd : ""),
        type: "GET",
        dataType: "json",
        success: function (chart_values) {
            var container_id = 'chart_agama_asn';
            var label_kategori = 'Agama';
            var label_banyak_data = 'Banyak Pegawai';
            pie_chart(chart_values, container_id, label_kategori, label_banyak_data);
        }
    });
    $.ajax({
        url: RESOURCES_URL + "chart/simpeg/beranda/pegawai-agama.php?status_kepegawaian=Honorer" + (role == '10' ? "?opd=" + user_opd : ""),
        type: "GET",
        dataType: "json",
        success: function (chart_values) {
            var container_id = 'chart_agama_honorer';
            var label_kategori = 'Agama';
            var label_banyak_data = 'Banyak Pegawai';
            pie_chart(chart_values, container_id, label_kategori, label_banyak_data);
        }
    });
    $.ajax({
        url: RESOURCES_URL + "chart/simpeg/beranda/pegawai-opd.php?status_kepegawaian=ASN" + (role == '10' ? "?opd=" + user_opd : ""),
        type: "GET",
        dataType: "json",
        success: function (chart_values) {
            var container_id = 'chart_opd_asn';
            var label_kategori = 'OPD';
            var label_banyak_data = 'Banyak Pegawai';
            pie_chart(chart_values, container_id, label_kategori, label_banyak_data);
        }
    });
    $.ajax({
        url: RESOURCES_URL + "chart/simpeg/beranda/pegawai-opd.php?status_kepegawaian=Honorer" + (role == '10' ? "?opd=" + user_opd : ""),
        type: "GET",
        dataType: "json",
        success: function (chart_values) {
            var container_id = 'chart_opd_honorer';
            var label_kategori = 'OPD';
            var label_banyak_data = 'Banyak Pegawai';
            pie_chart(chart_values, container_id, label_kategori, label_banyak_data);
        }
    });
    $.ajax({
        url: RESOURCES_URL + "chart/simpeg/beranda/pegawai-jenis-kepegawaian.php" + (role == '10' ? "?opd=" + user_opd : ""),
        type: "GET",
        dataType: "json",
        success: function (chart_values) {
            var container_id = 'chart_jenis_kepegawaian';
            var label_kategori = 'Jenis Kepegawaian';
            var label_banyak_data = 'Banyak Pegawai';
            pie_chart(chart_values, container_id, label_kategori, label_banyak_data);
        }
    });
    $.ajax({
        url: RESOURCES_URL + "chart/simpeg/beranda/pegawai-status-kepegawaian.php" + (role == '10' ? "?opd=" + user_opd : ""),
        type: "GET",
        dataType: "json",
        success: function (chart_values) {
            var container_id = 'chart_status_kepegawaian';
            var label_kategori = 'Status Kepegawaian';
            var label_banyak_data = 'Banyak Pegawai';
            pie_chart(chart_values, container_id, label_kategori, label_banyak_data);
        }
    });
    $.ajax({
        url: RESOURCES_URL + "chart/simpeg/beranda/pegawai-jenis-jabatan.php?status_kepegawaian=ASN" + (role == '10' ? "&&opd=" + user_opd : ""),
        type: "GET",
        dataType: "json",
        success: function (chart_values) {
            var container_id = 'chart_jenis_jabatan_asn';
            var label_kategori = 'Jenis Jabatan';
            var label_banyak_data = 'Banyak Pegawai';
            pie_chart(chart_values, container_id, label_kategori, label_banyak_data);
        }
    });
    $.ajax({
        url: RESOURCES_URL + "chart/simpeg/beranda/pegawai-pgr.php?status_kepegawaian=ASN" + (role == '10' ? "&&opd=" + user_opd : ""),
        type: "GET",
        dataType: "json",
        success: function (chart_values) {
            var container_id = 'chart_pgr_asn';
            var label_kategori = 'Jenis Jabatan';
            var label_banyak_data = 'Banyak Pegawai';
            pie_chart(chart_values, container_id, label_kategori, label_banyak_data);
        }
    });
});