@extends('layouts.main')
@section('title', 'Orders')

@section('content')
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
</form>

                            <table class="table table-bordered table-striped table-hover">
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
                                            <a href="{{ route('pos.edit', $data->id) }}" class="btn btn-sm btn-success">
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
@endsection
