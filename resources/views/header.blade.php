<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            {{-- <a href="/krs" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <img src="{{ asset('img/Logo_Unand.svg') }}" height=32 alt="logo unand">
        </a> --}}

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <img src="logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                @if (Auth::user()->role == 'admin')
                <li><a href="/barang" class="nav-link px-2 link-body-emphasis">Daftar Barang</a></li>
                <li><a href="/transactions" class="nav-link px-2 link-body-emphasis">Transaksi</a></li>
                @elseif (Auth::user()->role == 'customer')
                <li><a href="/katalog" class="nav-link px-2 link-body-emphasis">Daftar Barang</a></li>
                <li><a href="/order" class="nav-link px-2 link-body-emphasis">Orderan</a></li>
                @endif

            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            </form>

            <div class="dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                        class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item" href="/password">Change Password</a></li>
                    <li><a class="dropdown-item" href="/profile">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); this.closest('form').submit();">Sign Out</a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
