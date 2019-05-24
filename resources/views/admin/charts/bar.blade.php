<script type="text/javascript" src="/js/chartjs/Chart.bundle.min.js"></script>
<style type="text/css">
    .frequency-wraper{
        position: absolute;
        left: 870px;
        top: 5px;
        z-index: 99;
    }
    .chart_payName{
        text-align:center;
        display: inline-block;
        width: 100px;
        height: 25px;
    }
    .chart-title{
        height: 36px;
        line-height: 36px;
        padding: 0 12px;
    }
    .chart-title_success{
            background: #36a2eb;
    }
    .chart-title_fail{
            background: #ff6384;
    }
    .chart-title_all{
            background: #ffce56;
    }
</style>
<div style="width: 1000px;height: 500px;"><canvas id="myChart" width="1000" height="500"></canvas></div>
<table class="table table-bordered" style="width:1000px">
    <tr>
        <td>第三方支付名称</td>
        <td>支付成功笔数</td>
        <td>支付失败笔数</td>
        <td>支付总笔数</td>
    </tr>
    @foreach($failDataArr as $key=>$value)<tr>
        <td>{{$key}}</td>
        <td class="success">{{$payData[$key]}}</td>
        <td class="danger">{{$failDataArr[$key]}}</td>
        <td class="warning">{{$allDataArr[$key]}}</td>
    </tr>@endforeach
</table>
<script>
    var labels = [];
    @foreach($labels as $one)
        labels.push("{{$one}}");
    @endforeach

    var heightData = [];
    @foreach($data as $one2)
        heightData.push({{$one2}});
    @endforeach
            
    $(function () {
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            //type: 'bar',
            type: 'horizontalBar',
            data: {
                labels: labels,
                datasets: [{
                    label: '%百分比',
                    data: heightData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(175, 192, 192, 1)',
                        'rgba(275, 192, 192, 1)',
                        'rgba(103, 102, 155, 1)',
                    ]
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        barPercentage: 1,
                        barThickness: 20,
                        maxBarThickness: 30,
                        minBarLength: 10,
                        gridLines: {
                            offsetGridLines: true
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        setInterval(function(){
            location.reload()
        }, 1000 * 60 * 5)
    });
</script>