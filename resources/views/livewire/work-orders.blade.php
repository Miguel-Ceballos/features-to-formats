<div class="space-y-4">
    <h1 class="text-2xl font-bold mb-10">Work Orders</h1>

    <div class="flex gap-4 my-12">
        <div>
           <flux:input type="month" wire:model.live="month" name="month" label="Month" placeholder="Month" class="w-full" />
        </div>
    </div>

    <div class="flex gap-4 w-full my-12">
        <!-- PIE CHART -->
        <div x-data="pieChart({ series: @entangle('series') })"
             x-init="$watch('series', () => { showChart() })"
             class="max-w-sm w-full bg-white rounded-lg shadow-sm dark:bg-zinc-700 p-4 md:p-6">
            <div class="flex justify-between items-start w-full">
                <div class="flex-col items-center">
                    <div class="flex items-center mb-1">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Ordenes de
                            trabajo</h5>
                        <svg data-popover-target="chart-info" data-popover-placement="bottom"
                             class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                             aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
                        </svg>
                        <div data-popover id="chart-info" role="tooltip"
                             class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                            <div class="p-3 space-y-2">
                                <h3 class="font-semibold text-gray-900 dark:text-white">Activity growth -
                                    Incremental</h3>
                                <p>Report helps navigate cumulative growth of community activities. Ideally, the chart
                                    should have a growing trend, as stagnating chart signifies a significant decrease of
                                    community activity.</p>
                                <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3>
                                <p>For each date bucket, the all-time volume of activities is calculated. This means
                                    that activities in period n contain all activities up to period n, plus the
                                    activities generated by your community in period.</p>
                                <a href="#"
                                   class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read
                                    more
                                    <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                </a>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </div>
                    <button id="dateRangeButton" data-dropdown-toggle="dateRangeDropdown"
                            data-dropdown-ignore-click-outside-class="datepicker" type="button"
                            class="inline-flex items-center text-blue-700 dark:text-blue-600 font-medium hover:underline">
                        31 Nov - 31 Dev
                        <svg class="w-3 h-3 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <div id="dateRangeDropdown"
                         class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-80 lg:w-96 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="p-3" aria-labelledby="dateRangeButton">
                            <div date-rangepicker datepicker-autohide class="flex items-center">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input name="start" type="text"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Start date">
                                </div>
                                <span class="mx-2 text-gray-500 dark:text-gray-400">to</span>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input name="end" type="text"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="End date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Line Chart -->
            <div class="py-6" id="pie-chart"></div>
            <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                    <!-- Button -->
                    <button
                        id="dropdownDefaultButton"
                        data-dropdown-toggle="lastDaysdropdown"
                        data-dropdown-placement="bottom"
                        class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                        type="button">
                        Last 7 days
                        <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <div id="lastDaysdropdown"
                         class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                            </li>
                            <li>
                                <a href="#"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                            </li>
                            <li>
                                <a href="#"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                    7 days</a>
                            </li>
                            <li>
                                <a href="#"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                    30 days</a>
                            </li>
                            <li>
                                <a href="#"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                    90 days</a>
                            </li>
                        </ul>
                    </div>
                    <a
                        href="#"
                        class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                        Traffic analysis
                        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 9 4-4-4-4"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div x-data="columnChart({categories: @entangle('users'), series: @entangle('workOrdersCategory')})"
             x-init="$watch('series', () => { showChart() })"
             class="max-w-full w-full bg-white rounded-lg shadow-sm dark:bg-zinc-700 p-4 md:p-6">
            <div class="flex justify-between items-start w-full">
                <div class="flex-col items-center">
                    <div class="flex items-center mb-1">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Ordenes de
                            trabajo
                        </h5>
                    </div>
                </div>
            </div>
            <!-- Line Chart -->
            <div class="py-6" id="column-chart"></div>
            <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                    <a
                        href="#"
                        class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                        Traffic analysis
                        <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 9 4-4-4-4"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-14">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Client
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    User
                </th>
                <th scope="col" class="px-6 py-3">
                    Total
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($workOrders as $workOrder)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $workOrder->client }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $workOrder->category->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $workOrder->user->name }}
                    </td>
                    <td class="px-6 py-4">
                        ${{ $workOrder->total }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $workOrder->created_at->format('d/m/Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center">
                        No work orders found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-end">
        {{ $workOrders->links() }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Alpine.data('pieChart', (data) => ({
                series: data.series,
                init() {
                    Livewire.on('monthUpdated', () => {
                        this.showChart();
                    });
                    this.showChart();
                },
                getChartOptions() {
                    return {
                        series: this.series,
                        colors: ["#1C64F2", "#16BDCA", "#9061F9"],
                        chart: {
                            id: "pie-chart",
                            height: 420,
                            width: "100%",
                            type: "pie",
                        },
                        stroke: {
                            colors: ["white"],
                            lineCap: "",
                        },
                        plotOptions: {
                            pie: {
                                labels: {
                                    show: true,
                                },
                                size: "100%",
                                dataLabels: {
                                    offset: -25
                                }
                            },
                        },
                        labels: ["Miguel", "Angel", "Sofia"],
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                            },
                        },
                        legend: {
                            position: "bottom",
                            fontFamily: "Inter, sans-serif",
                        },
                        yaxis: {
                            labels: {
                                formatter: function (value) {
                                    return value + "%"
                                },
                            },
                        },
                        xaxis: {
                            labels: {
                                formatter: function (value) {
                                    return value + "%"
                                },
                            },
                            axisTicks: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                        },
                    }
                },

                showChart() {

                    if(document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                        const chart = new ApexCharts(document.getElementById("pie-chart"), this.getChartOptions());
                        chart.updateSeries(this.series);
                        chart.render();
                    }

                    /*if(typeof ApexCharts === 'object') {
                        // ApexCharts.exec('pie-chart', 'updateSeries', [this.series, true]);
                        /!*const myChart = ApexCharts.getChartByID("pie-chart");
                        myChart.destroy();
                        const newChart = new ApexCharts(document.getElementById("pie-chart"), this.getChartOptions());
                        newChart.render();*!/
                    } else {
                        const chart = new ApexCharts(document.getElementById("pie-chart"), this.getChartOptions());
                        chart.render();
                    }*/
                },
            }))

            Alpine.data('columnChart', (data) => ({
                series: data.series,
                categories: data.categories,
                init() {
                    this.showChart();
                },
                getChartOptions() {
                    return  {
                        series: this.series,
                        chart: {
                            type: 'bar',
                            height: 350,
                            stacked: true,
                        },
                        stroke: {
                            width: 1,
                            colors: ['#fff']
                        },
                        dataLabels: {
                            formatter: (val) => {
                                return val / 1000 + 'K'
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false
                            }
                        },
                        xaxis: {
                            categories: this.categories,
                        },
                        fill: {
                            opacity: 1
                        },
                        colors: ['#80c7fd', '#008FFB', '#80f1cb', '#00E396'],
                        yaxis: {
                            labels: {
                                formatter: (val) => {
                                    return val / 1000 + 'K'
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'left'
                        }
                    };
                },
                showChart() {
                    if(document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
                        const chart = new ApexCharts(document.getElementById("column-chart"), this.getChartOptions());
                        chart.updateSeries([this.series, this.categories]);
                        chart.render();
                    }
                },
            }))
        });
    </script>
</div>
