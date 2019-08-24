<div>
	<div class="container">
		<h4>Email New Laster</h4>
		<div class="input-group mb-3">
		  <input type="email" class="form-control" placeholder="Enter Email">
		  <div class="input-group-append">
		    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Submit Email</button>
		  </div>
		</div>
	</div>
</div>
<footer class="app-footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-sm-12">
				<h3>{site_name}</h3>
				<div class="row">
					<div class="col-lg-7 col-sm-12">
						<p><i class="fa fa-map"></i> {full_address}</p>
						<p><i class="fa fa-copyright"></i> Mã số thuế : {company_license_number}</p>
					</div>
					<div class="col-lg-5 col-sm-12">
						<p><i class="fa fa-phone"></i> Phone : <a href="tel:<?php echo config_item("hotline");?>">{hotline}</a></p>
						<p><i class="fa fa-phone"></i> Tel : <a href="tel:<?php echo config_item("ctyphone");?>">{ctyphone}</a></p>
						
					</div>
				</div>
				<p><i class="fa fa-envelope"></i> <a href="mailto:{site_email}?subject=Contact">{site_email}</a></p>
				
				
			</div>

			<div class="col-lg-3 col-sm-12">
				<h3>Về chúng tôi</h3>
				<?php
					echo $this->pages_model->getDropdown(["show_menu" => "footer"]);
				?>
			</div>
			<div class="col-lg-2 col-sm-12">
				<h3>Liên hệ qua</h3>
				<i class="fab fa-facebook fa-2x"></i>
				
				<i class="fab fa-linkedin fa-2x"></i>
				<i class="fab fa-whatsapp fa-2x"></i>
				<i class="fab fa-twitter fa-2x"></i>
				
				
			</div>
		</div>
	</div>
</footer>