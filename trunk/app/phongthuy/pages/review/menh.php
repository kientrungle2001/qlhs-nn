<div class="col-md-12">
	<div class="row">
		<div class="col-md-8">
			<div layout="review/menh">
				<core.db.detail table="news_article" itemId="<?php echo pzk_request()->getSegment(3) == '5'? '102' : pzk_request()->getSegment(3); ?>" facebookComment="true"/>
			</div>
		</div>
		<div class="col-md-4">
			<div layout="lastest-articles" />
		</div>
	</div>
</div>