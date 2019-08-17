<section class="nav-breadcrumb mb-4">
	<div class="container">
		<?php echo $this->components->breadcrumb();?>
	</div>
</section>
<div class="container">
	<div class="row">
		
		<div class="col-lg-8 col-sm-12">
			<?php $this->load->view("plugins/posts",["data" => $data->posts, "class" => 'col-lg-4 col-sm-12']);?>
		</div>
		
		<div class="col-lg-4 col-sm-12 hidden-xs">
			<div class="card right-alt">
				<div class="card-header">
					<h5>Category</h5>
				</div>
				
				<?php echo $data->listCatalog;?>
			</div>
		</div>

	</div>
</div>