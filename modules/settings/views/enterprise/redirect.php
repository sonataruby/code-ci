<?php echo form_open();?>
<input type="hidden" name="edit" value="<?php echo $this->input->get("edit");?>">
<div class="hbox">
	<h4>Di chuyển URL</h4>
</div>

<div class="hbox">
	<div class="row">
		<div class="col">
			<?php 
	
			echo $this->forms->text([
				"name" => "redirect[old_url]",
				"label" => "Old URL",
				"value" => @$edit["old_url"]
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
			
			echo $this->forms->text([
				"name" => "redirect[new_url]",
				"label" => "New URL",
				"value" => @$edit["new_url"]
			],$arvSetup);?>
		</div>

		

	</div>
	<?php
	if($this->input->get("edit")){
		?>
		<a href="/settings/enterprise/configs/urlredirect" class="btn btn-info"><i class="fa fa-plus"></i> Thêm mới</a>
		<button type="submit" class="btn btn-primary">Cập nhập</button>
		<?php
	}else{
	?>
	<button type="submit" class="btn btn-primary">Lưu lại</button>
	<?php } ?>
	
</div>
<?php echo form_close();?>
<div class="hbox">
	<h4>Danh sách URL di chuyển</h4>
	<table class="table table-hover">
		<thead>
			<th>URL Củ</th>
			<th>Chuyển đến URL</th>
			
			<th></th>
		</thead>
		<tbody>
			
		
	<?php foreach($data as $key => $value){ ?>
		<tr>
				<td><?php echo $key;?></td>
				<td><?php echo $value;?></td>
				
				<td class="text-right"><a href="/settings/enterprise/configs/urlredirect?delete=<?php echo $key;?>" class="btn btn-sm btn-info">Delete</a></td>
			</tr>
	<?php } ?>
	</tbody>
	</table>
</div>