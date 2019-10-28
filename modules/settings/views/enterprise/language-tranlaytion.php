<?php echo form_open();?>
<div class="hbox">
	<h4>Language Tranlaytion
		<div class="float-right  w-25">
			<div class="input-group mb-3">
			<select class="form-control" onchange="window.location.href='/settings/enterprise/language/tranlaytion/<?php echo $path;?>/' + this.value;">
			<option>Select File</option>
			<?php foreach ($data as $key => $value) { 
				if($value != "index.html"){
				?>
				<option value="<?php echo $value;?>" <?php echo ($value == $file ? "selected" : "");?>><?php echo $value;?></option>
			<?php } 
				}
			?>
		</select>
		<div class="input-group-append">
			<button type="submit" class="btn btn-success">Save</button>
		</div>
		</div>
	</div>
	</h4>
</div>
<div class="hbox">
	
	<table class="table">
		<thead>
			<th class="text-right">Key</th>
			<th>Value</th>
		</thead>
		<tbody>
			<?php foreach ($row as $key => $value) { ?>
				
			<tr>
				<td class="w-25">
					<input type="text" name="keys[]" readonly class="form-control-plaintext text-right" value="<?php echo $key;?>">
				</td>
				<td>
					<input type="text" name="value[]" class="form-control" value="<?php echo $value;?>">
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	
</div>
</form>