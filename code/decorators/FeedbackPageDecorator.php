<?php
class FeedbackPageDecorator extends Extension{
	
	function onAfterInit(){
		Requirements::javascript(THIRDPARTY_DIR.'/jquery/jquery.js'); //interferes with other versions
		
		if(Feedback::canSee()){
			Requirements::css('feedback/css/sidefeedback.css');
			Requirements::css("feedback/javascript/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css");
			Requirements::javascript('feedback/javascript/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js');
				
			$script = <<<JS
					 (function($){
					 $(document).ready(function() {
						$('#FeedbackSideLink a.feedbacklink').fancybox({
             	'transitionIn'		: 'none',
             	'transitionOut'		: 'none',
             	'autoScale'     	: false,
             	'type'				: 'iframe',
             	'width'				: 500,
             	'height'			: 420,
             	'scrolling'   		: 'no'
             });
			  		});
					})(jQuery);
JS;
				
			Requirements::customScript($script,'feedbackpopup');
		}
	}
	
	function Feedback(){
		
		$data = new ArrayData(array(
			'FeedbackSideLink' => $this->FeedbackSideLink()
		));
		
		return $data->renderWith('FeedbackSideLink');
	}
	
	function FeedbackSideLink(){
		if(Feedback::canSee())
			return "FeedbackPage/window/".$this->owner->ID."?currenturl=".$this->FeedbackURL();
		return false;
	}
	
	function FeedbackURL(){
		$url = rawurlencode($_SERVER['REQUEST_URI']);
		return $url;
	}
	
}
?>