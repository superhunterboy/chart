<style type="text/css">
    #chart-waper{
        height:780px;
        padding: 48px 22px 10px 28px;
    }
    .compared-wraper{
        position: absolute;
        right: 300px;
        top: 45px;
        z-index: 99;
    }
    .frequency-wraper{
        position: absolute;
        right: 100px;
        top: 45px;
        z-index: 99;
    }
    .hint{
        position: absolute;
        left: 100px;
        color: red;
        font-size: 18px;
    }
</style>
<script type="text/javascript" src="/js/chartjs/echarts.min.js"></script>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<div class="report-list">
    <div class="compared-wraper">
        统计对比：
        <select class="input compared" onChange="handleChangeCompared()">
            <option value="1">当天</option>
            <option value="2">两天</option>
            <option value="5">五天</option>
            <option value="3">三天</option>
            <option value="7">一周</option>
        </select>
    </div>
    <div class="frequency-wraper">
        统计频率：
        <select class="input frequency" onChange="handleChangeFrequency()">
            <option value="5">5分钟</option>
            <option value="10">10分钟</option>
            <option value="15">15分钟</option>
            <option value="20">20分钟</option>
            <option value="30">半小时</option>
            <option value="60">1小时</option>
        </select>
    </div>
    <div id="chart-waper"></div>
</div>
<div class="hint">示例:xxxx-xx-xx 12:00:00(20分钟区间) 实际为 12:00:00 -- 12:20:00的数据</div>
<script>
    var frequency = "30"
    var compared = "5"
    // echart实例
    var chart_instance
    // 获取数据接口ajax
    var getDataAjax

    var urlString = '/admin/pull-success-pay'
    // 

    /**
        * 获取图表渲染数据
        * @param {String} url 接口请求地址
        * @param {String} frequency 刷新频率
        * @param {String} compared 对比天数
        */
    function getReportData(url, frequency, compared){
        chart_instance.showLoading();
        getDataAjax && getDataAjax.abort()
        getDataAjax = $.get(url, {
                days: compared,
                mins: frequency
            }, function (res) {
            res = JSON.parse(res);
            if(!res.status){
                drawChart(res.data, frequency, compared)
            }else{
                alert("查询数据失败：" + res.msg)
            }
        });
    }

    // 绘制图形
    var drawChart = function (dataList, frequency, compared) {
        echarts_all_option = {
            title: {
                text: '成功入款笔数监控数据'
            },
            tooltip : {
                trigger: 'item'
            },
            grid: {
                top: '12%',
                left: '1%',
                right: '1%',
                containLabel: true
            },
            yAxis: [
                {
                    type : 'value',
                    name : '(笔)',
                    axisLabel: {
                        textStyle: {
                            fontSize: 16,
                            fontWeight: 'bold'
                        }
                    }
                }
            ]
        };

        if(frequency === "5" || frequency === "10" || frequency === "15" || frequency === "20"){
            echarts_all_option.dataZoom = [
                {
                    type: 'inside',
                    show: true,
                    start: 0,
                    end: 100,
                    handleSize: 8
                },
                {
                    type: 'inside',
                    show: true,
                    yAxisIndex: 0,
                    filterMode: 'filter',
                    width: 12,
                    height: '60%',
                    handleSize: 8,
                    showDataShadow: false,
                    left: '93%'
                }
            ]
        }

        if(compared === "1"){
            echarts_all_option.legend = {
                data: [dataList.day]
            }
            echarts_all_option.xAxis = [
                {
                    type : 'category',
                    data : dataList.time
                }
            ]
            echarts_all_option.series = [
                {
                    name: dataList.day,
                    type: 'line',
                    data: dataList.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    },
                }
            ]
        }else if(compared === "2"){
            echarts_all_option.legend = {
                data: [dataList.day1.day, dataList.day2.day]
            }
            echarts_all_option.xAxis = [
                {
                    type : 'category',
                    data : dataList.day1.time
                }
            ]
            echarts_all_option.series = [
                {
                    name: dataList.day1.day,
                    type: 'line',
                    data: dataList.day1.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day2.day,
                    type: 'line',
                    data: dataList.day2.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                }
            ]
        }else if(compared === "3"){
            echarts_all_option.legend = {
                data: [dataList.day1.day, dataList.day2.day, dataList.day3.day]
            }
            echarts_all_option.xAxis = [
                {
                    type : 'category',
                    data : dataList.day1.time
                }
            ]
            echarts_all_option.series = [
                {
                    name: dataList.day1.day,
                    type: 'line',
                    data: dataList.day1.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day2.day,
                    type: 'line',
                    data: dataList.day2.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day3.day,
                    type: 'line',
                    data: dataList.day3.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                }
            ]
        }else if(compared === "5"){
            echarts_all_option.legend = {
                data: [dataList.day1.day, dataList.day2.day, dataList.day3.day, dataList.day4.day
                    ,dataList.day5.day]
            }
            echarts_all_option.xAxis = [
                {
                    type : 'category',
                    data : dataList.day1.time
                }
            ]
            echarts_all_option.series = [
                {
                    name: dataList.day1.day,
                    type: 'line',
                    data: dataList.day1.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day2.day,
                    type: 'line',
                    data: dataList.day2.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day3.day,
                    type: 'line',
                    data: dataList.day3.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day4.day,
                    type: 'line',
                    data: dataList.day4.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day5.day,
                    type: 'line',
                    data: dataList.day5.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                }
            ]
        }else if(compared === "7"){
            echarts_all_option.legend = {
                data: [dataList.day1.day, dataList.day2.day, dataList.day3.day, dataList.day4.day
                    ,dataList.day5.day, dataList.day6.day, dataList.day7.day]
            }
            echarts_all_option.xAxis = [
                {
                    type : 'category',
                    data : dataList.day1.time
                }
            ]
            echarts_all_option.series = [
                {
                    name: dataList.day1.day,
                    type: 'line',
                    data: dataList.day1.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day2.day,
                    type: 'line',
                    data: dataList.day2.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day3.day,
                    type: 'line',
                    data: dataList.day3.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day4.day,
                    type: 'line',
                    data: dataList.day4.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day5.day,
                    type: 'line',
                    data: dataList.day5.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day6.day,
                    type: 'line',
                    data: dataList.day6.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                },
                {
                    name: dataList.day7.day,
                    type: 'line',
                    data: dataList.day7.num,
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                width: 4
                            }
                        }
                    }
                }
            ]
        }

        chart_instance.hideLoading();
        chart_instance.clear()
        chart_instance.setOption(echarts_all_option);
    };

    // 动态数据更新
    function dynUpdateData(frequency){
        var timeTicket;
        var lastData;
        var axisData;
        var refreshTime
        clearInterval(timeTicket);
        timeTicket = setInterval(function () {
            $(".frequency").val("30")
            $(".compared").val("30")
            getReportData(urlString, "30", "5")
        }, 1000 * 60 * 15);
    }

    // 动态更新数据
    dynUpdateData(frequency)

    function handleChangeFrequency(){
        frequency = $(".frequency").val()
        getReportData(urlString, frequency, compared)
    }

    function handleChangeCompared(){
        compared = $(".compared").val()
        getReportData(urlString, frequency, compared)
    }

    function init(){
        $(".compared").val(compared)
        $(".frequency").val(frequency)
        // 默认加载
        var timer;
        timer = setInterval(function(){
            if(document.getElementById('chart-waper')){
                chart_instance = echarts.init(document.getElementById('chart-waper'));
                getReportData(urlString, frequency, compared)
                clearInterval(timer)
            }
        }, 100)
    }

    init()
</script>