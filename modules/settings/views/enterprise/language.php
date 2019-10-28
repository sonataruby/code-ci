<div class="hbox">
	<h4>Language</h4>
</div>
<div class="hbox">
	<table class="table">
		<thead>
			<th>Name</th>
			<th>Folder</th>
			<th>Status</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach ($data as $key => $value) { 
				
				?>
				
			<tr>
				<td>
					<?php echo (config_item("language") == $value->folder ? "<span style=\"color:red\">(*)</span> " : "");?> <?php echo (@isset($value->name) ? $value->name : ucfirst($value));?>
				</td>
				<td><?php echo (@isset($value->folder) ? $value->folder : $value);?></td>
				<td><?php echo (@isset($value->status) ? $value->status : "Off");?></td>
				<td class="text-right">
					<a class="btn btn-sm btn-info" href="/settings/enterprise/language/tranlaytion/<?php echo $key;?>">Tranlaytion</a>
					<a class="btn btn-sm btn-info" href="/settings/enterprise/language/share/<?php echo $key;?>">Share</a>
					<a class="btn btn-sm btn-info" href="/settings/enterprise/language/edit/<?php echo $key;?>">Edit</a>
					<a class="btn btn-sm btn-info" href="/settings/enterprise/language/remove/<?php echo $key;?>">Remove</a>
					<a class="btn btn-sm btn-info" href="/settings/enterprise/language/copy/<?php echo $key;?>">Copy</a>
					<a class="btn btn-sm btn-info" href="/settings/enterprise/language/default/<?php echo $key;?>">Default</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>