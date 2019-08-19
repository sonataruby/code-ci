<?php echo form_open();?>
<div class="hbox">
	<h3>Tags <button type="submit" class="btn  btn-primary float-right">Update</button></h3>
	<hr>
	<p>Các tags cách nhau dấu (,) tối đa 255 nhóm từ</p>
</div>

<div class="hbox">
	
	<textarea class="form-control" rows=18><?php echo $data;?></textarea>
	
</div>
<?php echo form_close();?>