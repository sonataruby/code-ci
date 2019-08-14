<div class="hbox">
	<h3>Channel <select class="form-control col-lg-3 col-sm-12 float-right" onchange="window.location.href='/posts/enterprise/catalog?channel='+this.value">
		<option value="">Default</option>
		<?php foreach (config_item("channel") as $key => $value) { ?>
			<option value="<?php echo $value->url;?>" <?php echo ($value->url == $this->input->get("channel") ? "selected" : "");?>><?php echo $value->name;?></option>
		<?php } ?>
		
	</select></h3>
	
</div>

<div class="row">
	<div class="col-lg-6 col-sm-12">
		<div class="hbox">
			<?php echo form_open(false, ["id" => "dataform"]);?>
			<input type="hidden" name="catalog_id" value="">
			<input type="hidden" name="channel" value="<?php echo $this->input->get("channel");?>">
			<?php if($this->input->get("parent")){ ?>
				<input type="hidden" name="catalog_parent" value="<?php echo $this->input->get("parent");?>">
			<?php } ?>
			<?php echo $this->forms->text([
				"name" => "catalog_name",
				"label" => "Catalog Name",
				"value" => @$data->catalog_name
			],[
				"requied" => true
			]);?>

			<?php echo $this->forms->textarea([
				"name" => "catalog_content",
				"label" => "Page Name",
				"value" => @$data->catalog_content
			],[
				"requied" => true
			]);?>

			<br>
			<button class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
			<?php echo form_close();?>
		</div>
	</div>
	<div class="col-lg-6 col-sm-12">
		
		<div class="hbox">
			<h3>Catalog List
				<?php if($this->input->get("parent")) { ?>
					<a class="float-right btn btn-primary" href="?">Back</a>
				<?php } ?>
			</h3>
			<div class="dd">
				<?php echo makeSortItem($ListNode);?>
			</div>
		</div>
	</div>
</div>

<?php 
function makeSortItem($arv=[]){
	if(!$arv) return;
	$html = '<ol class="dd-list">';
	foreach ($arv as $key => $value) {
		$show_dashboard = ($value->show_dashboard == 1 ? "bg-success text-white" : "");
		$show_menu = ($value->show_menu == 1 ? "bg-success text-white" : "");
		$show_header = ($value->show_header == 1 ? "bg-success text-white" : "");
		$status = ($value->status == 1 ? "bg-success text-white" : "bg-danger text-white");
		
		$html .= '<li class="dd-item" data-id="'.$value->id.'"><div class="dd-handle">Drag</div><div class="dd-content"><a href="?parent='.$value->id.'">'.$value->name.'</a><div class="dd-panel" panel-id="'.$value->id.'"><a onClick="getCreate('.$value->id.')"><i class="fa fa-plus"></i></a> <a onClick="getEdit('.$value->id.')"><i class="fa fa-edit"></i></a> <a onClick="getDelete('.$value->id.')"><i class="fa fa-trash"></i></a> <a class="'.$show_dashboard.'" onClick="changeEvent(\'show_dashboard\','.$value->id.', this)" data-status="'.$value->show_dashboard.'"><i class="fa fa-tachometer-alt"></i></a> <a class="'.$show_header.'" onClick="changeEvent(\'show_header\','.$value->id.', this)" data-status=""><i class="fa fa-align-justify"></i></a> <a class="'.$show_menu.'" onClick="changeEvent(\'show_menu\','.$value->id.', this)" data-status="'.$value->show_menu.'"><i class="fa fa-ellipsis-v"></i></a> <a class="'.$status.'" onClick="changeEvent(\'status\','.$value->id.', this)" data-status="'.$value->status.'"><i class="fa fa-unlock'.($value->status == 1 ? "-alt" : "").'"></i></a></div></div>'.(isset($value->item) ? makeSortItem($value->item) : "").'</li>';
	}
	$html .= '</ol>';
	return $html;
}
?>

<script type="text/javascript">

	var getEdit = function(id){
			
			$("#dataform").find('input[name="catalog_id"]').val(id);

			$.ajax({
                type: "POST",
                url: '/posts/enterprise/catalog/catalogjson/'+id,
                dataType : "json",
                success: function(data){
                	
                    $.each(data, function(i, item){
                    	$('#dataform input[name="'+i+'"]').val(item);

                    });
                }
            });
		};

		var getCreate = function(parent_id){
			
			
			$.ajax({
                type: "POST",
                url: '/posts/enterprise/catalog/createcatalog',
                data : {catalog_parent : parent_id, "catalog_name" : "Catalog Name", "channel" : "<?php echo $this->input->get("channel");?>"},
                dataType : "json",
                success: function(data){
                	console.log(data);
                    $('.dd').nestable('add', {"id":data.catalog_id,"parent_id":parent_id, "content" : "Catalog Name"});
                }
            });
		};

		var getDelete = function(catalog_id){

			$.ajax({
                type: "POST",
                url: '/posts/enterprise/catalog/catalogdelete/'+catalog_id,
                dataType : "json",
                success: function(data){

                	if(data.status == "success"){
                		$('.dd').nestable('remove', catalog_id);
                		$("#dataform").find("input").val("");
                	}
                    
                }
            });
		};

		var changeEvent = function (field, catalog_id, obj){
			
			now_status = $(obj).attr("data-status");
			$.ajax({
                type: "POST",
                url: '/posts/enterprise/catalog/catalogstatus/'+catalog_id,
                data : {field : field, value : now_status},
                dataType : "json",
                success: function(data){
                	if(data.status == "success"){
                		if(now_status == "0"){
                			$(obj).attr("data-status",1);
                			$(obj).removeClass("bg-danger");
                			$(obj).addClass("bg-success text-white");
                		}else{
                			$(obj).attr("data-status",0);
                			$(obj).removeClass("bg-success");
                			$(obj).addClass("bg-danger text-white");
                		}
                		
                	}
                    
                }
            });
		};

	$().ready(function(){

		$('.dd').nestable({ 
			contentNodeName : "div",
        	itemRenderer: function(item_attrs, content, children, options, item) {
	            var item_attrs_string = $.map(item_attrs, function(value, key) {
	                return ' ' + key + '="' + value + '"';
	            }).join(' ');
	            
	            var html = '<' + options.itemNodeName + item_attrs_string + '>';
	            html += '<' + options.handleNodeName + ' class="' + options.handleClass + '">Drag</' + options.handleNodeName + '>';

	            html += '<' + options.contentNodeName + ' class="' + options.contentClass + '">';
	            html += '<a href="?parent='+item.id+'">'+content+'</a>';
	            html += '<div class="dd-panel" panel-id="'+item.id+'"><a onClick="getCreate('+item.id+')"><i class="fa fa-plus"></i></a> <a onClick="getEdit('+item.id+')"><i class="fa fa-edit"></i></a> <a onClick="getDelete('+item.id+')"><i class="fa fa-trash"></i></a> <a onClick="changeEvent(\'show_dashboard\','+item.id+', this)" data-status="0"><i class="fa fa-tachometer-alt"></i></a> <a onClick="changeEvent(\'show_header\','+item.id+', this)" data-status="0"><i class="fa fa-align-justify"></i></a> <a onClick="changeEvent(\'show_menu\','+item.id+', this)" data-status="0"><i class="fa fa-ellipsis-v"></i></a> <a onClick="changeEvent(\'status\','+item.id+', this)" data-status="0"><i class="fa fa-unlock"></i></a></div>';
	            html += '</' + options.contentNodeName + '>';
	            
	            html += children;
	            html += '</' + options.itemNodeName + '>';

	            return html;
	        },
			group: 1,
		}).on('change', function(e){
			var list = e.length ? e : $(e.target);
	        if(window.JSON) {
	            data = window.JSON.stringify(list.nestable('serialize'));//, null, 2));
	        }
	        else {
	            data = 'JSON browser support required for this demo.';
	        }


	        $.ajax({
                type: "POST",
                url: '/posts/enterprise/catalog/catalogsorts',
                data : {data : data},
                dataType : "json",
                success: function(data){

                }
            });

			
		});


		$("#dataform").bind("submit", function(){
			
			
			var catalog_name = $(this).find('input[name="catalog_name"]').val();
			var catalog_id = $(this).find('input[name="catalog_id"]').val();
			
			if(catalog_name == ""){
				alert("Input Catalog Name");
				return false;
			}
			var data = $( this ).serialize();
			
			$.ajax({
                type: "POST",
                url: '/posts/enterprise/catalog/catalogsavejson/' + catalog_id,
                data : data,
                dataType : "json",
                success: function(data){

                	if(catalog_id != ""){
                		$('[data-id="'+catalog_id+'"] .dd-content a').eq(0).text(catalog_name);
                	}else{

                		$('.dd').nestable('add', {"id":data.catalog_id, "content" : catalog_name});
                	}
                	$("#dataform input").val("");
                    
                }
            });

			return false;
		});

	})
</script>
<?php libs_url("js/jquery.nestable.js");?>
<?php libs_url("css/jquery.nestable.css");?>