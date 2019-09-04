<section class="nav-breadcrumb mb-4">
	<div class="container">
		<?php echo $this->components->breadcrumb();?>
	</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-lg-9 col-sm-12">
			<div class="content">
				<div class="row">
					<div class="col-lg-7 col-sm-12">
						<?php echo $this->components->image($data->image,["class" => "w-100"]);?>
					</div>
					<div class="col-lg-5 col-sm-12">
						<h4 class="mb-3"><?php echo $data->name;?></h4>

						
						<ul class="list-menu">
						 
						  <li class="flex"><div class="bg-light text-right">Mã sản phẩm</div> <div>SUK-2516133</div></li>
						  <li class="flex"><div class="bg-light text-right">Nhà sản xuất</div> <div>Apple</div></li>
						  <li class="flex"><div class="bg-light text-right">Số lượng</div> <div>7 <em>Cái</em></div></li>
						  <li class="flex"><div class="bg-light text-right">Trạng thái</div> <div>Còn hàng</div></li>

						</ul>

						<br>
						 <h5 class="flex">Giá bán : <small>620.000 VND</small> 630.000 VND</h5>
						<div class="input-group mb-3">
						  <input type="number" class="form-control" placeholder="1" aria-label="Recipient's username" aria-describedby="button-addon2">
						  <div class="input-group-append">
						    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Thêm vào giỏ hàng"><i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng</button>
						  </div>
						</div>

						<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
						  
						  <div class="btn-group btn-group-lg" role="group" aria-label="Second group">
						    <button type="button" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="Bạn yêu thích sản phẩm này?"><i class="fa fa-heart"></i></button>
						    <button type="button" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="So sánh sản phẩm"><i class="fa fa-window-restore"></i></button>
						    <button type="button" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="Chia sẽ"><i class="fab fa-creative-commons-share"></i></button>
						  </div>
						  
						</div>
					</div>
				</div>
				
				<br>
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
		<div class="col-lg-3 col-sm-12">
			<?php $this->components->slidebar(false,["type" => "rightslide"]);?>

		</div>
	</div>
</div>