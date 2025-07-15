<aside
    class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered navbar-vertical-aside-initialized"
>
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <div class="navbar-brand-wrapper justify-content-center" style="height: auto">
                <!-- Logo -->

                <a class="navbar-brand toggle-navbar" href="javascript:void(0)" aria-label="Front">
                    <img
                        class="navbar-brand-logo"
                        src="{{ asset('image/logo code_fun.png')}}"
                        alt="Logo" style="min-width:5rem; height:5rem;"
                    />
                    <img
                        class="navbar-brand-logo-mini"
                        src="{{ asset('image/logo code_fun.png')}}"
                        alt="Logo" style="min-width:5rem; height:5rem;"
                    />
                </a>

                <!-- End Logo -->
            </div>

            <!-- Content -->
            <div class="navbar-vertical-content">
                <ul class="navbar-nav navbar-nav-lg nav-tabs">
                    <!-- Apps -->
                    <!-- End Apps -->
                    <li class="navbar-vertical-aside-has-menu ">
                        <a
                            class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle "
                            href="javascript:;"
                            title="Apps"
                        >
                            <i class="tio-apps nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"
                            >Quản lý khóa học
                   </span>
                        </a>

                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                            <li class="nav-item">
                                <a
                                    class="nav-link "
                                    href="{{route('index_khoa_hoc')}}"
                                    title="Calendar"
                                >
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">Danh sách khóa học</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link "

                                    href="{{ route('index_lesson') }}"
                                    title="Kanban"
                                >
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">Danh sách bài giảng</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link "
                                    href=" {{ route('index_terms_KH') }}"
                                    title="Kanban"
                                >
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">Danh sách tag khóa học</span>
                                </a>
                            </li>
                   
                        </ul>
                    </li>
                    <li class="navbar-vertical-aside-has-menu ">
                        <a
                            class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle "
                            href="javascript:;"
                            title="Apps"
                        >
                            <i class="tio-apps nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"
                            >Quản lý bộ câu hỏi
                   </span>
                        </a>

                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                            <li class="nav-item">
                                <a
                                    class="nav-link "
                                    href="{{route('index_trac_nghiem')}}"
                                    title="Calendar"
                                >
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">Danh sách câu hỏi trắc nghiệm</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link "
                                    href="{{route('index_history_trac_nghiem')}}"
                                    title="Kanban"
                                >
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">Danh sách lịch sử kiểm tra</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="navbar-vertical-aside-has-menu ">
                        <a
                            class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle "
                            href="javascript:;"
                            title="Apps"
                        >
                            <i class="tio-apps nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"
                            >Quản lý bài viết
                   </span>
                        </a>

                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                            <li class="nav-item">
                                <a
                                    class="nav-link "
                                    href="{{ route('indexBV') }}"
                                    title="Calendar"
                                >
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate"
                                    >Danh sách bài viết
                        </span>
                                </a>
                            </li>
        
                            <li class="nav-item">
                                <a
                                    class="nav-link "
                                    href="{{ route('index_terms_HD') }}"
                                    title="Kanban"
                                >
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">Danh sách tag bài viết</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="navbar-vertical-aside-has-menu ">
                        <a
                            class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle "
                            href="javascript:;"
                            title="Apps"
                        >
                            <i class="tio-apps nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"
                            >Quản lý hình ảnh
                   </span>
                        </a>

                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                            <li class="nav-item">
                                <a
                                    class="nav-link "
                                    href=" {{ route('index_picture') }}"
                                    title="Calendar">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">Danh sách hình ảnh</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="navbar-vertical-aside-has-menu ">
                        <a
                            class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle "
                            href="javascript:;"
                            title="Apps"
                        >
                            <i class="tio-apps nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"
                            >Quản lý tài khoản
                    </span>
                        </a>

                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                            <li class="nav-item">
                                <a
                                    class="nav-link "
                                    href="{{ route('index_user') }}"
                                    title="Calendar"
                                >
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate"
                                    >Danh sách tài khoản
                        </span
                                    >
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="navbar-vertical-aside-has-menu ">
                        <a
                            class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle "
                            href="javascript:;"
                            title="Apps"
                        >
                            <i class="tio-apps nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"
                            >Quản lý giỏ hàng
                    </span>
                        </a>

                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                            <li class="nav-item">
                                <a
                                    class="nav-link "
                                    href="{{ route('index_gio_hang') }}"
                                    title="Calendar"
                                >
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">Danh sách giỏ hàng </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="navbar-vertical-aside-has-menu ">
                        <a
                            class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle "
                            href="javascript:;"
                            title="Apps"
                        >
                            <i class="tio-apps nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"
                            >Quản lý yêu cầu tư vấn
                    </span>
                        </a>

                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                            <li class="nav-item">
                                <a
                                    class="nav-link "
                                    href=""
                                    title="Calendar"
                                >
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">Danh sách tư vấn</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="navbar-vertical-aside-has-menu ">
                        <a
                            class="js-navbar-vertical-aside-menu-link nav-link  "
                            href="{{asset('/admin/logout')}}"
                            title="Apps"
                        >
                            <i class="tio-apps nav-icon"></i>
                            <span
                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"
                            >Đăng xuất
                    </span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- End Content -->
        </div>
    </div>
</aside>
<div
    class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-mobile-overlay"
></div>