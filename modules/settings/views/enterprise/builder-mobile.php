<style type="text/css">
	body{
		--panel-left : 280px;
		--panel-right:480px;
		--margin-panel-left : 120px;
	}
	#panel-left{
		position: fixed;
		height: 100%;
		width: calc(var(--panel-left));
		border-right:1px solid #ddd; 
		left:var(--margin-panel-left);
		padding: 10px;
		
		
	}
	#panel-right{
		position: fixed;
		height: 100%;
		width: calc(var(--panel-right));
		border-left:1px solid #ddd;
		right: 0;
		
	}
	.panel{
		background-color: #f2f2f2;
		padding: 10px;
	}
	main{
		position: fixed;
		height: 100%;
		left: calc(var(--panel-left) + var(--margin-panel-left));
		width: calc(100% - (var(--panel-right) + var(--panel-left) + var(--margin-panel-left)));
	}
	main .layer{
		margin:auto;
		width: 480px;
		height: 100%;
		background-color: #FFF;

	}
	main iframe{
		height: 100%;
		width: 100%;
		border: 1px solid #ddd;

	}
</style>
<div style="position: relative; background-color: red; margin-top:-15px;">
	<div id="panel-left">
		<h3>Select Layout</h3>
	</div>
	<div id="panel-right">
		<div class="panel">
			<button class="btn btn-primary">Save</button>
			<a href="/settings/enterprise/builder/support" class="btn btn-primary">Enable Mobile Support</a>
		</div>
	</div>
	<main>
		<div class="layer">
			<iframe src="about:none;"></iframe>
		</div>
	</main>
</div>