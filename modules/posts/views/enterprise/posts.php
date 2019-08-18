<div class="hbox">
	<h3>Quản lý bài viết <a class="btn btn-primary float-right" href="/posts/enterprise/posts/create?channel=<?php echo $channel;?>" sn-link="true" parent-controller="#posts"><i class="fa fa-plus"></i> Add Posts</a></h3>
	<hr>
	<div class="row">
	<?php foreach (config_item("channel") as $key => $value) { ?>
		<div class="col-lg-2 col-sm-6"><div class="card card-body <?php echo ($value->url == $this->input->get("channel") ? "active" : "");?>">
			<a href="/posts/enterprise/posts?channel=<?php echo $value->url;?>">
				<?php echo $value->name;?>
			</a>
		</div></div>
	<?php } ?>
	</div>
</div>
<div class="hbox">
	<div class="input-group">
		<?php echo $catalog;?>
	  <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
	  <div class="input-group-append">
	    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i> Search</button>
	  </div>
	</div>
	<br>
	<table class="table">
		<thead>
			<th colspan="2">Name</th>
			<th>Create Date</th>
			<th>View</th>
			<th>Comments</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach ($data as $key => $value) { ?>
				
			<tr>
				<td width="2%">
					<img src="<?php echo (is_array($value->image) ? $value->image[0] : $value->image);?>" style="width:120px; height:60px;">
				</td>
				<td>
					<b><?php echo $value->name;?></b>
					<p>
						<?php foreach ($value->catalog as $keyCat => $valueCat) { ?>
						<a href="/catalog/<?php echo $valueCat->catalog_url;?>.html" target="_bank"><?php echo $valueCat->catalog_name;?></a>
						<?php }?></p>
				</td>
				<td><?php echo $value->created_date;?></td>
				<td><?php echo $value->views;?></td>
				<td></td>
				<td class="text-right">
					<a class="btn btn-primary" href="/posts/enterprise/posts/create/<?php echo $value->id;?>?channel=<?php echo $value->channel;?>" sn-link="true" parent-controller="#posts">Edit</a>
					<a class="btn btn-primary" href="/posts/enterprise/posts/deletepost/<?php echo $value->id;?>?channel=<?php echo $value->channel;?>" sn-link="true" parent-controller="#posts">Delete</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>