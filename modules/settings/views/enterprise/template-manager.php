<div class="hbox">
	<h4>Template Active <a class="btn btn-primary float-right" href="/settings/enterprise/template/search" sn-link="true" parent-controller="#apps">Search Apps</a></h4>
	<hr>
	<div class="row">
		
		<div class="col-xl-4 col-sm-12 col-md-6">
			<div class="card mb-3">
			  <img src="<?php echo site_url("template/".config_item("template")."/banner.jpg");?>" class="card-img-top" alt="...">
			  
			</div>
			
		</div>
		<div class="col-xl-8 col-sm-12 col-md-6">
			<div class="card mb-3">
			  
			  <div class="card-body">
			    <h5 class="card-title"><?php echo $data->name;?></h5>
			    <p class="card-text"><?php echo ucfirst($data->description);?></p>
			     <p><a href="/settings/enterprise/template/css" class="btn btn-outline-primary btn-sm">Điều chỉnh CSS</a> </p>
			  </div>
			  
			</div>
			
		</div>
	</div>

</div>

<div class="hbox">
	<h4>Template on Location</h4>
	<div class="row">
		<?php foreach($location as $key => $value){ ?>
		<div class="col-xl-4 col-sm-12 col-md-6">
			<div class="card mb-3">
			  <img src="<?php echo site_url("template/{$key}/banner.jpg");?>" class="card-img-top" alt="...">
			  <div class="card-body">
			    <h5 class="card-title"><?php echo ucfirst($value->name);?></h5>
			    <p class="card-text"><?php echo ucfirst($value->description);?></p>
			  </div>
			  <ul class="list-group list-group-flush">
			    <li class="list-group-item">Tác giả : <?php echo $value->athour;?></li>
			    <li class="list-group-item">Phiên bản : <?php echo $value->version;?></li>
			    <li class="list-group-item">Định dạng : <?php echo $value->format;?></li>

			  </ul>
			  <div class="card-body">
			    <a href="#" class="card-link"><?php echo $value->create;?></a>
			    <a href="/settings/enterprise/template/install/<?php echo $key;?>" class="card-link float-right btn btn-outline-primary btn-sm">Cài đặt</a>
			  </div>
			</div>
			
		</div>
		<?php } ?>
	</div>
</div>