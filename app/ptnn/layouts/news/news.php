
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
			<div style="float:left; padding-top:20px;padding-bottom:150px;padding-left:20px;padding-right:50px;">
				<img src="<?php echo BASE_URL.$title['img'] ; ?>"alt="" width="120px" height="120px"> 
			</div>
			<div>
			<strong > {title[title]}</strong>
			<?php $titles2= $data->getSubnews($title['id']); ?>
				<ul style="list-style-type:none;">
					{each $titles2 as $title2}
					<li style="color:green;"; align="left"><img src="<?php echo BASE_URL.$title2['img'] ; ?>"alt="" width="50px" height="50px"></img> <a href="/news/shownews?id={title2[id]} "> {title2[title]} </a> (<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> {title2[views]}           <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> {title2[comments]})</li>
					{/each}
				</ul>
			</div>
        </div> 		
        {/each} 
       </div>
     </div>               
 </div> 
                