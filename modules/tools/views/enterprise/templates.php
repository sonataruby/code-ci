<?php
$rTheme = str_replace('components/', '', $themePath);
$checkLayout = file_exists($rTheme . "layout/default.php") ? "danger" : "success";
?>
<div class="hbox">
	<h3>Template Builder <div class="float-right">
		<div class="row">
			<div class="col">
				<select class="custom-select" onChange="window.location.href='/tools/templates/'+this.value;" style="min-width: 350px;">
				<?php foreach ($theme as $key => $value) { 
					if(is_dir(CMS_THEMEPATH . $value)){
						$value = str_replace('/', '', $value);
					?>
					<option value="<?php echo $value;?>" <?php echo ($active == $value ? "selected" : "");?>><?php echo ucfirst($value);?></option>
				<?php } 
					}
				?>
			</select></div>
			<div class="col"> <a class="btn btn-outline-info">Back</a></div>
		</div></div></h3>
</div>
<div class="row">
	<div class="col-lg-3 flex-box">
		<div class="hbox">
			<h4>Layout</h4>
			<a class="btn mb-3 btn-<?php echo $checkLayout;?>" href="/tools/templates/<?php echo $active;?>?layout=default.php">Copy Default Layout</a>

			<a class="btn btn-primary" href="/tools/templates/<?php echo $active;?>?fixmiss[]=styles.css&fixmiss[]=app.js">Fix Miss File</a>

			<hr>
			<h4>Channel</h4>
			<ul class="list-group list-group-flush">
			<?php foreach (config_item("channel") as $key => $value) { 
					$ready = (is_dir(str_replace('components', 'channel', $themePath) . $key) ? "danger" : "success");
				?>
				<li class="list-group-item" style="padding-left: 0; padding-right: 0;"><?php echo ucfirst($value->name);?> <a href="/tools/templates/<?php echo $active;?>?channel=<?php echo $key;?>" class="float-right btn btn-sm btn-outline-<?php echo $ready;?>"><i class="fa fa-copy"></i></a></li>
			<?php } ?>
			</ul>
		</div>
	</div>

	<div class="col-lg-3 flex-box">
		<div class="hbox">
			<h4>Components</h4>
			<ul class="list-group list-group-flush">
				<?php foreach ($components as $key => $value) { 
					if(!file_exists($themePath . basename($value))){
					?>
					<li class="list-group-item" style="padding-left: 0; padding-right: 0;"><?php echo basename($value);?> <a href="/tools/templates/<?php echo $active;?>?copy=<?php echo str_replace(FCPATH, '', $value);?>" class="float-right btn btn-sm btn-outline-info"><i class="fa fa-copy"></i></a></li>
				<?php } 
					}
				?>
			</ul>
		</div>
	</div>


	<div class="col-lg-3 flex-box">
		<div class="hbox">
			<h4>Components</h4>
		</div>
	</div>

	<div class="col-lg-3 flex-box">
		<div class="hbox">
			<h4>Components</h4>
		</div>
	</div>
</div>