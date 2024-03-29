<section class="nav-breadcrumb mb-4">
	<div class="container">
		<?php echo $this->components->breadcrumb(false,["active" => lang("login")]);?>
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-sm-12">
				<h3>{lang_welcome_login}</h3>
				<p>{lang_welcome_login_description}</p> 
				<h4>{site_name}</h4>
				<p><i class="fa fa-phone fa-2x"></i> <a href="call:{hotline}">{hotline}</a></p>
				<p><i class="fa fa-map fa-2x"></i> {full_address}</p>
				<p><i class="fa fa-envelope fa-2x"></i> <a href="mailto:{site_email}?subject=Contact">{site_email}</a></p>

			</div>
			<div class="col-lg-7 col-sm-12">
				<div class="card card-body">
				<h5><?php echo lang("login");?></h5>
				<hr>
				<?php echo form_open();?>
				<input type="hidden" name="ref" value="<?php echo $this->input->get("ref");?>">
				<?php echo $this->forms->text([
					"name" => "email",
					"label" => '{lang_email}',
					"value" => "",

				],[
					"required" => TRUE,
					"group" => true,
					"type" => "email",
					"placeholder" => "{lang_enter_email}"
				],[false, '<div class="input-group-append">
    <button class="btn btn-info" type="button" id="button-addon2"><i class="fa fa-spinner"></i></button>
  </div>']);?>

				<?php echo $this->forms->text([
					"name" => "password",
					"label" => '{lang_password}',
					"value" => "",
					
				],[
					"required" => true,
					"group" => true,
					"placeholder" => "{lang_enter_password}",
					"type" => "password"
				],[false, '<div class="input-group-append">
    <button class="btn btn-outline-secondary" data-viewpass="true" type="button" id="button-addon2"><i class="fa fa-eye"></i></button>
  </div>']);?>

				<?php echo $this->forms->checkbox([
					"name" => "remember",
					"label" => "Password",
					"value" => "",
					"options" => [["label" => "{lang_remember_login}", "value" => 1]]
				],[
					"label" => false,
					"group" => true
				]);?>

				<div class="row">
					<div class="col-6"><a href="<?php echo site_url("account/register");?>">{lang_register}</a></div>
					<div class="col-6 text-right"><a href="<?php echo site_url("account/forget");?>">{lang_forget_password}</a></div>
				</div>
				<hr>
				<button class="btn btn-primary" type="submit">{lang_button_login}</button>
				<?php echo form_close();?>
				</div>
			</div>
			
		</div>
	</div>
</section>