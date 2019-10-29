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
	
	<h3>Add Language <button class="btn btn-info btn-sm float-right" type="button" onClick="addLanguage();">Add</button></h3>
	<table class="table">
		<thead>
			<th class="text-right">Key</th>
			<th>Value</th>
		</thead>
		<tbody id="addLanguageID">
			
				
			
			
		</tbody>
	</table>

</div>
</form>
<script type="text/javascript">
	function addLanguage(){
		$("#addLanguageID").append('<tr><td class="w-25"><input type="text" name="keys[]" class="form-control text-right" value=""></td><td><input type="text" name="value[]" class="form-control" value=""></td><td><a class="btn btn-sm btn-primary" onClick="$(this).parent().parent().remove();">-</a></td></tr>');
	}
</script>