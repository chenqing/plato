
<div class="tabbable tabs-left" style="min-height: 400px;">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#lA"><i class="icon-search  icon-3x"></i>  万能搜索</a></li>

        <li class=""><a data-toggle="tab" href="#lC"><i class=" icon-bar-chart  icon-3x"></i>图表统计</a></li>
        <li class=""><a data-toggle="tab" href="#lB"><i class="   icon-comments  icon-3x"></i>  有事留言</a></li>
        <li class=""><a data-toggle="tab" href="#lD"><i class=" icon-h-sign  icon-3x"></i>  批量运行</a></li>
        <li class=""><a data-toggle="tab" href="#lE"><i class="icon-spinner icon-spin icon-3x"></i>  再加点啥</a></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="tab-content">
        <div id="lA" class="tab-pane active" style="min-height: 420px; overflow: hidden;">
            <div class="container">
                <div class="row" style="min-height: 420px; overflow: hidden;">
                    <div class="span3">
                    </div>
                    <div class="span6">
                        <h1 style="min-height: 100px;" class="text-center"><img src="../assets/img/search-logo.jpg"></h1>
                        <div class="input-append ">
                            <input class="span5 input-xlarge" id="appendedInputButton" type="text" placeholder="搜索@host #node ~ip ">
                            <button class="btn btn-primary" type="button">搜索</button>
                        </div>
                    </div>

            </div>
        </div>
            </div>
        <div id="lB" class="tab-pane">
            <!-- Duoshuo Comment BEGIN -->
            <div class="ds-thread"></div>
            <script type="text/javascript">
                var duoshuoQuery = {short_name:"plato"};
                (function() {
                    var ds = document.createElement('script');
                    ds.type = 'text/javascript';ds.async = true;
                    ds.src = 'http://static.duoshuo.com/embed.js';
                    ds.charset = 'UTF-8';
                    (document.getElementsByTagName('head')[0]
                        || document.getElementsByTagName('body')[0]).appendChild(ds);
                })();
            </script>
            <!-- Duoshuo Comment END -->

        </div>
        <div id="lC" class="tab-pane">

            <script src="<?php echo base_url('assets/js/highcharts.js');?>"></script>
            <script src="<?php echo base_url('assets/js/exporting.js');?>"></script>

            <div id="container" style="min-width: 300px; height: 200px; margin: 10px ;float: left;"></div>
            <div id="container1" style="min-width: 400px; height: 200px; margin: 10px;float: left;"></div>
            <div id="container2" style="min-width: 300px; height: 200px; margin: 10px ;float: left;"></div>
            <script type="text/javascript">
                $(function () {
                    $('#container').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: '服务器数量及占比'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: '服务器数量占比',
                            data: [
                                ['FC',   800],
                                ['FSCS',       380],
                                {
                                    name: 'FDNS',
                                    y: 12.8,
                                    sliced: true,
                                    selected: true
                                },
                                ['A10',    10],
                                ['F5',     8],
                                ['交换机',  100 ]
                            ]
                        }]
                    });
                    $('#container1').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: '节点分布及占比'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: '节点分布及占比',
                            data: [
                                ['移动节点',   15],
                                ['铁通节点',       1],
                                ['广电节点',6],
                                ['联通节点',    1],
                                ['电信节点',     1],
                                ['海外节点',  4 ]
                            ]
                        }]
                    });
                    $('#container2').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: '流量及占比'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: '流量及占比',
                            data: [
                                ['出流量',   800],
                                ['入流量',       380]
                            ]
                        }]
                    });
                });


            </script>
        </div>
        <div id="lD" class="tab-pane">
            <iframe src="http://112.25.34.10:60000/hello.html" width="100%" align="center" height="420px" frameborder="0" scrolling="auto"></iframe>

        </div>
        <div id="lE" class="tab-pane">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#home">Linux</a></li>
                <li><a href="#profile">程序设计</a></li>
                <li><a href="#messages">网络相关</a></li>
                <li><a href="#settings">技术潮流</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <iframe src="http://www.chenqing.org" width="100%" align="center" height="420px" frameborder="0" scrolling="auto">

                    </iframe>

                </div>
                <div class="tab-pane" id="profile">2</div>
                <div class="tab-pane" id="messages">3</div>
                <div class="tab-pane" id="settings">4</div>
            </div>
            <script>
                $('#myTab a').click(function (e) {
                    e.preventDefault();
                    $(this).tab('show');
                })

            </script>


        </div>
    </div>
</div>
<script>
    $.messager.show({
        title:'欢迎您',
        msg:'欢迎过来转转',
        showType:'show'
    });
</script>