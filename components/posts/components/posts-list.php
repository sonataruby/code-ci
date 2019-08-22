<div class="post-list">
	<?php foreach ($data as $key => $value) { ?>
		
		<div class="media mb-3">
		  	<div class="card-header-top mr-3" style="max-width: 180px;">
			  <?php echo $this->components->image($value->image,["class" => "card-img-top", "alt" => $value->name]);?>
			</div>
		  <div class="media-body">
		    <h5 class="mt-0"><a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $value->name;?></a></h5>
		    <p> <?php foreach ($value->catalog as $keyC => $valueC) { ?>
			    		<a class="btn btn-sm btn-outline-info" href="<?php echo catalog_url($valueC->catalog_url, @$valueC->channel);?>"><?php echo $valueC->catalog_name;?></a>
			    <?php }?>
			</p>
		  </div>
		</div>
	<?php } ?>
	
</div>

<?php print_r($pages);?>