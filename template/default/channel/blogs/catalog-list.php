<section class="nav-breadcrumb mb-4">
	<div class="container">
		<?php echo $this->components->breadcrumb(false,["active" => "All Post"]);?>
	</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-lg-9 col-sm-12">
			<h3>{lang_category} <?php echo @config_item("channel")->{$channel}->name;?></h3>
			<?php $this->components->catalog($channel,["limit" => 20, "theme" => "card"]);?>
			<hr>
			<h3>{lang_news_item}</h3>
			<hr>
			<div class="content">
				<?php $this->components->posts($channel,["limit" => 8]);?>
			</div>
		</div>
		<div class="col-lg-3 col-sm-12">
			<?php $this->components->slidebar(false,["type" => "rightslide"]);?>
		</div>
	</div>
</div>
