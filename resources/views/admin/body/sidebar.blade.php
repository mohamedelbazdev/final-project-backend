<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="index.html"><img src="{{ asset('backend/assets/images/logo.svg') }}"
                alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img
                src="{{ asset('backend/assets/images/logo-mini.svg') }}" alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{{ asset('backend/assets/images/faces/face15.jpg') }}"
                            alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal"></h5>
                        <span>Gold Member</span>
                    </div>
                </div>
                <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                    aria-labelledby="profile-dropdown">
                    <a href="" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-onepassword  text-info"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-calendar-today text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                        </div>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ URL::to('dashboard') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                    <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Categories</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('category.create') }}">Add Ctaegory</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('category.index') }}">All Categories</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#district" aria-expanded="false" aria-controls="district">
                <span class="menu-icon">
                    <i class="mdi mdi-security"></i>
                </span>
                <span class="menu-title">Provider</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="district">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('provider.create') }}"> Add Provider </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('provider.index') }}"> All Providers </a>
                    </li>

                </ul>
            </div>
        </li>



        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#post" aria-expanded="false" aria-controls="post">
                <span class="menu-icon">
                    <i class="mdi mdi-security"></i>
                </span>
                <span class="menu-title">orders</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="post">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href=""> Add order </a></li>
                    <li class="nav-item"> <a class="nav-link" href=""> All orders </a></li>

                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="post">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">User</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="setting">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.create') }}"> add User </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.index') }}">User List </a></li>


                </ul>
            </div>
        </li>




        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#website" aria-expanded="false" aria-controls="post">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Payments</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="website">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href=""> Add Payment
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href=""> All PAyemts


                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#photo" aria-expanded="false" aria-controls="post">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">FeedBack</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="photo">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href=""> add Feedback</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href=""> List All Feedbacks
                        </a></li>


                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#photo" aria-expanded="false" aria-controls="post">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Advertisments</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="photo">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="""> Insert Ads</a></li>
                    <li class="nav-item"> <a class="nav-link" href=""> All Ads </a></li>


                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Form Elements</span>
            </a>
        </li>


        <li class="nav-item menu-items">
            <a class="nav-link" href="">
                <span class="menu-icon">
                    <i class="mdi mdi-table-large"></i>
                </span>
                <span class="menu-title">Tables</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="">
                <span class="menu-icon">
                    <i class="mdi mdi-chart-bar"></i>
                </span>
                <span class="menu-title">Charts</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="">
                <span class="menu-icon">
                    <i class="mdi mdi-contacts"></i>
                </span>
                <span class="menu-title">Icons</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-icon">
                    <i class="mdi mdi-security"></i>
                </span>
                <span class="menu-title">Admin Roles</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href=""> Add Admin </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href=""> All Admins </a>
                    </li>

                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link"
                href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
                <span class="menu-icon">
                    <i class="mdi mdi-file-document-box"></i>
                </span>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>