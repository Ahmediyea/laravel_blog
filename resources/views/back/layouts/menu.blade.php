@section('name','Blog Sitesi Admin')
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">

                <div class="sidebar-brand-text">@yield('name')</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Sol Menü -->
            <li class="nav-item @if(Request::segment(2) == 'panel') active @endif">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Panel</span></a>
            </li>


            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                İçerik Yönetimi
            </div>

            <li class="nav-item">
                <a class="nav-link  @if(Request::segment(2) == 'makaleler') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Makaleler</span>
                </a>
                <div id="collapseTwo" class="collapse  @if(Request::segment(2) == 'makaleler') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Makale İşlemleri:</h6>
                        <a class="collapse-item  @if(Request::segment(2) == 'makaleler' and !Request::segment(3)) active @endif"  href="{{route('admin.makaleler.index')}}">Tüm Makaleler</a>
                        <a class="collapse-item @if(Request::segment(2) == 'makaleler' and Request::segment(3)) active @endif"  href="{{route('admin.makaleler.create')}}">Makale Oluştur</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item @if(Request::segment(2)=="kategoriler") active @endif">
                <a class="nav-link "  href="{{route('admin.category.index')}}"
                   >
                    <i class="fas fa-fw fa-list"></i>
                    <span>Kategoriler</span>
                </a>

            </li>
               <li class="nav-item">
                <a class="nav-link  @if(Request::segment(2) == 'sayfalar') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapsePage"
                    aria-expanded="true" aria-controls="collapsePage">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Sayfalar</span>
                </a>
                <div id="collapsePage" class="collapse  @if(Request::segment(2) == 'sayfalar') show @endif" aria-labelledby="headingPage" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sayfa İşlemleri:</h6>
                        <a class="collapse-item  @if(Request::segment(2) == 'sayfalar' and !Request::segment(3)) active @endif"  href="{{route('admin.page.index')}}">Tüm Sayfalar</a>
                        <a class="collapse-item @if(Request::segment(2) == 'sayfalar' and Request::segment(3)) active @endif"  href="{{route('admin.page.create')}}">Sayfa Oluştur</a>
                    </div>
                </div>
            </li>


             <li  id="menuMessage" class="nav-item @if(Request::segment(2)=="mesajlar") active @endif">
                <a id="menuMessage" class="nav-link "  href="{{route('admin.message')}}"
                   >

                    <i class="fas fa-fw fa-comments"></i>
                    <span>Mesajlar</span>
                </a>

            </li>
            <li class="nav-item @if (Request::segment(2)=='profile') active @endif">
                <a class="nav-link " href="{{route('admin.profile')}}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profil</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Site ayarları
            </div>




            <!-- Nav Item - Pages Collapse Menu -->


            <!-- Nav Item - Tables -->
            <li class="nav-item @if (Request::segment(2)=='ayarlar') active @endif">
                <a class="nav-link " href="{{route('admin.config.index')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Ayarlar</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                @if (count($contacts)>0)
                                <span id="messageCount" class="badge badge-danger badge-counter">{{$contacts->count()}}</span>
                                @endif

                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                 @foreach ( $contacts->take(5) as $contact )
                                <a class="dropdown-item d-flex align-items-center" href="{{route('admin.message')}}">
                                    <div class="dropdown-list-image mr-3">

                                        <i class="fas fa-user-circle fa-3x"></i>

                                    </div>



                                    <div class="font-weight-bold">
                                        <div class="text-truncate">{{$contact->message}}</div>
                                        <div class="small text-gray-500">{{$contact->name}} · {{$contact->created_at->diffForHumans()}}</div>
                                    </div>
                                </a>
                                @endforeach
                                <a class="dropdown-item text-center small text-gray-500" href="{{route('admin.message')}}">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{(auth()->user()->name)}}</span>
                                <i class="fas fa-user-circle fa-2x  text-gray-800"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('admin.profile')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('admin.login')}}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Çıkıs Yap
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Çıkış Yap</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Çıkış yapmak istediğinde emin misin</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Vazgeç</button>
                                    <a class="btn btn-primary" href="{{route('admin.logout')}}">Çıkıs Yap</a>
                                </div>
                            </div>
                        </div>
                    </div>
                                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                        <a href="{{route('homepage')}}" target='_blank' class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-globe fa-sm text-white-50"></i> Siteyi Görüntüle</a>

                            </div>
