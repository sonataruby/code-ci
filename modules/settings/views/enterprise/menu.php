<div class="row">
    <div class="col-lg-6 col-sm-12">
        <div class="hbox">
            Menu Groups
            <div class="form-row">
                
                <div class="col-3">
                  <select type="text" class="custom-select" placeholder="Last name"></select>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Enter Menu Groups">
                      <input type="text" class="form-control" placeholder="Enter Menu Groups">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="button-addon2">Add</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hbox">
            <?php echo form_open(false, ["id" => "dataform"]);?>
            <input type="hidden" name="id" value="<?php echo $this->input->get("id");?>">
            <?php if($this->input->get("parent")){ ?>
                <input type="hidden" name="parent_id" value="<?php echo $this->input->get("parent");?>">
            <?php } ?>
            <?php echo $this->forms->text([
                "name" => "name",
                "label" => "Menu Name",
                "value" => @$data->name
            ],["data-inputicoin" => "true","requied" => true],[
               
                '<span class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" data-icon="'.(@$data->icoin ? @$data->icoin : "fa fa-file-word").'" data-placement="right" role="iconpicker"></button>
                </span>',
                 false
                
            ]);?>

            
            <?php echo $this->forms->text([
                "name" => "url",
                "label" => "Menu Link",
                "value" => @$data->url
            ],["requied" => true,'data-autocomplete' => "true"]);?>
            <hr>

           

            <br>
            <button class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            <?php echo form_close();?>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">

        <div class="hbox">
            <h3>Menu List
                <?php if($this->input->get("parent")) { ?>
                    <a class="float-right btn btn-primary" href="?">Back</a>
                <?php } ?>
            </h3>
            <div class="dd">
                <?php print_r($item); ?>
            </div>
        </div>
    </div>
</div>

<?php libs_url("js/tagcomplete.js");?>
<?php libs_url("css/tagcomplete.css");?>
<style type="text/css">
    .tags_container{
        display: block;
    }
</style>


<?php libs_url("js/jquery.nestable.js");?>
<?php libs_url("css/jquery.nestable.css");?>


<script type="text/javascript">
    var autoComplete = function(){


        $("[data-autocomplete]").tagComplete({

          // wether the tagcomplete input should be hidden or not
          hide: false,

          // input limit to start the ajax
          keyLimit: 1,

          // tokenizer
          tokenizer: ",",

          // allows users to insert their own data
          freeInput : true,

          // allows usert to edit the tags input
          freeEdit : true,
          setView : <?php echo $menutagSelect;?>,
          // autocomplete options
          autocomplete: {

            // data
            data: [],

            // ajax options
            ajaxOpts: {
              url: "/settings/enterprise/menu/menutag",
              method: 'GET',
              dataType: 'json',
              data: {}
            },

            // remote query parameters
            params : function(value){
              
              return {q: value};
            },

            // proccess data
            proccessData: function(data){
               
              return data;
            },
            

          }
          
        });
    };
	var getEdit = function(id){
			
            window.location.href= "/settings/enterprise/menu/manager?id="+id;
			$("#dataform").find('input[name="id"]').val(id);

			$.ajax({
                type: "POST",
                url: '/settings/enterprise/menu/jsoninfo/'+id,
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
                url: '/settings/enterprise/menu/createjson',
                data : {parent_id : parent_id, "name" : "Menu Name"},
                dataType : "json",
                success: function(data){
                	console.log(data);
                    $('.dd').nestable('add', {"id":data.id,"parent_id":parent_id, "content" : "Menu Name"});
                }
            });
		};

		var getDelete = function(catalog_id){

			$.ajax({
                type: "POST",
                url: '/settings/enterprise/menu/delete/'+catalog_id,
                dataType : "json",
                success: function(data){

                	if(data.status == "success"){
                		$('.dd').nestable('remove', catalog_id);
                		$("#dataform").find("input").val("");
                	}
                    
                }
            });
		};

		

	$().ready(function(){

        
        autoComplete();
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
	            html += '<div class="dd-panel" panel-id="'+item.id+'"><a onClick="getCreate('+item.id+')"><i class="fa fa-plus"></i></a> <a onClick="getEdit('+item.id+')"><i class="fa fa-edit"></i></a> <a onClick="getDelete('+item.id+')"><i class="fa fa-trash"></i></a> </div>';
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
                url: '/settings/enterprise/menu/sorts',
                data : {data : data},
                dataType : "json",
                success: function(data){

                }
            });

			
		});

        
		$("#dataform").bind("submit", function(){
			
			
			var menu_name = $(this).find('input[name="name"]').val();
			var menu_id = $(this).find('input[name="id"]').val();
			
			if(menu_name == ""){
				alert("Input Catalog Name");
				return false;
			}
			var data = $( this ).serialize();
			
			$.ajax({
                type: "POST",
                url: '/settings/enterprise/menu/savejson/' + menu_id,
                data : data,
                dataType : "json",
                success: function(data){
                    
                	if(menu_id != ""){
                		$('[data-id="'+menu_id+'"] .dd-content a').eq(0).text(menu_name);
                	}else{

                		$('.dd').nestable('add', {"id":data.id, "content" : name});
                	}
                	$("#dataform input").val("");
                    
                }
            });

			return false;
		});
        

	})
</script>
