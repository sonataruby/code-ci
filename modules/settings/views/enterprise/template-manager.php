<div class="hbox">
	<h4>Template Active <a class="btn btn-primary float-right" href="/settings/enterprise/template/search" sn-link="true" parent-controller="#apps">Search Apps</a></h4>
	<hr>
	<div class="row">
		
		<div class="col-xl-4 col-sm-12 col-md-6">
			<div class="card mb-3">
			  <img src="https://www.dhresource.com/f2/albu/g9/M00/67/DD/rBVaWF1D1-GAe4M3AAGbfutg5TI067.jpg" class="card-img-top" alt="...">
			  
			</div>
			
		</div>
		<div class="col-xl-8 col-sm-12 col-md-6">
			<div class="card mb-3">
			  
			  <div class="card-body">
			    <h5 class="card-title">Card title</h5>
			    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			     <p><a href="#" class="btn btn-outline-primary btn-sm">Điều chỉnh CSS</a> <a href="#" class="btn btn-outline-primary btn-sm">Điều chỉnh CSS</a> <a href="#" class="btn btn-outline-primary btn-sm">Điều chỉnh CSS</a></p>
			  </div>
			  
			</div>
			
		</div>
	</div>

</div>

<div class="hbox">
	<h4>Template on Location</h4>
	<div class="row">
		<?php for($i=1;$i<=12;$i++){ ?>
		<div class="col-xl-4 col-sm-12 col-md-6">
			<div class="card mb-3">
			  <img src="https://www.dhresource.com/f2/albu/g9/M00/67/DD/rBVaWF1D1-GAe4M3AAGbfutg5TI067.jpg" class="card-img-top" alt="...">
			  <div class="card-body">
			    <h5 class="card-title">Card title</h5>
			    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			  </div>
			  <ul class="list-group list-group-flush">
			    <li class="list-group-item">Tác giả : Cras justo odio</li>
			    <li class="list-group-item">Phiên bản : Dapibus ac facilisis in</li>
			    <li class="list-group-item">Định dạng : Vestibulum at eros</li>

			  </ul>
			  <div class="card-body">
			    <a href="#" class="card-link"><?php echo date("d-m-Y h:i:s");?></a>
			    <a href="#" class="card-link float-right btn btn-outline-primary btn-sm">Cài đặt</a>
			  </div>
			</div>
			
		</div>
		<?php } ?>
	</div>
</div>