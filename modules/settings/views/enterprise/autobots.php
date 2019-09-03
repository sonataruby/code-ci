<div class="hbox">
	<h3>Tự động cấu hình</h3>
</div>

<?php echo form_open();?>
<div class="hbox">
	<h3>Loại hình kinh doanh</h3>
	
	<div class="row">
		<?php foreach ($data as $key => $value) { ?>
			
		<div class="col-2">
			<div  class="card card-body">
				<label>
					<h5><?php echo $key;?></h5>
					<input type="checkbox" name="solution[]" value="<?php echo $key;?>"> On / Off
				</label>
			</div>
		</div>
		<?php } ?>
	</div>

	<button type="submit" class="btn btn-primary">Builder</button>
</div>

<?php echo form_close();?>