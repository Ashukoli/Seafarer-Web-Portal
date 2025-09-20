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
            <a href="{{ route('candidate.dashboard') }}">
                <div class="parent-icon"><i class="bx bx-home-alt"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-file"></i></div>
                <div class="menu-title">Resume</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('candidate.resume.edit') }}">
                        <div class="menu-title">Edit Resume</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('candidate.view.resume') }}">
                        <div class="menu-title">View Resume</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('candidate.resume.hide') }}">
                        <div class="menu-title">Hide Resume</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('candidate.jobs.search') }}">
                <div class="parent-icon"><i class="bx bx-search"></i></div>
                <div class="menu-title">Search Jobs</div>
            </a>
        </li>
        <li>
            <a href="{{ route('candidate.jobs.hot') }}">
                <div class="parent-icon"><i class="bx bx-briefcase"></i></div>
                <div class="menu-title">Hot Jobs</div>
            </a>
        </li>
        <li>
            <a href="{{ route('candidate.express.service') }}">
                <div class="parent-icon"><i class="bx bx-bolt-circle"></i></div>
                <div class="menu-title">Express Service</div>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-bar-chart-alt-2"></i></div>
                <div class="menu-title">Statistics</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('candidate.statistics1') }}">
                        <div class="menu-title">Applied By You</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('candidate.statistics2') }}">
                        <div class="menu-title">Viewed Your Resume</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('candidate.messages') }}">
                <div class="parent-icon"><i class="bx bx-message"></i></div>
                <div class="menu-title">Messages</div>
            </a>
        </li>
        <li>
            <a href="http://tmwsmagazine.com/magazine.php" target="_blank">
                <div class="parent-icon"><i class="bx bx-book"></i></div>
                <div class="menu-title">TMWS Magazine</div>
            </a>
        </li>
          <li>
            <a href="{{ route('candidate.profile.delete') }}">
                <div class="parent-icon"><i class="bx bx-trash"></i></div>
                <div class="menu-title ">Delete Profile</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</aside>
