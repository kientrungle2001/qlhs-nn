﻿<?php
$comments=pzk_request('comments');
$newsid=pzk_request('id');
$ip=$data->getRealIPAddress();
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
//$count = $data->getCountComment($newsid);
//$pages = ceil($count / 5);	

?>
<style>
.user-id p{padding-top:0px; margin:0px}
span.comment_date{font-weight:none; font-size:12px;}

</style>

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
				<div class=" col-xs-12">
					<div class="avatar col-xs-2"  style="width:50px; height:50px;float:left; margin:10px; ">
						<img src="{allcomment[avatar]}" width=50; height=50;></img>
					</div>
					<div class="user-comments col-xs-10"style="width:600px; height:auto;">
						<div class="user-id" style="float:left;">
							<p class="comment-name" align="left"><a href="/user/profileusercontent?member={allcomment[username]}">{allcomment[name]}</a></p>
							<button type="button" class="btn btn-default btn-xs" id="like-comment"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>Like</button> {allcomment[likecomment]}
							<p align="left"><span class="comment_date">on {allcomment[created]} says: </span></p>
							<p>{allcomment[comment]}</p>
							
						</div>
					</div>
				</div>
			{/each}
			</div>
		</div>
							<?php
								$userid=$data->getInfo($username);
								$newsid=pzk_request('id');
								$datelike=date("Y-m-d");
								$commentids=$data->getComments($newsid);
								foreach( $commentids as $commentid){
								
								$id=$commentid['id'];
								}
								
				
								
							?>
							<script>
								
								$('#like-comment').click(function() {
									
									
									var userid='<?php echo $userid['id']; ?>';
									var newsid= '<?php echo $newsid; ?>';
									var datelike= '<?php echo $datelike; ?>';
									var commentid= '<?php echo $id ?>';
									
									$.ajax({
										url:'../news/likecomment',
										data:{
											userid: userid,
											newsid:newsid,
											datelike:datelike,
											commentid:commentid
										}, 
										success:function(result){
										
											
											if(result !=""){
												alert(result);
											}else{

												$('#like-comment').before(<button type="button" class="btn btn-default btn-xs" id="like-comment"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>Like</button> +userId+)
											}
     
										}
									});

        
								});
							</script>
<form role="form" method="post" action="/news/commentsPost">
  <input type="hidden" name="id" value="" />
  <div class="form-group">
    <input type="text" style="height:100px;" class="form-control" id="comments" name="comments" placeholder="
	<?php if(pzk_session('login')){
	echo"Đăng bình luận";
	}else{
	echo "Bạn chưa đăng nhập, đăng nhập để gửi bình luận";	
	}
	?>" >
	<button type="submit" class="btn btn-primary" >Bình luận</button>
  </div>
  </form>

</div>