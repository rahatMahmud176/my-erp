<aside id="sidebar" class="sidebar d-print-none">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @role('super-admin')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/roles*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                    <i class="bi bi-person-check"></i>
                    <span>Role Manage</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people-fill"></i>
                    <span>User Manage</span>
                </a>
            </li> 

            
        @endrole
        {{-- //super Admin  --}}

        @role('admin' && 'super-admin')

        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/suppliers*') ? 'active' : '' }}" href="{{ route('admin.suppliers.index') }}">
                <i class="bi bi-people-fill"></i>
                <span>Supplier Manage</span>
            </a>
        </li>  

        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/pos*') ? 'active' : '' }}" href="{{ route('admin.pos.index') }}">
                <i class="bi bi-people-fill"></i>
                <span>POS</span>
            </a>
        </li> 


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#utility-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Utilitis</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="utility-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Category Manage</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.sub-categories.index') }}">
                            <i class="bi bi-circle"></i><span>SubCategory Manage</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.brands.index') }}">
                            <i class="bi bi-circle"></i><span>Brand Manage</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.colors.index') }}">
                            <i class="bi bi-circle"></i><span>Color Manage</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sizes.index') }}">
                            <i class="bi bi-circle"></i><span>Size Manage</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.country_variants.index') }}">
                            <i class="bi bi-circle"></i><span>Country Variant Manage</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.units.index') }}">
                            <i class="bi bi-circle"></i><span>Base Unit Manage</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.sub_units.index') }}">
                            <i class="bi bi-circle"></i><span>Sub Unit Manage</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->
        @endrole
        {{-- //User Role  --}}

        @role('user')
        @endrole
        {{-- //User Role  --}}


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Item </span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('admin.items.index') }}">
                        <i class="bi bi-circle"></i><span>Registered Items </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.items.create') }}">
                        <i class="bi bi-circle"></i><span>Add Items</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-stocks" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Stock </span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-stocks" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('admin.stocks.create') }}">
                        <i class="bi bi-circle"></i><span>Add Stock</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.stocks.index') }}">
                        <i class="bi bi-circle"></i><span>Stock</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-history" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>History </span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-history" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('admin.transitions.index') }}">
                        <i class="bi bi-circle"></i><span>Account Transitions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.supplier_transitions.index') }}">
                        <i class="bi bi-circle"></i><span>Supplier Transitions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.product_history.index') }}">
                        <i class="bi bi-circle"></i><span>Product History</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('admin.salePurchase.index') }}">
                        <i class="bi bi-circle"></i><span>Sale Purchase History</span>
                    </a>
                </li> --}}

            </ul>
        </li><!-- End Components Nav -->



        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.challans.index') }}">
                <i class="bi bi-person"></i>
                <span>Challans</span>
            </a>
        </li><!-- End Challans Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.invoice.index') }}">
                <i class="bi bi-person"></i>
                <span>Invoices</span>
            </a>
        </li><!-- End Challans Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.customers.index') }}">
                <i class="bi bi-people-fill"></i>
                <span>Customers</span>
            </a>
        </li><!-- End Challans Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.setting.index') }}">
                <i class="bi bi-person"></i>
                <span>Settings</span>
            </a>
        </li><!-- End Profile Page Nav --> 


    </ul>

</aside><!-- End Sidebar-->
