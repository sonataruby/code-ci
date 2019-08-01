jQuery(document).ready(function(){
	

	$(document).ajaxStart(function () {
           $("#loader").show();
      }).ajaxStop(function () {
	      	setTimeout(function(){
	           $("#loader").hide();
	       },1000);
      });


	$("header .switchClass").bind("click", function(){
		$("body").toggleClass("layout-small");
	});

	$("a[sn-link]").bind("click", function(){
		var url = $(this).attr("href");
		var parentController = $(this).attr("parent-controller");
		url = url.replace(base_url,'');
		window.location.href = base_url + base_target + '#'+url;
		if(parentController !== undefined){
			$(parentController).addClass("display-sub");
			$("body").addClass("display-sub");
		}
		$('div[sn-body="content"]').load(base_url + url, function(response, status, xhr){
			if(status == "error"){
				$(this).html("Error loading page");
			}
		});
		
		return false;
	});

	$('[data-toggle="collapse"]').collapse({
	  toggle: false
	});
});