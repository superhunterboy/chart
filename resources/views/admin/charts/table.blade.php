<script type="text/javascript" src="/js/chartjs/Chart.bundle.min.js"></script>
<style type="text/css">
    .frequency-wraper{
        position: absolute;
        left: 870px;
        top: 5px;
        z-index: 99;
    }
    .compared-wraper{
        position: absolute;
        left: 700px;
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
<div class="report-list">
    <div class="compared-wraper">
        <select class="input compared" onChange="handleChange()">
            <option value="0">当天</option>
            <option value="1">两天</option>
            <option value="2">三天</option>
            <option value="3">四天</option>
            <option value="4">五天</option>
            <option value="20">20分钟</option>
            <option value="30">30分钟</option>
            <option value="60">60分钟</option>
        </select>
    </div>
    <div id="chart-waper"></div>
</div>
<table class="table table-bordered" style="width:1000px">
    <thead>
        <tr>
            <td>第三方支付名称</td>
            <td>支付成功笔数</td>
            <td>支付失败笔数</td>
            <td>支付总笔数</td>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<script>
    var urlString = '/admin/pull-success-table';
    var compared = "20";
    var getDataAjax;
    var viewData;
    var myChart

    function handleChange(){
        compared = $(".compared").val()
        getReportData(urlString, compared)
    }    

    function getReportData(url,compared){
        // chart_instance.showLoading();
        getDataAjax && getDataAjax.abort()
        getDataAjax = $.get(url, {
                date: compared,
            }, function (res) {
            if(!res.status){
                viewData = res.data;
                drawChart();
                drawTable();
            }else{
                alert("查询数据失败：" + res.msg)
            }
        });
    }

            
    function drawChart() {
        myChart.data.labels = viewData.labels;
        myChart.data.datasets.forEach((dataset) => {
            dataset.data = viewData.data
        });
        myChart.clear()
        myChart.update();
        setInterval(function(){
            location.reload()
        }, 1000 * 60 * 5)
    };

    function drawTable(){
        var trList = ""
        for(var key in viewData.failDataArr){
            trList += "<tr>" +
                    "<td>"+ key +"</td>"+
                    "<td class='success'>"+ viewData.payData[key] +"</td>"+
                    "<td class='danger'>"+ viewData.failDataArr[key] +"</td>"+
                    "<td class='warning'>"+ viewData.allDataArr[key] +"</td>"+
                    "</tr>"
        }
        $(".table tbody").html(trList)

    }

    function dynUpdateData(){
        setInterval(function(){
            getReportData(urlString, compared)
        }, 1000 * 60 * 15)
    }

    function initCharts(){
        var ctx = document.getElementById("myChart").getContext('2d');
        var option = {
            //type: 'bar',
            type: 'horizontalBar',
            data: {
                labels: [],
                datasets: [{
                    label: '%百分比',
                    data: [],
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
        }
        myChart = new Chart(ctx, option);
    }

    $(function(){
        $(".compared").val(compared)
        initCharts()
        getReportData(urlString, compared)
        dynUpdateData()
    })
</script>