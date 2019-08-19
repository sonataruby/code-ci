<div class="row" id="element">
	<?php foreach ($data as $key => $value) { ?>
		<div class="col-lg-3 flex-box mb-3" id="item-<?php echo $value->image_id;?>">
			<div class="card card-body">
			<img src="<?php echo site_url($value->image_url);?>" title="<?php echo $value->image_name;?>" class="w-100"><p><i class="fa fa-images"></i> <?php echo $value->image_name;?></p>
			<div style="position: absolute; top:0; right:0; padding:15px; background:#FFF;"><a><i class="fa fa-expand"></i></a> <a data-remove="<?php echo basename($value->image_url);?>"><i class="fa fa-trash"></i></a></div>
			</div>
		</div>
	<?php } ?>
	
</div>