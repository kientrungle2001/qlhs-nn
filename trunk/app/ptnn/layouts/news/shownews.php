
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
<a href="/news/shownews?id=<?php echo $news['id']?>"><?php echo $news['title']?></a>
</p>

<div id="shownews-wrapper">
  <div id="shownews-left">
    <div class="shownews-container">
      <div class="shownews-title">
	  <h3> {news[title]}</h3>
	  </div>
	  <div class="shownews-brief"><h6><strong>{news[brief]}<strong></h6></div>
      <div class="shownews-content" style="margin-bottom:20px;">{news[content]}</div>
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