<?php if($type == "background"){ ?>
<div style="height: <?php echo @$height;?>px; position: relative;">
    <div data-youtube="<?php echo @$url;?>"></div>
    <div style="position: absolute; top:0; height: 100%; display: flex; width: 100%;"><?php echo $content;?></div>
</div>
    <script type="text/javascript">
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/player_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        (function ($) {

            $.fn.youtube_background = function() {
                var YOUTUBE = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i;

                var $this = $(this);

                function onVideoPlayerReady(event) {
                    event.target.playVideo();

                    $(event.target.a).css({
                        "top" : "50%",
                        "left" : "50%",
                        "transform": "translateX(-50%) translateY(-50%)",
                        "position": "absolute"
                    });

                    var $root = $(event.target.a).parent();

                    function onResize() {
                        var h = $root.outerHeight() + 100; // since showinfo is deprecated and ignored after September 25, 2018. we add +100
                        var w = $root.outerWidth() + 100;
                        var res = 1.77777778;

                        if (res > w/h) {
                            $root.find('iframe').width(h*res).height(h);
                        } else {
                            $root.find('iframe').width(w).height(w/res);
                        }
                    }
                    $(window).on('resize', onResize);
                    onResize();
                }

                function onVideoStateChange(event) {
                    event.target.playVideo();
                }

                var ytp = null;
                var yt_event_triggered = false;

                window.onYouTubeIframeAPIReady = function () {
                    yt_event_triggered = true;

                     //element loop
                    for (var i = 0; i < $this.length; i++) {
                        var $elem = $($this[i]);

                        if ($elem.parent().hasClass('youtube-background')) {
                            continue;
                        }

                        $elem.wrap('<div class="youtube-background" />');
                        var $root = $elem.parent();

                        $root.css({
                            "height" : "100%",
                            "width" : "100%",
                            "z-index": "0",
                            "position": "absolute",
                            "overflow": "hidden"
                        });

                        $root.parent().parent().css({
                            "position": "relative"
                        });

                        var ytid = $elem.data('youtube');

                        var pts = ytid.match(YOUTUBE);
                        if (pts && pts.length) {
                            ytid = pts[1];
                        }

                        ytp = new YT.Player($elem[0], {
                            height: '1080',
                            width: '1920',
                            videoId: ytid,
                            playerVars: {
                                'controls': 0,
                                'autoplay': 1,
                                'mute': 1,
                                'origin': window.location.origin,
                                'loop': 1,
                                'rel': 0,
                                'showinfo': 0,
                                'modestbranding': 1
                            },
                            events: {
                                'onReady': onVideoPlayerReady,
                                'onStateChange': onVideoStateChange
                            }
                        });
                    }
                };

                if (window.hasOwnProperty('YT') && window.YT.loaded && !yt_event_triggered) {
                    window.onYouTubeIframeAPIReady();
                }

                return $this;
            };
        })(jQuery);
        jQuery(document).ready(function() {
            $('[data-youtube]').youtube_background();
        });

    </script>

<?php }else{ ?>
<div id="link" style="position: relative;" data-playvideo>
    <img src="https://img.youtube.com/vi/<?php echo $video_id;?>/maxresdefault.jpg" class="w-100">
    <div style="position: absolute; width: 100%; height: 100%; line-height: 300px; top:0; text-align: center; vertical-align: middle; display: block; flex: 1;"><i class="fab fa-youtube fa-4x"></i></div>

    <iframe data-src="https://www.youtube.com/embed/<?php echo $video_id;?>" width="100%" height="100%" frameborder="0" allowfullscreen="" style="position: absolute; top:0; display: none;"></iframe>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('[data-playvideo]').on("click", function(){

            var video = $(this).find("iframe");
            video.css("display","block");
            var url = video.attr("data-src") + "?autoplay=1";
            video.attr("src", url);

        });
    });
</script>
<?php } ?>