@extends('components/layout')
@section('components/sidebar')
@section('page-header','統計報表')
@section('page-header-detail','在這裡檢視各項統計圖表。')
@section('content')
<div class="ts-grid is-relaxed">
    <div class="column is-8-wide">
        <div id="container" style="width:100%; height:300px;"></div>

        <div class="ts-space"></div>
    </div>
    <div class="column is-8-wide">
        <div id="container2" style="width:100%; height:300px;"></div>

        <div class="ts-space"></div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chart = Highcharts.chart('container', {
            chart: { type: "line" },
            title: {
                text: '近14日違規次數'
            },
            xAxis: {
                categories: ['{!!implode("','",$x_array)!!}'],
               // categories: ['Apples', 'Bananas', 'Oranges']
            },
            yAxis: {
                title: {
                    text: '次數'
                }
            },
            series: [{
                name: '違規次數',
                data: [{!!implode(",",$y_array)!!}]
            },]
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const chart = Highcharts.chart('container2', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: '近14日違規種類'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: '佔比',
                colorByPoint: true,
                data: [{!!$pie_code!!}]
            }]
        });
    });
</script>
@stop