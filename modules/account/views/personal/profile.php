<?php libs_url('js/admin.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('js/exif.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('js/croppie.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('css/croppie.css',['name' => "Font Icoin Picker"]);?>
<?php echo form_open();?>
<div class="hbox">
	<h3>Profile</h3>
</div>

<div class="hbox">
	
	<?php echo $this->forms->upload([
		"name" => "config[avatar][]",
		"label" => "Avatar",
		"value" => @$data->avatar
	],[
		"requied" => true,
		"group" => 'row',
		"layout" => "inline",
		"size" => "480x480"
	]);?>

	<?php echo $this->forms->address([
		"name" => "config",
		"value" => @$data
	],[
		"requied" => true
	]);?>
	<button type="submit" class="btn btn-primary">Save</button>
</div>
<?php echo form_close();?>