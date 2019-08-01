<div class="row">
	<div class="col-lg-9 col-sm-12">
		<div class="hbox">
			<h3>Gallery <button class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">Create gallery</button></h3>
			<div class="row">
				<?php foreach ($data as $key => $value) { ?>
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

		<div class="hbox">
			<h3>New Image</h3>
		</div>
	</div>
	<div class="col-lg-3 col-sm-12">
		<div class="hbox">
			<h3>Upload Image</h3>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Gallery Manager</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/posts/enterprise/gallery" method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Gallery Name</label>
            <input type="text" name="gallery_name" class="form-control" id="recipient-name">
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btnsavegallery" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function(){
		$(".btnsavegallery").bind("click", function(){
		 	$(".modal-body form").submit();
		});
		$(".modal-body form").bind("submit", function(){
			var url = $(this).attr("action");
			var data = $(".modal-body form").serialize();
			
			$.ajax({
		        url: url,
		        type: "post",
		        data: data,
		        success: function (response) {

		           window.location.href= "#/posts/enterprise/gallery/" + response.id;
		           
		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
		    });

		    return false;
		});
	});
</script>