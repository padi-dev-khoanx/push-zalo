<div class="main-header side-header sticky">
    <div class="container-fluid">
        <div class="main-header-left">
            <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
        </div>
        <div class="main-header-right">
            <div class="dropdown main-profile-menu">
                <a class="d-flex" href="">
                    <span class="main-img-user"><img alt="avatar" src="{{ asset_admin('img/users/1.jpg') }}"></span>
                </a>
                <div class="dropdown-menu">
                    <div class="header-navheading">
                        <h6 class="main-notification-title">{{ Auth::user()->name }}</h6>
                        {{-- <p class="main-notification-text">{{ Auth::user()->getRoleText() }}</p> --}}
                    </div>
                    <a class="dropdown-item border-top" href="profile.html">
                        <i class="fe fe-user"></i> My Profile
                    </a>
                    <a class="dropdown-item" href="/logout">
                        <i class="fe fe-power"></i> Sign Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>