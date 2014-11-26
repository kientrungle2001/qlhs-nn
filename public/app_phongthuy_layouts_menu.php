<?php 
$total_hits = pzk_filevar('total_hits');
$items = _db()->useCB()->select('*')->from('catalog_category')->where(array('and', array('parentId', 0), array('status', 1)))->orderBy('ordering asc')->result();?>
<div class="menu">
<div class="toggle-menu" style="padding-bottom: 0; margin-bottom: -5px;">
<a href="javascript:void(0)" onclick="$('.menu .nav').toggle();" style="padding: 2px;color: red;">DANH MỤC<a> <a href="javascript:void(0)" onclick="$('.menu .nav').toggle();" style="padding: 2px;color: YELLOW;" class="glyphicon glyphicon-chevron-down"></a> | 
<a href="/" style="padding: 2px;color: red;" >Trang Chủ</a> | 
<a href="/Chat2" style="padding: 2px;color: red;">Chat</a> | 
<span style="padding: 2px;color: red;"><?php echo @$total_hits;?> Lượt Xem</span>
<br />
<p style="line-height: 25px;text-align: center;">
&nbsp;&nbsp;&nbsp;&nbsp;<a href="/xem-phong-thuy-lay-menh-theo-nam" style="padding: 2px;color: red;">----------------&gt; Xem Mệnh Theo Năm &lt;----------------</a> <br /> 
&nbsp;&nbsp;&nbsp;&nbsp; <a href="/xem-kim-lau-hoang-oc" style="padding: 2px;color: red;">::::::::::::::::::::: Kim Lâu - Hoang Ốc :::::::::::::::::::::</a>  <br /> 
&nbsp;&nbsp;&nbsp;&nbsp; <a href="/xem-thang-cuoi" style="padding: 2px;color: red;">-------------------&gt; Chọn Tháng Cưới &lt;-------------------</a>
</p>
</div>
<ul class="nav">
<?php foreach ( $items as $item ) : ?>
	<li><a href="/<?php echo @$item['alias'];?>"><?php echo @$item['title'];?></a></li>
<?php endforeach; ?>
</ul>
</div>