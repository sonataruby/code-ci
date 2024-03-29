
<?php echo form_open("",["id" => "savedata"]);?>
<div class="row">
	<div class="col-lg-9 col-sm-12">
		<div class="hbox border">
			
			<?php echo $this->forms->text([
				"name" => "page_name",
				"label" => "Page Name",
				"value" => @$data->name
			],[
				"requied" => true
			]);?>
		</div>
		<div class="hbox border" style="min-height: 70vh;">
			<div id="content" name="content"><?php echo (@$data->content ? @$data->content : "<span style=\"font-size:48px;\">T</span>ext content here");?></div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-12 sticky-top">
		<div class="hbox border">
			<button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Public</button>
			<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Draff</button>
		</div>
		<div class="">
			<?php echo $this->forms->gallery([
				"name" => "page_image[]",
				"label" => "Page Layout",
				"value" => @$data->image
			],[]);?>
		</div>
		<div class="hbox border ">
			<div class="btn-group" role="group" aria-label="Basic example">
			  <button type="button" class="btn btn-primary" data-view="desktop" data-target=".fr-wrapper"><i class="fa fa-desktop"></i></button>
			  <button type="button" class="btn btn-primary" data-view="mobile" data-target=".fr-wrapper"><i class="fa fa-mobile-alt"></i></button>
			  <button type="button" class="btn btn-primary" data-view="tablet" data-target=".fr-wrapper"><i class="fa fa-tablet-alt"></i></button>
			</div>

			<hr>

			<?php 
			
                  $pageArv=[];
                  $pageArv[] = "Default";
                  foreach (get_instance()->layout_model->getList() as $key => $value) {  
                  	$pageArv[$value->url] = $value->name;
                  }

			echo $this->forms->select([
				"name" => "page_layout",
				"label" => "Page Layout",
				"value" => @$data->layout,
				"options" => $pageArv
			],[]);?>


			<?php echo $this->forms->text([
				"name" => "page_icoin",
				"label" => "Page Icoin",
				"value" => @$data->icoin
			],["data-inputicoin" => "true"],[
				false,
				'<span class="input-group-append">
			        <button class="btn btn-outline-secondary" type="button" data-icon="'.(@$data->icoin ? @$data->icoin : "fa fa-file-word").'" data-placement="left" role="iconpicker"></button>
			    </span>'
			]);?>


			<?php echo $this->forms->text([
				"name" => "page_tag",
				"label" => "Page Tag's",
				"value" => @$data->tag
			],[],
			[false, '<div class="input-group-append">
			    <button class="btn btn-outline-secondary" type="button"><i class="fa fa-spinner"></i></button>
			  </div>']
			);?>

			

			

		</div>

		<div class="hbox border">
			<h3>SEO Panel</h3>
			<?php echo $this->forms->text([
				"name" => "page_url",
				"label" => "Page URL",
				"value" => @$data->url
			],[],[false, '<div class="input-group-append">
			    <button class="btn btn-primary" type="button" onclick="openWindow(this);"><i class="fa fa-external-link-alt"></i></button>
			  </div>']);?>

			<?php echo $this->forms->textarea([
				"name" => "page_keyword",
				"label" => "Page Keyword",
				"value" => @$data->keyword
			],[
				"rows" => 2
			]);?>


			<?php echo $this->forms->textarea([
				"name" => "page_description",
				"label" => "Page Description",
				"value" => @$data->description
			],["rows" => 2]);?>

		</div>

	</div>
</div>
<?php echo form_close();?>
<?php libs_url('js/exif.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('js/croppie.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('css/croppie.css',['name' => "Font Icoin Picker"]);?>
<?php libs_url('js/bootstrap-iconpicker-iconset-all.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('js/bootstrap-iconpicker.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('css/bootstrap-iconpicker.css',['name' => "Font Icoin Picker"]);?>
<style type="text/css">
	.fr-iframe{
		border:1px solid #ddd;
	}
</style>
<script type="text/javascript">
	function openWindow(obj){
		
		var url = base_url + 'page/' + $(obj).parent().parent().find("input").val() + ".html";
		var win = window.open(url, '_blank');
		if (win) {
		    //Browser has allowed it to be opened
		    win.focus();
		} else {
		    //Browser has blocked it
		    alert('Please allow popups for this website');
		}
	}
	

</script>
<?php addon("addon/editer",["target" => "#content", "form" => "#savedata"]);?>