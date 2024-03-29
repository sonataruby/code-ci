<ul class="<?php echo (@$attr["class"] ? $attr["class"] : "navbar-nav form-inline my-2 my-lg-0");?>">
  <?php foreach ((Array)config_item("language_list") as $key => $value) { 
      if($value->status == 1){
      ?>
      <li class="nav-item nav-lang"><a href="?language=<?php echo $value->folder;?>" title="<?php echo $value->name;?>" class="<?php echo (config_item("language") == $value->folder ? "text-danger active-languge" : "");?>"><?php echo $value->tags;?></a> </li>

  <?php }
      }
  ?>
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
<style type="text/css">
  li.nav-lang{
    margin-right: 5px;
  }
  li.nav-lang a{
    border-right: 1px dotted #ddd; 
    padding-right:5px;
   
  }
  .navbar-nav .nav-lang:last-child a{
    
    border-right-width: 0px !important;
  }
</style>