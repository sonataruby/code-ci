
<?php echo form_open("",["id" => "savedata"]);?>
<button type="submit" class="btn btn-primary">Save</button>
<br>
<div class="border">
	
<textarea id="content" rows="32" class="form-control" name="content"><?php echo @$content;?></textarea>
</div>
<?php echo form_close();?>

<?php
addon("addon/codemirror",["target" => "#content", "form" => "#savedata", "tools" => "true", "libs" => "default", "tools_desktop" => ".tools_desktop"]);

?>
<iframe id="IF_savedata" name="IF_savedata" style="border:0px; height: 1px; width: 1px; margin-top: -1000vh;"></iframe>