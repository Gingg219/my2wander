<div class="left-side-menu mm-show">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="assets/images/logo.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo_sm.png" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="assets/images/logo-dark.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo_sm_dark.png" alt="" height="16">
        </span>
    </a>

    <div class="h-100 mm-active" id="left-side-menu-container" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px;">

                            <!--- Sidemenu -->
                            <ul class="metismenu side-nav mm-show">

                                <li class="side-nav-title side-nav-item">Navigation</li>

                                <li class="side-nav-item">
                                    <a href="javascript: void(0);" class="side-nav-link" aria-expanded="false">
                                        <i class="uil-home-alt"></i>
                                        <span class="badge badge-success float-right">4</span>
                                        <span> Dashboards </span>
                                    </a>
                                    <a href="{{ route('admin.users.index') }}" class="side-nav-link" aria-expanded="false">
                                        <i class="uil-users-alt"></i>
                                        <span class="badge badge-success float-right"></span>
                                        <span> Users </span>
                                    </a>
                                    <a href="{{ route('admin.posts.index') }}" class="side-nav-link" aria-expanded="false">
                                        <i class="mdi mdi-post-outline"></i>
                                        <span class="badge badge-success float-right"></span>
                                        <span> Posts </span>
                                    </a>
                                    <ul class="side-nav-second-level mm-collapse" aria-expanded="false"
                                        style="height: 0px;">
                                        <li>
                                            <a href="dashboard-analytics.html">Analytics</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-crm.html">CRM</a>
                                        </li>
                                        <li>
                                            <a href="index.html">Ecommerce</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-projects.html">Projects</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="side-nav-title side-nav-item">Apps</li>



                                <li class="side-nav-item">
                                    <a href="apps-chat.html" class="side-nav-link" aria-expanded="false">
                                        <i class="uil-comments-alt"></i>
                                        <span> Chat </span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="javascript: void(0);" class="side-nav-link" aria-expanded="false">
                                        <i class="uil-clipboard-alt"></i>
                                        <span> Tasks </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="side-nav-second-level mm-collapse" aria-expanded="false"
                                        style="height: 0px;">
                                        <li>
                                            <a href="apps-tasks.html">List</a>
                                        </li>
                                        <li>
                                            <a href="apps-tasks-details.html">Details</a>
                                        </li>
                                        <li>
                                            <a href="apps-kanban.html">Kanban Board</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- End Sidebar -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 228px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
            <div class="simplebar-scrollbar"
                style="height: 0px; transform: translate3d(0px, 45px, 0px); display: none;"></div>
        </div>
    </div>
    <!-- Sidebar -left -->
</div>