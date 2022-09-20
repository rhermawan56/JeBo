<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/css/fonts.css">
    <link href="/css/dashboard.css" rel="stylesheet">


</head>

<body>
    <header class="navbar sticky-top flex-md-nowrap p-0 shadow">
        <p class="navbar-brand col-md-3 col-lg-2 me-0 mb-0 px-3 fs-4 text-center joan-bold text-purp">Je.Bo</p>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation" style="top: 0.65rem;">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if ($header != 'Transaction')
            <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search"
                aria-label="Search">
        @endif
        <div class="navbar-nav" data-target="{{ $header }}">
            <div class="nav-item text-nowrap">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="nav-link px-3 border-0 bg-transparent">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">

            @extends('layouts.dashboard.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">{{ $header }}</h1>
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        @if (auth()->user()->role === 'Admin')
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/home/{{ auth()->user()->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <button class="dropdown-item">Home Admin</button>
                                </form>
                            </li>
                            {{-- <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                        @endif
                    </ul>
                </div>

                @if (session()->has('created'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p class="m-0"><strong>Thanks</strong>, {{ session('created') }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('update'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p class="m-0"><strong>Thanks</strong>, {{ session('update') }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="m-0"><strong>Thanks</strong>, {{ session('delete') }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('forbidden'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="m-0"><strong>{{ session('forbidden') }}</strong></p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('application')

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
                                @if (date('d.m.y', strtotime(now())) === date('d.m.y', strtotime($transaction->updated_at)))
                                    <tr>
                                        <center>
                                            <td>{{ $transaction->id }}</td>
                                            <td>{{ $transaction->order_by }}</td>
                                            <td>{{ $transaction->product->product }}</td>
                                            <td class="text-center">{{ $transaction->qty }}</td>
                                            <td class="text-center">
                                                {{ $transaction->qty * $transaction->product->price }}
                                            </td>
                                            <td class="text-center">{{ $transaction->status }}</td>
                                            <td class="text-center border">
                                                <div class="d-flex justify-content-center">
                                                    <form action="/{{ $transaction->id }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-success badge p-1 mx-1"><span
                                                                data-feather="check-circle"></span> </button>
                                                    </form>

                                                    <div>
                                                        <a href="/dashboard/transaction/{{ $transaction->id }}/edit"
                                                            class="btn btn-warning badge p-1 mx-1"><span
                                                                data-feather="edit"></span> </a>
                                                    </div>

                                                    <form action="/dashboard/transaction/{{ $transaction->id }}"
                                                        method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger badge p-1 mx-1"><span
                                                                data-feather="check-circle"></span> </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </center>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="/js/jquery-3.6.1.min.js"></script>

    <script src="/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>

    <script>
        feather.replace()
    </script>

    <script src="/js/dashboard.js"></script>
</body>

</html>
