@extends('admin.layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang, {{ Auth::user()->name }}! 👋</h5>
                            <p class="mb-4">Berikut adalah ringkasan kondisi keuanganmu. Mari lihat pencapaianmu bulan ini.</p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop.png') }}" height="140" alt="Man with laptop" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    <div class="row">
        <div class="col-lg-4 col-md-12 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="Total Saldo" class="rounded" />
                        </div>
                    </div>
                    <span>Total Saldo</span>
                    <h4 class="card-title mb-1">Rp {{ number_format($totalBalance, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="Pemasukan" class="rounded" />
                        </div>
                    </div>
                    <span>Pemasukan Bulan Ini</span>
                    <h4 class="card-title text-success mb-1">+ Rp {{ number_format($totalIncome, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('assets/img/icons/unicons/cc-warning.png') }}" alt="Pengeluaran" class="rounded" />
                        </div>
                    </div>
                    <span>Pengeluaran Bulan Ini</span>
                    <h4 class="card-title text-danger mb-1">- Rp {{ number_format($totalExpense, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0 me-2">Ringkasan Bulan Ini</h5>
                    <small class="text-muted">{{ \Carbon\Carbon::now()->format('F Y') }}</small>
                </div>
                <div class="card-body">
                    <div id="incomeVsExpenseChart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Alokasi Pengeluaran</h5>
                </div>
                <div class="card-body">
                    @if(array_sum($expenseChartData['series']) > 0)
                        <div id="expenseAllocationChart"></div>
                    @else
                        <div class="text-center p-5">
                            <p>Belum ada data pengeluaran bulan ini untuk ditampilkan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
    
    <div class="row">
         <div class="col-12">
            <div class="card">
                <div class="card-header nav-align-top">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#tab-incomes" aria-controls="tab-incomes" aria-selected="true">
                                Pemasukan Terbaru
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab-expenses" aria-controls="tab-expenses" aria-selected="false">
                                Pengeluaran Terbaru
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="tab-incomes" role="tabpanel">
                            <ul class="p-0 m-0">
                                @forelse ($recentIncomes as $income)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3"><span class="avatar-initial rounded bg-label-success"><i class="bx bx-log-in"></i></span></div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $income->category->name }}</h6>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($income->date)->format('d M Y') }}</small>
                                        </div>
                                        <div class="user-progress"><h6 class="mb-0 text-success">+{{ number_format($income->amount, 0, ',', '.') }}</h6></div>
                                    </div>
                                </li>
                                @empty
                                <li class="text-center">Tidak ada pemasukan terbaru.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="tab-expenses" role="tabpanel">
                             <ul class="p-0 m-0">
                                @forelse ($recentExpenses as $expense)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3"><span class="avatar-initial rounded bg-label-danger"><i class="bx bx-log-out"></i></span></div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $expense->category->name }}</h6>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</small>
                                        </div>
                                        <div class="user-progress"><h6 class="mb-0 text-danger">-{{ number_format($expense->amount, 0, ',', '.') }}</h6></div>
                                    </div>
                                </li>
                                @empty
                                <li class="text-center">Tidak ada pengeluaran terbaru.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
@endsection

@push('scripts')
{{-- Library ApexCharts --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Opsi umum untuk format Rupiah
    const currencyFormatter = function(val) {
        return "Rp " + new Intl.NumberFormat('id-ID').format(val);
    }
    
    // 1. Grafik Pemasukan vs Pengeluaran (Bar Chart)
    var incomeVsExpenseOptions = {
        series: [{
            name: 'Jumlah',
            data: [{{ $totalIncome }}, {{ $totalExpense }}]
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: false }
        },
        plotOptions: {
            bar: {
                distributed: true,
                borderRadius: 4,
                horizontal: false,
                columnWidth: '40%',
            }
        },
        colors: ['#28a745', '#dc3545'],
        dataLabels: {
            enabled: true,
            formatter: currencyFormatter,
            style: {
                fontSize: '12px',
                colors: ["#fff"]
            }
        },
        xaxis: {
            categories: ['Pemasukan', 'Pengeluaran'],
        },
        yaxis: {
            labels: {
                formatter: currencyFormatter
            }
        },
        legend: { show: false },
        tooltip: {
            y: { formatter: currencyFormatter }
        }
    };
    var incomeVsExpenseChart = new ApexCharts(document.querySelector("#incomeVsExpenseChart"), incomeVsExpenseOptions);
    incomeVsExpenseChart.render();


    // 2. Grafik Alokasi Pengeluaran (Doughnut Chart)
    // Hanya render jika ada data
    if (@json(array_sum($expenseChartData['series'])) > 0) {
        var expenseAllocationOptions = {
            series: @json($expenseChartData['series']),
            chart: {
                type: 'donut',
                height: 380,
            },
            labels: @json($expenseChartData['labels']),
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                formatter: function (w) {
                                    const total = w.globals.seriesTotals.reduce((a, b) => { return a + b }, 0);
                                    return currencyFormatter(total);
                                }
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.config.labels[opts.seriesIndex] + ": " + val.toFixed(1) + '%'
                },
            },
            legend: {
                position: 'bottom'
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return currencyFormatter(val);
                    }
                }
            }
        };
        var expenseAllocationChart = new ApexCharts(document.querySelector("#expenseAllocationChart"), expenseAllocationOptions);
        expenseAllocationChart.render();
    }
});
</script>
@endpush