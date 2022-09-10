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

                            <div class="form-floating">
                                <input name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" id="password"
                                    placeholder="Password">
                                <label for="floatingPassword">Password</label>

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
                            <p class="mt-5 mb-3 text-muted">&copy; Je.Bo-2022</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
