<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo site_url();?>">Home</a></li>
    <?php foreach ($data as $key => $value) { ?>
    	<li class="breadcrumb-item"><a href="<?php echo catalog_url($value->catalog_url);?>"><?php echo $value->catalog_name;?></a></li>
    <?php } ?>
    
    <li class="breadcrumb-item active" aria-current="page"><?php echo $active;?></li>
  </ol>
</nav>