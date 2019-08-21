<?php echo form_open();?>
<div class="hbox">
	<h3>{lang_changepass}</h3>
</div>

<div class="hbox">
	
	<?php echo $this->forms->text([
		"name" => "old_password",
		"label" => "Old Password",
		"value" => ''
	],[
		"requied" => true,
		"group" => 'row',
		"layout" => "inline",
		"type" => "password"
	]);?>

	<?php echo $this->forms->text([
		"name" => "new_password",
		"label" => "New Password",
		"value" => ''
	],[
		"requied" => true,
		"group" => 'row',
		"layout" => "inline",
		"type" => "password"
	]);?>

	
	<button type="submit" class="btn btn-primary">{lang_changepass}</button>
</div>
<?php echo form_close();?>