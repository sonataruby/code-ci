<?php echo form_open();?>
<div class="hbox">
	<h4>Header Settings <button type="submit" class="btn btn-primary float-right">Save</button></h4>
	
</div>

<div class="hbox">
	
	<h5>Header</h5>
	<?php echo $this->forms->radio([
		"name" => "config[sticky_header]",
		"label" => "Navbar Sticky",
		"value" => @$data->sticky_header,
		"options" => [["label" => "None", "value" => ""],["label" => "Sticky", "value" => "sticky-top"],["label" => "Fixed Top", "value" => "fixed-top"]]
	],["group" => 'row', "layout" => 'inline']);?>


	

	
	<?php echo $this->forms->select([
		"name" => "config[header_color]",
		"label" => "Navbar Style",
		"value" => @$data->header_color,
		"options" => [
			"bg-none" => "None",
			"bg-dark" => "Dark", 
			"bg-light" => "Light", 
			"bg-primary" => "Primary",
			"bg-info" => "Info",
			"bg-success" => "Success",
			"bg-danger" => "Danger",
			"bg-warning" => "Yellow"
		]
	],["group" => 'row', "layout" => 'inline']);?>

	<?php echo $this->forms->select([
		"name" => "config[header_style]",
		"label" => "Navbar Style",
		"value" => @$data->header_style,
		"options" => ["navbar-light" => "Light", "navbar-dark" => "Dark"]
	],["group" => 'row', "layout" => 'inline']);?>

	<?php echo $this->forms->checkbox([
		"name" => "config[scrolmenu]",
		"label" => "Scrol Menu ",
		"value" => @$data->scrolmenu,
		"options" => [["label" => "On/Off", "value" => "data-scrolmenu"]]
	],["group" => 'row', "layout" => 'inline']);?>


	<?php echo $this->forms->text([
		"name" => "config[scrolmenu_class]",
		"label" => "Scrol Menu ",
		"value" => (@$data->scrolmenu_class ? @$data->scrolmenu_class : "animated bounceDown")
	],["group" => 'row', "layout" => 'inline']);?>


	<?php echo $this->forms->checkbox([
		"name" => "config[shadown]",
		"label" => "Shadown Menu ",
		"value" => @$data->shadown,
		"options" => [["label" => "On/Off", "value" => "bg-shadown"]]
	],["group" => 'row', "layout" => 'inline']);?>


</div>
<?php echo form_close();?>