<?php echo form_open();?>
<input type="hidden" name="edit" value="<?php echo $this->input->get("edit");?>">
<div class="hbox">
	<h4>Channel Controller</h4>
</div>

<div class="hbox">
	<div class="row">
		<div class="col">
			<?php 
	
			echo $this->forms->text([
				"name" => "channel[name]",
				"label" => "Name",
				"value" => @$edit->name
			],[
				"required" => true,
				"group" => 'outline-group',
				"layout" => "outline"
			]);?>
		</div>
		<div class="col">
			<?php 
			$arvSetup = ["required" => true,
				"group" => 'outline-group',
				"layout" => "outline"];
			if($this->input->get("edit")){
				$arvSetup["readonly"] = true;
			}
			echo $this->forms->text([
				"name" => "channel[url]",
				"label" => "Prefix URL",
				"value" => @$edit->url
			],$arvSetup);?>
		</div>

		<div class="col">
			<?php 
	
			echo $this->forms->select([
				"name" => "channel[layout]",
				"label" => "Layout",
				"value" => @$edit->layout,
				"options" => ["default" => "Default","blogs" => "Blog's"]
			],[
				
				"group" => 'outline-group',
				"layout" => "outline"
			]);?>
		</div>
		<div class="col">
			<?php 
	
			echo $this->forms->text([
				"name" => "channel[image_size]",
				"label" => "Image Size",
				"value" => @$edit->image_size
			],[
				
				"group" => 'outline-group',
				"layout" => "outline"
			]);?>
		</div>

	</div>
	<?php
	if($this->input->get("edit")){
		?>
		<a href="/settings/enterprise/configs/channels" class="btn btn-info"><i class="fa fa-plus"></i> New</a>
		<button type="submit" class="btn btn-primary">Update</button>
		<?php
	}else{
	?>
	<button type="submit" class="btn btn-primary">Save</button>
	<?php } ?>
	
</div>
<?php echo form_close();?>
<div class="hbox">
	<h4>List Channel </h4>
	<table class="table table-hover">
		<thead>
			<th>Name</th>
			<th>URL</th>
			<th>Layout</th>
			<th>Image Size</th>
			<th></th>
		</thead>
		<tbody>
			
		
	<?php foreach($data as $key => $value){ ?>
		<tr>
				<td><?php echo $value->name;?></td>
				<td><?php echo $value->url;?></td>
				<td><?php echo $value->layout;?></td>
				<td><?php echo @$value->image_size;?></td>
				<td class="text-right"><a href="/settings/enterprise/configs/channels?edit=<?php echo $value->url;?>" class="btn btn-sm btn-info">Edit</a> <a href="/settings/enterprise/configs/channels?delete=<?php echo $value->url;?>" class="btn btn-sm btn-info">Delete</a></td>
			</tr>
	<?php } ?>
	</tbody>
	</table>
</div>