@extends('layouts.main') @section('title', 'Order Detail')
@section('content')
<section>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-header">
                <h3>{{ $title ?? ''}}</h3>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-primmary">Back</a>
                <a href="#" class="btn btn-success">
                    <i class="bi bi-printer"></i>
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 align="center" class="card-title">Select Order</h5>
                        @csrf
                        <div align="left" class="mt2">
                            <a
                                href="{{ url()->previous() }}"
                                class="btn btn-secondary btn-sm">Back
                            </a>
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">Category Name</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Select One</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="col-form-label">Product Name *</label>
                            <select name="" id="product_id" class="form-control">
                                <option value="">Select One</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div align="right" class="mb-3">
                            <button class="btn btn-warning add-row" type="button">
                                Add
                            </button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div align="center" class="card-body">
                        <h5 class="card-title">Order Basket</h5>
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-info" align="center">
                                <tr>
                                    <th>Photo</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                    <th class="bg-warning"></th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <tfoot>
                                        <tr align="center">
                                        <td colspan="2">Total</td>
                                        <td colspan="3" class="text-end pe-4">
                                            <span class="grandtotal"></span>
                                            <input type="hidden" class="form-control" name="grandtotal" readonly>
                                        </td>
                                        <td></td>
                                        </tr>
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-success">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</section>
@endsection
