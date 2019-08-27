<div class="hbox">
	<h4>Quản lý ứng dụng <a class="btn btn-primary float-right" href="/settings/enterprise/addon/search" sn-link="true" parent-controller="#apps">Search Apps</a></h4>
	<p>Dùng chức năng tìm kiếm apps để tìm các modules chức năng trong thu viện. Hoàn toàn miễn phí từ nhà phát triển</p>
</div>

<div class="hbox">
	<h4>Đã cài đặt</h4>
	<?php if(count($module) == 0){ ?>
		Không có modules nào được cài đặt
	<?php }else{ ?>
	<table class="table">
		<thead>
			<th>Name</th>
			<th>Version</th>
			<th>Support</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach ($module as $key => $value) {  ?>
				
			<tr>
				<td>
					<b><?php echo ucfirst($key);?></b>
					<p><?php echo @$value->description;?></p>
				</td>
				
				<td><?php echo @$value->version;?></td>
				<td><a href="<?php echo @$value->support;?>">Support</a></td>
				<td class="text-right">
					<?php if(@$value->sample == "true"){ ?>
						<a href="/settings/enterprise/addon/install/<?php echo $key;?>" class="btn btn-primary btn-sm">Tạo nội dung mẫu</a>
					<?php } ?>
					<a href="/settings/enterprise/addon/uninstall/<?php echo $key;?>" class="btn btn-info btn-sm">Gở cài đặt</a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php } ?>
</div>

<div class="hbox">
	<h4>Trong thu viện</h4>
	<?php if(count($location) == 0){ ?>
		Không có modules nào chưa cài đặt tồn tại trong thư viện
	<?php }else{ ?>
	<table class="table">
		<thead>
			<th>Name</th>
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
				
				<td><?php echo @$value->version;?></td>
				<td><a href="<?php echo @$value->support;?>">Support</a></td>
				<td class="text-right">
					
					<a href="/settings/enterprise/addon/install/<?php echo $key;?>" class="btn btn-info btn-sm">Cài đặt</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php } ?>
</div>