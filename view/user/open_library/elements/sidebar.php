<ul class="nav nav-sidebar">
  <li <?php if($page=='dashboard') echo 'class="active"'; ?>>
    <a href="<?php echo site_url($module.'/dashboard'); ?>">
      <span class="nav_icon"><i class="fa fa-dashboard"></i></span>
      Dashboard
    </a>
  </li>
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
  <li <?php if($page=='issue') echo 'class="active"'; ?>>
    <a id="issue_nav_button" href="#" data-toggle="collapse" data-target="#issue_submenu" aria-expanded="false">
      <span class="nav_icon"><i class="fa fa-credit-card-alt"></i></span> Issue
      <i class="fa fa-caret-down pull-right"></i>
    </a>
    <ul class="nav collapse" id="issue_submenu" role="menu">
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
</ul>