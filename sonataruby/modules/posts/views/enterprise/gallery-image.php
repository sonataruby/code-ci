<div class="row">
	<div class="col-lg-9 col-sm-12">
		<div class="hbox">
			<h3>Gallery <button class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">Create gallery</button></h3>
			<div class="row">
				<?php foreach ($data->image as $key => $value) { ?>
					<div class="col-lg-3 col-sm-6 mb-3">
						<div class="card">
						    <img src="https://www.dhresource.com/fc/s009/homepage/062519/990x440_190618_sport.jpg" class="card-img-top" alt="...">
						    <div class="card-body">
						      <h5 class="card-title"><?php echo $value->name;?></h5>
						      <p class="card-text"><a href="/posts/enterprise/gimage/<?php echo $value->id;?>" sn-link="true" parent-controller="#posts" class="btn btn-sm btn-info">Add Image</a> <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModalCenter" data-id="<?php echo $value->id;?>" data-name="<?php echo $value->name;?>">Edit</button></p>
						      
						    </div>
						</div>
					</div>
				<?php } ?>
			</div>


		</div>

	</div>
	<div class="col-lg-3 col-sm-12">
		<div class="hbox">
			<h3>Upload Image</h3>
			<hr>
			<?php echo $this->forms->gallery([
				"name" => "post_image[]",
				"label" => "Thumnail Image",
				"value" => @$data->image
			],[
				"onChange" => "AutoUpload(this);",
				"resize" => "false"
			]);?>
		</div>
		<div class="hbox">
			<h3>Options</h3>
			<hr>
		</div>
	</div>
</div>

<script type="text/javascript">
	var AutoUpload = function(){
		alert("");
	}
</script>