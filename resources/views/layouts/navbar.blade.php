<!-- Vertical Nav -->

@if (Auth::user()->role->name == 'admin')
    <nav class="hk-nav hk-nav-light">
        <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i
                    data-feather="x"></i></span></a>
        <div class="nicescroll-bar">
            <div class="navbar-nav-wrap">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="documentation.html">
                            <i class="ion ion-ios-keypad"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vehicles.index') }}">
                            <i class="ion ion-ios-car"></i>
                            <span class="nav-link-text">Unit Kendaraan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="documentation.html">
                            <i class="ion ion-ios-document"></i>
                            <span class="nav-link-text">Laporan Service</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
@endif

@if (Auth::user()->role->name == 'user1' || Auth::user()->role->name == 'user2')
    <nav class="hk-nav hk-nav-light">
        <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i
                    data-feather="x"></i></span></a>
        <div class="nicescroll-bar">
            <div class="navbar-nav-wrap">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user1.home') }}">
                            <i class="ion ion-ios-keypad"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user1.vehicle') }}">
                            <i class="ion ion-ios-car"></i>
                            <span class="nav-link-text">Unit Kendaraan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kerusakan.index') }}">
                            <i class="ion ion-ios-build"></i>
                            <span class="nav-link-text">Transaksi Kerusakan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="documentation.html">
                            <i class="ion ion-ios-document"></i>
                            <span class="nav-link-text">Laporan Service</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
@endif
