<?php libs_url("editor/css/froala_editor.css");?>
<?php libs_url("editor/css/froala_editor.pkgd.css");?>
<style type="text/css">
  .fr-qi-helper a.fr-btn.fr-floating-btn{
    padding: 1px 10px;
  }
  .tools_desktop{
    max-width: 900px;
    min-width: 900px;
    padding:15px;
  }
</style>

<script type="text/html" id="makeTools">
<div class="row">
  <?php 
  $libs = [
    ["name" => "Section", "html" => '<section class=""><div class="container"><div class="row"><div class="col-lg-6 col-sm-12">Text</div><div class="col-lg-6 col-sm-12">Text</div></div></div></section>'],
    ["name" => "Container", "html" => '<div class="container"></div>'],
    ["name" => "Row", "html" => '<div class="row"><div class="col-lg-6 col-sm-12">Text</div><div class="col-lg-6 col-sm-12">Text</div></div>'],
    ["name" => "Text", "html" => '<p>Text</p>'],
    ["name" => "Image", "html" => '<img src="" />'],
    ["name" => "Video", "html" => '<video src="" />'],
  ];
  foreach($libs as $key => $value){ ?>
    <div class="col-3 mb-3">
      <div class="border" style="padding: 10px;" data-item="true">
        <?php echo $value["name"];?>
        <dd style="display:none;"><?php echo $value["html"];?></dd>
      </div>
    </div>
  <?php } ?>
</div>
</script>

<script type="text/javascript">
  var objEditer;
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
      quickInsertButtons: ['image','video', 'table', 'ol', 'ul'],
      pluginsEnabled: ['quickInsert', 'image','imageManager', 'video','table', 'lists','html'],
      //height : 550,//
      bootstrapToolTarget : '<?php echo @$tools_desktop;?>',
      bootstrapToolContent : $("#makeTools").html(),
      imageMove: false,
      imageOutputSize: false,
      imageResizeWithPercent: true,

      imageUploadParam : "userfile",
      imageUploadURL : "/settings/enterprise/uploads/image",
      imageUploadMethod: 'POST',
      imageAllowedTypes: ['jpeg', 'jpg', 'png'],

      
      imageManagerLoadURL: "/settings/enterprise/uploads/imagemanager",
      imageManagerLoadMethod: "GET",
      imageManagerPageSize: 20,
      imageEditButtons: ['imageReplace', 'imageAlign', 'imageRemove', '|', 'imageLink', 'linkOpen', 'linkEdit', 'linkRemove', '-', 'imageDisplay', 'imageStyle', 'imageAlt', 'imageSize'],
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
        initialized: function () {
          this.events.focus();
        },
        contentChanged: function () {
          
          $("form<?php echo $form;?>").find('textarea[name="'+name+'"]').val(this.html.get());
        },
        'edit.on': function () {
          // Do something here.
          // this is the editor instance.
          objEditer = this;
        }
      }
      //iframeStyleFiles : ['https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css']
    });
    
   
   

    $("form<?php echo $form;?>").bind("submit", function(){
        $("form<?php echo $form;?>").find('textarea[name="'+name+'"]').val(editer.html.get());
    });
  }


jQuery(document).ready(function(){
  getScripts(["/libs/editor/js/froala_editor.min.js","/libs/editor/js/froala_editor.pkgd.min.js", "/libs/js/froala/bootstrap.js"], function () {
    install();
  });
  
});
</script>