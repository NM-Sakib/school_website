<style>
    .app-search .position-relative {
        position: relative;
    }

    .app-search-design {
        border-radius: 10px;
        overflow: hidden;
    }

    #search-results {
        overflow-y: scroll;
        min-height: auto;
        max-height: 400px;
        cursor: pointer;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 1000;
        background-color: white;
        border-top: none;
        list-style: none;
        margin: 0;
        padding: 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 450px;
        border-radius: 10px;
        box-sizing: border-box;
        transition: all 0.3s ease-in-out;
    }

    #search-results {
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE and Edge */
    }

    #search-results::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari, Opera */
    }

    #search-results li {
        padding: 8px 12px;
        white-space: nowrap;
        border-bottom: 1px solid #ececec;
        font-weight: 700;
        font-size: 14px;
    }

    #search-results li a {
        color: #333;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .list-group-item:last-child {
        border: none;
    }

    #search-results li:hover {
        background-color: #e3f3fd;
    }
</style>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('administrative.dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/icon.jpeg') }}" alt="logo-sm-light" height="22">
                    </span>
                    <span class="logo-lg">
                        {{-- <img src="{{ asset('assets/images/logo.svg') }}" alt="logo-light" width="100%"> --}}
                        SMSCR
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" id="header-search-input" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                    <div class="app-search-design">
                        <ul class="list-group mt-2" id="search-results"></ul>
                    </div>
                </div>
            </form>

        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3" id="header-search-form">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="ri-search-line"></i></button>
                                </div>
                            </div>
                            <ul class="list-group mt-2" id="search-results"></ul>
                        </div>
                    </form>

                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>


            <div class="dropdown d-inline-block">
                {{-- <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    <span class="dot"></span>
                </button> --}}
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            {{-- <div class="col-auto">
                                <a href="#!" class="small"> View All</a>
                            </div> --}}
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;overflow-y: auto;" class="noptify">

                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            {{-- <a class="btn btn-sm btn-link font-size-14 text-center" href="{{route('administrative.approval.list')}}">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/dummy_80x80.png') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ auth()->user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <!-- <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item d-block" href="#"><i class="ri-settings-2-line align-middle me-1"></i> Settings</a> -->
                    <!-- <div class="dropdown-divider"></div> -->
                    <form id="logoutForm" method="post" action="{{ route('administrative.logout') }}"
                        style="display: none">
                        @csrf
                    </form>
                    <a class="dropdown-item" style="cursor: pointer;"
                        onclick="document.getElementById('logoutForm').submit();">
                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i>
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
