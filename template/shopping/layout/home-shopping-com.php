<div class="slider">
<div class="container"><img class="w-100" src="https://lorempixel.com/1600/480/?72572" /></div>
</div>
<section>
<div class="container">
<h2>Chương tr&igrave;nh tour Thang 10</h2>
{components=posts}limit=12{/components}</div>
</section>
<section>
<div class="container">
<h2>Tour được quan t&acirc;m</h2>
{components=posts}limit=6{/components}</div>
</section>
<section>
<div class="container">
<h2>Điểm đến l&yacute; tưởng</h2>
{components=posts}limit=6{/components}</div>
</section>
<section class="pt-4 pb-4">
<div class="container">
<div class="row">
<div class="col-lg-4 col-sm-12 col-md-12 col-4">
<h3>Hướng dẫn kh&aacute;ch h&agrave;ng</h3>
<ul class="list-group list-group-flush">
<li class="list-group-item">Hướng dẫn mua h&agrave;ng</li>
<li class="list-group-item">Hướng dẫn thanh to&aacute;n</li>
<li class="list-group-item">Hướng dẫn vận chuyển</li>
<li class="list-group-item">Hướng dẫn bảo h&agrave;nh</li>
<li class="list-group-item">Hướng dẫn đổi trả</li>
</ul>
</div>
<div class="col-lg-4 col-sm-12 col-md-6 col-4">
<h3>{site_name}</h3>
<p>{full_address}</p>
<p>M&atilde; số thuế : {company_license_number}</p>
<p>Phone : <a href="tel:&lt;?php echo config_item(">{hotline}</a></p>
<p>Tel : <a href="tel:&lt;?php echo config_item(">{ctyphone}</a></p>
<p><a href="mailto:{site_email}?subject=Contact">{site_email}</a></p>
</div>
<div class="col-lg-4 col-sm-12 col-md-6 col-4">
<h3>Chi nh&aacute;nh HCM</h3>
<p>{full_address}</p>
<p>M&atilde; số thuế : {company_license_number}</p>
<p>Phone : <a href="tel:&lt;?php echo config_item(">{hotline}</a></p>
<p>Tel : <a href="tel:&lt;?php echo config_item(">{ctyphone}</a></p>
<p><a href="mailto:{site_email}?subject=Contact">{site_email}</a></p>
</div>
</div>
</div>
</section>