<header class="fixed-header">
    <div class="header-top" style="background-color: #fffbd5">
        <div class="container">
            <div class="pull-left" style="z-index: 999;">
                <a href="index.html" class="logo">
                    <img src="{{ asset('images/vedraj_logo.png') }}" style="z-index: 999;" width="150" alt="">
                </a>
            </div>
            <!-- /.pull-left -->
            <div class="pull-right">
                <div class="ico-item hidden-on-desktop">
                    <button type="button"
                        class="menu-button js__menu_button fa fa-bars waves-effect waves-light"></button>
                </div>
                <!-- /.ico-item hidden-on-desktop -->
                <div class="ico-item">
                    <a href="#" class="ico-item fa fa-search js__toggle_open"
                        data-target="#searchform-header"></a>
                    <form action="#" id="searchform-header" class="searchform js__toggle"><input type="search"
                            placeholder="Search..." class="input-search"><button class="fa fa-search button-search"
                            type="submit"></button></form>
                    <!-- /.searchform -->
                </div>
                <!-- /.ico-item -->
                <div class="ico-item fa fa-arrows-alt js__full_screen"></div>
                <!-- /.ico-item fa fa-fa-arrows-alt -->
                <div class="ico-item toggle-hover js__drop_down ">
                    <span class="fa fa-th js__drop_down_button"></span>
                    <div class="toggle-content">
                        <ul>
                            <li><a href="#"><i class="fa fa-github"></i><span class="txt">Github</span></a>
                            </li>
                            <li><a href="#"><i class="fa fa-bitbucket"></i><span
                                        class="txt">Bitbucket</span></a></li>
                            <li><a href="#"><i class="fa fa-slack"></i><span class="txt">Slack</span></a>
                            </li>
                            <li><a href="#"><i class="fa fa-dribbble"></i><span class="txt">Dribbble</span></a>
                            </li>
                            <li><a href="#"><i class="fa fa-amazon"></i><span class="txt">Amazon</span></a>
                            </li>
                            <li><a href="#"><i class="fa fa-dropbox"></i><span class="txt">Dropbox</span></a>
                            </li>
                        </ul>
                        <a href="#" class="read-more">More</a>
                    </div>
                    <!-- /.toggle-content -->
                </div>
                <!-- /.ico-item -->
                <div class="ico-item">
                    <a href="#" class="ico-item fa fa-envelope notice-alarm js__toggle_open"
                        data-target="#message-popup"></a>
                    <div id="message-popup" class="notice-popup js__toggle" data-space="55">
                        <h2 class="popup-title">Recent Messages<a href="#" class="pull-right text-danger">New
                                message</a></h2>
                        <!-- /.popup-title -->
                        <div class="content">
                            <ul class="notice-list">
                                <li>
                                    <a href="#">
                                        <span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
                                        <span class="name">John Doe</span>
                                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae,
                                            impedit facere repellat voluptates.</span>
                                        <span class="time">10 min</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- /.notice-list -->
                            <a href="#" class="notice-read-more">See more messages <i
                                    class="fa fa-angle-down"></i></a>
                        </div>
                        <!-- /.content -->
                    </div>
                    <!-- /#message-popup -->
                </div>
                <!-- /.ico-item -->
                <div class="ico-item">
                    <a href="#" class="ico-item fa fa-bell notice-alarm js__toggle_open"
                        data-target="#notification-popup"></a>
                    <div id="notification-popup" class="notice-popup js__toggle" data-space="55">
                        <h2 class="popup-title">Your Notifications</h2>
                        <!-- /.popup-title -->
                        <div class="content">
                            <ul class="notice-list">
                                <li>
                                    <a href="#">
                                        <span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
                                        <span class="name">John Doe</span>
                                        <span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
                                        <span class="time">10 min</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- /.notice-list -->
                            <a href="#" class="notice-read-more">See more messages <i
                                    class="fa fa-angle-down"></i></a>
                        </div>
                        <!-- /.content -->
                    </div>
                    <!-- /#notification-popup -->
                </div>
                <!-- /.ico-item -->
                <div class="ico-item">
                    <a href="#" class="ico-item fa fa-user js__toggle_open" data-target="#user-status"></a>
                    <div id="user-status" class="user-status js__toggle">
                        <a href="#" class="avatar"><img src="{{ asset('images/avatar-1.jpg') }}"
                                alt=""><span class="status online"></span></a>
                        <h5 class="name"><a href="profile.html">Emily Stanley</a></h5>
                        <h5 class="position">Administrator</h5>
                        <!-- /.name -->
                        <div class="control-items">
                            <div class="control-item"><a href="#" title="Settings"><i
                                        class="fa fa-gear"></i></a></div>
                            <div class="control-item"><a href="#" class="js__logout" title="Log out"><i
                                        class="fa fa-power-off"></i></a></div>
                        </div>
                        <!-- /.control-items -->
                    </div>
                    <!-- /#user-status -->
                </div>
                <!-- /.ico-item -->
            </div>
            <!-- /.pull-right -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <nav class="nav-horizontal">
        <button type="button" class="menu-close hidden-on-desktop js__close_menu"><i
                class="fa fa-times"></i><span>CLOSE</span></button>
        <div class="container" style="padding-left: 200px;">

            <ul class="menu">
                <li @if (Route::currentRouteName() == 'dashboard') class="current" @endif>
                    <a href="{{ route('dashboard') }}"><i class="ico fa fa-home"></i><span>Dashboard</span></a>
                </li>
                <li @if (Str::is('branch*', Route::currentRouteName())) class="current" @endif>
                    <a href="{{ route('branch.index') }}">
                        <i class="ico fa fa-building"></i>
                        <span>Branches</span>
                    </a>
                </li>
                <li @if (Str::is('staff*', Route::currentRouteName())) class="current" @endif>
                    <a href="{{ route('staff.index') }}">
                        <i class="ico fa fa-users"></i>
                        <span>Staff</span>
                    </a>
                </li>
                <li @if (Str::is('disease*', Route::currentRouteName())) class="current" @endif>
                    <a href="{{ route('disease.index') }}">
                        <i class="ico fa fa-medkit"></i>
                        <span>Disease</span>
                    </a>
                </li>
                <li @if (Route::currentRouteName() == 'project') class="current" @endif>
                    <a href="#">
                        <i class="ico fa fa-puzzle-piece"></i>
                        <span>Project</span>
                    </a>
                </li>
                <li @if (Route::currentRouteName() == 'notification') class="current" @endif>
                    <a href="#">
                        <i class="ico fa fa-bell"></i>
                        <span>Notification</span>
                    </a>
                </li>

                <!-- demo of Dropdown menu -->
                {{-- <li class="has-sub">
                    <a href="#"><i class="ico fa fa-paper-plane"></i><span>Additions</span></a>
                    <ul class="sub-menu mega mega-2">
                        <li class="has-sub">
                            <h3 class="title">Tables</h3>
                            <!-- .title -->
                            <ul class="child-list">
                                <li><a href="tables-basic.html">Basic Tables</a></li>
                                <li><a href="tables-datatable.html">Data Tables</a></li>
                                <li><a href="tables-responsive.html">Responsive Tables</a></li>
                                <li><a href="tables-editable.html">Editable Tables</a></li>
                            </ul>
                            <!-- /.child-list -->
                        </li>
                        <li class="has-sub">
                            <h3 class="title">Others</h3>
                            <!-- .title -->
                            <ul class="child-list">
                                <li><a href="calendar.html">Calendar</a></li>
                                <li><a href="ui-notification.html">Notification</a></li>
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="widgets.html">Widgets</a></li>
                            </ul>
                            <!-- /.child-list -->
                        </li>
                    </ul>
                    <!-- /.sub-menu mega -->
                </li> --}}
            </ul>
            <!-- /.menu -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.nav-horizontal -->
</header>
<!-- /.fixed-header -->

{{-- <div id="color-switcher">
    <div id="color-switcher-button" class="btn-switcher">
        <div class="inside waves-effect waves-circle waves-light">
            <i class="ico fa fa-gear"></i>
        </div>
        <!-- .inside waves-effect waves-circle -->
    </div>
    <!-- .btn-switcher -->
    <div id="color-switcher-content" class="content">
        <a href="#" data-color="red" class="item js__change_color"><span class="color"
                style="background-color: #f44336;"></span><span class="text">Red</span></a>
        <a href="#" data-color="violet" class="item js__change_color"><span class="color"
                style="background-color: #673ab7;"></span><span class="text">Violet</span></a>
        <a href="#" data-color="dark-blue" class="item js__change_color"><span class="color"
                style="background-color: #3f51b5;"></span><span class="text">Dark Blue</span></a>
        <a href="#" data-color="blue" class="item js__change_color active"><span class="color"
                style="background-color: #304ffe;"></span><span class="text">Blue</span></a>
        <a href="#" data-color="light-blue" class="item js__change_color"><span class="color"
                style="background-color: #2196f3;"></span><span class="text">Light Blue</span></a>
        <a href="#" data-color="green" class="item js__change_color"><span class="color"
                style="background-color: #4caf50;"></span><span class="text">Green</span></a>
        <a href="#" data-color="yellow" class="item js__change_color"><span class="color"
                style="background-color: #ffc107;"></span><span class="text">Yellow</span></a>
        <a href="#" data-color="orange" class="item js__change_color"><span class="color"
                style="background-color: #ff5722;"></span><span class="text">Orange</span></a>
        <a href="#" data-color="chocolate" class="item js__change_color"><span class="color"
                style="background-color: #795548;"></span><span class="text">Chocolate</span></a>
        <a href="#" data-color="dark-green" class="item js__change_color"><span class="color"
                style="background-color: #263238;"></span><span class="text">Dark Green</span></a>
        <span id="color-reset" class="btn-restore-default js__restore_default">Reset</span>
    </div>
    <!-- /.content -->
</div> --}}
<!-- #color-switcher -->
