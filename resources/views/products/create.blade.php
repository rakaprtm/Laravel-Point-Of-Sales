@extends('layouts.main') @section('title', 'Data Products')
@section('content')
<section>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 align="center" class="card-title">New Product</h5>
                    <form
                        action="{{ route('products.store') }}"
                        method="post"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        <div align="left" class="mt2">
                            <a
                                href="{{ url()->previous() }}"
                                class="btn btn-warning"
                                >Back</a
                            >
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label"
                                >Product Name</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                name="product_name"
                                placeholder="Enter Product"
                                required
                            />
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label"
                                >Category Name</label
                            >
                            <select
                                name="category_id"
                                id=""
                                class="form-control"
                            >
                                <option value="">Select One</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="col-form-label"
                                >Product Price</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                name="product_price"
                                id="product_price"
                                placeholder="Rp. 0"
                                required
                            />

                        </div>

                        <div class="mb-3">
                            <label for="" class="col-form-label"
                                >Product Description</label
                            >
                            <textarea
                                name="product_description"
                                class="form-control"
                                placeholder="Enter Product Description"
                                required
                            ></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="" class="col-form-label"
                                >Product Photo</label
                            >
                            <input
                                type="file"
                                class="form-control"
                                name="product_photo"
                            />
                        </div>

                        <div class="mb-3">
                            <label for="" class="col-form-label">Status</label>
                            <br />
                            publish
                            <input type="radio" name="is_active" value="1" checked/>
                            Draft
                            <input type="radio" name="is_active" value="0" />
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">
                                Save
                            </button>
                            <button class="btn btn-danger" type="reset">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<script>
    const priceInput = document.getElementById('product_price');

    priceInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        e.target.value = 'Rp. ' + rupiah;
    });
</script>

