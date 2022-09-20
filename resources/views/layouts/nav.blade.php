<nav class="navbar p-2 px-3 navbar-expand-lg fixed-top shadow">
    <div class="container-fluid">
        <p class="navbar-brand joan-bold text-purp fs-2 py-0 mb-0">Je.Bo</p>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="bi bi-list"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    @auth
                        <form action="/home/{{ auth()->user()->id }}" method="POST">
                            @method('put')
                            @csrf
                            <button
                                class="nav-link border-0 bg-transparent {{ $title === 'Home' ? 'active border-bottom' : '' }}">Home</button>
                        </form>
                    @else
                        <a class="nav-link {{ $title === 'Home' ? 'active border-bottom' : '' }} disabled">Home</a>
                    @endauth
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Login As
                    </a>
                    <ul class="dropdown-menu" id="login_as">
                      <li><a class="dropdown-item" href="#">Admin</a></li>
                      <li><a class="dropdown-item" href="#">Super Admin</a></li>
                      <li><a class="dropdown-item" href="#">Supervisor</a></li>
                      {{-- <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                    </ul>
                  </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Hi, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/dashboard/admin">Transaction</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ $title === 'Login' ? 'active' : '' }}" href="/login">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
