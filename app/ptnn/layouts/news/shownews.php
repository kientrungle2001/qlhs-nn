
     <style>
	.news{
		display: block;
		float:left;
		
	}
	ul{
		list-style-type:none;
	}
    </style>

 <div class="news">
 <ul name="news-menu">Tin tức

 <li name="shownews"><a href="/news/shownews"> Tin mới</a></li>
 <li name="old-news"><a href="/news/oldnews"> Tin đã đăng</a></li>
 <li name="hotnews"><a href="/news/hotnews"> Tin hot</a></li>
 <li name="all"><a href="/news/news"> Xem tất cả</a></li>
 </ul>
 <?php
$titles = _db()->select('*')->from('news')->result();
foreach ($titles as $title)
		{
			//$this->sendMail($email['mail'],$title,$content);
			echo $title['title']."<br>"
			 .$title['brief']
			 .$title['content']."<br>";
			
		}
?>

 </div>

