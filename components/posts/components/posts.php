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
<div class="row">
	<?php foreach ($data as $key => $value) { ?>
		<div class="<?php echo $attr_class;?> mb-3 flex-box" data-animated-action="<?php echo (@$attr["animated"] ? $attr["animated"] : "");?>">
			<div class="card">
			  <div class="card-header-top">
			  <a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $this->components->image($value->image,["class" => "card-img-top", "alt" => $value->name,"lazy" => @$attr["lazy"]]);?></a>
			  </div>
			  <div class="card-body text">
			    <strong class="line-2"><a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $value->name;?></a></strong>
			   	
			   	<?php if(@$value->itemView){
			   		echo $value->itemView;
			   	}else{ ?>
			    <p class="card-text line-3"><?php echo $value->description;?></p>
			   	<?php } ?>
			  </div>
			</div>
		</div>
	<?php } ?>
	
</div>

<?php print_r($pages);?>