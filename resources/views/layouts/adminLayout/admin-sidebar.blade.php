        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <?php $user = Auth::User(); ?>
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark profile-dd" href="javascript:void(0)" aria-expanded="false">
                                <img src="{{ asset('images/backend-images/users/user-avatar.png') }}" class="rounded-circle ml-2" width="30">
                                <span class="hide-menu">{{$user->name}} </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="{{ url('/logout') }}" class="sidebar-link">
                                        <i class="fas fa-power-off"></i>
                                        <span class="hide-menu"> Logout </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('/admin/dashboard')}}" class="sidebar-link">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <!-- First menu  start -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                                <i class="mdi mdi-credit-card-multiple"></i>
                                <span class="hide-menu">Sales Orders</span> 
                                <span class="badge badge-inverse badge-pill ml-auto mr-3 font-medium px-2 py-1"></span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">

                                <li class="sidebar-item">
                                    <a href="{{ url('admin/view-orders') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">View Sales Orders</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">View Wordpress Sales Orders</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/view-orders-summary') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Summary/Reports</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                                        {{--       Product Setup                 --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-credit-card-multiple"></i>
                                <span class="hide-menu">Product Setup</span> 
                                <span class="badge badge-inverse badge-pill ml-auto mr-3 font-medium px-2 py-1"></span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
<!--                                 <li class="sidebar-item">
                                    <a href="{{ url('admin/sizeattribute/list-sizeattribute') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Size Attribute</span>
                                    </a>
                                </li> -->
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/view-categories') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Product Categories</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/view-subcategories') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Product Sub-Categories</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/view-products') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Products</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/view-customer-prices') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Products Customer Prices</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        {{--       Customers Setup             --}}
                        <li class="sidebar-item">
                            <a href="{{ url('admin/view-customers') }}" class="sidebar-link">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Customer Setup</span>
                            </a>
                        </li>

                        <!-- Products -->
                        <li class="sidebar-item">
                            <a href="{{ url('/admin/view-suppliers')}}" class="sidebar-link">
                                <i class="mdi mdi-shopping"></i>
                                <span class="hide-menu">Suppliers Setup</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-shopping"></i>
                                <span class="hide-menu">Purchase Orders Setup</span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
<!--                                 <li class="sidebar-item">
                                    <a href="{{ url('admin/sizeattribute/list-sizeattribute') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Size Attribute</span>
                                    </a>
                                </li> -->
                                <li class="sidebar-item">
                                    <a href="{{ url('/admin/view-pruchase-orders')}}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Purchase Order</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('/admin/recieve-pruchase-orders') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Recieve Purchase Order</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="mdi mdi-shopping"></i>
                                <span class="hide-menu">Departments</span>
                            </a>
                        </li> -->
                        <!-- <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-shopping"></i>
                                <span class="hide-menu">Assets</span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">

                                <li class="sidebar-item">
                                    <a href="{{ url('/admin/view-assets-categories') }}" class="sidebar-link">
                                    <i class="mdi mdi-shopping"></i>
                                    <span class="hide-menu">Assets Categories</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('/admin/view-assets-sub-categories') }}" class="sidebar-link">
                                    <i class="mdi mdi-shopping"></i>
                                    <span class="hide-menu">Assets Sub Categories</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('/admin/view-assets') }}" class="sidebar-link">
                                    <i class="mdi mdi-shopping"></i>
                                    <span class="hide-menu">Assets</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li> -->
                        

                         <li class="sidebar-item">
                            <a href="{{ url('/admin/view-vehicles') }}" class="sidebar-link">
                                <i class="mdi mdi-shopping"></i>
                                    <span class="hide-menu">Vehicles</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ url('/admin/view-riders') }}" class="sidebar-link">
                                <i class="mdi mdi-shopping"></i>
                                    <span class="hide-menu">Riders</span>
                            </a>
                        </li>

                        <!-- <li class="sidebar-item">
                            <a href="{{ url('/admin/view-states')}}" class="sidebar-link">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">States</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ url('/admin/view-cities')}}" class="sidebar-link">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Cities</span>
                            </a>
                        </li> -->

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
