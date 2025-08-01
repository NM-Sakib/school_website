<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title text-light">Menu</li>
        <li class="{{ request()->is('administrative/dashboard') ? 'mm-active' : '' }}">
            <a href="{{ route('administrative.dashboard') }}" class="waves-effect">
                <i class="ri-dashboard-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-tools-line"></i>
                <span>Account Settings</span>
            </a>
            <ul class="sub-menu" aria-expanded="true">
                @can('user_list')
                    <li class="{{ request()->is('administrative/user/*') ? 'mm-active' : '' }}">
                        <a href="{{ route('administrative.user') }}">
                            <i class="ri-user-line"></i> User List
                        </a>
                    </li>
                @endcan

                <li class="{{ request()->is('administrative/role/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('administrative.role') }}">
                        <i class="ri-shield-user-line"></i> Role
                    </a>
                </li>

                @can('permission_list')
                    <li class="{{ request()->is('administrative/permission/*') ? 'mm-active' : '' }}">
                        <a href="{{ route('administrative.permission') }}">
                            <i class="ri-lock-line"></i> Permission
                        </a>
                    </li>

                    @can('upload_file_list')
                        <li class="{{ request()->is('administrative/uploaded-files/*') ? 'mm-active' : '' }}">
                            <a href="{{ route('administrative.uploaded-files') }}">
                                <i class="ri-upload-2-line"></i> File Manager
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        <!-- Content Management -->
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-file-text-line"></i>
                <span>Content Management</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li class="{{ request()->is('administrative/news/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('administrative.news') }}">
                        <i class="ri-article-line"></i> News
                    </a>
                </li>
                <li class="{{ request()->is('administrative/events/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('administrative.events') }}">
                        <i class="ri-calendar-event-line"></i> Events
                    </a>
                </li>
                <li class="{{ request()->is('administrative/notices/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('administrative.notices') }}">
                        <i class="ri-notification-line"></i> Notices
                    </a>
                </li>
                <li class="{{ request()->is('administrative/popup-notices/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('administrative.popup-notices') }}">
                        <i class="ri-message-2-line"></i> Popup Notices
                    </a>
                </li>
                <li class="{{ request()->is('administrative/pages/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('administrative.pages') }}">
                        <i class="ri-file-list-line"></i> Pages
                    </a>
                </li>
            </ul>
        </li>

        <!-- Academic Management -->
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-book-open-line"></i>
                <span>Academic Management</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li class="{{ request()->is('administrative/teachers/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('administrative.teachers') }}">
                        <i class="ri-user-star-line"></i> Teachers
                    </a>
                </li>
                <li class="{{ request()->is('administrative/class-routines/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('administrative.class-routines') }}">
                        <i class="ri-time-line"></i> Class Routines
                    </a>
                </li>
                <li class="{{ request()->is('administrative/admissions/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('administrative.admissions') }}">
                        <i class="ri-user-add-line"></i> Admissions
                    </a>
                </li>
            </ul>
        </li>

        <!-- Media Management -->
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-image-line"></i>
                <span>Media Management</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li class="{{ request()->is('administrative/gallery/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('administrative.gallery') }}">
                        <i class="ri-image-2-line"></i> Gallery
                    </a>
                </li>
                <li class="{{ request()->is('administrative/downloads/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('administrative.downloads') }}">
                        <i class="ri-download-line"></i> Downloads
                    </a>
                </li>
            </ul>
        </li>

        <!-- Communication -->
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-message-3-line"></i>
                <span>Communication</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li class="{{ request()->is('administrative/inbox/*') ? 'mm-active' : '' }}">
                    <a href="{{ route('administrative.inbox') }}">
                        <i class="ri-inbox-line"></i> Contact Inbox
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</div>
