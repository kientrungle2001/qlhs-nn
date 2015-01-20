<?php 
$id=pzk_request('id');
$gallerys=$data->getSubgallery($id); 

?>
{each $gallerys as $gallery}
<div class="footer-logos">
        <ul>
            <li><img src="{gallery[url]}" alt="" class="first"></li>
            
        </ul>
</div>
{/each}