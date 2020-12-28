<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <i class="fe-airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>



                <!--start here-->

                <!-- <li>
                    <a href="{{route('admin.role')}}">
                        <i class="fas fa-user-tag"></i>
                        <span> Role </span>
                    </a>
                </li> -->

                <li>
                    <a href="{{route('admin.service')}}">
                        <i class="fas fa-hand-holding-heart"></i>
                        <span> Service </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.medicine')}}">
                        <i class="fas fa-pills"></i>
                        <span> Medicine </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.doctor')}}">
                        <i class="fas fa-user-md"></i>
                        <span> Doctor </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.patient')}}">
                        <i class="fas fa-user-injured"></i>
                        <span> Patient </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.caserecord')}}">
                        <i class="fas fa-user-injured"></i>
                        <span> Case Record </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.calendar')}}">
                        <i class="far fa-calendar-alt"></i>
                        <span> Calendar </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.appointment')}}">
                        <i class="far fa-calendar-check"></i>
                        <span> Appointment </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.message')}}">
                        <i class="fas fa-comments"></i>
                        <span> Message </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.subcrible')}}">
                        <i class="fas fa-users"></i>
                        <span> Subcrible </span>
                    </a>
                </li>

                <li>
                    <a href="/laravel-filemanager">
                        <i class="fas fa-folder-open"></i>
                        <span> File Manager </span>
                    </a>
                </li>

                <hr>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-trash"></i>
                        <span> Trash </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{route('admin.trash.patient')}}">Patient</a></li>
                        <li><a href="{{route('admin.trash.caserecord')}}">Case Record</a></li>
                        
                        
                    </ul>
                </li>
                <!-- end here -->
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->