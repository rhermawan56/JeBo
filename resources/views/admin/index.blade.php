@extends('layouts.dashboard.application')

@section('application')
    <div class="border-bottom">
        <div class="container-fluid mb-3">
            <form action="/dashboard/admin" method="POST">
                @csrf
                <div class="row row-cols-1 row-cols-lg-3 g-2">
                    <div class="col" style="display:none">
                        <div class="p-3 border">
                            <input name="id" type="number" class="form-control" id="hidden" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <label for="Default" class="form-label">Product</label>
                            <div class="position-relative">
                                <input name="product" type="text" class="form-control" id="product">
                                <div class="product position-absolute bg-purp">
                                    @foreach ($products as $product)
                                        <p data-index="{{ $product->id }}" class="m-1 p-2 text-light product-list">
                                            {{ $product->product . ' - ' . $product->price }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <label for="Qty" class="form-label">Qty</label>
                            <input name="qty" type="number" class="form-control" id="Qty">
                        </div>
                    </div>

                    <div class="col">
                        <div class="btn-order p-3">
                            <center>
                                <br>
                                <button type="submit" class="btn bg-purp text-light">Order Now</button>
                            </center>
                        </div>
                    </div>
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
                        <th scope="col" class="text-center">Product</th>
                        <th scope="col" class="text-center">Qty</th>
                        <th scope="col" class="text-center">Price Total</th>
                        <th scope="col" class="text-center">Status</th>
                    </center>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <center>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->product->product }}</td>
                            <td class="text-center">{{ $transaction->qty }}</td>
                            <td class="text-center">{{ $transaction->qty * $transaction->product->price }}</td>
                            <td class="text-center">text</td>
                        </center>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
