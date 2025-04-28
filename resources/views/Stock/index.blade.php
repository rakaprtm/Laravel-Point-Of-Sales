@extends('layouts.main') @section('title', 'Data Products') @section('content')
<div class="container mt-4">
    <section class="section">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            @isset($title) {{ $title }} @endisset
                        </h5>

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session("success") }}
                        </div>
                        @endif

                        <div class="mt-4 mb-3">
                            <table
                                class="table table-bordered table-striped table-hover"
                            >
                                <thead align="center" class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Photo</th>
                                        <th>Qty</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    @php $no=1; @endphp @foreach ($products as
                                    $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <img
                                                src="{{ asset('storage/'. $data->product_photo) }}"
                                                alt=""
                                                width="50"
                                            />
                                        </td>

                                        <td>{{ $data->product_qty }}</td>
                                        <td>{{ $data->product_name }}</td>
                                        <td>
                                            Rp.
                                            {{ number_format($data->product_price, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            {{ $data->is_active ? 'publish' : 'Draft' }}
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
