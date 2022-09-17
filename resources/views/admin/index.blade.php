@extends('layouts.dashboard.application')

@section('application')
    <div class="border-bottom">
        <div class="container-fluid mb-3">
            <form action="/dashboard/admin" method="POST">
                @csrf
                <div class="row row-cols-1 row-cols-lg-3 g-2">
                    <div class="col" style="display:none">
                        <div class="p-3">
                            <input name="product_id" type="number" class="form-control" id="hidden" readonly>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <label for="order_by" class="form-label">Order By</label>
                            <input name="order_by" type="text"
                                class="form-control @error('order_by') is-invalid @enderror" id="order_by"
                                value="{{ old('order_by') }}">
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
                                    id="product">
                                <div class="product position-absolute bg-purp">
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
                                id="Qty">
                            @error('qty')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="p-3 order">
                    <button type="submit" class="btn bg-purp text-light">Order Now</button>
                </div>

            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <center>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center">Order_by</th>
                        <th scope="col" class="text-center">Product</th>
                        <th scope="col" class="text-center">Qty</th>
                        <th scope="col" class="text-center">Price Total</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </center>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <center>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->order_by }}</td>
                            <td>{{ $transaction->product->product }}</td>
                            <td class="text-center">{{ $transaction->qty }}</td>
                            <td class="text-center">{{ $transaction->qty * $transaction->product->price }}</td>
                            <td class="text-center">{{ $transaction->status }}</td>
                            <td class="text-center d-flex border justify-content-center">
                                <form action="/dashboard/{{ $transaction->id }}" method="POST">
                                    @csrf
                                    <input type="text" class="hidden" name="status" value="done" readonly>
                                    <button class="btn btn-success badge mx-1" style="line-height: unset"><i
                                            data-feather="check-square"></i></button>
                                </form>
                                <a class="btn btn-primary badge mx-1" style="line-height: unset"
                                    href="/dashboard/admin/{{ $transaction->id }}/edit"><i
                                        data-feather="edit"></i></a>
                                <button class="btn btn-primary badge mx-1" style="line-height: unset">a</button>
                            </td>
                        </center>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
