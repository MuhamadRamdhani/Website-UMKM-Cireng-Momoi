<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Bulan {{ $month }}</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan - Bulan {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}</h2>
    <p>Total Pendapatan: <strong>Rp {{ number_format($totalRevenue, 2) }}</strong></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>Nama Customer</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($checkouts as $key => $checkout)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $checkout->order_id }}</td>
                    <td>{{ ucwords($checkout->user->name) }}</td>
                    <td>{{ $checkout->created_at->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($checkout->total_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
