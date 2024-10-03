@extends('layouts.app')

@section('body')
    <x-main-header title="Dashboard" />
    <section class="grid grid-cols-1 gap-4">
        <div class="w-full p-2 border border-gray-100 shadow rounded-lg">
            <h2 class="font-semibold mb-2 text-lg sm:text-xl">Rp. 90,2323,992</h2>
            <p class="text-sm text-gray-500">Penghasilan Tahunan</p>
            <div class="" id="chart"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="w-full p-2 border border-gray-100 shadow rounded-lg">
                <h2 class="font-semibold mb-2 text-lg sm:text-xl">Latest Orders</h2>
                @livewire('dashboard.list-latest-orders', ['lazy' => true])
            </div>
            <div class="w-full p-2 border border-gray-100 shadow rounded-lg">
                <h2 class="font-semibold mb-2 text-lg sm:text-xl">Other Statistic</h2>
                
            </div>
            <div class="w-full p-2 border border-gray-100 shadow rounded-lg">
                <h2 class="font-semibold mb-2 text-lg sm:text-xl">Persebaran Pembelian</h2>
                <div id="svgMap"></div>
            </div>
            <div class="w-full p-2 border border-gray-100 shadow rounded-lg">
                <h2 class="font-semibold mb-2 text-lg sm:text-xl">Orders Month</h2>
                <div id="chartPembelian"></div>
            </div>
        </div>
    </section>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/svg-pan-zoom@3.6.1/dist/svg-pan-zoom.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/StephanWagner/svgMap@v2.10.1/dist/svgMap.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/StephanWagner/svgMap@v2.10.1/dist/svgMap.min.css" rel="stylesheet">
<script>
    var options = {
            series: [{
            name: "STOCK ABC",
            data: [9932838, 1223727, 3727723, 1723737, 323231, 3232323]
        }],
        chart: {
            type: 'area',
            height: 350,
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        labels: [21, 22, 23, 25, 26, 27],
        yaxis: {
            opposite: true
        },
        legend: {
            horizontalAlign: 'left'
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
<script>
    var options = {
        series: [{
            name: 'Inflation',
            data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                    position: 'top', // top, center, bottom
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val + "%";
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },
        
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            position: 'top',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                    colorFrom: '#D8E3F0',
                    colorTo: '#BED1E6',
                    stops: [0, 100],
                    opacityFrom: 0.4,
                    opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function (val) {
                    return val + "%";
                }
            }
        
        }
    };

    var chart = new ApexCharts(document.querySelector("#chartPembelian"), options);
    chart.render();
</script>
<script>
    new svgMap({
        targetElementID: 'svgMap',
        mouseWheelZoomEnabled: false,
        mouseWheelZoomWithKey: true,
        data: {
            data: {
            gdp: {
                name: 'GDP per capita',
                format: '{0} USD',
                thousandSeparator: ',',
                thresholdMax: 50000,
                thresholdMin: 1000
            },
            change: {
                name: 'Change to year before',
                format: '{0} %'
            }
            },
            applyData: 'gdp',
            values: {
            AF: { gdp: 587, change: 4.73 },
            AL: { gdp: 4583, change: 11.09 },
            DZ: { gdp: 4293, change: 10.01 }
            // ...
            }
        }
    });
</script>
@endpush