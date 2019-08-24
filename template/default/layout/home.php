{components=html5}type=round&color=red&content=<h1>Con bo</h1>{/components}

<section class="services">
  	<div class="container">
      <div class="row d-flex">
      <div class="col-lg-4 col-sm-12 flex-box hidden-xs">
        	<div class="border">[plugin name="posts/catalog"]limit=5&order=desc[/plugin]</div>
      </div>
        
      <div class="col-lg-8 col-sm-12">
        <div class="row flex-box-card">
              <div class="col-lg-6 col-sm-12 mb-3 text-center">
              	<div class="card card-body">
                  <div class="text-center"><i class="fa fa-home fa-3x border p-3 rounded"></i></div>
                  <h3>Cung cấp đồng hồ lưu lượng </h3>
                  <p>Chuyên cung cấp các sản phẩm đồng hồ lưu lượng trên toàn quốc</p>
                </div>
              </div>
              <div class="col-lg-6 col-sm-12 mb-3 text-center">
                  <div class="card card-body">
                      <div class="text-center"><i class="fa fa-home fa-3x border p-3 rounded"></i></div>
                      <h3>Cung cấp đồng hồ nước</h3>
                      <p>Chuyên cung cấp các sản phẩm đồng hồ nước trên toàn quốc</p>
                  </div>
              </div>

              <div class="col-lg-6 col-sm-12 text-center">
                <div class="card card-body">
                    <div class="text-center"><i class="fa fa-home fa-3x border p-3 rounded"></i></div>
                    <h3>Cung cấp van công nghiệp</h3>
                    <p>Chuyên cung cấp các sản phẩm van công nghiệp  trên toàn quốc</p>
                </div>
              </div>

              <div class="col-lg-6 col-sm-12 text-center">
                <div class="card card-body">
                    <div class="text-center"><i class="fa fa-home fa-3x border p-3 rounded"></i></div>
                    <h3>Cung cấp máy bơm</h3>
                    <p>Chuyên cung cấp các sản phẩm máy bơm công nghiệp trên toàn quốc</p>
                </div>
              </div>
        </div>
        </div>
        
        </div>
	</div>
</section>
<section>
  	<div class="container" data-animated="true" data-sequence="150">
      {components=posts}limit=5&theme=masonry&animated=bounceIn{/components}
    </div>
</section>
<section>
  	<div class="container" data-animated="true" data-sequence="200">
      <h3>Sản phẩm chủ lực</h3>
      {components=posts}limit=5&animated=fadeIn{/components}
	</div>
</section>



<section>
  	<div class="container">
     <h1 class="text-center">Đối tác</h1>
     [components name="gallery" class="col-lg-3 mb-3" type="slide"]limit=12&tags=doitac[/components]
      
	</div>
</section>
