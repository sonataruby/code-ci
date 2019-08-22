<div class="media">
  <img src="<?php echo site_url($profile->avatar);?>" class="mr-3" alt="..." style="width: 80px;height: 80px;display: inline-block;overflow: hidden;background: #f3f6f9;border-radius: 50%;">
  
  <div class="media-body">
    <h4><?php echo ucfirst($attr->name);?>
    	<div class="float-right" style="padding-top: 15px;">
			<a class="btn btn-sm btn-outline-info"><i class="fa fa-thumbs-up"></i></a>
			<a class="btn btn-sm btn-outline-info"><i class="fa fa-thumbs-down"></i></a>
		</div>
	</h4>
	<p><i class="fa fa-calendar-alt"></i> <?php echo $attr->updated_date;?> </p>

	
  </div>
</div>