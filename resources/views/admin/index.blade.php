@extends('layouts.dashboard.application')

@section('application')
    <div class="border-bottom">
        <div class="container-fluid mb-3">
            <form action="">
                <div class="row row-cols-1 row-cols-lg-2 g-2">
                    <div class="col" hidden>
                        <div class="p-3 border">
                            <input type="number" class="form-control" id="hidden" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 border">
                            <label for="Default" class="form-label">Product</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" id="product">
                                <div class="product position-absolute bg-primary">
                                    <p data-index="1" class="m-1 p-2 text-light product-list">html</p>
                                    <p data-index="2" class="m-1 p-2 text-light product-list">css</p>
                                    <p data-index="3" class="m-1 p-2 text-light product-list">javascript</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 border">
                            <label for="product" class="form-label">Email address</label>
                            <input type="number" class="form-control" id="hidden">
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
                    <th scope="col">#</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1,001</td>
                    <td>random</td>
                    <td>data</td>
                    <td>placeholder</td>
                    <td>text</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
