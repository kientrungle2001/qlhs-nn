<?php 
$id=pzk_request('id');
$gallerys=$data->getSubgallery($id); 

?>
{each $gallerys as $gallery}
<style>
footer-logos {text-align:center;}
.footer-logos img {margin-left:20px;margin-right:20px;}
.footer-logos img.first {}
.footer-logos img.last {}
.footer-logos ul {}
.footer-logos ul li {display: inline; list-style:none;}
</style>
<div class="footer-logos">
        <ul>
            <li><img src="{gallery[url]}" alt="" style="width:60%; height:60%;"></li>
            
        </ul>
</div>
{/each}