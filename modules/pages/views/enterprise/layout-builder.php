<style type="text/css">
	body{
		--panel-left : 280px;
		--panel-right:320px;
		--margin-panel-left : 120px;
	}
	#panel-left{
		position: fixed;
		height: 100%;
		width: calc(var(--panel-left));
		border-right:1px solid #ddd; 
		left:var(--margin-panel-left);
		background-color: #FFF;
		
		
	}
	#panel-right{
		position: fixed;
		height: 100%;
		width: calc(var(--panel-right));
		border-left:1px solid #ddd;
		right: 0;
		background-color: #FFF;
	}
	.preview{
		padding:10px; 
		border-bottom: 1px solid #ddd;
		margin-bottom: 15px;
		position: relative;
	}
	main#layer{
		position: fixed;
		height: 100%;
		width: calc(100% - (var(--panel-right) + var(--panel-left) + var(--margin-panel-left)));
		background-color: #f3f3f3;
		left : calc(var(--panel-left) + var(--margin-panel-left));
	}
	main#layer div.wapper-layer{
		height: 100%;
		margin: auto;
	}
	main#layer iframe{
		width: 100%;
		height: 100%;
		border:0px;
	}

	#components ul{
		padding:0;
		margin:0;
		list-style: none;  
	}
	#components ul li{
		width: 50%;
		float: left;
		text-align: center;
		padding:10px; 
	}
	#components ul li div{
		border: 1px solid #ddd;
		box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.2);
  		-webkit-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.1);
  		height: 80px;
  		background-repeat: no-repeat;
  		background-position: center;
  		background-size: auto 38px;
	}
	#components ul li img{
		width: 95%;
	}
	.tab-content{
		height: calc(100% - 180px);
		overflow-y: auto; 
	}
	.preview-mobile{
		width: 360px;
		height: 740px;
	}
	.preview-tablet{
		width: 768px;
		height: 100%;
		background-image: url(/libs/image/ipadmini.png);
		padding: 35px;
		background-size: 768px;
		background-repeat: no-repeat;
		padding-top: 80px; 
	}
	#iframe-layer{
		position: relative;
		pointer-events: none;
		white-space: nowrap;
	}
	#iframe-layer #selectbox{
	  position: absolute;
	  border: 1px solid #4285f4;
	  width: 0px;
	  height: 0px;
	  top: 0px;
	  left: 0px;
	}
	
</style>
<div style="margin-top: -15px; position: relative;">
	<div id="panel-left">
		<ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist" style="padding-left: 10px; padding-right: 10px;">
		  <li class="nav-item w-50">
		    <a class="nav-link active text-center" id="pills-home-tab" data-toggle="pill" href="#components" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-network-wired fa-2x"></i><br>Components</a>
		  </li>
		  <li class="nav-item w-50">
		    <a class="nav-link text-center" id="pills-profile-tab" data-toggle="pill" href="#layout" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-layer-group fa-2x"></i><br>Layout</a>
		  </li>
		  
		</ul>
		
		<div class="tab-content" id="pills-tabContent">
		  <div class="tab-pane fade show active" id="components" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
		  <div class="tab-pane fade" id="layout" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
		  
		</div>
	</div>
	<div id="panel-right">
		<div class="preview">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button type="button" class="btn btn-primary" id="btnSave"><i class="fa fa-save"></i> Save</button>
			</div>
			<div class="btn-group float-right" role="group" aria-label="Basic example">
			  <button type="button" class="btn btn-secondary btnPreview" data-class="preview-mobile"><i class="fa fa-mobile-alt"></i></button>
			  <button type="button" class="btn btn-secondary btnPreview" data-class="preview-tablet"><i class="fa fa-tablet-alt"></i></button>
			  <button type="button" class="btn btn-secondary btnPreview" data-class="preview-dektop"><i class="fa fa-desktop"></i></button>
			</div>
			
		</div>
		
		<ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist" style="padding-left: 10px; padding-right: 10px;">
		  <li class="nav-item" style="width: 33%;">
		    <a class="nav-link active text-center" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-id-card-alt fa-2x"></i><br>Content</a>
		  </li>
		  <li class="nav-item" style="width: 33%;">
		    <a class="nav-link text-center" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fab fa-css3-alt fa-2x"></i><br>Style</a>
		  </li>
		  <li class="nav-item" style="width: 33%;">
		    <a class="nav-link text-center" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa fa-cogs fa-2x"></i><br>Advanced</a>
		  </li>
		</ul>
		
		<div class="tab-content" id="pills-tabContent" style="padding: 10px;">
		  <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="pills-home-tab">
		  	
		  </div>
		  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
		  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
		</div>

	</div>
	<main id="layer">
		<div class="wapper-layer">
			<div id="iframe-layer">
				<div id="selectbox"></div>
			</div>

			<iframe src="about:none" id="iframe1"></iframe>
		</div>
	</main>
</div>
<script type="text/html" id="sonata-input" data-control="content">
	<input type="text" name="" class="form-control">
</script>
<?php 
$dir = glob(FCPATH."libs/builder/libs/builder/icons/*.svg");
foreach ($dir as $key => $value) {?>
	
<script data-components data-image="<?php echo site_url(str_replace(FCPATH, '', $value));?>" type="text/html">
</script>
<?php }?>
<?php echo libs_url("js/jquery-ui.js");?>
<script type="text/javascript">
	if (SonataBuilder === undefined) var SonataBuilder = {};
	function isElement(obj){
	   return (typeof obj==="object") &&
	      (obj.nodeType===1) && (typeof obj.style === "object") &&
	      (typeof obj.ownerDocument ==="object")/* && obj.tagName != "BODY"*/;
	}
	SonataBuilder = {
		elementSelect : null,
		tagSelect : null,
		frameBody : null,
		init : function(url, callback){
			var self = this;
			self.layer = $("main > .wapper-layer > iframe");
			this.loadURL(url);
			this.components();
			this.preview();
			this.getHtml();
		},
		editer : {
			isActive: false,
			oldValue: '',
			doc:false,
			init : function(doc){
				this.doc = doc;
			},
			undo: function(element) {
				this.doc.execCommand('undo',false,null);
			},

			redo: function(element) {
				this.doc.execCommand('redo',false,null);
			},
			
			edit: function(element) {
				element.attr({'contenteditable':true, 'spellcheckker':false});
				$("#wysiwyg-editor").show();

				this.element = element;
				this.isActive = true;
				this.oldValue = element.html();
			},

			destroy: function(element) {
				element.removeAttr('contenteditable spellcheckker');
				//$("#wysiwyg-editor").hide();
				this.isActive = false;
				node = this.element.get(0);
				
				/*SonataBuilder.Undo.addMutation({type:'characterData', 
										target: node, 
										oldValue: this.oldValue, 
										newValue: node.innerHTML});*/
			},
		},
		preview : function(){
			$(".btnPreview").on("click", function(){
				var _class = $(this).attr("data-class");
				var removeClass = "preview-mobile preview-tablet preview-dektop";
				$(".wapper-layer").removeClass(removeClass);
				$(".wapper-layer").addClass(_class);
			});
		},
		loadURL : function(url){
			var self = this;
			self.iframe = this.layer.get(0);
			self.iframe.src = url;
			return this.layer.on("load", function() 
	        {
	        	window.FrameWindow = self.iframe.contentWindow;
				window.FrameDocument = self.iframe.contentWindow.document;

				self.frameDoc = $(window.FrameDocument);
				self.frameHtml = $(window.FrameDocument).find("html");
				self.frameBody = $(window.FrameDocument).find("body");
				self.frameHead = $(window.FrameDocument).find("head");

				$(window.FrameWindow).on( "beforeunload", function(event) {
					var dialogText = "You have unsaved changes";
					event.returnValue = dialogText;
					return dialogText;
				});

				jQuery(window.FrameWindow).on("scroll resize", function(event) {
				});

				self.editer.init(window.FrameDocument);

				$(window).triggerHandler("iframe.loaded", self.frameDoc);
				
				return self._targetIfreamController();
	        });

			//$("main#layer").html('<iframe src="'+url+'"></iframe>');
		},
		_targetIfreamController : function(){
			var self = this;
			self.frameHtml.on("mousemove touchmove", function(event) {
				if (event.target && isElement(event.target) && event.originalEvent)
				{
					var target = jQuery(event.target);
					var offset = target.offset();
					jQuery("#selectbox").css({
						"top": offset.top - self.frameDoc.scrollTop() , 
						 "left": offset.left - self.frameDoc.scrollLeft() , 
						 "width" : target.outerWidth(), 
						 "height": target.outerHeight(),
						 "display": "block",
					 });
				}
			});

			self.frameHtml.on("mouseup touchend", function(event) {
			});

			self.frameHtml.on("dblclick", function(event) {
				self.texteditEl = target = jQuery(event.target);
				self.editer.edit(self.texteditEl);
				self.texteditEl.attr({'contenteditable':true, 'spellcheckker':false});
				self.texteditEl.on("blur keyup paste input", function(event) {
					jQuery("#select-box").css({
							"width" : self.texteditEl.outerWidth(), 
							"height": self.texteditEl.outerHeight()
						 });
				});
			});
			self.frameHtml.on("click", function(event) {
				if (event.target)
				{
					self.selectNode(event.target);
				}
				event.preventDefault();
				return false;
			});
		},
		components : function(){
			var self = this;
			var html = '';
			$.each($('[data-components]'), function(index, item){
				var image = $(item).attr("data-image");
				html += '<li><div style="background-image:url('+image+');"></div></li>';
			});
			$("#components").html('<ul>'+html+'</ul>');

			window.FrameDocument = this.layer.get(0).contentWindow.document;
			self.frameBody = $(window.FrameDocument).find("body");

			$("#components").draggable({
			    connectToSortable: self.frameBody.sortable({
			      items: "> div",
			      revert: true,
			    }),
			    helper: "clone",
			    iframeFix: true,
			    helper: function(event) {
			      return "<div class='custom-helper'>I move this</div>";
			    },
			    revert: "invalid"
			});
			  

		},
		selectNode : function(node){
			var self = this;
			if (!node)
			{
				jQuery("#select-box").hide();
				return;
			}

			if (self.texteditEl && self.selectedEl.get(0) != node) 
			{
				self.editer.destroy(self.texteditEl);
				jQuery("#select-box").removeClass("text-edit").find("#select-actions").show();
				self.texteditEl = null;
			}

			var target = jQuery(node);

			if (target)
			{
				self.selectedEl = target;

				try {
					var offset = target.offset();
					jQuery("#selectbox").css({
						"top": offset.top - self.frameDoc.scrollTop() , 
						 "left": offset.left - self.frameDoc.scrollLeft() , 
						 "width" : target.outerWidth(), 
						 "height": target.outerHeight(),
						 "display": "block",
					 });

				} catch(err) {
					console.log(err);
					return false;
				}
			}
			this._getElementType(node);
			console.log(node.tagName);
			//console.log(target.html());
		},
		_getElementType: function(el) {
			var control = $('[data-control]');
			$.each(control, function(index, item){
				var target = $(item).attr("data-control");
				$("#"+target).html($(item).html());
			});
		},
		
		getHtml : function(){
			var self = this;
			self.iframe = this.layer.get(0);
			$("#btnSave").on("click", function(){

				
				
				window.FrameWindow = self.iframe.contentWindow;
				window.FrameDocument = self.iframe.contentWindow.document;
				self.frameDoc = $(window.FrameDocument);
				self.frameHtml = $(window.FrameDocument).find("html");
				self.frameBody = $(window.FrameDocument).find("body");
				self.frameHead = $(window.FrameDocument).find("head");
				console.clear();
				console.log(self.frameBody.html());
			});
		}
	}
	
</script>

<script type="text/javascript">
	$(document).ready(function(){
		SonataBuilder.init("/pages/layout/loadcontent/<?php echo $page_id;?>");
	});
</script>
