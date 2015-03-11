
<div class="item">
    <?php
    $categories = $data->getCateByParent();
    $video = $data->getVideo();
    //debug($video);die();
    if(isset($video)) {

		$time = time();
		$username = pzk_session('username');
		if(!$username) $username = 'ongkien';
		$token = md5($time.$username . 'onghuu');
    ?>
        <link href="/default/skin/ptnn/css/video-js.css" rel="stylesheet">
        <script src="/default/skin/ptnn/js/video.js"></script>

    <div style="height: 500px; border: 1px solid red;" class="item slider">

        <video id="video" class="video-js vjs-default-skin" controls preload="auto" width="100%" height="100%"   >
            <source src="/video.php?id={video[id]}&token={token}&time={time}" type='video/mp4' />
        </video>

    </div>
        <script>

            $(document).ready(function(){
                $('body').bind('contextmenu',function() { return false; });
            });

        </script>
    <?Php } ?>
    <div class="item section_cate">
        {each $categories as $item}
        <a href="<?php echo pzk_request()->build($item['router'].'/'.$item['id']); ?>">{item[name]}</a>
        {/each}
    </div>
</div>

