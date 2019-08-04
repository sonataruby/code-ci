function getScripts(scripts, callback) {
    var progress = 0;
    scripts.forEach(function(script) { 
        $.getScript(script, function () {
            if (++progress == scripts.length) callback();
        }); 
    });
}

$(document).ajaxStart(function () {
   $("#loader").show();
}).ajaxStop(function () {
	$(".modal-backdrop").remove();
  	setTimeout(function(){
       $("#loader").hide();
   },1000);
});
$.ajaxPrefilter(function( options, originalOptions, jqXHR ) { 
	options.async = true; 
});

jQuery(document).ready(function(){
	var autoMakeContent = function(){
		var getURL = window.location.href;
		getURL = getURL.replace('##','#');
		getURL = getURL.split('#')[1];
		if(getURL !== undefined){
			var parentController = $('a[href="'+ getURL +'"]').attr('parent-controller');
			if(parentController !== undefined){
				$(parentController).addClass("display-sub");
				$("body").addClass("display-sub");
			}
			$('div[sn-body="content"]').load(base_url + getURL, function(response, status, xhr){
				if(status == "error"){
					$(this).html("Error loading page");
				}

				$("a[sn-link]").each(function(){
					var link = $(this).attr("href");
					link = link.replace('#','');

					$(this).attr("href",'#'+link);
				});
				mainFunction();
				
			});
		}
	};

	window.onhashchange = function(){
		//$('.modal').modal('hide');
		
		autoMakeContent();
	}
	
	

	$("header .switchClass").bind("click", function(){
		$("body").toggleClass("layout-small");
	});
	autoMakeContent();



	$("a[sn-link]").bind("click", function(){
		var url = $(this).attr("href");
		var parentController = $(this).attr("parent-controller");
		url = url.replace(base_url,'');
		url = url.replace('#','');
		window.location.href = base_url + base_target + '#'+url;
		if(parentController !== undefined){
			$("body .display-sub").removeClass("display-sub");
			$(parentController).addClass("display-sub");
			$("body").addClass("display-sub");
		}
		
		$("a[sn-link]").each(function(){
			var link = $(this).attr("href");
			link = link.replace('#','');

			$(this).attr("href",'#'+link);
		});
		
		return false;
	});


	


	function calculateAspectRatioFit(srcWidth, srcHeight, maxWidth, maxHeight) {

	    var ratio = Math.min(maxWidth / srcWidth, maxHeight / srcHeight);

	    return { width: srcWidth*ratio, height: srcHeight*ratio };
	}


	var digmodel = '<div class="modal digmodelUpload fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">';
	  digmodel += '<div class="modal-dialog modal-lg">';
	    digmodel += '<div class="modal-content">';
		    digmodel += '<div class="modal-header">';
	        digmodel += '<h5 class="modal-title" id="exampleModalLabel">Crop Image</h5>';
	        digmodel += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
	          digmodel += '<span aria-hidden="true">&times;</span>';
	        digmodel += '</button>';
	      	digmodel += '</div>';
	     	digmodel += '<div class="modal-body"><div id="uploadCrop" class="center-block"></div></div>';
	    

	     	digmodel += '<div class="modal-footer">';
         	//digmodel += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
         	digmodel += '<button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>';
       		digmodel += '</div>';
       	digmodel += '</div>';
	  digmodel += '</div>';
	digmodel += '</div>';


	var mainFunction = function(){


		$('[data-view]').bind("click", function(){
			var target = $(this).attr("data-target");
			var query = $(this).attr("data-view");
			$(target).removeClass("androi-mobile androi-tablet androi-desktop");
			$(target).addClass("androi-"+query);
		});

		
		$("[upload-image-preview]").on("change",function() {
		  var getID = $(this).attr("upload-image-preview");
		  var size = $(this).data("size").split('x');
		  var resize = $(this).data("resize");

		  
		  var imgPath = $(this)[0].value;
	      var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	      var $uploadCrop;
	      var viewport, digSize;
	      if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
	        if (typeof (FileReader) != "undefined") {
			    
			    var image_holder = $(getID);
	            image_holder.empty();

	            var reader = new FileReader();
	            reader.fileName = $(this)[0].files[0].name;
	            
		            reader.onload = function (e) {
		            	var image = new Image();

					    image.src = e.target.result;
					    if(resize != false){
					    image.onload = function() {
					        //alert(image.width);
					        //alert($("body .digmodelUpload").hasClass("digmodelUpload"));
					        if($("body .digmodelUpload").hasClass("digmodelUpload") == false){
					        	$("body").append(digmodel);
					        }
					        if (typeof Croppie == "undefined") {
							   $("head").append('<script src="/libs/js/exif.js"></script><script src="/libs/js/croppie.js"></script><link rel="stylesheet" href="/libs/css/croppie.css">');
							}
						        $('body .digmodelUpload').modal('show');
						        viewport = calculateAspectRatioFit(size[0], size[1], 980, 650);
						        digSize = calculateAspectRatioFit(image.width, image.height, 980, 650);
						        $uploadCrop = $('body .digmodelUpload #uploadCrop').croppie({
										viewport: {width : viewport.width / 2, height : viewport.height / 2},
										enforceBoundary: false,
										enableExif: true
									});

						        $('body .digmodelUpload').on('shown.bs.modal', function(){
						        	$('body .digmodelUpload #uploadCrop').css({width : digSize.width, height : digSize.height});
						        	$('body .digmodelUpload .modal-dialog').attr("style","max-width : " + ((digSize.width < 980 ? digSize.width : 980) + 30) + "px");
						        	$uploadCrop.croppie('bind', {
							        		url: image.src
							        	});
						        });

						        $('body .digmodelUpload').on('hidden.bs.modal', function(){
						        	$uploadCrop.croppie('destroy');
						        });
						        $('#cropImageBtn').on('click', function (ev) {
									$uploadCrop.croppie('result', {
										type: 'base64',
										size: {width: size[0], height: size[1]}
									}).then(function (resp) {
										//image.src = resp;
										image_holder.empty();
										$("<img />", {
						                    "src": resp,
						                        "class": "w-100"
						                }).appendTo(image_holder);

						                image_holder.parent().find("input[type=hidden]").val(resp);
										$('body .digmodelUpload').modal('hide');
										image_holder = false;
									});
								});
						    }

					    };


	                
	                $("<img />", {
				            "src": e.target.result,
				            "class": "w-100"
				    }).appendTo(image_holder);
	                image_holder.parent().find("label.displayname").html(e.target.fileName);
	                image_holder.parent().find("input[type=hidden]").val(e.target.result);
	            }
	            image_holder.show();

	            reader.readAsDataURL($(this)[0].files[0]);

			}else {
	            alert("This browser does not support FileReader.");
	        }
		}else{
			alert("Pls select only images");
		}
		});

		$(".gallery-clear").on("click", function(){
			var parent = $(this).parent().parent();
			parent.find("img").attr("src","/catalog/share/image/nophoto.png");
			parent.find("input[type=hidden]").val("");
		});
	};



	mainFunction();
});