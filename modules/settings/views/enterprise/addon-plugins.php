<div class="hbox">
	<h4>Plugins Manager <a class="btn btn-primary float-right" href="/settings/enterprise/addon/plugins?active=build" sn-link="true" parent-controller="#apps">Active All</a></h4>
</div>
<div class="hbox">
	<table class="table">
		<thead>
			<tr>
				<th>Modules</th>
				<th>Name</th>
				<th>Status</th>
				
				<th>Run Buy</th>
				<th class="text-right">Shortcode</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data as $key => $value) { ?>
				
			<tr>
				<td><?php echo $value["modules"];?></td>
				<td><?php echo $value["name"];?></td>
				<td>On</td>
				
				<td>Systems</td>
				<td class="text-right">[plugin name="<?php echo strtolower($value["modules"]."/".$value["name"]);?>"][/plugin]</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>