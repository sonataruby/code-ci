<?php if($type == "background"){ ?>
<div style="height: <?php echo @$height;?>px; position: relative;">
    <div data-youtube="<?php echo @$url;?>"></div>
    <?php if(@$mask){ ?>
        <div style="position: absolute; top:0; height: 100%; display: flex; width: 100%; z-index: 998; opacity: <?php echo $mask;?>; background-color: <?php echo (@$bgcolor ? $bgcolor : "#FFF");?>;"></div>
    <?php } ?>
    <div style="position: absolute; top:0; height: 100%; display: flex; width: 100%; z-index: 999;"><?php echo $content;?></div>
</div>
    <?php echo libs_url("js/background-video.js");?>

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