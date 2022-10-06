{{-- @dd(
    $transactions->where('order_id', $transaction->order_id)->sum('total')
) --}}

@extends('layouts.dashboard.application')

@section('application')
    <div class="border-bottom">
        <div class="container-fluid mb-3">

            <form action="/dashboard/transaction/{{$transaction->id}}" method="POST">
                @method('put')
                @csrf

                <div class="row row-cols-1 row-cols-lg-2 g-2">
                    <div class="col">
                        <div class="p-3">
                            <label for="order_id" class="form-label">Order_Id</label>
                            <input type="text" class="form-control" id="order_id" name="order_id"
                                value="{{$transaction->order_id}}" readonly>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <label for="order_by" class="form-label">Order By</label>
                            <input name="order_by" type="text"
                                class="form-control" id="order_by"
                                value="{{ $transaction->order_by }}" readonly>
                        </div>
                    </div>
                </div>

                <input type="hidden" value="" id="order_item">

                <div class="row row-cols-1 row-cols-lg-2 g-2">
                    <div class="col" style="display:none">
                        <div class="p-3">
                            <input name="product_id" type="number" class="form-control" id="hidden" value="{{$transaction->product_id}}" readonly>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <label for="product" class="form-label">Product</label>
                            <div class="position-relative">
                                <input type="text" class="form-control product-edit @error('product_id') is-invalid @enderror"
                                    id="product" data-price="{{$transaction->product->price}}" value="{{$transaction->product->product." - ".$transaction->product->price}}" placeholder="{{$transaction->product->product." - ".$transaction->product->price}}">
                                <div class="product position-absolute bg-purp">
                                    {{-- harus di edit --}}
                                    @foreach ($products as $product)
                                        <p data-price="{{ $product->price }}" data-index="{{ $product->id }}"
                                            class="m-1 p-2 text-light product-list">{{ $product->product . ' - ' . $product->price }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <label for="Qty" class="form-label">Qty</label>
                            <input name="qty" type="number" class="form-control qty-edit" id="Qty" value="{{$transaction->qty}}" placeholder="{{$transaction->qty}}">
                        </div>
                    </div>
                </div>

                <div class="row row-cols-2 row-cols-lg-6 g-2 ">
                    <div class="col">
                        <div class="p-3">
                            <p class="m-0 form-control border-0"><strong>Total</strong></p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <input name="total" type="hidden" class="form-control border-0 name-total-edit" id="name-total"
                                value="{{$transaction->total}}" readonly>

                            <input name="total-trx" type="number" class="form-control border-0 total-edit" id="total" value="0" readonly>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <p class="m-0 form-control border-0 for-pay"><strong>Payment</strong></p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <input name="payment-trx" type="number" class="form-control for-pay" id="payment" value="0">
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <p class="m-0 form-control border-0 for-pay"><strong>Change</strong></p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <input type="number" class="form-control border-0 for-pay" value="0" id="change"
                                readonly>
                        </div>
                    </div>
                </div>

                <div class="p-3 order">
                    <button id="order-btn" type="submit" class="btn bg-purp text-light disabled bg-secondary">Update Order</button>
                    <a class="btn bg-purp text-light for-pay pay-edit" id="pay">Pay</a>
                    <a class="btn bg-purp text-light cancel-edit" id="cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
