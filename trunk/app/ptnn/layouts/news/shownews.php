
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
	 <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fptnn.vn%2Fnews%2Fshownews&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21&amp;appId=826319910759457" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
   </div>
	<!-- Go to www.addthis.com/dashboard to generate a new set of sharing buttons -->
<a align="right" href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=http%3A%2F%2Fptnn.vn&pubid=ra-54b62333391ca3f3&ct=1&title=Ph%E1%BA%A7n%20m%E1%BB%81m%20ph%C3%A1t%20tri%E1%BB%83n%20ng%C3%B4n%20ng%E1%BB%AF%20v%C3%A0%20luy%E1%BB%87n%20vi%E1%BA%BFt%20v%C4%83n&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/></a>
<a align="right" href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=http%3A%2F%2Fptnn.vn&pubid=ra-54b62333391ca3f3&ct=1&title=Ph%E1%BA%A7n%20m%E1%BB%81m%20ph%C3%A1t%20tri%E1%BB%83n%20ng%C3%B4n%20ng%E1%BB%AF%20v%C3%A0%20luy%E1%BB%87n%20vi%E1%BA%BFt%20v%C4%83n&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/></a>
<a align="right" href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=http%3A%2F%2Fptnn.vn&pubid=ra-54b62333391ca3f3&ct=1&title=Ph%E1%BA%A7n%20m%E1%BB%81m%20ph%C3%A1t%20tri%E1%BB%83n%20ng%C3%B4n%20ng%E1%BB%AF%20v%C3%A0%20luy%E1%BB%87n%20vi%E1%BA%BFt%20v%C4%83n&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png" border="0" alt="Google+"/></a>

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