<link href="/default/skin/ptnn/css/video-js.css" rel="stylesheet">
<script src="/default/skin/ptnn/js/video.js"></script>
<script>

    videojs('video', {}, function() {
        var player = this;
        player.disableUi(); // initialize the plugin
    });

    $(document).ready(function(){
        $('body').bind('contextmenu',function() { return false; });

    });

</script>
<div class="item">
    <?php
    $categories = $data->getCateByParent();
    $video = _db()->useCB()->select('url,id')->from('video')->where(array('category_id', pzk_request()->getSegment(3)))->result_one();
    if($video) {

		$time = time();
		$username = pzk_session('username');
		if(!$username) $username = 'ongkien';
		$token = md5($time.$username . 'onghuu');
    ?>
    <div style="height: 500px; border: 1px solid red;" class="item slider">

        <video id="video" class="video-js removeurl vjs-default-skin"
               controls preload="auto" width="100%" height="100%">
            <source src="/video.php?id={video[id]}&token={token}&time={time}" type='video/mp4' />
        </video>

    </div>
    <?Php } ?>
    <div class="item section_cate">
        {each $categories as $item}
        <a href="<?php echo pzk_request()->build($item['router'].'/'.$item['id']); ?>">{item[name]}</a>
        {/each}
    </div>
</div>

