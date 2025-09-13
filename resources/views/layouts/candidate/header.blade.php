<header class="top-header">
    <nav class="navbar navbar-expand gap-3">
      <div class="mobile-toggle-icon fs-3 d-flex d-lg-none">
          <i class="bi bi-list"></i>
        </div>
        <div class="top-navbar-right ms-auto">
          <ul class="navbar-nav align-items-center gap-1">

           <li class="nav-item dark-mode d-none d-sm-flex">
              <a class="nav-link dark-mode-icon" href="javascript:;">
                <div class="">
                  <i class="bi bi-moon-fill"></i>
                </div>
              </a>
           </li>
          </ul>
          </div>
          <div class="dropdown dropdown-user-setting">
            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
              <div class="user-setting d-flex align-items-center gap-3">
                <img src="{{ asset('theme/assets/images/avatars/avatar-2.png') }}   " class="user-img" alt="">
                <div class="d-none d-sm-block">
                   <p class="user-name mb-0">bhupesh Bhandari</p>
                  <small class="mb-0 dropdown-user-designation">
                    candidate
                </small>
                </div>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
               <li>
                  <a class="dropdown-item" href="{{ route('candidate.password.change') }}">
                     <div class="d-flex align-items-center">
                       <div class=""><i class="bi bi-person-fill"></i></div>
                       <div class="ms-3"><span>Profile</span></div>
                     </div>
                   </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('candidate.dashboard') }}">
                     <div class="d-flex align-items-center">
                       <div class=""><i class="bi bi-speedometer"></i></div>
                       <div class="ms-3"><span>Dashboard</span></div>
                     </div>
                   </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <form method="POST" action="{{ route('candidate.logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item d-flex align-items-center">
                      <i class="bi bi-lock-fill"></i>
                      <span class="ms-3">Logout</span>
                    </button>
                  </form>
            </ul>
          </div>
    </nav>
   </header>
