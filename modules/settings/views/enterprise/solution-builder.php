<div class="hbox">
	<h3>Solution Builder</h3>
</div>
<?php echo form_open("",["id" => "savedata", "target" => "IF_savedata"]);?>
<div class="row">
	<div class="col-lg-3">
		<div class="hbox">
			<button type="submit" class="btn btn-primary">Save</button>
			<?php if($mode == "dataform"){ ?> 
			<button type="button" class="btn btn-info btnAddfile">Add Field</button>
			<?php } ?>
		</div>
		<div class="hbox">
			
			<h4>Database</h4>
			Table : <a  href="/settings/enterprise/solution/database/<?php echo $channel;?>"><?php echo $database;?></a>
			<h4>Layout</h4>
			<ul class="list-group list-group-flush">
			  <li class="list-group-item">Catalog <a class="btn btn-sm btn-info float-right" href="/settings/enterprise/solution/layout/<?php echo $channel;?>/catalog">Edit</a></li>
			  <li class="list-group-item">List <a class="btn btn-sm btn-info float-right" href="/settings/enterprise/solution/layout/<?php echo $channel;?>/list">Edit</a></li>
			  <li class="list-group-item">Detail <a class="btn btn-sm btn-info float-right" href="/settings/enterprise/solution/layout/<?php echo $channel;?>/detail">Edit</a></li>
			  
			</ul>
		</div>
	</div>
	<div class="col-lg-9">
		<div class="hbox">
			<?php if($mode == "code"){ ?>
			<div class="border">
				
				
				<textarea id="content" rows="32" class="form-control" name="content"><?php echo @$code;?></textarea>

			</div>
			<?php }else{ ?>
				<table class="table tableData">
					<thead>
						<th>Name</th>
						<th>Type</th>
						<th>Length</th>
						<th>Input</th>
						<th>Default</th>
						<th></th>
					</thead>
					<tbody>
						<?php foreach ($fields as $key => $value) { 
								if($value->primary_key == 0){
							?>
							
						<tr>
							<td><input type="text" name="name[]" value="<?php echo $value->name;?>" class="form-control"></td>
							<td><select class="form-control" name="type[]">
								<option value="varchar" <?php echo ($value->type == "varchar" ? "selected" : "");?>>Varchar</option>
								<option value="int" <?php echo ($value->type == "int" ? "selected" : "");?>>INT</option>
								<option value="bigint" <?php echo ($value->type == "bigint" ? "selected" : "");?>>BIGINT</option>
								<option value="text" <?php echo ($value->type == "text" ? "selected" : "");?>>Text</option>
								<option value="longtext" <?php echo ($value->type == "longtext" ? "selected" : "");?>>Long Text</option>
							</select></td>
							<td><input type="text" name="length[]" value="<?php echo $value->max_length;?>" class="form-control"></td>
							<td><select class="form-control">
								<option>Text</option>
								<option>Editter</option>
								<option>Select Box</option>
								<option>Check Box</option>
								<option>Radio</option>
							</select></td>
							<td><input type="text" name="default[]" value="<?php echo $value->default;?>" class="form-control"></td>
							<td class="text-right">
								<a href="" class="btn btn-sm btn-primary">Remove</a>
							</td>
						</tr>
						<?php } 
							}
						?>
					</tbody>
				</table>
			<?php } ?>
		</div>
	</div>
</div>
</form>

<script type="text/html" id="addZone">
	<tr>
		<td><input type="text" name="name[]" class="form-control"></td>
		<td><select class="form-control" name="type[]">
			<option value="varchar">Varchar</option>
			<option value="int">INT</option>
			<option value="bigint">BIGINT</option>
			<option value="text">Text</option>
			<option value="longtext">Long Text</option>
		</select></td>
		<td><input type="text" name="length[]" class="form-control"></td>
		<td><select class="form-control">
			<option>Text</option>
			<option>Editter</option>
			<option>Select Box</option>
			<option>Check Box</option>
			<option>Radio</option>
		</select></td>
		<td><input type="text" name="default[]" class="form-control"></td>
		<td class="text-right">
			<a href="" class="btn btn-sm btn-primary">Remove</a>
		</td>
	</tr>
</script>
<?php
if($mode == "code") addon("addon/codemirror",["target" => "#content", "form" => "#savedata", "tools" => "true", "libs" => "default", "tools_desktop" => ".tools_desktop"]);

?>
<script type="text/javascript">
	
	$(".btnAddfile").on("click", function(){
		$(".tableData").append($("#addZone").html());
	});
	
</script>
<iframe id="IF_savedata" name="IF_savedata" style="border:0px; height: 1100px; width: 1000px; margin-top: 000vh;"></iframe>