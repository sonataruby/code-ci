<?php
$config = config_item("header");
?>
<div class="topbar bg-light">
  <div class="container">
    Welcome you back
  </div>
</div>
<header class="app-header">
  <div class="<?php echo @$config->shadown;?> <?php echo @$config->sticky_header;?> <?php echo (@$config->header_color ? $config->header_color : "bg-light");?>" <?php echo @$config->scrolmenu;?> data-active-class="<?php echo @$config->scrolmenu_class;?> animated fixed-top go" data-target="_parent">
    <div class="container">
      <nav class="navbar navbar-theme navbar-expand-lg justify-content-between <?php echo (@$config->header_style ? $config->header_style : "navbar-light");?>">
        <button class="navbar-toggler" type="button" data-mobile="left" data-html="#navbarSupportedContent" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="<?php echo site_url();?>"><?php echo (config_item("navbar_icon") ? '<img src="'.site_url(config_item("navbar_icon")).'" class="d-inline-block max-height" alt="'.config_item("site_name").'"/> ' : "");?><?php echo config_item("site_navbar");?></a>
        <button class="navbar-toggler" type="button" data-mobile="right" data-html="#navbarSupportedContent" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">

          <form class="form-inline my-2 my-lg-0 mr-auto">
            <input class="form-control mr-sm-2" style="min-width: 450px;" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>

          
          

          <?php $this->components->users("panel",["class" => "navbar-nav"]);?>

        </div>
      </nav>
      
    </div>

    <div class="bg-info">
        <div class="container">
          <div id="navbarSupportedContent">
            <?php print_r($this->menu_model->getDropdown(false,["class" => "nav"]));?>
          </div>
        </div>
    </div>

</div>

</header>
<style type="text/css">
  #navbarSupportedContent .fa-icon{
    display: block;
    font-size: 32px;
    text-align: center;
  }
  #navbarSupportedContent .nav > li.active{
    background:red;
    color:#FFF;
  }
  #navbarSupportedContent .nav > li.active a{
    color:#FFF;
  }
  .nav-breadcrumb{
    background-color: red;
    color:#FFF;
  }
  .nav-breadcrumb a{
    color: #FFF;
  }
</style>