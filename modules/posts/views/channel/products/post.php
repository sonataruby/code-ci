<section class="nav-breadcrumb mb-4">
	<div class="container">
		<?php echo $this->components->breadcrumb();?>
	</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-sm-12">
			<div class="content">
				<?php echo $this->components->image($data->image);?>
				<h4><?php echo $data->name;?></h4>
				<p><i class="fa fa-calendar-alt"></i> <?php echo $data->created_date;?> </p>
				<?php echo $data->content;?>
			</div>
			<div class="row">
				<?php if(@$data->prev->name){ ?>
				<div class="col">
					<div class="card card-body">
						<h5 class="prev"><a href="<?php echo post_url(@$data->prev->url, @$data->prev->channel);?>" title="Prev Post"><i class="fa fa-chevron-left fa-1x"></i> <?php echo @$data->prev->name;?></a></h5>
					</div>
				</div>
				<?php } ?>
				<?php if(@$data->next->name){ ?>
				<div class="col">
					<div class="card card-body text-right">
						<h5 class="next"><a href="<?php echo post_url(@$data->next->url, @$data->next->channel);?>" title="Next Post"><?php echo @$data->next->name;?> <i class="fa fa-chevron-right fa-1x"></i> </a></h5>
					</div>
				</div>
				<?php } ?>
			</div>

			
			
		</div>
		<div class="col-lg-4 col-sm-12">
			<?php $this->components->slidebar(false,["type" => "rightslide"]);?>

		</div>
	</div>
</div>