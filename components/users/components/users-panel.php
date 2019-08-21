<?php print_r($data);?>
<ul class="navbar-nav form-inline my-2 my-lg-0">
  <?php if(is_login()){ ?>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Account</a>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
      <?php echo $usermenu;?>
    </ul>
  </li>
<?php }else{ ?>
  <li class="nav-item mr-2">
    <a href="/account/register" title="Register account" class="btn btn-sm btn-outline-primary">Register</a>
  </li>

  <li class="nav-item">
    <a href="/account/login" title="Login Panel" class="btn btn-sm btn-primary">Login</a>
  </li>
<?php } ?>
</ul>