<nav id="main_nav" class="navbar navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img id="logo_image" src="<?php echo base_url('images/'.$this->settings->institute_logo); ?>" alt="<?php echo $this->settings->institute_name; ?>">
        <span id="institute_name"><?php echo $this->settings->institute_name; ?></span>
      </a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
        <li <?php if($page=='dashboard') echo 'class="active"'; ?>>
          <a href="<?php echo site_url($module.'/dashboard'); ?>">
            <span class="nav_icon"><i class="fa fa-dashboard"></i></span>
            Dashboard
          </a>
        </li>
        <?php if($this->session->userdata['admin_type']!=0) { ?>
        <li class="dropdown <?php if($page=='user') echo 'active'; ?>">
          <a id="user_submenu_button" class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
            <span class="nav_icon"><i class="fa fa-users"></i></span> Users
            <i class="fa fa-caret-down pull-right"></i>
          </a>
          <ul class="dropdown-menu" id="users_submenu" role="menu">
            <li class="">
              <a href="<?php echo site_url($module.'/user/students'); ?>">
              <span class="nav_icon"><i class="fa fa-users"></i></span>Students
              </a>
            </li>
            <li class="">
              <a href="<?php echo site_url($module.'/user/teachers'); ?>">
              <span class="nav_icon"><i class="fa fa-users"></i></span>Teachers
              </a>
            </li>
            <li>
              <hr>
            </li>
            <li class="">
              <a href="<?php echo site_url($module.'/user/students/1'); ?>">
              <span class="nav_icon"><i class="fa fa-users"></i></span>Deactivated Students
              </a>
            </li>
            <li class="">
              <a href="<?php echo site_url($module.'/user/teachers/1'); ?>">
              <span class="nav_icon"><i class="fa fa-users"></i></span>Deactivated Teachers
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <li <?php if($page=='categories') echo 'class="active"'; ?>>
          <a href="<?php echo site_url($module.'/category'); ?>">
            <span class="nav_icon"><i class="fa fa-align-left"></i></span>
            Cateogries
          </a>
        </li>
        <li <?php if($page=='authors') echo 'class="active"'; ?>>
          <a href="<?php echo site_url($module.'/author'); ?>">
            <span class="nav_icon"><i class="fa fa-pencil"></i></span>
            Authors
          </a>
        </li>
        <li <?php if($page=='publications') echo 'class="active"'; ?>>
          <a href="<?php echo site_url($module.'/publication'); ?>">
            <span class="nav_icon"><i class="fa fa-bookmark"></i></span>
            Publications
          </a>
        </li>
        <li <?php if($page=='books') echo 'class="active"'; ?>>
          <a href="<?php echo site_url($module.'/book'); ?>">
            <span class="nav_icon"><i class="fa fa-book"></i></span>
            Books
          </a>
        </li>

        <!-- <li <?php if($page=='book_copy') echo 'class="active"'; ?>>
          <a href="<?php echo site_url($module.'/book/copy'); ?>">
            <span class="nav_icon"><i class="fa fa-file"></i></span>
            Book Copy
          </a>
        </li> -->
        
        <li class="dropdown <?php if($page=='issue') echo 'active'; ?>">
          <a class="dropdown-toggle" id="issue_nav_button" href="#" data-toggle="dropdown" aria-expanded="false" role="button" aria-haspopup="true">
            <span class="nav_icon"><i class="fa fa-credit-card-alt"></i></span> Issues
            <i class="fa fa-caret-down pull-right"></i>
          </a>
          <ul class="dropdown-menu" id="issue_submenu" role="menu">
            <li class="<?php if($page == 'issue' && $subpage =='requests') echo 'active'; ?>">
              <a href="<?php echo site_url($module.'/issue'); ?>">
              <span class="nav_icon"><i class="fa fa-credit-card"></i></span>New Requests
              </a>
            </li>
            <li class="<?php if($page == 'issue' && $subpage =='active') echo 'active'; ?>">
              <a href="<?php echo site_url($module.'/issue/active'); ?>">
              <span class="nav_icon"><i class="fa fa-bullhorn"></i></span>Active
              </a>
            </li>
            <li class="<?php if($page == 'issue' && $subpage =='overdue') echo 'active'; ?>">
              <a href="<?php echo site_url($module.'/issue/overdue'); ?>">
              <span class="nav_icon"><i class="fa fa-ban"></i></span>Overdue
              </a>
            </li>
            <li class="<?php if($page == 'issue' && $subpage =='completed') echo 'active'; ?>">
              <a href="<?php echo site_url($module.'/issue/completed'); ?>">
              <span class="nav_icon"><i class="fa fa-check"></i></span>Completed
              </a>
            </li>
            <li class="<?php if($page == 'issue' && $subpage =='all') echo 'active'; ?>">
              <a href="<?php echo site_url($module.'/issue/all'); ?>">
              <span class="nav_icon"><i class="fa fa-copy"></i></span>All
              </a>
            </li>
          </ul>
        </li>
        <!-- Application Settins available for admins -->
          <?php if($this->session->userdata['admin_type'] != 0) { ?>
        <li class="dropdown <?php if($page=='settings') echo 'active'; ?>">
          <a id="settings_submenu_button" class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
            <span class="nav_icon"><i class="fa fa-wpforms"></i></span> App
            <i class="fa fa-caret-down pull-right"></i>
          </a>
          <ul class="dropdown-menu" id="settings_submenu" role="menu">
            <li <?php if($page=='managers') echo 'class="active"'; ?>>
              <a href="<?php echo site_url($module.'/manager'); ?>">
                <span class="nav_icon"><i class="fa fa-user"></i></span>
                Managers
              </a>
            </li>
            <li class="<?php if($page == 'settings' && $subpage =='app_settings') echo 'active'; ?>">
              <a href="<?php echo site_url($module.'/settings'); ?>">
              <span class="nav_icon"><i class="fa fa-cogs"></i></span>Settings
              </a>
            </li>
          </ul>
        </li>
          <?php } ?>


        <li class="dropdown">
          <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
            <span class="nav_icon"><i class="fa fa-user"></i></span> <?php echo $this->session->admin_name; ?>
            <i class="fa fa-caret-down pull-right"></i>
          </a>
          <ul class="dropdown-menu" id="settings_submenu" role="menu">
            <li class="<?php if($page == 'sync') echo 'active'; ?>">
              <a href="<?php echo site_url($module.'/sync'); ?>">
              <span class="nav_icon"><i class="fa fa-refresh"></i></span>Sync
              </a>
            </li>
            <li class="">
              <a href="<?php echo site_url($module.'/login/logout'); ?>">
              <span class="nav_icon"><i class="fa fa-sign-out"></i></span>Log Out
              </a>
            </li>
          </ul>
        </li>




      </ul>
    </div>
  </div>
</nav>