<?php foreach ($data as $key => $value) {
	if($value->winget_content_as == 0){
	?>
	<div class="card mb-3">
		<div class="card-header">
			<i class="<?php echo $value->winget_icon;?>"></i> <?php echo $value->winget_name;?>
		</div>
		<div class="card-body">
			<?php echo $value->winget_content;?>
		</div>
	</div>
<?php }else{ ?>
	<?php echo $value->winget_content;?>
<?php } ?>
<?php } ?>