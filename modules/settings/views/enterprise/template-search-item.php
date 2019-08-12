
<div class="row">
	<?php foreach($data as $key => $value){ ?>
	<div class="col-xl-4 col-sm-12 col-md-6">
		<div class="card mb-3">
		  <img src="<?php echo $value->image;?>" class="card-img-top" alt="...">
		  <div class="card-body">
		    <h5 class="card-title"><?php echo $value->name;?></h5>
		    <p class="card-text"><?php echo $value->description;?></p>
		  </div>
		  <ul class="list-group list-group-flush">
		    <li class="list-group-item">Tác giả : <?php echo $value->athour;?></li>
		    <li class="list-group-item">Phiên bản : <?php echo $value->version;?></li>
		    <li class="list-group-item">Định dạng : <?php echo $value->format;?></li>
		  </ul>
		  <div class="card-body">
		    <a href="#" class="card-link"><?php echo $value->price;?> $</a>
		    <a href="/settings/enterprise/template/download/<?php echo $value->hash;?>" class="card-link float-right btn btn-outline-primary btn-sm">Tải về</a>
		  </div>
		</div>
		
	</div>
	<?php } ?>
</div>