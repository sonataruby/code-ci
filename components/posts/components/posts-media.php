<?php
if(isset($attr["item"])){
	$attr_class = "col-xxl-".(12/$attr["item"])." col-lg-".(12/$attr["item"])." col-md-4 col-sm-6 col-12";
}else{
	$attr_class = "col-xxl-2 col-lg-3 col-md-4 col-sm-6 col-12";
}
?>
<ul>
<?php foreach ($data as $key => $value) { ?>
	<li class="border-bottom mb-2">
		<div class="media">
		  <div class="mr-3" style="width: 35%;">
		  	<a href="<?php echo post_url($value->url, $value->channel);?>">
		  		<?php echo $this->components->image($value->image,["class" => "w-100", "alt" => $value->name,"lazy" => @$attr["lazy"]]);?>
		  	</a>
		  </div>
		  <div class="media-body text">
		    <div class="line-2"><a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $value->name;?></a></div>
		    
		  </div>
		</div>
	</li>
<?php } ?>
</ul>