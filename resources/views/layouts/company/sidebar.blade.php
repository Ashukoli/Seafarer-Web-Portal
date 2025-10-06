<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <h4 class="logo-text">Seafarer Jobs</h4>
        </div>
        <div class="toggle-icon ms-auto">
            <i class="bi bi-list"></i>
        </div>
    </div>

    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('company.dashboard') }}">
                <div class="parent-icon"><i class="bx bx-home-alt"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('company.search.candidates') }}" class="nav-link">
                <i class="bx bx-search"></i>
                <span>Search Candidates</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-home-alt"></i></div>
                <div class="menu-title">Hotjobs</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('company.hotjobs.create') }}">
                        <div class="menu-title">Add Hotjob</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('company.hotjobs.index') }}">
                        <div class="menu-title">List of Hotjobs</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('company.subadmin.list') }}">
                <div class="parent-icon"><i class="bx bx-home-alt"></i></div>
                <div class="menu-title">Subadmin List</div>
            </a>
        </li>
        <li>
            <a href="{{ route('company.messages') }}">
                <div class="parent-icon"><i class="bx bx-message-dots"></i></div>
                <div class="menu-title">Messages</div>
            </a>
        </li>

        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-bar-chart-alt-2"></i></div>
                <div class="menu-title">Statistics</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('company.statistics.applied') }}">
                        <div class="menu-title">Directly Applied</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="menu-title">Downloaded Resumes</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>`
    <!--end navigation-->
</aside>
