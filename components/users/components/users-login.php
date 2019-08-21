<?php if(is_login()){ ?>
 
  <div class="text-center">
    <img src="<?php echo site_url($data->avatar);?>" class="img-fluid img-thumbnail rounded-circle" style="max-width: 65px;">
    <h4><?php echo $data->firstname;?> <?php echo $data->lastname;?></h4>
  </div>

	<ul class="list-group list-group-flush">
  
	  	<li class="list-group-item"><a href="/account/personal/profile"><i class="fa fa-user-circle"></i> {lang_profile}</a></li>
	    <li class="list-group-item"><a href="/account/personal/changepass"><i class="fa fa-key"></i> {lang_changepass}</a></li>

	    <?php if(@$data->account_type == "enterprise"){ ?>
	        <li class="list-group-item"><a href="/enterprise"><i class="fa fa-user-shield"></i> {lang_admin_panel}</a></li>
	    <?php } ?>

	    <?php if(@$data->account_type == "personal"){ ?>
	        <li class="list-group-item"><a href="/personal">Administrator</a></li>
	    <?php } ?>

	    <li class="list-group-item"><a href="/account/logout"><i class="fa fa-lock"></i> {lang_logout}</a></li>
	</ul>
<?php }else{ ?>
<?php echo form_open("account/login");?>
<div class="form-group">
    <label for="exampleInputEmail1">{lang_email}</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">{lang_password}</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">{lang_button_login}</button>

<?php echo form_close();?>
<?php } ?>