<div class="hbox">
	<div class="input-group">
	  <input type="text" class="form-control" placeholder="Search apps">
	  <div class="input-group-append">
	    <button class="btn btn-primary" type="button" id="button-addon2"><i class="fa fa-search"></i> Search</button>
	  </div>
	</div>
</div>

<div class="hbox">
	<h4>Search form server</h4>
	<div id="loadAddonServer"></div>
</div>
<script type="text/javascript">
	$().ready(function(){
		$("#loadAddonServer").load("<?php echo site_url("settings/enterprise/template/searchitem");?>");
	});
</script>