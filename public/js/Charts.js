$(document).ready(function () {
    $.ajax({
        url: "/charts/api/chartData",
        dataType: 'json',
        context: document.body
    }).done(function (data) {
        let chartData = data;
        let series = []

        $.each(chartData, function (index, value) {
            series.push({
                name: index,
                data: chartData[index]['onboarding_percentage']
            });
        })
        let myChart = new Highcharts.chart('container', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'User Flow'
            },
            series: series
        })
    })
})