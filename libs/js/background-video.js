var tag=document.createElement("script");tag.src="https://www.youtube.com/player_api";var firstScriptTag=document.getElementsByTagName("script")[0];firstScriptTag.parentNode.insertBefore(tag,firstScriptTag),function(c){c.fn.youtube_background=function(){var n=/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i,i=c(this);function u(t){t.target.playVideo(),c(t.target.a).css({top:"50%",left:"50%",transform:"translateX(-50%) translateY(-50%)",position:"absolute"});var o=c(t.target.a).parent();function e(){var t=o.outerHeight()+100,e=o.outerWidth()+100,a=1.77777778;e/t<a?o.find("iframe").width(t*a).height(t):o.find("iframe").width(e).height(e/a)}c(window).on("resize",e),e()}function d(t){t.target.playVideo()}var s=!1;return window.onYouTubeIframeAPIReady=function(){s=!0;for(var t=0;t<i.length;t++){var e=c(i[t]);if(!e.parent().hasClass("youtube-background")){e.wrap('<div class="youtube-background" />');var a=e.parent();a.css({height:"100%",width:"100%","z-index":"0",position:"absolute",overflow:"hidden"}),a.parent().parent().css({position:"relative"});var o=e.data("youtube"),r=o.match(n);r&&r.length&&(o=r[1]),new YT.Player(e[0],{height:"1080",width:"1920",videoId:o,playerVars:{controls:0,autoplay:1,mute:1,origin:window.location.origin,loop:1,rel:0,showinfo:0,modestbranding:1},events:{onReady:u,onStateChange:d}})}}},window.hasOwnProperty("YT")&&window.YT.loaded&&!s&&window.onYouTubeIframeAPIReady(),i}}(jQuery),jQuery(document).ready(function(){$("[data-youtube]").youtube_background()});