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
                <div class="menu-title">Masters</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.ranks.index') }}">
                        <div class="menu-title">Rank</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.shiptypes.index') }}">
                        <div class="menu-title">Shiptype</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dce-endorsements.index') }}">
                        <div class="menu-title">DCE Endorsements</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.course-certificates.index') }}">
                        <div class="menu-title">Courses & Certificates</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.countries.index') }}">
                        <div class="menu-title">Country</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.states.index') }}">
                        <div class="menu-title">State</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.cities.index') }}">
                        <div class="menu-title">Cities</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.mobile-country-codes.index') }}">
                        <div class="menu-title">Country Codes</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-file"></i></div>
                <div class="menu-title">Candidate</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.candidates.create') }}">
                        <div class="menu-title">New Candidate</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.candidates.index') }}">
                        <div class="menu-title">All Candidates</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.candidate.delete_requests.index') }}" class="menu-link">
                        <div class="menu-title">Profile Delete Requests</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-building"></i></div>
                <div class="menu-title">Company</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.company.register.step', 1) }}">
                        <div class="menu-title">Add Company</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.company.index', 1) }}">
                        <div class="menu-title">List of Companies</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.company.followups.index') }}">

                        <div class="menu-title">Company Follow-Ups</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.company.banners.index') }}">
                        <div class="menu-title">Company Banners</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-building"></i></div>
                <div class="menu-title">Hotjobs</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.hotjobs.create') }}">
                        <div class="menu-title">Add Hotjob</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.hotjobs.index') }}">
                        <div class="menu-title">List of Hotjobs</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.hotjobs.index', ['status' => 'pending']) }}">
                        <div class="menu-title">Validate Hotjobs</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.messages') }}">
                <div class="parent-icon"><i class="bx bx-message-dots"></i></div>
                <div class="menu-title">Messages</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</aside>
