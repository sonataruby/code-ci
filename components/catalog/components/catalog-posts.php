<?php foreach ($data as $keyC => $valueC) { ?>
<h1><?php echo $valueC->name;?> <a class="btn btn-link float-right" href="<?php echo catalog_url($valueC->url, $valueC->channel);?>">More..</a></h1>
<div class="row">
	<div class="col-lg-3 col-sm-12 flex-box mb-lg-0 mb-sm-3">
		<?php 
			$first = array_pop($valueC->posts);
			if($first){
		?>
		<div class="card">
			  <div class="card-header-top">
			  <a href="<?php echo post_url($first->url, $first->channel);?>"><?php echo $this->components->image($first->image,["class" => "card-img-top", "alt" => $first->name,"lazy" => @$attr["lazy"]]);?></a>
			  </div>
			  <div class="card-body">
			    <strong class="card-title"><a href="<?php echo post_url($first->url, $first->channel);?>"><?php echo $first->name;?></a></strong>
			   
			    <p class="card-text"><?php echo $first->description;?></p>
			   
			  </div>
			
		</div>
		<?php } ?>
	</div>
	<div class="col-lg-9 col-sm-12">
		<div class="row">
		<?php foreach ($valueC->posts as $key => $value) { ?>
			<div class="col-lg-five col-md-6 col-sm-12 <?php echo ($key < 5 ? "mb-3" : "mb-lg-0 mb-sm-3");?> flex-box" data-animated-action="<?php echo (@$attr["animated"] ? $attr["animated"] : "");?>">
				<div class="card text">
				  <div class="card-header-top">
				  <a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $this->components->image($value->image,["class" => "card-img-top", "alt" => $value->name,"lazy" => @$attr["lazy"]]);?></a>
				  </div>
				  <div class="card-body">
				    <strong class="line-2"><a href="<?php echo post_url($value->url, $value->channel);?>"><?php echo $value->name;?></a></strong>
				   
				    <p class="line-3"><?php echo $value->description;?></p>
				   
				  </div>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</div>
<?php } ?>