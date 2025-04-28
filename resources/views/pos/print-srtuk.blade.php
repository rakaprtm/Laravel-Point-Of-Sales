<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Struk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 17px;
            width: 300px;
            margin: auto;
        }
        .table-borderless td {
            padding: 0.2rem;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="text-center mb-2">
        <div align="center" class="sb">
            <!-- <img src="{{ asset('img/resto.png') }}" alt="Profile" class="rounded-circle" /> -->
            <img src="{{ asset('img/resto.png') }}" alt="logo" style="width: 120px; height: auto;">
        </div>
        <h6 class="fw-bold mb-3 fs-1"><i>STARBOY</i></h6>
        <small class="fw-bold">JL. DR.TAUBAT N0. 420, BARCELONA</small><br>
        <small class="fw-bold">NO. TELP: 0895347570504</small><br>
        <small class="fw-bold">{{ now()->format('YmdHis') }}</small>
    </div>

    <hr class="my-2 fw-bold">

    <table class="table table-borderless fw-bold">
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

    <table class="table table-sm fw-bold">
        <tbody>
            @foreach ($orderDetails as $key => $item)
            <tr>
                <td colspan="2">{{ $key + 1 }}. {{ $item->product->product_name }}</td>
                <td class="text-end">Rp {{ number_format($item->order_price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-end">x{{ $item->qty }}</td>
                <td class="text-end">Rp {{ number_format($item->order_subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr class="my-2">

    <table class="table table-borderless fw-bold">
        <tr>
            <td><strong>Qty</strong></td>
            <td class="text-end">{{ $orderDetails->sum('qty') }}</td>
        </tr>
        <tr>
            <td><strong>Total</strong></td>
            <td class="text-end">Rp {{ number_format($order->order_amount, 0, ',', '.') }}</td>
        </tr>
        <!-- <tr>
            <td>Bayar</td>
            <td class="text-end">Rp {{ number_format($order->order_amount, 0, ',', '.') }}</td>
        </tr> -->
    </table>

    <div class="text-center">
        <p class="mt-4">TERIMA KASIH ANDA TELAH MENJADI STARBOY</p>
    </div>

</body>
</html>
