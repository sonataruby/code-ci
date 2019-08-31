<?php libs_url("js/Chart.js");?>
<?php libs_url("js/Chart-utils.js");?>
<?php libs_url("css/Chart.css");?>
<div class="row">
	<div class="col-laptop-3 col-tablet-6">
		<div class="hbox bg-primary text-white">
			<h4><i class="fa fa-chart-pie"></i> Channel <div class="float-right"><?php print_r(count((array)config_item("channel")));?></div></h4>
			
		</div>
	</div>
	<div class="col-laptop-3 col-tablet-6">
		<div class="hbox bg-info text-white">
			<h4><i class="fa fa-file-word"></i> Posts <div class="float-right"><?php print_r(get_instance()->posts_model->getNumRows());?></div></h4>
			
		</div>
	</div>
	<div class="col-laptop-3 col-tablet-6">
		<div class="hbox bg-success text-white">
			<h4><i class="fa fa-file-invoice-dollar"></i> Invoice <div class="float-right">0</div></h4>
		</div>
	</div>
	<div class="col-laptop-3 col-tablet-6">
		<div class="hbox bg-danger text-white">
			<h4><i class="fa fa-users"></i> Member <div class="float-right">1</div></h4>
		</div>
	</div>

	<div class="col-laptop-4 col-tablet-12 flex-box mb-3">
		<div class="hbox">
			<h4>Khu vực người dùng</h4>
			<canvas id="myChart2" width="100%" ></canvas>
		</div>
	</div>

	<div class="col-laptop-8 col-tablet-12">
		<div class="row">
			<div class="col flex-box mb-3">
				<div class="hbox">
					<h4>Các nội dung được xem</h4>
					<canvas id="myChart" width="100%" ></canvas>
				</div>
			</div>

			<div class="col flex-box mb-3">
				<div class="hbox">
					<h4>Robot tìm kiếm</h4>
					<table class="table">
						<thead>
							<th>Name</th>
							<th>Insert</th>
							<th class="text-right">Time</th>
							
						</thead>
						<tbody>
							<?php foreach ($robot as $key => $value) { ?>
								<tr>
									<td><?php echo $value->bot_name;?></td>
									<td class="text-center"><?php echo $value->count_connect;?></td>
									<td class="text-right"><?php echo $value->reconnect;?></td>
									
								</tr>
							<?php } ?>
							

						</tbody>
					</table>
				</div>
			</div>
			
			
		</div>
		
	</div>


	<div class="col-laptop-6 col-tablet-12">
		<div class="hbox">
			<h4>Comments</h4>
		</div>
	</div>


	<div class="col-laptop-6 col-tablet-12">
		<div class="hbox">
			<h4>Chat Box</h4>
		</div>
	</div>


	<div class="col-laptop-6 col-tablet-12">
		<div class="hbox">
			<h4>Systems</h4>
			<table class="table">
				<thead>
					<th>Name</th>
					<th>Version</th>
					<th>Status</th>
				</thead>
				<tbody>
					<tr>
						<td>Modules</td>
						<td>1.1</td>
						<td>On</td>
					</tr>

					<tr>
						<td>Plugins <b><?php print_r(count((array)config_item("plugins")));?></b></td>
						<td>1.1</td>
						<td>On</td>
					</tr>


					<tr>
						<td>Components</td>
						<td>1.1</td>
						<td>On</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>

	<div class="col-laptop-6 col-tablet-12">
		<div class="hbox">
			<h4>News</h4>
		</div>
	</div>

	<div class="col-laptop-12 col-tablet-12">
		<div class="hbox">
			<h4>History</h4>
			<table class="table">
				<thead>
					<th>IP</th>
					<th>URL</th>
					<th>Platform</th>
					<th>Browser</th>
					<th>View</th>
					<th>City</th>
					<th>Country</th>
					<th class="text-right">Time</th>
				</thead>
				<tbody>
					<?php 

					foreach ($history as $key => $value) { ?>
						<tr>
							<td><?php echo $value->form_ip;?></td>
							<td><a href="<?php echo $value->view_url;?>" target="_bank"><?php echo $value->view_url;?></a></td>
							<td><?php echo $value->platform;?></td>
							<td><?php echo $value->browser;?></td>
							<td><?php echo $value->view_count;?></td>
							<td><?php echo $value->city;?></td>
							<td><?php echo $value->country;?></td>
							<td class="text-right"><?php echo $value->view_update;?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

</div>
<script type="text/javascript">
	$(document).ready(function(){
		var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

		var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};

		var config = {
			type: 'line',
			data: {
				labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
				datasets: [{
					label: 'My First dataset',
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: [
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor()
					],
					fill: false,
				}, {
					label: 'My Second dataset',
					fill: false,
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data: [
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor()
					],
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Chart.js Line Chart'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						},
						ticks: {
							min: 0,
							max: 100,

							// forces step size to be 5 units
							stepSize: 5
						}
					}]
				}
			}
		};
		window.onload = function() {
			
			new Chart(document.getElementById('myChart').getContext('2d'), config);
			new Chart(document.getElementById('myChart2').getContext('2d'), config);
		};
	})
</script>