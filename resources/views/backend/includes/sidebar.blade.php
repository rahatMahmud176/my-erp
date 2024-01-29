<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


   
    

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard')?'active':'' }}" href="{{ route('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      @role('super-admin')
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/roles*')?'active':'' }}" href="{{ route('admin.roles.index') }}">
                <i class="bi bi-person-check"></i>
            <span>Role Manage</span>
            </a>
        </li> 
     @endrole 
     {{-- //super Admin  --}}

      @role('user')
      
      @endrole 
     {{-- //User Role  --}}


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
           
          <li>
            <a href="components-tooltips.html">
              <i class="bi bi-circle"></i><span>Tooltips</span>
            </a>
          </li> 

        </ul>
      </li><!-- End Components Nav -->

      

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

     

 

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

     

    </ul>

  </aside><!-- End Sidebar-->

 