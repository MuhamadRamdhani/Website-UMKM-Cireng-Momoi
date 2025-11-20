<x-app-layout>
    <x-slot name="header">
       <div class="flex justify-between items-center">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Penjualan') }}
        </h2>
        <form method="GET" action="{{ route('laporan.index') }}" class="mb-6 flex items-center gap-4">
            <div>
                <label for="month" class="block text-sm font-medium text-gray-700">Pilih Bulan</label>
                <input type="month" name="month" id="month" value="{{ request('month') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <div class="pt-6">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Filter</button>
            </div>
            <div class="pt-6">
                <a href="{{ route('laporan.cetak', ['month' => request('month')]) }}" target="_blank" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Cetak PDF
                </a>
            </div>
        </form>

       </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistik Penjualan -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-500">Total Penjualan</h3>
                    <p class="mt-2 text-3xl font-semibold text-indigo-600">{{ $totalSales }}</p>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-500">Total Pendapatan</h3>
                    <p class="mt-2 text-3xl font-semibold text-green-600">Rp {{number_format($revenue,2)}}</p>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-500">Pesanan Pending</h3>
                    <p class="mt-2 text-3xl font-semibold text-yellow-600">{{ $pendingOrders }}</p>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-500">Total Pelanggan</h3>
                    <p class="mt-2 text-3xl font-semibold text-blue-600">{{ $customers }}</p>
                </div>
            </div>

            <!-- Grafik Penjualan -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h3 class="text-lg font-medium mb-4">Grafik Penjualan 30 Hari Terakhir</h3>
                <canvas id="salesChart" height="300"></canvas>
            </div>
        </div>
    </div>

{{-- Javascript untuk nampilin tabel --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('salesChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartData['labels']),
            datasets: [
                {
                    label: 'Jumlah Transaksi',
                    data: @json($chartData['sales']),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false,
                    yAxisID: 'y'
                },
                {
                    label: 'Total Pendapatan (IDR)',
                    data: @json($chartData['revenue']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false,
                    yAxisID: 'y1'
                },
                {
                    label: 'Pesanan Pending',
                    data: @json($chartData['pending']),
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false,
                    yAxisID: 'y'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Jumlah Transaksi & Pending' }
                },
                y1: {
                    beginAtZero: true,
                    position: 'right',
                    title: { display: true, text: 'Pendapatan (IDR)' },
                    grid: { drawOnChartArea: false }
                }
            }
        }
    });
});
</script>

</x-app-layout>