<?php if(@$attr["type"] == "slide"){ ?>
	<div class="owl-carousel owl-theme">
		<?php foreach ($data as $key => $value) { ?>
			<div class="ml-2 mb-3">
				<div class="card card-body">
					<a href="<?php echo (@$link[$key] ? @$link[$key] : "#");?>" target="_bank">
						<img src="<?php echo site_url($value->image_url);?>" class="img-fluid">
					</a>
					
				</div>
			</div>
		<?php } ?>
		
	</div>
	<?php echo libs_url('css/owl.carousel.css');?>
	<?php echo libs_url('css/owl.theme.default.css');?>
	<script type="text/javascript">
		getScripts(['/libs/js/owl.carousel.js'], function(){
			$(".owl-carousel").owlCarousel({
				autoplay:true,
				items : 5,
				autoWidth : false,
				lazyLoad : true,
				responsiveClass:true,
				responsiveBaseElement : ".container",
				dots: true,
				nav : true,
				responsive : {
					0 : {
						items : 1,
						dots: false,
						nav : false,
					},
					485 : {
						items : 2,
						dots: false,
						nav : false,
					},
					728 : {
						items : 4,
						loop: true,
						dots: true,
						nav : true,
						
					},
					960 : {
						items : 5,
						loop: true,
						dots: true,
						nav : true,

					},
					1200 : {
						items : 7,
						dots: true,
						nav : true
					}
					
				},
				
			});
		});
	</script>
	
<?php }else{ ?>

<div class="row owl-carousel owl-theme">
	<?php foreach ($data as $key => $value) { ?>
		<div class="<?php echo @$attr["class"] ? $attr["class"] : "col-lg-3 col-sm-12 mb-3";?>">
			<a href="<?php echo (@$link[$key] ? @$link[$key] : "#");?>" target="_bank">
				<img src="<?php echo site_url($value->image_url);?>" class="img-fluid img-thumbnail">
			</a>
		</div>
	<?php } ?>
	
</div>
<?php } ?>
