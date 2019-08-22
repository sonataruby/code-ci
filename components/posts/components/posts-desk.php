<div class="card-deck">
	<?php foreach ($data as $key => $value) { ?>
		
			<div class="card">
			  <div class="card-header-top">
			  <?php echo $this->components->image($value->image,["class" => "card-img-top", "alt" => $value->name]);?>
			  </div>
			  <div class="card-body">
			    <h5 class="card-title"><a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $value->name;?></a></h5>
			   
			    <p class="caregory-item">
			    	<?php echo $value->description;?>
			    </p>
			    
			  </div>
			</div>
	<?php if($key > 0 && $key%4 == 0){ ?>

		</div><div class="card-deck mb-3">
	<?php } ?>
	<?php } ?>
	
</div>
<?php print_r($pages);?>