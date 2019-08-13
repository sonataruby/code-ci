
<?php echo form_open("",["id" => "savedata"]);?>
<div class="border">
	<button type="submit" class="btn btn-primary">Save</button>
<textarea id="textarea" rows="32" class="form-control" name="content"><?php echo @$content;?></textarea>
</div>
<?php echo form_close();?>

<?php
addon("addon/codemirror",["target" => "#textarea", "form" => "#savedata", "tools" => "true", "libs" => "default", "tools_desktop" => ".tools_desktop"]);

?>
