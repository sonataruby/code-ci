<?php
$randomID = "Slider".random_string('alnum', 16);
if(is_array($data)){ ?>
<div id="<?php echo $randomID;?>" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  	<?php foreach ($data as $key => $value) { ?>
    <li data-target="#<?php echo $randomID;?>" data-slide-to="<?php echo $key;?>" class="<?php echo ($key==0 ? "active" : "");?>"></li>
    <?php } ?>
    
  </ol>
 <div class="carousel-inner">
<?php foreach ($data as $key => $value) { ?>
		<div class="carousel-item <?php echo ($key==0 ? "active" : "");?>">
	      <img src="<?php echo site_url($value);?>" <?php echo _attributes_to_string($attr);?>>
	    </div>
<?php } ?>
</div>
  <a class="carousel-control-prev" href="#<?php echo $randomID;?>" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#<?php echo $randomID;?>" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<?php }else{ ?>
  <div class="carousel">
	   <img src="<?php echo site_url($data);?>" <?php echo _attributes_to_string($attr);?>/>
  </div>
<?php } ?>

  