<div class="row d-flex">
	<?php
	$first = array_pop($data);
	?>
	<div class="col-lg-4 col-sm-12 flex-box">
		<div class="card">
		  <div class="card-header-top">
		  <?php echo $this->components->image($first->image,["class" => "card-img-top", "alt" => $first->name]);?>
		  </div>
		  <div class="card-body">
		    <h5 class="card-title"><a href="<?php echo post_url($first->url, $first->channel);?>"><?php echo $first->name;?></a></h5>
		    <p><i class="fa fa-phone fa-1x"></i> <a href="tel:<?php echo config_item("hotline");?>">{hotline}</a></p>
			<p><i class="fa fa-envelope fa-1x"></i> <a href="mailto:{site_email}?subject=Contact">{site_email}</a></p>
			
		    <p>
		    	<?php foreach ($first->catalog as $keyC => $valueC) { ?>
		    		<a class="btn btn-sm btn-outline-info" href="<?php echo catalog_url($valueC->catalog_url, $valueC->channel);?>"><?php echo $valueC->catalog_name;?></a>
		    	<?php }?>
		    </p>
		    <a href="<?php echo post_url($first->url, $first->channel);?>" class="btn btn-primary btn-sm">Xem thêm..</a>
		  </div>
		</div>
	</div>
	<div class="col-lg-8 col-sm-12">
		<div class="row">
			<?php foreach ($data as $key => $value) { ?>
				<div class="<?php echo (@$class ? $class : "col-lg-4 col-sm-12");?> mb-3">
					<div class="card">
					  <div class="card-header-top">
					  <?php echo $this->components->image($value->image,["class" => "card-img-top", "alt" => $value->name]);?>
					  </div>
					  <div class="card-body">
					    <h5 class="card-title"><a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $value->name;?></a></h5>
					    
					  </div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>