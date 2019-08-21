<?php echo form_open();?>

<div class="hbox">
	<h4>Page 404
		<button type="submit" class="btn btn-info float-right">Save</button>
	</h4>
</div>

<div class="hbox">
	<?php echo $this->forms->radio([
                "name" => "layout_404",
                "label" => "Layout",
                "value" => (@$data->layout_404 ? @$data->layout_404 : 0),
                "options" => [["label" => "Default", "value" => 0], ["label" => "Blank Layout", "value" => 1]]
            ],["layout" => "inline", "group" => "row"]);?>

	<?php echo $this->forms->textarea([
        "name" => "content_404",
        "label" => "Menu Name",
        "value" => @$data->content_404
    ],["requied" => true, "label" => false]);?>
</div>

<?php echo form_close();?>