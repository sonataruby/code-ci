<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-sm-12">
				<h5>Login</h5>
				<hr>
				<?php echo form_open();?>
				<?php echo $this->forms->text([
					"name" => "email",
					"label" => "Email",
					"value" => "",

				],[
					"required" => TRUE,
					"group" => true,
					"placeholder" => "Enter Email address"
				],[false, '<div class="input-group-append">
    <button class="btn btn-info" type="button" id="button-addon2"><i class="fa fa-spinner"></i></button>
  </div>']);?>

				
				<div class="row">
					<div class="col-6"><a href="<?php echo site_url("account/register");?>">Register</a></div>
					<div class="col-6 text-right"><a href="<?php echo site_url("account/login");?>">Login</a></div>
				</div>
				<hr>
				<button class="btn btn-primary" type="submit">Send password</button>
				<?php echo form_close();?>
			</div>
			<div class="col-lg-5 col-sm-12">
				
			</div>
		</div>
	</div>
</section>