<ul class="<?php echo (@$attr["class"] ? $attr["class"] : "navbar-nav form-inline my-2 my-lg-0");?>">
  <?php if(isset($data->account_id)){ ?>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     <img src="<?php echo site_url($data->avatar);?>" class="img-fluid rounded-circle" style="max-width: 32px;">
     Hi! <?php echo $data->firstname;?> <?php echo $data->lastname;?>
   </a>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <li class="dropdown-item"><a href="/account/personal/profile"><i class="fa fa-user-circle"></i> {lang_profile}</a></li>
        <li class="dropdown-item"><a href="/account/personal/changepass"><i class="fa fa-key"></i> {lang_changepass}</a></li>


        <?php if(@$data->account_type == "enterprise"){ ?>
            <li class="dropdown-item"><a href="/enterprise"><i class="fa fa-user-shield"></i> {lang_admin_panel}</a></li>
        <?php } ?>

        <?php if(@$data->account_type == "personal"){ ?>
            <li class="dropdown-item"><a href="/personal">Administrator</a></li>
        <?php } ?>

        <li class="dropdown-item"><a href="/account/logout"><i class="fa fa-lock"></i> {lang_logout}</a></li>
    </ul>
  </li>
<?php }else{ ?>
  <li class="nav-item mr-2">
    <a href="/account/register" title="Register account" class="btn btn-sm btn-outline-primary">{lang_register}</a>
  </li>

  <li class="nav-item">
    <a href="/account/login" title="Login Panel" class="btn btn-sm btn-primary">{lang_login}</a>
  </li>
<?php } ?>
</ul>