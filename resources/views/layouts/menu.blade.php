<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <router-link to="/home" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt blue"></i>
                  <p>
                    Dashboard
                  </p>
                </router-link>
               </li>

          <li class="nav-item">
            <router-link to="/event" class="nav-link">
            <i class="nav-icon fas fa-clipboard cyan"></i>
              <p>Events</p>
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/news" class="nav-link">
            <i class="nav-icon fas fa-clipboard cyan"></i>
              <p>News & Media</p>
            </router-link>
          </li>

          @can('isAdmin')
          <li class="nav-item">
            <router-link to="/user" class="nav-link">
            <i class="nav-icon fas fa-users yellow"></i>
              <p>Users</p>
            </router-link>
          </li>
          @endcan
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog red"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/slides"class="nav-link">
                  <i class="fas fa-list-ul nav-icon red"></i>
                  <p>Slides</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/photo"class="nav-link">
                  <i class="fas fa-list-ul nav-icon red"></i>
                  <p>Photos</p>
                </router-link>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog red"></i>
                  <p>
                    About
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/about" class="nav-link">
                    <i class="fas fa-tags nav-icon cyan"></i>
                    <p>About {{config('app.name')}}</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/biography" class="nav-link">
                    <i class="fas fa-tags nav-icon cyan"></i>
                    <p>Biography</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/issue" class="nav-link">
                    <i class="fas fa-tags nav-icon cyan"></i>
                    <p>Campaign Issues</p>
                  </router-link>
                </li>
              </ul>
            </li>
            </ul>
          </li>
          @can('isAdmin')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs white"></i>
              <p>
                Configuration
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/about" class="nav-link">
                  <i class="fas fa-info nav-icon brown"></i>
                  <p>About</p>
                </router-link>
              </li>
              
              <li class="nav-item">
                <router-link to="/contact" class="nav-link">
                  <i class="fas fa-address-card nav-icon green"></i>
                  <p>Contact</p>
                </router-link>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-comment-alt brown"></i>
              <p>
                Feedback
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/comments"class="nav-link">
                  <i class="fas fa-comment-dots nav-icon red"></i>
                  <p>Comments</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/messages" class="nav-link">
                  <i class="fas fa-envelope nav-icon cyan"></i>
                  <p>Direct Messages</p>
                </router-link>
              </li>
            </ul>
          </li>
         @endcan 

          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
            <i class="nav-icon fas fa-user green"></i>
              <p>Profile</p>
            </router-link>
          </li>
        
          <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off red"></i>
          <p>
            {{ __('Logout') }}
          </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li> 
        </ul>
            </nav>        