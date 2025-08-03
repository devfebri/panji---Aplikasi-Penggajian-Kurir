<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom: 1px solid rgba(255, 107, 157, 0.3);">
        <div class="image">
            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-user" style="color: white; font-size: 16px;"></i>
            </div>
        </div>
        <div class="info">
            <a href="{{ route('admin.profile.show') }}" class="d-block" style="color: #ecf0f1; font-weight: 500;">
                <span style="color: #ff9ff3;"></span> {{ Auth::user()->nama }}
            </a>
        </div>
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if(auth()->user()->is_admin)
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: #ff9ff3;"></i>
                        <p>
                            <span style="margin-left: 5px;"> {{ __('Dashboard') }}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users" style="color: #ff9ff3;"></i>
                        <p>
                            <span style="margin-left: 5px;"> {{ __('Kurir') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.gaji.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-wave" style="color: #ff9ff3;"></i>
                        <p>
                            <span style="margin-left: 5px;"> {{ __('Gaji') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.gajiKurir.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-wave" style="color: #ff9ff3;"></i>
                        <p>
                            <span style="margin-left: 5px;"> {{ __('Gaji Kurir') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar" style="color: #ff9ff3;"></i>
                        <p>
                            <span style="margin-left: 5px;"> Laporan</span>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('admin.laporan.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon" style="color: #ff9ff3;"></i>
                                <p style="margin-left: 5px;"> Slip Gaji</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @else
            <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: #ff9ff3;"></i>
                        <p>
                            <span style="margin-left: 5px;"> {{ __('Dashboard') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.gajikaryawan.index') }}" class="nav-link">


                        <i class="nav-icon fas fa-money-bill-wave" style="color: #ff9ff3;"></i>
                        <p>
                            <span style="margin-left: 5px;"> {{ __('Gaji') }}</span>
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar" style="color: #ff9ff3;"></i>
                        <p>
                            <span style="margin-left: 5px;"> Laporan</span>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('admin.laporan.show') }}" class="nav-link">
                                <i class="far fa-circle nav-icon" style="color: #ff9ff3;"></i>
                                <p style="margin-left: 5px;"> Slip Gaji</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->