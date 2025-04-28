@extends('layouts.main')
@section('title', 'ORDERS')

@section('content')
<style>
    /* Mengatur tampilan print */
@media print {
    /* Menyembunyikan tombol print saat mencetak */
    #print-btn {
        display: none;
        .table th, .table td {
        border: 1px solid #000; /* Border hitam solid 1px */
        padding: 0.5rem;
        text-align: left;
    }
    .table thead th {
        background-color: #eee !important; /* Latar belakang header abu-abu muda */
        color: #000 !important;
    }
        
    }

    /* Mengatur layout laporan untuk mode print */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .container {
        width: 100%;
    }

    /* Kamu bisa menambahkan aturan khusus di sini */
}

</style>
<div class="container mt-4">
    <section class="section">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">@isset($title) {{ $title }} @endisset</h5>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="mt-4 mb-3">
                            <form method="GET" action="{{ route('pos.index') }}" class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <select name="filter" class="form-select">
                                        <option value="">-- Filter By --</option>
                                        <option value="daily" {{ request('filter') == 'daily' ? 'selected' : '' }}>Harian</option>
                                        <option value="weekly" {{ request('filter') == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                                        <option value="monthly" {{ request('filter') == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="date" value="{{ request('date') }}" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                                    <a href="{{ route('pos.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-success" id="print-btn">Print</button>
                                </div>
                            </form>

                            <table class="table table-bordered table-striped table-hover ">
                                <thead align="center" class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th class="bg-danger">Order code</th>
                                        <th>Order Date</th>
                                        <th class="bg-danger">Amount</th>
                                        <th>Status</th>
                                        <th class="bg-secondary"></th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    @php $no=1; @endphp
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->order_code}}</td>
                                        <td>{{ $data->order_date }}</td>
                                        <td align="left">{{ 'Rp ' . number_format($data->order_amount, 0, ',', '.') }}</td>
                                        <td>{{ $data->order_status ? 'Paid' : 'Unpaid' }}</td>
                                        <td>
                                            <a href="{{ route('pos.show', $data->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('print', $data->id) }}" class="btn btn-sm btn-success">
                                                <i class="bi bi-printer"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Fungsi untuk memfilter laporan berdasarkan tipe
    // document.getElementById('print-btn').addEventListener('click', function() {
    //     window.print(); // Menampilkan dialog print untuk mencetak halaman
    // });
</script>
@endsection
