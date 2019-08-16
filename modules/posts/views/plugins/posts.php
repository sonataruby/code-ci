<div class="row">
	<?php foreach ($data as $key => $value) { 
		if(@$type == "list"){
			?>
			<div class="<?php echo (@$class ? $class : "col-sm-12");?> mb-3">
				<div class="media">
					<div class="size64 mr-3">
					  <?php echo $this->components->image($value->image,["class" => "w-100", "alt" => $value->name]);?>
					</div>
				  <div class="media-body">
				    <h5 class="mt-0"><a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $value->name;?></a></h5>
				    
				  </div>
				</div>
			</div>
			<?php
		}else{
		?>
		<div class="<?php echo (@$class ? $class : "col-lg-3 col-sm-12");?> mb-3">
			<div class="card">
			  <div class="card-header-top">
			  <?php echo $this->components->image($value->image,["class" => "card-img-top", "alt" => $value->name]);?>
			  </div>
			  <div class="card-body">
			    <h5 class="card-title"><a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $value->name;?></a></h5>
			    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			    <p>
			    	<?php foreach ($value->catalog as $keyC => $valueC) { ?>
			    		<a class="btn btn-sm btn-outline-info" href="<?php echo catalog_url($valueC->catalog_url, @$valueC->channel);?>"><?php echo $valueC->catalog_name;?></a>
			    	<?php }?>
			    </p>
			    <a href="#" class="btn btn-link">More..</a>
			  </div>
			</div>
		</div>
	<?php 
		}
	} ?>
</div>
<style type="text/css">
	.size64{
		width: 40%;
	}
</style>