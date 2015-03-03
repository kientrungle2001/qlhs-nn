
<div id="featured-wrapper" >
     <div class="featured-container" >
       <div class="title">
         <p align="center" style=" padding-top: 10px;"><strong>Các bài viết hay</strong></p>
       </div>
       <div class="title">
<?php 
		$featured= $data->getFeatured();
		
 ?>
		{each $featured as $title}
        <div style="clear: both;">
			<div><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>
			<strong > <a href="/featured/showfeatured?id={title[id]}"> {title2[title]}  {title[title]}</a></strong>
			<?php $titles2= $data->getSubFeatured($title['id']); ?>
				<ul style="list-style-type:none;">
					{each $titles2 as $title2}
					<li style="color:green;"; align="left"><img src="<?php echo BASE_URL.$title2['img'] ; ?>"alt="" width="50px" height="50px"></img> <a href="/featured/showfeatured?id={title2[id]}"> {title2[title]}  </a> ( <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> {title2[views]} <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> {title2[comments]} )</li>
					{/each}
				</ul>
			</div>
        </div> 		
        {/each} 
       </div>
     </div>               
 </div> 
 