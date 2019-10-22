<div class="hbox">
	<h3>Task Manager <a class="btn btn-info float-right"><i class="fa fa-plus"></i> Add New task</a></h3>
</div>
<div class="hbox">
	<table class="table">
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Events Time</th>
			<th>Status</th>
			<th>Update</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach ($task as $key => $value) { ?>
				
			<tr>
				<td>ID</td>
				<td><?php echo $value["name"];?></td>
				<td><?php echo @$value["time"];?></td>
				<td></td>
				<td></td>
				<td class="text-right">
					<a href="" class="btn btn-sm btn-info">Edit</a>
					<a href="" class="btn btn-sm btn-info">Start</a>
					<a href="" class="btn btn-sm btn-info">Stop</a>

				</td>
			</tr>
			<?php } ?>
		</tbody>
		
	</table>
</div>
