<div class="hbox">
	<h2>Account Manager</h2>
</div>
<div class="hbox">
	<table class="table">
		<thead>
			<th>Name</th>
			<th>Email</th>
			<th>Brith Day</th>
			<th>Location</th>
			<th>Last Login</th>
			<th>Status</th>
			<th>Type</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach ($data as $key => $value) { ?>
				
			<tr>
				<td><?php echo $value->firstname;?> <?php echo $value->lastname;?></td>
				<td><?php echo $value->account_email;?></td>
				<td><?php echo $value->brithday;?></td>
				<td><?php echo $value->city;?></td>
				<td><?php echo $value->lastlogin;?></td>
				<td><?php echo $value->status;?></td>
				<td><?php echo $value->account_type;?></td>
				<td class="text-right">
					<a href="" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
					<a href="" class="btn btn-sm btn-info">Pass</a>
					<a href="" class="btn btn-sm btn-info"><i class="fa fa-lock"></i></a>
					<a href="" class="btn btn-sm btn-info"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>