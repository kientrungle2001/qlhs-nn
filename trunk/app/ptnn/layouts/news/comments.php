<?php
$comments=pzk_request('comments');
$newsid=pzk_request('id');
$ip=$_SERVER['REMOTE_ADDR'];
pzk_session('newsid',$newsid);
if (pzk_session('login')){
	$username= pzk_session('username');
	$id=$data->getInfo($username);
	pzk_session('id',$id['id']);
}
else
{
	$username="Khách";
}
$count = $data->getCountComment($newsid);
$pages = ceil($count / 5);	

?>
<div class="comments-wrapper">
		<div class="Showcomments" align="center" style="margin:20px; float:left;">
			<div style="clear:both;"></div>
				<div style="float:left;"><h4>Ý kiến thành viên</h4></div> 
				<div style="float:right;">
				<?php $count=$data->getCountComment($newsid); ?>
				<h4> <?php echo $count." "; ?> Bình luận</h4>
				</div>
			
			<div class="comments" style="width:800px; height:auto; border:1px solid red; float:left;">
			<?php $allcomments=$data->getComments($newsid); ?>
			{each $allcomments as $allcomment}
					<div class="avatar" style="width:50px; height:50px; float:left; margin:10px; border: 1px solid red;">
					<img src="{allcomment['avatar']}">avatar</img>
					</div>
					<div class="user-comments"style="width:600px; height:auto;">
						<div class="user-id"><a href="/user/profilefriend?id={allcomment[userId]}"style=" float:left;">{allcomment[name]}</a>
						<p style="float:left;"><?php echo $allcomment['comment'];?></p>
						</div>
						<div style="clear:both;"></div>
					</div>
					{/each}
			</div>
		</div>
		
		<strong>Trang: </strong>
		<?php for ($page = 0; $page < $pages; $page++) { 
			if($page == 5) {
				$btn = 'btn-primary';
			} else {
				$btn = 'btn-default';
			}
		?>
		<a class="btn {btn}" href="{url /news/shownews}?id={newsid}&page={page}">{? echo ($page + 1)?}</a>
		<?php } ?>
		
<form role="form" method="post" action="/news/commentsPost">
  <input type="hidden" name="id" value="" />
  <div class="form-group">
    <input type="text" style="height:100px;" class="form-control" id="comments" name="comments" placeholder="bạn phải đăng nhập để gửi bình luận" >
	<button type="submit" class="btn btn-primary" >Bình luận</button>
  </div>
  </form>

</div>