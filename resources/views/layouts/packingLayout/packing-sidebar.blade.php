        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark profile-dd" href="javascript:void(0)" aria-expanded="false">
                                <img src="{{ asset('images/backend-images/users/user-avatar.png') }}" class="rounded-circle ml-2" width="30">
                                <span class="hide-menu">Packing </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link">
                                        <i class="ti-user"></i>
                                        <span class="hide-menu"> My Profile </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link">
                                        <i class="ti-wallet"></i>
                                        <span class="hide-menu"> My Balance </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link">
                                        <i class="ti-email"></i>
                                        <span class="hide-menu"> Inbox </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link">
                                        <i class="ti-settings"></i>
                                        <span class="hide-menu"> Account Setting </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link">
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
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-credit-card-multiple"></i>
                                <span class="hide-menu">Orders</span> 
                                <span class="badge badge-inverse badge-pill ml-auto mr-3 font-medium px-2 py-1"></span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">

                                <li class="sidebar-item">
                                    <a href="{{ url('admin/view-course-type') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">View Orders</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/view-classes') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">View Wordpress Orders</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/view-subjects') }}" class="sidebar-link">
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
                                    <a href="{{ url('admin/view-course-type') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Product Categories</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/view-classes') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Product Sub-Categories</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/view-subjects') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">View Products</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/view-subjects') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Products Customer Prices</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        {{--       Customers Setup             --}}
                        <li class="sidebar-item">
                            <a href="{{ url('/admin/view-fabriccategories')}}" class="sidebar-link">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Customer Setup</span>
                            </a>
                        </li>

                        <!-- Products -->
                        <li class="sidebar-item">
                            <a href="{{ url('/admin/list-product')}}" class="sidebar-link">
                                <i class="mdi mdi-shopping"></i>
                                <span class="hide-menu">Suppliers Setup</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('/admin/list-product')}}" class="sidebar-link">
                                <i class="mdi mdi-shopping"></i>
                                <span class="hide-menu">Purchases/Demands</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ url('/admin/list-product')}}" class="sidebar-link">
                                <i class="mdi mdi-shopping"></i>
                                <span class="hide-menu">Departments</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('/admin/list-product')}}" class="sidebar-link">
                                <i class="mdi mdi-shopping"></i>
                                <span class="hide-menu">Vehicles</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ url('/admin/view-countries')}}" class="sidebar-link">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Countries</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
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
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
