<?php echo form_open();?>
<div class="hbox">
	<h3>Design Block
		<button type="submit" class="btn btn-primary float-right">Save</button>
	</h3>
</div>

<div class="row">
	<div class="col-lg-9 col-sm-12">
		<div class="hbox">
			<textarea class="form-control" name="block_content" rows="24"><?php echo @$data->block_content;?></textarea>
		</div>
	</div>
	<div class="col-lg-3 col-sm-12">
		<?php echo $this->forms->text([
				"name" => "block_name",
				"label" => "Name",
				"value" => @$data->block_name
			],["group" => "form-group"]);?>

		<?php echo $this->forms->text([
				"name" => "block_keyword",
				"label" => "Type",
				"value" => @$data->block_keyword
			],["group" => "form-group"]);?>

		<?php echo $this->forms->gallery([
				"name" => "block_image[]",
				"label" => "Page Layout",
				"value" => [@$data->block_image]
			],["group" => "row", "size" => "280x120"]);?>

		

	</div>
</div>
<?php echo form_close();?>