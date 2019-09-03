
<?php echo form_open("",["id" => "savedata","target" => "IF_savedata"]);?>
<div class="row">
	<div class="col-lg-9 col-md-12">
		
		
		<div class="border" style="min-height: 70vh;">
			<div id="content" rows="32" name="content"><?php echo str_replace(['<?php','?>'], ['&lt;?php','?a&gt;'], @$data->content);?></div>
		</div>
	</div>
	<div class="col-lg-3 col-md-12 sticky-top">
		<div class="hbox border">
			<?php echo $this->forms->text([
				"name" => "layout_name",
				"label" => "Layout Name",
				"value" => @$data->name
			],[
				"requied" => true,
			]);?>
			<br>
			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Public</button>
			<?php if(@$data->id){?>
				<a href="/pages/layout/builder/<?php echo @$data->id;?>" class="btn btn-warning"><i class="fa fa-save"></i> Design Tools</a>
			<?php } ?>
		</div>
		<div class="">
			<?php echo $this->forms->gallery([
				"name" => "layout_image[]",
				"label" => "Page Layout",
				"value" => @$data->image
			],[]);?>
		</div>
		

		<div class="hbox border">
			<h3>SEO Panel</h3>
			<?php echo $this->forms->text([
				"name" => "layout_url",
				"label" => "Layout URL",
				"value" => @$data->url
			],[],[false, '<div class="input-group-append">
			    <button class="btn btn-primary" type="button" onclick="openWindow(this);"><i class="fa fa-external-link-alt"></i></button>
			  </div>']);?>

			<?php echo $this->forms->textarea([
				"name" => "layout_keyword",
				"label" => "Page Keyword",
				"value" => @$data->keyword
			],[
				"rows" => 2
			]);?>


			<?php echo $this->forms->textarea([
				"name" => "layout_description",
				"label" => "Page Description",
				"value" => @$data->description
			],["rows" => 2]);?>

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
<?php
addon("addon/editer",["target" => "#content", "form" => "#savedata", "tools" => "true", "libs" => "default", "tools_desktop" => ".tools_desktop"]);

?>

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
<iframe id="IF_savedata" name="IF_savedata" style="border:0px; height: 1px; width: 1px; margin-top: -1000vh;"></iframe>