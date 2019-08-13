<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-sm-12">
				<h5>Login</h5>
				<hr>
				<?php echo form_open();?>
				<input type="hidden" name="ref" value="<?php echo $this->input->get("ref");?>">
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

				<?php echo $this->forms->text([
					"name" => "password",
					"label" => "Password",
					"value" => "",
					
				],[
					"required" => true,
					"group" => true,
					"placeholder" => "Enter password",
					"type" => "password"
				],[false, '<div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-eye"></i></button>
  </div>']);?>

				<?php echo $this->forms->checkbox([
					"name" => "remember",
					"label" => "Password",
					"value" => "",
					"options" => [["label" => "Remember login", "value" => 1]]
				],[
					"label" => false,
					"group" => true
				]);?>

				<div class="row">
					<div class="col-6"><a href="<?php echo site_url("account/register");?>">Register</a></div>
					<div class="col-6 text-right"><a href="<?php echo site_url("account/forget");?>">For get password</a></div>
				</div>
				<hr>
				<button class="btn btn-primary" type="submit">Login</button>
				<?php echo form_close();?>
			</div>
			<div class="col-lg-5 col-sm-12">
				
			</div>
		</div>
	</div>
</section>