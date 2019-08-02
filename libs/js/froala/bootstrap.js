(function (FroalaEditor) {
  // Add an option for your plugin.
  FroalaEditor.DEFAULTS = Object.assign(FroalaEditor.DEFAULTS, {
    bootstrapToolTarget: "",
    bootstrapToolContent : "",
    bootstrapToolOptions : '<h5>Options</h5><div class="row">{code}</div>'
  });

  // Define the plugin.
  // The editor parameter is the current instance.
  FroalaEditor.PLUGINS.bootstrap = function (editor) {
    // Private variable visible only inside the plugin scope.
    var private_var = 'Tools Bootstrap Builder';

    // Private method that is visible only inside plugin scope.
    function _privateMethod () {
      console.log (private_var);
    }

    // Public method that is visible in the instance scope.
    function publicMethod () {
      console.log (_privateMethod());
    }

    
    // The start point for your plugin.
    function _init () {
      // You can access any option from documentation or your custom options.
      
      $(editor.opts.bootstrapToolTarget).html(editor.opts.bootstrapToolContent + '<div class="optionDIV"></div>');

      $(editor.opts.bootstrapToolTarget +' [data-item]').bind("click", function(){
        var html = $(this).find("dd").html();
        editor.html.insert(html);
        editor.events.focus();
      });

      editor.events.on('click', function(e) {
        var node = e.currentTarget.nodeName;
        var className = e.currentTarget.className;
        console.log (e);
        var code = '';
        if(node == "DIV"){
          code += '<div class="col-lg-12">Class : <input type="text" value="'+className+'" class="form-control class"></div>';
          code += '<div class="col-lg-12">Amite : <input type="text" class="form-control"></div>';
          editor.opts.bootstrapToolOptions = editor.opts.bootstrapToolOptions.replace('{code}', code);

          $(".optionDIV").html(editor.opts.bootstrapToolOptions);
          $(".optionDIV input.class").on("keypress", function(){
              e.originalEvent.srcElement.className = this.value;
          });

          

        }else{
          $(".optionDIV").html("");
        }
      });
      

      // Call any method from documentation.
      // editor.methodName(params);

      // You can listen to any event from documentation.
      // editor.events.add('contentChanged', function (params) {});
    }

    // Expose public methods. If _init is not public then the plugin won't be initialized.
    // Public method can be accessed through the editor API:
    // editor.myPlugin.publicMethod();
    return {
      _init: _init,
      publicMethod: publicMethod
    }
  }
})(FroalaEditor);