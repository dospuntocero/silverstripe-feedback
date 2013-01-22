<html>
	<head>
		<title>Website Feedback</title>
		<base target="_self"/>
	</head>
	<body>
		<div id="FeedbackPage">
			<div class="inner">
			  <% if Success %>
				  <h1><% _t('FeedbackPage_window.FEEDBACKRECEIVED','Feedback received') %></h1>
          <% _t('ProductPage.THANKS','Thanks for your time, with your help we will improve this site for you') %>
        <% else %>
				  <h1><% _t('FeedbackPage_window.PROVIDEFEEDBACK','Give your feedback here') %></h1>
    				$Content
    				$Form

        <% end_if %>
        
			</div>
		</div>
	</body>
</html>