{{-- @dd($transactions->where('order_id', $transactions->sortDesc()->first()->order_id)) --}}

@extends('layouts.dashboard.application')

@section('application')
    <div class="border-bottom">
        <div class="container-fluid mb-3">

            <form action="/dashboard/transaction" method="POST">
                @csrf

                <div class="row row-cols-1 row-cols-lg-2 g-2">
                    <div class="col">
                        <div class="p-3">
                            <label for="order_id" class="form-label">Order_Id</label>
                            @if ($ii != null)
                                <input type="text" class="form-control" id="order_id" name="order_id"
                                    value="{{ $transactions->sortDesc()->first()->order_id }}" class="disabled" readonly>
                            @else
                                <input type="text" class="form-control" id="order_id" name="order_id"
                                    value="{{ fake()->regexify('[A-Z]{5}[0-10]{3}') . $transactions->sortDesc()->first()->id + 1 }}"
                                    class="disabled" readonly>
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <label class="form-label">Order_Item</label>
                            <select class="form-select" aria-label="Default select example" id="select_order_item"
                                name="select_order_item">
                                @if ($ii == null)
                                    <option value="1">One Item</option>
                                    <option value="2">Two Item</option>
                                    <option value="4">Three Item</option>
                                @endif
                                @if ($ii == 2)
                                    <option selected value="1">Two Item</option>
                                @endif
                                @if ($ii == 3)
                                    <option selected value="1">Three Item</option>
                                @endif
                                @if ($ii == 4)
                                    <option selected value="3">Three Item</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <input type="hidden" value="" id="order_item">

                <div class="p-3">
                    <label for="order_by" class="form-label">Order By</label>
                    @if ($ii != null)
                        <input name="order_by" type="text"
                            class="form-control disabled @error('order_by') is-invalid @enderror" id="order_by"
                            value="{{ $transactions->sortDesc()->first()->order_by }}" readonly>
                    @else
                        <input name="order_by" type="text" class="form-control @error('order_by') is-invalid @enderror"
                            id="order_by" value="{{ old('order_by') }}">
                    @endif
                    @error('order_by')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row row-cols-1 row-cols-lg-2 g-2">
                    <div class="col" style="display:none">
                        <div class="p-3">
                            <input name="product_id" type="number" class="form-control" id="hidden" readonly>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <label for="Default" class="form-label">Product</label>
                            <div class="position-relative">
                                <input type="text" class="form-control @error('product_id') is-invalid @enderror"
                                    id="product">
                                <div class="product position-absolute bg-purp">
                                    {{-- harus di edit --}}
                                    @foreach ($products as $product)
                                        <p data-price="{{ $product->price }}" data-index="{{ $product->id }}"
                                            class="m-1 p-2 text-light product-list">{{ $product->product . ' - ' . $product->price }}</p>
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

                <div class="row row-cols-2 row-cols-lg-6 g-2 ">
                    <div class="col">
                        <div class="p-3">
                            <p class="m-0 form-control border-0"><strong>Total</strong></p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <input name="total" type="hidden" class="form-control border-0" id="name-total"
                                value="0" readonly>

                            @if ($ii > 1)
                                <input type="number" class="form-control border-0" id="total"
                                    value="{{ $transactions->where('order_id', $transactions->sortDesc()->first()->order_id)->sum('total') }}"
                                    readonly>
                            @else
                                <input type="number" class="form-control border-0" id="total" value="0" readonly>
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <p class="m-0 form-control border-0 for-pay"><strong>Payment</strong></p>
                            @error('payment_trx')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <input type="number" class="form-control for-pay" id="payment" value="0">
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <p class="m-0 form-control border-0 for-pay"><strong>Change</strong></p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-3">
                            <input type="number" class="form-control border-0 for-pay" value="0" id="change" readonly>
                        </div>
                    </div>
                </div>

                <div class="p-3 order">
                    <button type="submit" class="btn bg-purp text-light disabled bg-secondary">Order Now</button>
                    <a class="btn bg-purp text-light for-pay" id="pay">Pay</a>
                    @if ($ii != null)
                        <a class="btn bg-purp text-light" id="cancel">Cancel</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
