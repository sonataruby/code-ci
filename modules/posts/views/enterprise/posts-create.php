
<?php echo form_open("",["id" => "savedata"]);?>
<input type="hidden" name="channel" value="<?php echo $this->input->get("channel");?>">
<div class="row">
	<div class="col-lg-9 col-sm-12">
		<div class="hbox border">
			
			<?php echo $this->forms->text([
				"name" => "post_title",
				"label" => "Tên bài viết",
				"value" => @$data->name
			],[
				"requied" => true
			]);?>
		</div>
		<div class="hbox border" style="min-height: 70vh;">
			<div id="textarea" name="content"><?php echo (@$data->content ? @$data->content : '<p>Nhập nội dung bài viết</p>');?></div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-12 sticky-top">
		<div class="hbox border">
			<button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Public</button>
			<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Draff</button>
		</div>
		
		<?php 

		echo $this->forms->gallery([
			"name" => "post_image[]",
			"label" => "Thumnail Image",
			"value" => is_string(@$data->image) ? [@$data->image] : @$data->image,
		],["number" => 6, "size" => @config_item("channel")->{$data->channel}->image_size]);?>
		
		<div class="hbox border ">
			<div class="btn-group" role="group" aria-label="Basic example">
			  <button type="button" class="btn btn-primary" onclick="$('.fr-iframe').width('100%');"><i class="fa fa-desktop"></i></button>
			  <button type="button" class="btn btn-primary" onclick="$('.fr-iframe').width('50%');"><i class="fa fa-mobile-alt"></i></button>
			  <button type="button" class="btn btn-primary" onclick="$('.fr-iframe').width('20%');"><i class="fa fa-tablet-alt"></i></button>
			</div>

			<hr>

			<div style="max-height: 180px; overflow:auto; ">
			<?php echo $catalog;?>
			</div>

			<?php echo $this->forms->text([
				"name" => "post_tag",
				"label" => "Page Tag's",
				"value" => @$data->tag
			],[],
			[false, '<div class="input-group-append">
			    <button class="btn btn-outline-secondary" type="button"><i class="fa fa-spinner"></i></button>
			  </div>']
			);?>

			

			

		</div>

		

	</div>
</div>
<?php echo form_close();?>

<?php libs_url('js/exif.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('js/croppie.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('css/croppie.css',['name' => "Font Icoin Picker"]);?>
<?php libs_url('js/bootstrap-iconpicker-iconset-all.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('js/bootstrap-iconpicker.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('css/bootstrap-iconpicker.css',['name' => "Font Icoin Picker"]);?>
<style type="text/css">
	.fr-iframe{
		border:1px solid #ddd;
	}
</style>
<script type="text/javascript">
	function openWindow(obj){
		
		var url = base_url + 'page/' + $(obj).parent().parent().find("input").val() + ".html";
		var win = window.open(url, '_blank');
		if (win) {
		    //Browser has allowed it to be opened
		    win.focus();
		} else {
		    //Browser has blocked it
		    alert('Please allow popups for this website');
		}
	}


</script>
<?php addon("addon/editer",["target" => "#textarea", "form" => "#savedata"]);?>