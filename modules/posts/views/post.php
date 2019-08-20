
<section class="nav-breadcrumb mb-4">
	<div class="container">
		<?php echo $this->components->breadcrumb();?>
	</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-lg-9 col-sm-12">
			<div class="content">
				
				<?php echo $this->components->image($data->image);?>
				<?php echo $this->components->userprofile($data->account_id,["theme" => "post","data" => $data]);?>
				
				
				<?php echo $data->content;?>
				<div class="tags"><p><i class="fa fa-tags"></i> </p></div>
				
			</div>
			<div class="row">
				<?php if(@$data->prev->name){ ?>
				<div class="col">
					<div class="card card-body">
						<h5 class="prev"><a href="<?php echo post_url(@$data->prev->url);?>" title="Prev Post"><i class="fa fa-chevron-left fa-2x"></i> <?php echo @$data->prev->name;?></a></h5>
					</div>
				</div>
				<?php } ?>
				<?php if(@$data->next->name){ ?>
				<div class="col">
					<div class="card card-body text-right">
						<h5 class="next"><a href="<?php echo post_url(@$data->next->url);?>" title="Next Post"><?php echo @$data->next->name;?> <i class="fa fa-chevron-right fa-2x"></i> </a></h5>
					</div>
				</div>
				<?php } ?>
			</div>

			<hr>
			<h3>Nội dung liên quan</h3>
			<?php $this->load->view("plugins/posts",["data" => $data->order, "class" => 'col-lg-6 col-sm-12',"type" => "list"]);?>
			<hr>
			<?php echo $this->components->comments("post",$data->url);?>
		</div>
		<div class="col-lg-3 col-sm-12">
			<?php $this->components->slidebar("rightslide",["class" => ""]);?>
			

		</div>
	</div>
</div>
