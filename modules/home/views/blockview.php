<?php if($data["winget_content_as"] == 0){ ?>
<div class="card">
	<div class="card-header"><i class="<?php echo $data["winget_icon"];?>"></i> <?php echo $data["winget_name"];?></div>
	<div class="card-body"><?php echo nl2br($data["winget_content"]);?></div>
</div>
<?php } else { ?>
	<?php echo nl2br($data["winget_content"]);?>
<?php } ?>