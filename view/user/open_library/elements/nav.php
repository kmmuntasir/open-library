<nav class="navbar navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="nav_icon"><i class="fa fa-align-justify"></i></span>
      </button>
      <a class="navbar-brand" href="#">IST Library</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
      <!-- --
        <li <?php if($page=='dashboard') echo 'class="active"'; ?>>
          <a href="<?php echo site_url($module.'/dashboard'); ?>">
            <span class="nav_icon"><i class="fa fa-dashboard"></i></span>
            Dashboard
          </a>
        </li>
      <!-- -->
        <li <?php if($page=='categories') echo 'class="active"'; ?>>
          <a href="<?php echo site_url($module.'/category'); ?>">
            <span class="nav_icon"><i class="fa fa-align-left"></i></span>
            Cateogries
          </a>
        </li>
        <li <?php if($page=='authors') echo 'class="active"'; ?>>
          <a href="<?php echo site_url($module.'/author'); ?>">
            <span class="nav_icon"><i class="fa fa-users"></i></span>
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
        <li <?php if($page=='book_copy') echo 'class="active"'; ?>>
          <a href="<?php echo site_url($module.'/book/copy'); ?>">
            <span class="nav_icon"><i class="fa fa-file"></i></span>
            Book Copy
          </a>
        </li>
        <li class="dropdown <?php if($page=='issue') echo 'active'; ?>">
          <a class="dropdown-toggle" id="issue_nav_button" href="#" data-toggle="dropdown" aria-expanded="false" role="button" aria-haspopup="true">
            <span class="nav_icon"><i class="fa fa-credit-card-alt"></i></span> My Issues
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
        <li class="dropdown <?php if($page=='user') echo 'active'; ?>">
          <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false" role="button" aria-haspopup="true">
            <span class="nav_icon"><i class="fa fa-user"></i></span> User
            <i class="fa fa-caret-down pull-right"></i>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li class="<?php if($page == 'profile') echo 'active'; ?>">
              <a href="<?php echo site_url($module.'/profile'); ?>">
              <span class="nav_icon"><i class="fa fa-list"></i></span> Profile
              </a>
            </li>
            <li class="">
              <a href="<?php echo site_url($module.'/login/logout'); ?>">
              <span class="nav_icon"><i class="fa fa-sign-out"></i></span> Logout
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>