<div class="hbox">
	<h4>Config system</h4>
</div>

<div class="hbox">
	<?php 
	//$this->forms->template("inline");
	echo $this->forms->text([
		"name" => "catalog_name",
		"label" => "Site Name",
		"value" => @$data->catalog_name
	],[
		"required" => true,
		"group" => 'row',
		"layout" => "inline"
	]);?>



	<?php echo $this->forms->textarea([
		"name" => "catalog_name",
		"label" => "Description",
		"value" => @$data->catalog_name
	],[
		"required" => true,
		"group" => 'row',
		"layout" => "inline",
		"rows" => 2
	]);?>


	<?php echo $this->forms->textarea([
		"name" => "catalog_name",
		"label" => "Keyword",
		"value" => @$data->catalog_name
	],[
		"required" => true,
		"group" => 'row',
		"layout" => "inline",
		"rows" => 2
	]);?>



	<?php echo $this->forms->select([
		"name" => "catalog_name",
		"label" => "Catalog Name",
		"value" => @$data->catalog_name
	],[
		"requied" => true,
		"group" => 'row',
		"layout" => "inline",
	]);?>



	<?php echo $this->forms->contact([
		"name" => "catalog_name",
		"label" => "Catalog Name",
		"value" => @$data->catalog_name
	],[
		"requied" => true
	]);?>



	

</div>