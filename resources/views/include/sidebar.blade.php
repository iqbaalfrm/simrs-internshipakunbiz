<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('dashboard.index') }}">
                        <span style="font-size:1.3rem;font-weight:bold;">SIMRS - RSHS</span>
                    </a>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block">
                        <i class="bi bi-x bi-middle"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                {{-- Dashboard --}}
                <li class="sidebar-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i><span>Dashboard</span>
                    </a>
                </li>

                   {{-- Data Pasien --}}
                <li class="sidebar-item {{ request()->routeIs('pasien.*') ? 'active' : '' }}">
                    <a href="{{ route('pasien.index') }}" class="sidebar-link">
                        <i class="bi bi-people-fill"></i><span>Data Pasien</span>
                    </a>
                </li>

                {{-- Rekam Medis --}}
                <li class="sidebar-item {{ request()->routeIs('rekam.*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-file-medical-fill"></i><span>Rekam Medis</span>
                    </a>
                </li>

                {{-- Jadwal Dokter & Poli --}}
                <li class="sidebar-item {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-clock-fill"></i><span>Jadwal Dokter & Poli</span>
                    </a>
                </li>

                 {{-- Daftar Antrian --}}
                <li class="sidebar-item {{ request()->routeIs('antrian.*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-list-ol"></i><span>Daftar Antrian</span>
                    </a>
                </li>

                {{-- Apotek / Stok Obat --}}
                <li class="sidebar-item {{ request()->routeIs('apotek.*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-capsule-pill"></i><span>Apotek / Stok Obat</span>
                    </a>
                </li>

                {{-- Pembayaran / Kasir --}}
                <li class="sidebar-item {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-cash-coin"></i><span>Pembayaran</span>
                    </a>
                </li>

                {{-- Laporan --}}
                <li class="sidebar-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-clipboard-data-fill"></i><span>Laporan</span>
                    </a>
                </li>

                {{-- Data Pegawai --}}
                <li class="sidebar-item {{ request()->routeIs('pegawai.*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-person-badge-fill"></i><span>Data Pegawai</span>
                    </a>
                </li>

                {{-- (Opsional) Data Dokter khusus --}}
                <li class="sidebar-item {{ request()->routeIs('dokter.*') ? 'active' : '' }}">
                    <a href="{{ route('dokter.index') }}" class="sidebar-link">
                        <i class="bi bi-hospital-fill"></i><span>Data Dokter</span>
                    </a>
                </li>

                @auth
                <li class="sidebar-title mt-3">Akun</li>
                <li class="sidebar-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="sidebar-link btn w-100 text-start">
                            <i class="bi bi-box-arrow-right"></i><span>Logout</span>
                        </button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</div>
