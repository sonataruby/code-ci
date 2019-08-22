<div class="row">
	<?php foreach ($data as $key => $value) { ?>
		<div class="col-lg-3 col-sm-12 mb-3 flex-box">
			<div class="card">
			  <div class="card-header-top">
			  <?php echo $this->components->image($value->image,["class" => "card-img-top", "alt" => $value->name]);?>
			  </div>
			  <div class="card-body">
			    <h5 class="card-title"><a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $value->name;?></a></h5>
			   
			    <p class="caregory-item">
			    	<?php foreach ($value->catalog as $keyC => $valueC) { ?>
			    		<a class="btn btn-sm btn-outline-info" href="<?php echo catalog_url($valueC->catalog_url, @$valueC->channel);?>"><?php echo $valueC->catalog_name;?></a>
			    	<?php }?>
			    </p>
			    <a href="#" class="btn btn-link btn-more">More..</a>
			  </div>
			</div>
		</div>
	<?php } ?>
	
</div>