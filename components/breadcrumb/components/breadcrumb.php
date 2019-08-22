<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo site_url();?>"><i class="fa fa-home"></i></a></li>
    <?php 

    foreach ($data as $key => $value) { 
        
        ?>
    	<?php if($value->catalog_url != '#'){ ?>
    		<li class="breadcrumb-item"><a href="<?php echo catalog_url($value->catalog_url, $value->channel);?>"><?php echo $value->catalog_name;?></a></li>
    	<?php }else{ ?>
    		<li class="breadcrumb-item"><a href="#"><?php echo $value->catalog_name;?></a></li>
    	<?php } ?>
    <?php } ?>
    
    <li class="breadcrumb-item active" aria-current="page"><?php echo $active;?></li>
  </ol>
</nav>