
<div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <?php if(is_array($attr["data"])){ 
        foreach ($attr["data"] as $key => $value) {
          
      ?> 
      <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $key;?>" <?php echo ($key == 0 ? 'class="active"' : "");?>></li>
      <?php } ?>
     <?php } ?>
      
    </ol>
    <div class="carousel-inner" style="<?php echo (@$attr["css"] ? $attr["css"] : "");?>">
      <?php if(is_array($attr["data"])){ 
        foreach ($attr["data"] as $key => $value) {
          
      ?> 
      <div class="carousel-item <?php echo ($key == 0 ? 'active' : "");?>">
        <img src="<?php echo @$attr["server"];?><?php echo @$value->image;?>" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5><?php echo @$value->name;?></h5>
          <p><?php echo @$value->description;?></p>
        </div>
      </div>
    <?php } ?>
     <?php } ?>
      
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>