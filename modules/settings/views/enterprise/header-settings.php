<div class="hbox">
	<h4>Header Settings <button type="submit" class="btn btn-primary float-right">Save</button></h4>
</div>

<div class="hbox">
	
	<h5>Header</h5>
	<?php echo $this->forms->checkbox([
		"name" => "config[sticky_header]",
		"label" => "Navbar Sticky",
		"value" => @$data->sticky_header,
		"options" => [["label" => "Sticky", "value" => "1"]]
	],["inline" => "false", "group" => true]);?>


	<?php echo $this->forms->checkbox([
		"name" => "config[fixed_header]",
		"label" => "Navbar Fixed",
		"value" => @$data->fixed_header,
		"options" => [["label" => "Sticky", "value" => "1"]]
	],["inline" => "false", "group" => true]);?>


	<?php echo $this->forms->select([
		"name" => "config[fixed_header]",
		"label" => "Navbar Style",
		"value" => @$data->fixed_header,
		"options" => [["label" => "Sticky", "value" => "1"]]
	],["group" => true]);?>

</div>