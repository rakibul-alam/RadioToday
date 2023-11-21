<style>
    .dashboard-menu {
    background-color: initial !important;
    color: initial !important;
}
</style>

<div class="nk-sidebar nk-sidebar-fixed" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em
                    class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="#" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{asset('images/radio_today_logo.png')}}"
                    srcset="{{asset('images/radio_today_logo.png 2x')}}" alt="logo">
                <img class="logo-dark logo-img" src="{{asset('images/radio_today_logo.png')}}"
                    srcset="{{asset('images/radio_today_logo.png 2x')}}" alt="logo-dark">
            </a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item ">

                        <a href="{{ route('home') }}" class="nk-menu-link dashboard-menu {{ request()->is('home') ? 'active' : '' }}">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                            <span class="nk-menu-text">Manage</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('podcasts.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Podcasts</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('categories.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Categories</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('rj-profiles.index')}}" class="nk-menu-link">
                                    <span class="nk-menu-text">RJ Profile</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('photo-galleries.index')}}" class="nk-menu-link">
                                    <span class="nk-menu-text">Photo Gallery</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('highlights.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Highlights</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('promotions.index')}}" class="nk-menu-link">
                                    <span class="nk-menu-text">Promotions</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('segments.index') }}" class="nk-menu-link">
                                   <span class="nk-menu-text">Segments</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('announcers.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Announcers/Djs</span>
                                </a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li>

                    <!-- .nk-menu-item -->
                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>



