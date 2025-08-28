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
                            <!-- <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="{{ url('/user-logout') }}" class="sidebar-link">
                                        <i class="fas fa-power-off"></i>
                                        <span class="hide-menu"> Logout </span>
                                    </a>
                                </li>
                            </ul> -->
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('/user/dashboard')}}" class="sidebar-link">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Customer Dashboard</span>
                            </a>
                        </li>
                        <!-- First menu  start -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                                <i class="mdi mdi-credit-card-multiple"></i>
                                <span class="hide-menu">Orders</span> 
                                <span class="badge badge-inverse badge-pill ml-auto mr-3 font-medium px-2 py-1"></span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">

                                <li class="sidebar-item">
                                    <a href="{{ url('user/view-orders') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">View Orders History</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('user/add-order') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu">Add Order</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('/user/profile') }}" class="sidebar-link">
                                <i class="mdi mdi-shopping"></i>
                                    <span class="hide-menu">Profile</span>
                            </a>
                        </li> 

                        <li class="sidebar-item" style="position: absolute; bottom: 0;">
                            <a href="{{ url('/user-logout') }}" class="sidebar-link">
                                <i class="mdi mdi-logout"></i>
                                    <span class="hide-menu">Logout</span>
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
