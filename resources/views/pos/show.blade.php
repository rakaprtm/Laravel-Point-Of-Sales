@extends('layouts.main') @section('title', 'POINT OF SALE')
@section('content')
    <section>

        <div class="row d-flex justify-content-center">
            <div class="col-lg-10">
                <div class="card-header d-flex justify-content-between align-items-center bg-secondary">
                    <h3  class="text-white card-title mb-0">{{ $title ?? '' }}</h3>
                    <div>
                       <a href="{{ url()->previous() }}" class="btn btn-danger me-2"><i class="bi bi-back me-1"></i>Back</a>

                        <a href="{{ route('print', $order->id) }}" class="btn btn-warning"><i class="bi bi-printer me-1"></i>Print</a>
                    </div>
                </div>
                <div class="col-lg-12  mx-auto">
                    <div class="card mt-3">
                        <div class="card-body bg-dark">
                            <h5 class="card-title text-white">ORDER</h5>
                            <table align="center"  class="table table-bordered table-striped table-hover">
                                <tr align="center">
                                    <th>ORDER CODE</th>
                                    <td>{{ $order->order_code ?? '' }}</td>
                                </tr>
                                <tr align="center">
                                    <th>ORDER DATE</th>
                                    <td>{{ $order->order_date ?? '' }}</td>
                                </tr>
                                <tr align="center">
                                    <th>ORDER STATUS</th>
                                    <td>{{ $order->order_status ?? '' }}</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" align="center">ORDER BASKET</h5>
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark" align="center">
                                <tr>
                                    <th>No</th>
                                    <th class="bg-secondary">Photo</th>
                                    <th>Product</th>
                                    <th class="bg-secondary">Qty</th>
                                    <th>Price</th>
                                    <th class="bg-secondary">Sub Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach ($orderDetails as $key => $orderDetails)
                                    <tr>
                                        <td>{{ $key += 1 }}</td>
                                        <td><img src="{{ asset('storage/' . $orderDetails->product->product_photo) }}" alt=""
                                                width="100"></td>
                                        <td>{{ $orderDetails->product->product_name }}</td>
                                        <td>{{ $orderDetails->qty }}</td>
                                        <td>{{ 'Rp ' . number_format($orderDetails->order_price, 0, ',', '.') }}</td>
                                        <td>{{ 'Rp ' . number_format($orderDetails->order_subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody align="center">
                            <tfoot>
                                <tr align="center">
                                    <td  class="bg-success text-white" colspan="2">Total</td>
                                    <td colspan="3" class="text-end pe-4">
                                        <span class="grandtotal"></span>
                                        <input type="hidden" class="form-control" name="grandtotal" readonly>
                                    </td>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
