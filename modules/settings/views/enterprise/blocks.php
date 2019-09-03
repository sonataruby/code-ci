<?php echo form_open(false,["id" => "serialize"]);?>
<input type="hidden" name="edit" value="<?php echo $this->input->get("edit");?>">
<div class="hbox">
	<h4>Blocks Manager
		<div class="float-right">
			
			<a class="btn btn-info" href="/settings/enterprise/template/blocks/?filter=<?php echo $this->input->get("filter");?>">New</a>
			<button type="submit" class="btn btn-info">Save</button>
		</div>
	</h4>
</div>


	<div class="row">
		<div class="col-3 flex-box">
			<div class="hbox">
				<select class="form-control" onchange="window.location.href='/settings/enterprise/template/blocks?filter='+this.value;">
					<?php
					$arv = ["topbar","header","footer","leftsilde","rightslide"];
					foreach ($arv as $key => $value) { ?>
						<option value="<?php echo $value;?>" <?php echo ($this->input->get("filter") == $value ? "selected" : "");?>><?php echo $value;?></option>
					<?php } ?>
					
				</select>
				<hr>
				
				<ul class="list-group" id="element">
  
				<?php foreach ($data as $key => $value) { ?>
					<li id="item-<?php echo $value->winget_id;?>" class="list-group-item"><a class="d-block" href="/settings/enterprise/template/blocks/<?php echo $value->winget_id;?>?filter=<?php echo $this->input->get("filter");?>"><i class="<?php echo $value->winget_icon;?>"></i> <?php echo $value->winget_name;?></a></li>
				<?php } ?>
				</ul>
			</div>
		</div>
		<div class="col flex-box">
			<div class="hbox">
				
				<div class="row">
					<div class="col-lg-7">
						<?php 
						

						echo $this->forms->text([
							"name" => "winget_name",
							"label" => "Name",
							"value" => @$content->winget_name
						],[
							"required" => true,
							"group" => 'outline-group',
							"layout" => "outline"
						]);?>
					</div>
					<div class="col-lg-5">
						<?php 
						

						echo $this->forms->select([
							"name" => "winget_content_as",
							"label" => "Name",
							"value" => @$content->winget_content_as,
							"options" => ["0" => "Display Title", "1" => "Hide Title"]
						],[
							"required" => true,
							"group" => 'outline-group',
							"layout" => "outline"
						]);?>
					</div>
				</div>

			<?php echo $this->forms->text([
				"name" => "winget_icon",
				"label" => "Page Icoin",
				"value" => @$content->winget_icon
			],["data-inputicoin" => "true"],[
				
				'<span class="input-group-append">
			        <button class="btn btn-outline-secondary" type="button" data-icon="'.(@$content->winget_icon ? @$content->winget_icon : "fa fa-file-word").'" data-placement="left" role="iconpicker"></button>
			    </span>',
			    false
			]);?>

			<?php echo $this->forms->text([
                "name" => "winget_display",
                "label" => "Display",
                "value" => @$content->winget_display ? @$content->winget_display : $this->input->get("filter")
            ],["requied" => true,'data-autocomplete' => "true"]);?>
            <hr>

			<div id="winget_content" name="winget_content"><?php echo @$content->winget_content;?><br /></div>
			</div>
		</div>
		<div class="col-3 flex-box">
			<div class="hbox">
				Preview
				<div class="previews"></div>
			</div>
		</div>

	</div>


<?php libs_url("js/tagcomplete.js");?>
<?php libs_url("js/jquery-ui.js");?>

<?php libs_url("css/tagcomplete.css");?>
<?php libs_url('js/bootstrap-iconpicker-iconset-all.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('js/bootstrap-iconpicker.js',['name' => "Font Icoin Picker"]);?>
<?php libs_url('css/bootstrap-iconpicker.css',['name' => "Font Icoin Picker"]);?>
<script type="text/javascript">
    $(document).ready(function(){
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
          setView : {},
          // autocomplete options
          autocomplete: {

            // data
            data: ["topbar","header","footer","leftsilde","rightslide"],

            // ajax options
            ajaxOpts: {
              //url: "",
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
        
        $('#element').sortable({
        	axis: 'y',
		    update: function (event, ui) {
		        var data = $(this).sortable('serialize');

		        // POST to server using $.post or $.ajax
		        $.ajax({
		            data: data,
		            type: 'POST',
		            url: '/settings/enterprise/template/blockssorts'
		        });
		    }
        });
    });
</script>
<?php addon("addon/editer",["target" => "#winget_content", "inline" => "false" , "height" => "550","form" => "#serialize", "contentChange" => '$.ajax({
                url : "/home/dashboard/blockview",
                type : "post",
                data : $("form#serialize").serialize(),
                success : function (result){
                    $(".previews").html(result);
                }
            });']);?>