<head>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>
</head>

<?php 
	$ip=$data->getRealIPAddress();
	$id=pzk_request('id');
	$ip=$data->getVisitor($ip,$id);
	$news=$data->getNewsContent($id);
	$nlists=$data->getNewsList($id);
	$lists = $nlists[0];

?>

<p><a href="/news/news">Tin tức</a>
<?php if ($nlists[2]){ ?> 
>> <a href="/news/shownews?id=<?php echo $nlists[2]['id'];?>">
  <?php echo $nlists[2]['title'];?></a>
<?php }
?>
 >>   
<a href="/news/shownews?id={news[id]}">{news[title]}</a>
</p>

<div id="shownews-wrapper">
  <div id="shownews-left">
    <div class="shownews-container">
      <div class="shownews-title">
	  <h3> {news[title]}</h3>
	  </div>
	  <div class="shownews-brief"><h6><strong>{news[brief]}<strong></h6></div>
      <div class="shownews-content" style="margin-bottom:20px;">{news[content]}</div>
	 <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fptnn.vn%2Fnews%2Fshownews&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21&amp;appId=826319910759457" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
   </div>
	<div class="comments">
		{children all}
	</div>
    <div class="prf_other" style="margin-top: 20px;">
      <div class="prf_title">Các tin liên quan
	  </div>
      <div class="prf_content"> 
	  {each $lists as $list}
	  <li><a href="/news/shownews?id={list[id]} ">{list[title]}<br></a></li>
	  {/each}
	  </div>
      <div class="prf_clear">
	  <p><a href="/news/news">Quay lại</a></p>
	  </div>
    </div>
  </div>
  <div id="profilefriend_right"></div>
</div>
<script type="text/javascript">stLight.options({publisher: "51c0dbe4-459b-4618-825a-81abb5e257ed", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script>
var options={ "publisher": "51c0dbe4-459b-4618-825a-81abb5e257ed", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "googleplus", "twitter", "email"]}};
var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
</script>