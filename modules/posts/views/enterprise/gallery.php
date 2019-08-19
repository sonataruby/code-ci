<div class="row">
	<div class="col-sm-12">
		<div class="hbox">
			<h3>Gallery <button class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">Create gallery</button></h3>
			<hr>
			<div class="row">
				<?php foreach ($data as $key => $value) { 
					
					$first = new stdClass;
					$first->image_url = "/libs/image/nophoto.jpg";
					if($value->image){
						$first = array_pop($value->image);
					}
					?>
					<div class="col-lg-3 col-sm-6 mb-3">
						<div class="card">
						    <img src="<?php echo site_url($first->image_url);?>" class="card-img-top" alt="...">

						    <div class="card-body">
						      <h5 class="card-title"><?php echo $value->name;?></h5>
						      <p class="card-text">
						      	<a href="/posts/enterprise/gallery/gimage/<?php echo $value->id;?>" parent-controller="#posts" class="btn btn-sm btn-info"><i class="fa fa-images"></i> Thêm</a> 
						      	<button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter" data-id="<?php echo $value->id;?>" data-name="<?php echo $value->name;?>" data-tags="<?php echo $value->tags;?>"><i class="fa fa-edit"></i> Sửa</button>
						      	<a href="/posts/enterprise/gallery/delete/<?php echo $value->id;?>" parent-controller="#posts" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Xóa</a> 
						      </p>
						      
						    </div>
						</div>
					</div>
				<?php } ?>
			</div>


		</div>

		<div class="hbox">
			<h3>New Image</h3>
			<div class="row">
				
					<?php foreach ($news as $key => $value) { ?>
					<div class="col-lg-2 flex-box mb-3" id="item-<?php echo $value->image_id;?>">
						<div class="card card-body">
						<img src="<?php echo site_url($value->image_url);?>" title="<?php echo $value->image_name;?>" class="w-100">
						
						</div>
					</div>
				<?php } ?>
				
			</div>
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
        <form action="/posts/enterprise/gallery/create" method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Gallery Name</label>
            <input type="text" name="gallery_name" class="form-control name" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tag's</label>
            <input type="text" name="tags" class="form-control tags" id="recipient-name">
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
		$('#exampleModalCenter').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var recipient = button.data('name'); // Extract info from data-* attributes
		  var tags = button.data('tags');
		  var id = button.data('id');
		  var url = $(".modal-body form").attr("action");
		  $(".modal-body form").attr("action",url + "/"+id);
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title').text('Gallery - ' + recipient)
		  modal.find('.modal-body input.name').val(recipient);
		  modal.find('.modal-body input.tags').val(tags);

		});

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