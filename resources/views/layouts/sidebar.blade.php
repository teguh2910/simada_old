<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('img/aisin.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SIMADA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- Admin Only Menus --}}
                @if (\auth::user()->jabatan == 'manager')
                    @if (
                        \auth::user()->dept == 'MPU' ||
                            \auth::user()->dept == 'PPU' ||
                            \auth::user()->dept == 'PQD' ||
                            \auth::user()->dept == 'MIM' ||
                            \auth::user()->dept == 'PMA')
                        <!-- Dashboard (Top Level) -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- SPTT Menu Group -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    SPTT
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ asset('create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Data SPTT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ asset('/outstanding') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Outstanding SPTT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ asset('/overdue') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Overduedate SPTT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ asset('/draft') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Draft SPTT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ asset('/final') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Final SPTT</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <!-- PCR Menu Group -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                PCR
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('list-pcr') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List PCR</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('create-pcr') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create PCR</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('list-pending-pcr') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Pending PCR</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- RFQ Menu Group -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                RFQ
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('rfq.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List RFQ Project</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rfq-apr.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List RFQ APR</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rfq-gp.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List RFQ GP</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Survey to Supplier Menu Group -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-poll"></i>
                            <p>
                                Survey to Supplier
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('survey-supplier.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Surveys</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Master Data Menu Group -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Master Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('customers.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Customers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Products</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('suppliers.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Suppliers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pics.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>PIC (Person In Charge)</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Price Controlled Menu Group -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>
                                Price Controlled
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('price-controlled.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Price Controlled</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('price-controlled.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Price Control</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Feasibility Study Menu Group -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                Feasibility Study
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('fs.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List FS</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('fs.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create FS</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Check Quotation Menu Group -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-contract"></i>
                            <p>
                                Check Quotation
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('quotation.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Quotations</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('quotation.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Quotation</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- Common Menus for All Users --}}
                <!-- Leave Management Menu Group -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Leave Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('leave_requests.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Leave Requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('leave_requests.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Request Leave</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('leave_requests.today') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Today's Leave</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- User Management Menu Group (Limited for non-admin users) -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (\auth::user()->jabatan == 'manager')
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New User</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('users.profile') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                        <i class="nav-icon fas fa-power-off"></i> Logout
                    </a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
