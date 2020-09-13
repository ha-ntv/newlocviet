jssor_1_slider_init = function () {
	//Reference http://www.jssor.com/development/slider-with-slideshow-no-jquery.html
	//Reference http://www.jssor.com/development/tool-slideshow-transition-viewer.html

	var jssor_1_SlideshowTransitions = [
			{ $Duration: 5000, $Opacity: 2 }
		];

	var jssor_1_options = {
		$AutoPlay: 1,                                //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
		$Idle: 4000,			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
		$SlideDuration: 500,                         //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
		$MinDragOffsetToSlide: 20,
		$SlideshowOptions: {
			$Class: $JssorSlideshowRunner$,
			$Transitions: jssor_1_SlideshowTransitions,
			$TransitionsOrder: 1
		},
		$ArrowNavigatorOptions: {
			$Class: $JssorArrowNavigator$
		},
		$BulletNavigatorOptions: {
			$Class: $JssorBulletNavigator$,
			$ChanceToShow: 2
		},

		$ArrowNavigatorOptions: {
			$Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
			$ChanceToShow: 1                               //[Required] 0 Never, 1 Mouse Over, 2 Always
		}
	};

	var jssor_1_slider = new $JssorSlider$("_slider", jssor_1_options);

	//responsive code begin
	//you can remove responsive code if you don't want the slider scales while window resizing
	function ScaleSlider() {
		var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
		if (refSize) {
			refSize = Math.min(refSize, 1920);
			jssor_1_slider.$ScaleWidth(refSize);
		}
		else {
			window.setTimeout(ScaleSlider, 30);
		}
	}
	ScaleSlider();
	$Jssor$.$AddEvent(window, "load", ScaleSlider);
	$Jssor$.$AddEvent(window, "resize", ScaleSlider);
	$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
	//responsive code end
};