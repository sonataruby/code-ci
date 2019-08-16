<div class="row">
	<div class="col-lg-5 col-sm-12">
		
		<h4>{site_name}</h4>
		<p><i class="fa fa-phone fa-2x"></i> <a href="tell:<?php echo config_item("hotline");?>">{hotline}</a></p>
		<p><i class="fa fa-map fa-2x"></i> {full_address}</p>
		<p><i class="fa fa-envelope fa-2x"></i> <a href="mailto:{site_email}?subject=Contact">{site_email}</a></p>

	</div>
	<div class="col-lg-7 col-sm-12">
		<div class="card card-body">
			<form>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
			  </div>
			  
			  <div class="form-group">
			    <label for="exampleInputEmail1">Subject</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
			  </div>


			  <div class="form-group">
			    
			    <textarea type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"></textarea>
			  </div>

			  <button type="submit" class="btn btn-primary">Send Contact</button>
			</form>
		</div>
	</div>
	
</div>