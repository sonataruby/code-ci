<?php
if(isset($attr["item"])){
	$attr_class = "col-xxl-".(12/$attr["item"])." col-lg-".(12/$attr["item"])." col-md-4 col-sm-6 col-12";
}else{
	$attr_class = "col-xxl-2 col-lg-3 col-md-4 col-sm-6 col-12";
}
?>
<div class="row">
	<?php foreach ($data as $key => $value) { ?>
		<div class="<?php echo $attr_class;?> mb-3 flex-box" data-animated-action="<?php echo (@$attr["animated"] ? $attr["animated"] : "");?>">
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

<?php print_r($pages);?>