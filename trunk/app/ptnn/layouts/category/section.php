<link href="//vjs.zencdn.net/4.11/video-js.css" rel="stylesheet">
<script src="//vjs.zencdn.net/4.11/video.js"></script>
<script>
    $(document).ready(function(){
        //$('body').bind('contextmenu',function() { return false; });

    });

</script>
<div class="item">
    <?php
    $categories = $data->getCateByParent();
    $video = _db()->useCB()->select('url')->from('video')->where(array('category_id', pzk_request()->getSegment(3)))->result_one();
    if(1 || $video) {
        //$name = explode('.', $video['url']);
        //$name = $name[0];
		$name = 'Wildlife';
		$time = time();
		$username = pzk_session('username');
		if(!$username) $username = 'guest';
		$token = md5($time.$username . 'securekey');
    ?>
    <div style="height: 500px; border: 1px solid red;" class="item slider">
		<embed type="application/x-mplayer2" name="MediaPlayer" src="/home/video?id=1&token={token}&time={time}" width="600px" height="400px" />
        <video id="example_video_1" class="video-js removeurl vjs-default-skin"
               controls preload="auto" width="100%" height="100%">
            <source src="/3rdparty/uploads/videos/Wildlife.wmv" type='video/wmv' />
            <source src="/3rdparty/uploads/videos/<?php echo $name.'.webm'; ?>" type='video/webm' />
            <source src="/3rdparty/uploads/videos/<?php echo $name.'.ogv'; ?>" type='video/ogg' />

            <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
        </video>

    </div>
    <?Php } ?>
    <div class="item section_cate">
        {each $categories as $item}
        <a href="<?php echo pzk_request()->build($item['router'].'/'.$item['id']); ?>">{item[name]}</a>
        {/each}
    </div>
</div>

