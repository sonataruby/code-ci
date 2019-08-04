<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  	<?php foreach ($item as $key => $value) { ?>
    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key;?>" class="<?php echo ($key == 0 ? "active" : "");?>"></li>
    <?php } ?>
    
  </ol>
  <div class="carousel-inner">
  	<?php foreach ($item as $key => $value) { ?>
  		<div class="carousel-item <?php echo ($key == 0 ? "active" : "");?>">
	      <img src="<?php echo $value->image;?>" class="d-block w-100" alt="...">
	      <?php if(isset($value->content)){ ?>
	      		<div class="carousel-caption d-none d-md-block">
		          <?php echo $value->content;?>
		        </div>
	      <?php } ?>
	    </div>
  	<?php } ?>
    
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

