@extends('layouts.dashboard.application')

@section('application')
    <div class="border-bottom">
        <div class="container-fluid mb-3">
            <form action="/dashboard/transaction/{{ $transaction->id }}" method="POST">
                @method('put')
                @csrf
                <div class="row row-cols-1 row-cols-lg-3 g-2">
                    <div class="col" style="display:none">
                        <div class="p-3">
                            <input name="product_id" type="number" class="form-control" id="hidden"
                                value="{{ $transaction->product->id }}" readonly>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <label for="order_by" class="form-label">Order By</label>
                            <input name="order_by" type="text"
                                class="form-control @error('order_by') is-invalid @enderror" id="order_by"
                                value="{{ old('order_by', $transaction->order_by) }}">
                            @error('order_by')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <label for="Default" class="form-label">Product</label>
                            <div class="position-relative">
                                <input type="text" class="form-control @error('product_id') is-invalid @enderror"
                                    id="product"
                                    value="{{ $transaction->product->product . ' - ' . $transaction->product->price }}">
                                <div class="product position-absolute bg-purp">
                                    {{-- harus di edit --}}
                                    @foreach ($products as $product)
                                        <p data-index="{{ $product->id }}" class="m-1 p-2 text-light product-list">
                                            {{ $product->product . ' - ' . $product->price }}</p>
                                    @endforeach
                                </div>
                                @error('product_id')
                                    <div class="invalid-feedback d-block">
                                        product is required
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <label for="Qty" class="form-label">Qty</label>
                            <input name="qty" type="number" class="form-control @error('qty') is-invalid @enderror"
                                id="Qty" value="{{ $transaction->qty }}">
                            @error('qty')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="p-3 order">
                    <a class="btn bg-purp text-light" href="/dashboard/transaction"><span
                            data-feather="arrow-left-circle"></span> Back</a>
                    <button type="submit" class="btn bg-purp text-light">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
