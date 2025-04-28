<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 14px;
            padding: 20px;
        }
        @media print {
            #print-btn {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-center w-100">Daftar Orders</h4>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Order Code</th>
                <th>Order Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($datas as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->order_code }}</td>
                <td>{{ $data->order_date }}</td>
                <td align="right">Rp {{ number_format($data->order_amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
