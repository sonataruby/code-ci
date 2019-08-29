<div class="hbox">
	<h3>Tools <a href="/tools/migrations/renderall" class="btn btn-info float-right">Render All</a></h3>
</div>
<div class="hbox">
	<table class="table">
		<thead>
			<th>Table Name</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach ($data as $key => $value) { ?>
				
			<tr>
				<td><?php echo $value;?></td>
				<td class="text-right">
					<a href="/tools/migrations/render/<?php echo $value;?>" class="btn btn-outline-primary">Make</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>