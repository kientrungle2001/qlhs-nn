
<div id="news-wrapper" >
     <div class="news-container" >
       <div class="title">
         <p align="center" style=" padding-top: 10px;"><strong>Danh sách tin tức</strong></p>
       </div>
       <div class="title">
<?php 
		$news= $data->getNews();
 ?>
		{each $news as $title}
        <div style="clear: both;">  
			<div style="float:left; padding-top:20px;padding-bottom:80px;padding-left:20px;padding-right:80px;">
				<img src="<?php echo BASE_URL.'/3rdparty/Filemanager/source/10269461_773590456011613_5268887879935957415_n.jpg' ; ?>"alt="" width="80px" height="80px"> 
			</div>
			<div>
			<strong ><a href="/news/shownews?id={title[id]} "> {title[title]}</a></strong>
			<?php $titles2= $data->getSubnews($title['id']); ?>
				<ul>
					{each $titles2 as $title2}
					<li align="left"><a href="/news/shownews?id={title2[id]} "> {title2[title]} </a></li>
					{/each}
				</ul>
			</div>
        </div> 		
        {/each} 
       </div>
     </div>               
 </div> 
                