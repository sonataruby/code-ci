
<section class="nav-breadcrumb mb-4">
	<div class="container">
		<?php echo $this->components->breadcrumb();?>
	</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-lg-9 col-sm-12">
			<div class="content">
				
				<?php echo $this->components->image($data->image,["class" => "w-100","lazy" => @$attr["lazy"]]);?>
				<div class="border bg-light mb-4" style="padding: 10px;">
				<?php echo $this->components->users("bar",$data);?>
				</div>
				
				<?php echo $data->content;?>

				<code class="mt-4">
					<div class="tags mt-4"><p><i class="fa fa-tags"></i> {lang_tags} : <?php echo $data->tagURL;?></p></div>
				</code>
				
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
			<h3>{lang_order_item}</h3>
			<?php $this->load->view("plugins/posts",["data" => $data->order, "class" => 'col-lg-6 col-sm-12',"type" => "list"]);?>
			<hr>
			<?php echo $this->components->comments("post",$data->url);?>
		</div>
		<div class="col-lg-3 col-sm-12">
			<?php $this->components->slidebar(false,["type" => "rightslide"]);?>
			

		</div>
	</div>
</div>
