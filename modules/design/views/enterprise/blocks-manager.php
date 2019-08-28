<div class="hbox">
	<h3>Design Block
		<a class="btn btn-primary float-right" href="/design/enterprise/blocks/create">Create Blocks</a>
	</h3>
</div>
<div class="hbox">
	<table class="table">
		<thead>
			<th colspan="2">Name</th>
			<th>Type</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach ($data as $key => $value) { ?>
				
			<tr>
				<td style="width: 120px;"><img src="<?php echo site_url($value->block_image);?>" class="w-100"></td>
				<td><b><?php echo $value->block_name;?></b><p>Type : bootstrap4/<?php echo $value->block_keyword;?></p></td>
				<td></td>
				<td class="text-right">
					<a class="btn btn-primary btn-sm" href="/design/enterprise/blocks/create/<?php echo $value->block_id;?>">Edit</a>
					<a class="btn btn-primary btn-sm" href="/design/enterprise/blocks/delete/<?php echo $value->block_id;?>">Delete</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>