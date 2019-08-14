<footer class="app-footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-sm-12">
				<h3><?php echo config_item("site_name");?></h3>
				<p><?php echo config_item("address");?>, <?php echo config_item("address");?>, <?php echo config_item("address");?>, <?php echo config_item("country");?></p>
				<p>Hotline : <?php echo config_item("hotline");?></p>
			</div>
			<div class="col-lg-3 col-sm-12">
				<h3>Infomation</h3>
				<?php
					echo $this->pages_model->getDropdown(["show_menu" => "footer"]);
				?>
			</div>
			<div class="col-lg-3 col-sm-12">
				<h3>Social</h3>
				<i class="fab fa-facebook fa-2x"></i>
				<i class="fab fa-google fa-2x"></i>
				<i class="fab fa-linkedin fa-2x"></i>
				<i class="fab fa-whatsapp fa-2x"></i>
				<i class="fab fa-twitter fa-2x"></i>
				
				
			</div>
		</div>
	</div>
</footer>