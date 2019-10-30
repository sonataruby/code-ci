<?php echo form_open("",["id" => "savedata", "target" => "IF_savedata"]);?>
<div class="row">
	<div class="col-lg-9">
		<div class="hbox">
			<div class="border ">
				<textarea id="content" rows="32" class="form-control" name="content"><?php echo @$data->content;?></textarea>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="hbox">
			<button type="submit" class="btn btn-primary">Save</button>
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
<?php
addon("addon/codemirror",["target" => "#content", "form" => "#savedata", "tools" => "true", "libs" => "default", "tools_desktop" => ".tools_desktop"]);

?>
<iframe id="IF_savedata" name="IF_savedata" style="border:0px; height: 1px; width: 1px; margin-top: -1000vh;"></iframe>