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

        <div class="row row-cols-1 row-cols-lg-2 g-2 justify-content-center">
            <div class="col">
                <div class="p-3 rounded border shadow">
                    <div class="form-signin p-3">
                        <form action="/register" method="POST">
                            @csrf
                            <p class="h1 joan-bold text-center text-purp">Je.Bo</p>
                            <p class="h5 text-center fw-normal my-3">Register</p>

                            <div class="form-floating">
                                <input name="name" type="text"
                                    class="form-control rounded-top @error('name') is-invalid @enderror" id="name"
                                    placeholder="name@gmail.com" value="{{ old('name') }}">
                                <label>Your Name</label>

                                @error('name')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-floating">
                                <input name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="name@gmail.com" value="{{ old('email') }}">
                                <label>Email address</label>

                                @error('email')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-floating">
                                <input name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="password">
                                <label>Password</label>

                                @error('password')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input name="repassword" type="password"
                                    class="form-control rounded-bottom @error('repassword') is-invalid @enderror" id="repassword"
                                    placeholder="password">
                                <label>Rewrite Password</label>
                            </div>

                            <button class="w-100 btn btn-lg btn-primary rounded-1" type="submit">Sign in</button>
                            <p class="text-center"><small>You have an account? <a href="/login"
                                        class="text-decoration-none">Login</a></small></p>
                            <p class="mt-5 mb-3 text-muted">&copy; Je.Bo-2022</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
