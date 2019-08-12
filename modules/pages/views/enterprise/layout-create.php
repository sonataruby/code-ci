
<?php echo form_open("",["id" => "savedata"]);?>
<div class="row">
	<div class="col-lg-9 col-sm-12">
		<div class="hbox border">
			<?php echo $this->forms->text([
				"name" => "layout_name",
				"label" => "Layout Name",
				"value" => @$data->name
			],[
				"requied" => true
			]);?>
			
		</div>
		

		<div class="hbox" style="position: relative;">
			<div>
				

				<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				  

				  <div class="btn-group" role="group">
				    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				      Layout
				    </button>
				    <div class="dropdown-menu tools_desktop" aria-labelledby="btnGroupDrop1">
				      <a class="dropdown-item" href="#">Dropdown link</a>
				      <a class="dropdown-item" href="#">Dropdown link</a>
				    </div>
				  </div>
				</div>

				<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				  

				  <div class="btn-group" role="group">
				    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				      Block
				    </button>
				    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
				      <a class="dropdown-item" href="#">Dropdown link</a>
				      <a class="dropdown-item" href="#">Dropdown link</a>
				    </div>
				  </div>
				</div>


				<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				  

				  <div class="btn-group" role="group">
				    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				      Image
				    </button>
				    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
				      <a class="dropdown-item" href="#">Dropdown link</a>
				      <a class="dropdown-item" href="#">Dropdown link</a>
				    </div>
				  </div>
				</div>


				<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				  

				  <div class="btn-group" role="group">
				    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				      Plugin & Wingets
				    </button>
				    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
				    	<?php foreach (config_item("plugins") as $key => $value) { ?>
				    		<a class="dropdown-item" data-item="text" data-append='[plugin name="<?php echo $key;?>"][/plugin]'><?php echo $value;?></a>
				    	<?php } ?>
				      
				      
				    </div>
				  </div>
				</div>

				<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				  

				  <div class="btn-group" role="group">
				    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				      Animated
				    </button>
				    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
				      <a class="dropdown-item"  data-item="animated" data-append="bounceIn">bounceIn</a>
				      <a class="dropdown-item"  data-item="animated" data-append="bounceInRight">bounceInRight</a>
				    </div>
				  </div>
				</div>

				

			</div>
		</div>
		<div class="border" style="min-height: 70vh;">
			<textarea id="textarea" rows="32" class="form-control" name="content"><?php echo @$data->content;?></textarea>
		</div>
	</div>
	<div class="col-lg-3 col-sm-12 sticky-top">
		<div class="hbox border">
			<button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Public</button>
			<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Draff</button>
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
addon("addon/codemirror",["target" => "#textarea", "form" => "#savedata", "tools" => "true", "libs" => "default", "tools_desktop" => ".tools_desktop"]);

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
