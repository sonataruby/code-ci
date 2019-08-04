<?php libs_url('js/exif.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('js/croppie.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('css/croppie.css',['name' => "Font Icoin Picker"]);?>
<?php echo form_open();?>
<div class="hbox">
	<h4>Config system <button type="submit" class="btn btn-primary float-right">Save</button></h4>
</div>

<div class="hbox">
	
	<?php 
	//$this->forms->template("inline");
	echo $this->forms->text([
		"name" => "config[site_name]",
		"label" => "Site Name",
		"value" => @$data->site_name
	],[
		"required" => true,
		"group" => 'row',
		"layout" => "inline"
	]);?>



	<?php echo $this->forms->textarea([
		"name" => "config[site_description]",
		"label" => "Description",
		"value" => @$data->site_description
	],[
		"required" => true,
		"group" => 'row',
		"layout" => "inline",
		"rows" => 2
	]);?>


	<?php echo $this->forms->textarea([
		"name" => "config[site_keyword]",
		"label" => "Keyword",
		"value" => @$data->site_keyword
	],[
		"required" => true,
		"group" => 'row',
		"layout" => "inline",
		"rows" => 2
	]);?>

	<h4>Image Info</h4>
	<?php echo $this->forms->upload([
		"name" => "config[icon][]",
		"label" => "Icon",
		"value" => @$data->icon
	],[
		"requied" => true,
		"group" => 'row',
		"layout" => "inline",
		"size" => "512x512"
	]);?>

	<?php echo $this->forms->upload([
		"name" => "config[logo][]",
		"label" => "Logo",
		"value" => @$data->logo
	],[
		"requied" => true,
		"group" => 'row',
		"layout" => "inline",
		"size" => "100x100"
	]);?>

	<?php echo $this->forms->upload([
		"name" => "config[banner][]",
		"label" => "banner",
		"value" => @$data->banner
	],[
		"requied" => true,
		"group" => 'row',
		"layout" => "inline",
		"size" => "640x420"
	]);?>

	<h4>Contact Infomation</h4>
	<?php echo $this->forms->contact([
		"name" => "config",
		"value" => @$data
	],[
		"requied" => true
	]);?>
	<button type="submit" class="btn btn-primary">Save</button>
	


	

</div>
<?php echo form_close();?>