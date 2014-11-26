PzkNivoSlideshow = PzkObj.pzkExt({
	init: function() {
		var that = this;
		jQuery(window).load(function(){
			jQuery("#" + that.id).nivoSlider({
				effect:"random",
				slices:15,
				boxCols:8,
				boxRows:4,
				animSpeed:500,
				pauseTime:3000,
				startSlide:0,
				directionNav:true,
				controlNav:true,
				controlNavThumbs:false,
				pauseOnHover:true,
				manualAdvance:false
			});
		});
	}
});