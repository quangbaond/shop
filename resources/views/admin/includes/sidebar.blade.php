<!-- leftbar-tab-menu -->
<div class="left-sidebar">
    <!-- LOGO -->
    <div class="brand">
        <a href="index.html" class="logo">
            <span>
                <b class="text-white">{{ env('APP_NAME') }}</b>
                <img src="{{ asset('dist/assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
            </span>
        </a>
    </div>
    <div class="sidebar-user-pro media border-end py-2">
        <div class="position-relative mx-auto">
            <img src="{{ asset('dist/assets/images/users/user-4.jpg') }}" alt="user" class="rounded-circle thumb-md">
            <span class="online-icon position-absolute end-0"><i class="mdi mdi-record text-success"></i></span>
        </div>
        <div class="media-body ms-2 user-detail align-self-center">
            <h5 class="font-14 m-0 fw-bold">{{ Auth::guard('admin')->user()->name }}</h5>
            <p class="opacity-50 mb-0">{{ Auth::guard('admin')->user()->email }}</p>
        </div>
    </div>

    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <div class="menu-body navbar-vertical">
            <div class="collapse navbar-collapse tab-content" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav tab-pane active" id="Main" role="tabpanel">
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarUser" data-bs-toggle="collapse" role="button"
                           aria-expanded="false" aria-controls="sidebarAnalytics">
                            <i class="ti ti-stack menu-icon"></i>
                            <span>{{ __('sidebar.users') }}</span>
                        </a>
                        <div class="collapse " id="sidebarUser">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.users.index') }}">{{ __('sidebar.userList') }}</a>
                                </li><!--end nav-item-->
                            </ul><!--end nav-->
                        </div><!--end sidebarAnalytics-->
                    </li><!--end nav-item-->
                </ul><!--end nav-->

            </div><!--end sidebarCollapse-->
        </div>
    </div>
</div>
<!-- end left-sidenav-->
<!-- end leftbar-menu-->
