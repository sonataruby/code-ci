<div class="slider">
	<div class="container">
		<img src="https://lorempixel.com/1600/480/?72572" class="w-100">
	</div>
</div>

<section>
	<div class="container">
		<h2>Sản phẩm mới</h2>
		{components=posts}type=products&limit=12&item=5{/components}
	</div>
</section>

<section class="hotcatalogTabs">
	<div class="container">
		<h2>Nổi bật nhất</h2>
		{components=catalog}type=products&source=tabs&limit=6{/components}
	</div>
</section>


<section class="pt-4 pb-4">
	<div class="container">
		
		<div class="row">
			<div class="col-lg-4 col-sm-12 col-md-12 col-4">
				<h3>Chính sách bán hàng</h3>
				<ul class="list-group list-group-flush">
				  <li class="list-group-item">Hướng dẫn mua hàng</li>
				  <li class="list-group-item">Hướng dẫn thanh toán</li>
				  <li class="list-group-item">Hướng dẫn vận chuyển</li>
				  <li class="list-group-item">Hướng dẫn bảo hành</li>
				  <li class="list-group-item">Hướng dẫn đổi trả</li>
				</ul>
			</div>
			<div class="col-lg-4 col-sm-12 col-md-6 col-4">
				<h3>{site_name}</h3>
				
				<p><i class="fa fa-map"></i> {full_address}</p>
				<p><i class="fa fa-copyright"></i> Mã số thuế : {company_license_number}</p>
				<p><i class="fa fa-phone"></i> Phone : <a href="tel:<?php echo config_item("hotline");?>">{hotline}</a></p>
				<p><i class="fa fa-phone"></i> Tel : <a href="tel:<?php echo config_item("ctyphone");?>">{ctyphone}</a></p>
				<p><i class="fa fa-envelope"></i> <a href="mailto:{site_email}?subject=Contact">{site_email}</a></p>
			</div>
			<div class="col-lg-4 col-sm-12 col-md-6 col-4">
				<h3>{site_name}</h3>
				
				<p><i class="fa fa-map"></i> {full_address}</p>
				<p><i class="fa fa-copyright"></i> Mã số thuế : {company_license_number}</p>
				<p><i class="fa fa-phone"></i> Phone : <a href="tel:<?php echo config_item("hotline");?>">{hotline}</a></p>
				<p><i class="fa fa-phone"></i> Tel : <a href="tel:<?php echo config_item("ctyphone");?>">{ctyphone}</a></p>
				<p><i class="fa fa-envelope"></i> <a href="mailto:{site_email}?subject=Contact">{site_email}</a></p>
			</div>
		</div>
	</div>
</section>

<style type="text/css">
	.hotcatalog{
		position: relative;
		display: flex;
		flex-direction:row;
	}
	.hotcatalog ul.list-group{
		flex-direction:revert;
		display: block;
		margin-left: -30px;
		width: 100%;
	}
	.hotcatalog ul li{
		float: left;
		width: calc(100%/4);
		padding: 0;
		margin: 0;
		border:0;
		margin-left: 30px; 
		margin-bottom: 15px;

	}
	.hotcatalog ul li a{
		display: block;
		border: 1px solid #ddd;
		padding:7px 15px; 
	}
</style>