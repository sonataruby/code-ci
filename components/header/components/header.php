<?php
$config = config_item("header");
?>
<header class="app-header">
  <div class="<?php echo @$config->shadown;?> <?php echo @$config->sticky_header;?> <?php echo (@$config->header_color ? $config->header_color : "bg-light");?>" <?php echo @$config->scrolmenu;?> data-activeclass="<?php echo @$config->scrolmenu_class;?>">
    <div class="container">
      <nav class="navbar navbar-theme navbar-expand-lg <?php echo (@$config->header_style ? $config->header_style : "navbar-light");?>">
        <a class="navbar-brand" href="<?php echo site_url();?>"><?php echo (config_item("navbar_icon") ? '<img src="'.site_url(config_item("navbar_icon")).'" class="d-inline-block max-height" alt="'.config_item("site_name").'"/> ' : "");?><?php echo config_item("site_navbar");?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <?php print_r($menu);?>
          

          <?php $this->components->users("panel");?>
        </div>
      </nav>
    </div>
</div>
</header>
<?php if(@$config->sticky_header == "fixed-top"){
?>
<div class="psFixHeight"></div>
<?php
}?>

<style type="text/css">
  .navbar-nav > li > a.nav-link{
    line-height : <?php echo @$config->height;?>px;
  }
  .psFixHeight{
    height : <?php echo (@$config->height + 15);?>px;
  }
</style>