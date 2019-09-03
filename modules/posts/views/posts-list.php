<section class="nav-breadcrumb mb-4">
	<div class="container">
		<?php echo $this->components->breadcrumb(false,["active" => $title]);?>
	</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-lg-9 col-sm-12">
			<div class="row">
				<div class="col-lg-5 col-sm-12 hidden-xs">
					<h3><?php echo $title;?></h3>
				</div>
				<div class="col-lg-7 col-sm-12">
					<ul class="nav justify-content-end">
					  <li class="nav-item">
					    <a class="nav-link" href="?view=gird"><i class="fa fa-th fa-2x<?php echo ($this->input->get("view") == "gird" || !$this->input->get("view") ? " text-danger" : "");?>"></i></a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link active" href="?view=list"><i class="fa fa-list-alt fa-2x<?php echo ($this->input->get("view") == "list" ? " text-danger" : "");?>"></i></a>
					  </li>
					  
					  <li class="nav-item">
					    <a class="nav-link" href="?view=masonry"><i class="fa fa-th-large fa-2x<?php echo ($this->input->get("view") == "masonry" ? " text-danger" : "");?>"></i></a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="?view=group"><i class="fa fa-border-all fa-2x<?php echo ($this->input->get("view") == "group" ? " text-danger" : "");?>"></i></a>
					  </li>
					  
					  
					</ul>
				</div>
			</div>
			<hr>
			<div class="content">
				<?php $this->components->posts($channel,["limit" => 20,"page" => true, "theme" => $this->input->get("view"), "tag" => $this->input->get("tags"), "item" => 4]);?>
			</div>
		</div>
		<div class="col-lg-3 col-sm-12">
			<?php $this->components->slidebar(false,["type" => "rightslide"]);?>
		</div>
	</div>
</div>
