<?php echo form_open();?>

<div class="hbox">
	<h4>Maintain
		<button type="submit" class="btn btn-info float-right">Save</button>
	</h4>
</div>

<div class="hbox">
	<?php echo $this->forms->radio([
                "name" => "maintain",
                "label" => "Trạng thái website",
                "value" => (@$data->maintain ? @$data->maintain : 0),
                "options" => [["label" => "Online", "value" => 0], ["label" => "Offline", "value" => 1]]
            ],["layout" => "inline", "group" => "row"]);?>

	<?php echo $this->forms->textarea([
        "name" => "maintain_content",
        "label" => "Menu Name",
        "value" => @$data->maintain_content
    ],["requied" => true, "label" => false]);?>
</div>

<?php echo form_close();?>