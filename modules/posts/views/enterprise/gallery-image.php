<div class="row">
	<div class="col-lg-9 col-sm-12">
		<div class="hbox">
			<h3>Gallery - <?php echo $data->name;?> <a class="btn btn-primary float-right" href="/posts/enterprise/gallery">Back gallery</a></h3>
			<hr>
			<div class="showgallery">
				
			</div>


		</div>
		
		

	</div>
	<div class="col-lg-3 col-sm-12">
		<div class="hbox border">
			<div id="myId" class="dropzone"></div> 
		</div>
		<div class="hbox border">
			<h4>Tools</h4>
			<hr>
			<div class="form-group">
			    <label for="exampleInputPassword1">Resize to</label>
			    <input type="text" class="form-control" id="imageResize" value="650x420" placeholder="Enter Size : 650x320">
			</div>
			<button type="button" onClick="window.location.href='/posts/enterprise/gallery/rsizeimage/<?php echo $data->id;?>/'+$('#imageResize').val();" class="btn btn-primary">Resize All</button>
		</div>

	</div>
</div>
<?php echo libs_url("css/dropzone.css");?>

<?php echo libs_url("js/dropzone.js");?>
<?php libs_url("js/jquery-ui.js");?>
<style type="text/css">
	.dropzone{
		border:1px solid #ddd;
		font-size: 24px;
	}
</style>
<script type="text/javascript">
	


		var queryItem = function(){
			$(".showgallery").load("/posts/enterprise/gallery/vimage/gallery/<?php echo $data->id;?>", function(){
				$("[data-remove]").on("click", function(){

					$.get("/posts/enterprise/gallery/vimage/gallery/<?php echo $data->id;?>?remove="+$(this).attr("data-remove"));
					$(this).parent().parent().remove();
				});

				$('#element').sortable({
				    update: function (event, ui) {
				        var data = $(this).sortable('serialize');

				        // POST to server using $.post or $.ajax
				        $.ajax({
				            data: data,
				            type: 'POST',
				            url: '/posts/enterprise/gallery/sortimage'
				        });
				    }
		        });
			});
		}

		queryItem();
	Dropzone.autoDiscover = false;
	$(document).ready(function(){
		new Dropzone("div#myId", { 
			url: "/settings/enterprise/uploads/image/gallery/<?php echo $data->id;?>/", 
			paramName: "userfile",
			success : function(){
				queryItem();
			}
		});
	});
</script>

