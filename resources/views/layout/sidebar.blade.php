<aside class="main-sidebar sidebar-dark-indigo elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        @php
            $words = explode(' ', $setting->nama_prusahaan);
            $word = '';
            foreach ($words as $w) {
                $word .= $w[0];
            }
        @endphp
        <span class="logo-mini">{{ $word }}</span>
        {{-- <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">{{ $setting->nama_prusahaan }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url(auth()->user()->foto ?? '') }}" class="img-circle img-profil elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-dailymotion"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (auth()->user()->level == 1)
                    <li class="nav-header">MASTER</li>
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-bars"></i>
                            <p>
                                Kategori
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('produk.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-cubes"></i>
                            <p>
                                Produk
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('member.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>
                                Member
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('supplier.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-person-booth"></i>
                            <p>
                                Supplier
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">TRANSAKSI</li>
                    <li class="nav-item">
                        <a href="{{ route('pengeluaran.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-dolly"></i>
                            <p>
                                Pengeluaran
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pembelian.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-cart-plus"></i>
                            <p>
                                Pembelian
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penjualan.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-cart-arrow-down"></i>
                            <p>
                                Penjualan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaksi.baru') }}" class="nav-link">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>
                                Transaksi Baru
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaksi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-bookmark"></i>
                            <p>
                                Transaksi Lama
                            </p>
                        </a>
                    <li class="nav-item">
                    </li>

                    <li class="nav-header">REPORT</li>
                    <li class="nav-item">
                        <a href="{{ route('laporan.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                    <li class="nav-header">SYSTEM</li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="fas fa-person-booth nav-icon"></i>
                            <p>User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('setting.index') }}" class="nav-link">
                            <i class="fas fa-wrench nav-icon"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.profil') }}" class="nav-link">
                            <i class="fas fa-person-booth nav-icon"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                    <li class="nav-header">LOGOUT</li>
                    <li class="nav-item">
                        <a href="#" onclick="document.getElementById('logout-form').submit()" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Logout</p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('transaksi.baru') }}" class="nav-link">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>
                                Transaksi Baru
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaksi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-bookmark"></i>
                            <p>
                                Transaksi Lama
                            </p>
                        </a>
                    <li class="nav-item">
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.profil') }}" class="nav-link">
                            <i class="fas fa-person-booth nav-icon"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
    @csrf
</form>
