
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar light js-sticky-header site-navbar-target" role="banner">

        <div class="container">
            <div class="row align-items-center">

                <div class="col-6 col-xl-2">
                    <div class="mb-0 site-logo"><a href="{{route('user.index')}}" class="mb-0">Anna<span class="text-primary">.</span>Dental
                        </a></div>
                </div>

                <div class="col-12 col-md-10 d-none d-xl-block">
                    <nav class="site-navigation position-relative text-right" role="navigation">

                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                            <li><a href="{{route('user.index')}}" class="nav-link active">Home</a></li>
                            <!-- <li class="has-children">
                              <a href="services.html" class="nav-link">Services</a>
                              <ul class="dropdown">
                                <li><a href="#" class="nav-link">General Surgery</a></li>
                                <li><a href="#" class="nav-link">Opthalmology Procedures</a></li>
                                <li><a href="#" class="nav-link">Outpatient Services</a></li>
                                <li><a href="#" class="nav-link">Radiology and Mammograms</a></li>
                                <li><a href="#" class="nav-link">Respiratory</a></li>
                                <li class="has-children">
                                  <a href="#">More Links</a>
                                  <ul class="dropdown">
                                    <li><a href="#">Menu One</a></li>
                                    <li><a href="#">Menu Two</a></li>
                                    <li><a href="#">Menu Three</a></li>
                                  </ul>
                                </li>
                              </ul>
                            </li> -->

                            <!-- <li><a href="departments.html" class="nav-link">Departments</a></li> -->


                            <li><a href="{{route('user.blog')}}" class="nav-link">Blog</a></li>
                            <li><a href="{{route('user.aboutus')}}" class="nav-link">About Us</a></li>
                            <li><a href="{{route('user.contactus')}}" class="nav-link">Contact</a></li>

                            @guest
                                <li><a href="{{route('login')}}" class="nav-link">Sign In</a></li>
                            @else
                                <li class="has-children">
                                    <a class="nav-link">Hi {{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                                    <ul class="dropdown">
                                        @if(\Illuminate\Support\Facades\Auth::user()->role->id == 2)
                                            <li><a href="{{route('admin.dashboard')}}" class="nav-link">Dashboard</a></li>
                                        @endif
                                        <li><a href="#" class="nav-link">Profile</a></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf

                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endguest







                        </ul>
                    </nav>
                </div>


                <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#"
                                                                                                                  class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3 text-black"></span></a>
                </div>

            </div>
        </div>

    </header>
