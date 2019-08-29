<?php libs_url("css/codemirror.css");?>
<?php libs_url("css/codemirror-material.css");?>

<style type="text/css">
	.tools_desktop{
		max-width: 900px;
		min-width: 900px;
		padding:15px;
		min-height: 350px;
		max-height: 350px;
		overflow: auto;
	}
</style>
<script type="text/html" id="makeTools">
<div class="row">
  <?php 
  $libs = [
    ["name" => "Section", "html" => '<section><div class="container"><div class="row"><div class="col-6">Text</div><div class="col-6">Text</div></div></div></section>'],
    ["name" => "Container", "html" => '<div class="container"></div>'],
    ["name" => "Row", "html" => '<div class="row"><div class="col-lg-6 col-sm-12">Text</div><div class="col-lg-6 col-sm-12">Text</div></div>'],
    ["name" => "Text", "html" => 'Text']
  ];
  foreach($libs as $key => $value){ ?>
    <div class="col-sm-3 mb-3">
      <div class="border" style="padding: 10px;" data-item="html">
        <?php echo $value["name"];?>
        <dd style="display:none;"><?php echo $value["html"];?></dd>
      </div>
    </div>
  <?php } ?>
</div>
</script>
<?php echo libs_url("/js/codemirror.js");?>
<?php echo libs_url("/js/js/xml.js");?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var _target = document.getElementById("<?php echo str_replace('#','',$target);?>");
		    var editor = CodeMirror.fromTextArea(_target, {
		      lineNumbers: true,
		      lineWrapping: true,
		      htmlMode: true
		    });
		    editor.setSize("100%",$(_target).height());

		    $('<?php echo @$tools_desktop;?>').html($("#makeTools").html());

		    
		    $('[data-item="html"]').on("click", function(){
		    	editor.replaceSelection($(this).find("dd").html());
		    });

		    $('[data-item="text"]').on("click", function(){
		    	editor.replaceSelection($(this).attr("data-append"));
		    });
		    $('[data-item="animated"]').on("click", function(){
		    	var string = $(this).attr("data-append");
		    	editor.replaceSelection(string);
		    });
		    

		    $(".dropdownImage").load("/settings/enterprise/uploads/imagecode", function(){
				$('[data-item="image"]').on("click", function(){
			    	editor.replaceSelection($(this).attr("data-append"));
			    });
			});
		
	});
  </script>
  
