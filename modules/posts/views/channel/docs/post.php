
<div class="content">
		
		<h4><?php echo $data->name;?></h4>
		<p><i class="fa fa-calendar-alt"></i> <?php echo $data->created_date;?> </p>
		<?php echo $data->content;?>
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
	
	<h3>Gởi các khó khăn mà bạn có cho chúng tôi</h3>
	<?php echo $this->components->comments("post",$data->url);?>
</div>