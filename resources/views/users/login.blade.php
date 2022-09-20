@extends('layouts.application')

@section('application')
    <div class="container mt-5 pt-5">
        {{-- <p class="m-0 h3">Login</p>
        <hr> --}}

        @if (session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('forbidden'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ session('forbidden') }}</strong> Please, login again!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }} <strong>Please Login!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row row-cols-1 row-cols-lg-2 g-2 justify-content-center">
            <div class="col">
                <div class="p-3 rounded border shadow">
                    <div class="form-signin p-3">
                        <form action="/login" method="POST">
                            @csrf
                            <p class="h1 joan-bold text-center text-purp">Je.Bo</p>
                            <p class="h5 text-center fw-normal my-3">Please sign in</p>

                            <div class="form-floating">
                                <input name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="name@gmail.com" value="{{ old('email') }}">
                                <label for="floatingInput">Email address</label>

                                @error('email')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3 position-relative">
                                <input name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="Password">
                                <label for="floatingPassword">Password</label>

                                <button type="button" class="btn icon icon-eye text-purp-smooth border-0 position-absolute"><i data-feather="eye"></i></button>
                                <button type="button" class="btn icon icon-eye-off text-purp-smooth border-0 position-absolute hidden"><i data-feather="eye-off"></i></button>

                                @error('password')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="checkbox mb-3" hidden>
                                <label>
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                            </div>
                            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                            <p class="text-center"><small>don't have an account? <a href="/register"
                                        class="text-decoration-none">Register</a></small></p>
                            <p class="mt-5 mb-3 text-muted">&copy; Je.Bo-2022</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
