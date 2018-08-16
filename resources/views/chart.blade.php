
@section('title')
    User Flow Chart | @parent
@endsection

@section('content.title')
    User Flow Chart
@endsection

@section('content.subtitle')
    Get the behaviour of the users based on date
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://underscorejs.org/underscore-min.js"></script>


<div id="container" name="container"></div>

<script>
    $(document).ready(function () {
        $.ajax({
            url: "/chartData",
            dataType: 'json',
            context: document.body
        }).done(function (data) {

            let chartData = JSON.parse(data);
            let dates = Object.keys(chartData)
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
</script>