<?php libs_url("editor/css/froala_editor.css");?>
<?php libs_url("editor/css/froala_editor.pkgd.css");?>

<script type="text/javascript">

  function install(){
    var name = $("<?php echo $target;?>").attr("name");
  
    var textarea = $("form<?php echo $form;?>").find('textarea[name="'+name+'"]');
    if(textarea.length == 0){
      $("form<?php echo $form;?>").append('<textarea name="'+name+'" style="height:1px; width:1px; display:none;"></textarea>');
    }
    
    
    var editer = new FroalaEditor('<?php echo $target;?>',{

      toolbarInline: true,
      charCounterCount: false,
      placeholderText: '<div class="placeholder">Click here add content</div>',
      iframe : false,
      videoAllowedProviders: ['youtube', 'vimeo'],
      quickInsertButtons: ['image','video', 'table', 'ol', 'ul', 'myButton'],
      pluginsEnabled: ['quickInsert', 'image', 'video','table', 'lists'],
      //height : 550,//
      imageMove: false,
      imageOutputSize: false,
      imageResizeWithPercent: true,
      imageStyles: {
        "w-100": 'Full Width',
        "border": 'Border',
        "img-thumbnail": 'img-thumbnail',
        "img-fluid": 'img-fluid',
        "rounded" : "rounded",
        "rounded-circle" : "circle",
        "rounded-pill" : "rounded-pill",
        "rounded-0" : "no rounded"
      },
      tableStyles: {
        "table": 'Class table',
        "table-striped": 'table-striped',
        "table-bordered" : "table-bordered",
        "table-hover" : "table-hover",
        "table-borderless" : "table-borderless",
        "table-sm" : "Table Small",
        "table-dark" : "Theme Dark",

      },
      events: {
        contentChanged: function () {
          
          $("form<?php echo $form;?>").find('textarea[name="'+name+'"]').val(this.html.get());
        }
      }
      //iframeStyleFiles : ['https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css']
    });


    $("form<?php echo $form;?>").bind("submit", function(){
        $("form<?php echo $form;?>").find('textarea[name="'+name+'"]').val(editer.html.get());
    });
  }


jQuery(document).ready(function(){
  getScripts(["/libs/editor/js/froala_editor.min.js","/libs/editor/js/froala_editor.pkgd.min.js"], function () {
    install();
  });
  
});
</script>