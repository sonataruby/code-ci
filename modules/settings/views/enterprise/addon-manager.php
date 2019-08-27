<div class="hbox">
	<h4>Apps Active <a class="btn btn-primary float-right" href="/settings/enterprise/addon/search" sn-link="true" parent-controller="#apps">Search Apps</a></h4>
</div>

<div class="hbox">
	<h4>Apps on Location</h4>
	<table class="table">
		<thead>
			<th>Name</th>
			<th>Status</th>
			<th>Version</th>
			<th>Support</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach ($location as $key => $value) {  ?>
				
			<tr>
				<td>
					<b><?php echo ucfirst($key);?></b>
					<p><?php echo @$value->description;?></p>
				</td>
				<td></td>
				<td><?php echo @$value->version;?></td>
				<td><a href="<?php echo @$value->support;?>">Support</a></td>
				<td class="text-right"><a href="/settings/enterprise/addon/install/<?php echo $key;?>" class="btn btn-info btn-sm">Install</a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>