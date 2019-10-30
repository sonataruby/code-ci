<?php
$config = config_item("header");
?>
  
<header class="app-header">
  <div class="<?php echo @$config->shadown;?> <?php echo @$config->sticky_header;?> <?php echo (@$config->header_color ? $config->header_color : "bg-light");?>" <?php echo @$config->scrolmenu;?> data-active-class="<?php echo @$config->scrolmenu_class;?> animated fixed-top go" data-target="_parent">
    <div class="container">
      <nav class="navbar navbar-theme navbar-expand-lg <?php echo (@$config->header_style ? $config->header_style : "navbar-light");?>">
        <button class="navbar-toggler" type="button" data-mobile="left" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="<?php echo site_url();?>"><?php echo (config_item("navbar_icon") ? '<img src="'.site_url(config_item("navbar_icon")).'" class="d-inline-block max-height" alt="'.config_item("site_name").'"/> ' : "");?><?php echo config_item("site_navbar");?></a>
        <button class="navbar-toggler" type="button" data-mobile="right" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <?php print_r($this->menu_model->getDropdown());?>
          

          <?php $this->components->users("panel");?>
        </div>
      </nav>
    </div>
</div>
</header>


<style type="text/css">
@media (min-width: 992px) {
  .navbar-nav > li > a.nav-link{
    line-height : var(--builder-top-nav);
  }
  <?php 
  if(is_home()){
  if((@$config->sticky_header == "fixed-top" || @$config->scrolmenu) && @$config->fixheight == "true"){?>
  body{
    margin-top:var(--builder-top-nav);
  }
<?php }
  }else{
    if((@$config->sticky_header == "fixed-top" || @$config->scrolmenu) && @$config->fixheight == "true"){
      ?>
      body{
        margin-top:var(--builder-top-nav);
      }
      <?php
    }
  }
?>
}
</style>