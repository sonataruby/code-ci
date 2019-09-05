<?php echo libs_url("css/swiper.css");?>
<?php
if(isset($attr["item"])){
	if($attr["item"] == "5"){
		$attr_class = "col-lg-five col-md-4 col-sm-6 col-12";
	}else{
		$attr_class = "col-xxl-".(12/$attr["item"])." col-lg-".(12/$attr["item"])." col-md-4 col-sm-6 col-12";
	}
	
}else{
	$attr_class = "col-xxl-2 col-lg-3 col-md-4 col-sm-6 col-12";
}
?>
<style type="text/css">
   .swiper-container {
      width: 100%;
      height: 100%;
      background: #000;
    }
    .swiper-slide {
      font-size: 18px;
      color:#fff;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      padding: 40px 60px;
    }
    .parallax-bg {
      position: absolute;
      left: 0;
      top: 0;
      width: 130%;
      height: 100%;
      -webkit-background-size: cover;
      background-size: cover;
      background-position: center;
    }
    .swiper-slide .title {
      font-size: 41px;
      font-weight: 300;
    }
    .swiper-slide .subtitle {
      font-size: 21px;
    }
    .swiper-slide .text {
      font-size: 14px;
      max-width: 400px;
      line-height: 1.3;
    }
  
</style>
<div class="swiper-container">
    <div class="parallax-bg" style="background-image:url(http://idangero.us/swiper/demos/images/nature-1.jpg)" data-swiper-parallax="-23%"></div>
    <div class="swiper-wrapper">
		<div class="row">
			<?php foreach ($data as $key => $value) { ?>
				<div class="<?php echo $attr_class;?> mb-3 flex-box swiper-slide" data-animated-action="<?php echo (@$attr["animated"] ? $attr["animated"] : "");?>">
					<div class="card">
					  <div class="card-header-top">
					  <a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $this->components->image($value->image,["class" => "card-img-top", "alt" => $value->name,"lazy" => @$attr["lazy"]]);?></a>
					  </div>
					  <div class="card-body">
					    <strong class="card-title"><a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $value->name;?></a></strong>
					   
					    <p class="card-text"><?php echo $value->description;?></p>
					   
					  </div>
					</div>
				</div>
			<?php } ?>
			
		</div>
	</div>
</div>

<?php print_r($pages);?>


<!-- Swiper JS -->
  <?php echo libs_url("js/swiper.js");?>

  <!-- Initialize Swiper -->
  <script type="text/javascript">
  jQuery(document).ready(function(){


    var swiper = new Swiper('.swiper-container', {
      speed: 3500,
      parallax: false,
      slidesPerView : 5,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  });
  </script>