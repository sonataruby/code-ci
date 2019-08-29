
<?php echo libs_url("tinymce/jquery.tinymce.min.js");?>
<?php echo libs_url("tinymce/tinymce.min.js");?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		
	  $("<?php echo $target;?>").tinymce({
	  		toolbar: false,

		    menubar: false,
		    inline: true,
		    plugins: [ 'quickbars','image','table', 'imagetools', 'media', 'code','template'],
		    skin: "oxide",
		    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote',
		    quickbars_insert_toolbar: 'quickimage media quicktable | template | code ',
  			statusbar: false,
  			content_css: ["/libs/css/bootstrap.css","/libs/css/bs-theme.css","/template/<?php echo config_item("template");?>/styles.css"],
  			table_default_attributes: {
			    class: 'table'
			 },
			table_class_list: [
			    {title: 'Table', value: 'table'},
			    {title: 'Hover', value: 'table table-hover'},
			    {title: 'Border', value: 'table table-border'},
			    {title: 'Small', value: 'table table-sm'}
			],
			
			image_class_list: [
			    {title: 'None', value: ''},
			    {title: 'Dog', value: 'dog'},
			    {title: 'Cat', value: 'cat'}
			],
			init_instance_callback: function (editor) {
			    editor.on('Change', function (e) {
			      
			      
			    });
			},
			templates: [
			    {title: '4 Row', description: '4 row bottrasp', content: '<div class="row"><div class="col-lg-3 col-sm-12">Row 1</div> <div class="col-lg-3 col-sm-12">Row 2</div> <div class="col-lg-3 col-sm-12">Row 3</div> <div class="col-lg-3 col-sm-12">Row 4</div></div>'},
			    {title: 'Base text', description: 'Base text', content: '<span style="font-size:48px;">T</span>ext here'}
			  ]
  
	    });
	  
	});
</script>