<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Struk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 14px;
            width: 300px;
            margin: auto;
        }
        .logo {
            font-size: 30px;
        }
        .highlight-box {
            border: 1px solid #198754;
            background-color: #d1e7dd;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }
        .table-borderless td {
            padding: 0.2rem;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="text-center mb-2">
        <div class="logo"></div>
        <h6 class="fw-bold mb-0">TOKO WIDODO</h6>
        <small>Jl. Dr. Ir. H. Taubat No.420, Kota Tutup, Kajarta</small><br>
        <small>No. Telp: 0895347570504</small><br>
        <small>{{ now()->format('YmdHis') }}</small>
    </div>

    <hr class="my-2">

    <table class="table table-borderless">
        <tr>
            <td>Tanggal</td>
            <td class="text-end">{{ date('Y-m-d') }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td class="text-end">{{ auth()->user()->name ?? 'Admin' }}</td>
        </tr>
        <tr>
            <td>No. Struk</td>
            <td class="text-end">{{ $order->order_code }}</td>
        </tr>
    </table>

    <table class="table table-sm">
        <tbody>
            @foreach ($orderDetails as $key => $item)
            <tr>
                <td colspan="2">{{ $key + 1 }}. {{ $item->product->product_name }}</td>
                <td class="text-end">Rp {{ number_format($item->order_price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-muted">x{{ $item->qty }}</td>
                <td class="text-end text-muted">Rp {{ number_format($item->order_subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr class="my-2">

    <table class="table table-borderless">
        <tr>
            <td><strong>Total Qty</strong></td>
            <td class="text-end">{{ $orderDetails->sum('qty') }}</td>
        </tr>
        <tr>
            <td><strong>Total</strong></td>
            <td class="text-end">Rp {{ number_format($order->order_amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Bayar</td>
            <td class="text-end">Rp {{ number_format($order->order_amount, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="text-center">
        <p class="mb-1">Terima kasih Anda Kena Penipuan</p>
    </div>

</body>
</html>
