<?php
echo<<<EOT
<div class="well">
	<span id="submitstatus" role="alert"></span>
	<h4>Leave a Comment:</h4>
	<form id="addcomment" role="form" action="includes/post-add-comment.php" method="POST">

		<div class="form-row">
			<div class="form-group col-md-6">
				  <input type="text" id="comment_author" name="comment_author" class="form-control" placeholder="Your name" required>
			</div>
			<div class="form-group  col-md-6">
			  <input type="email" id="comment_email" name="comment_email" class="form-control" placeholder="Your email" required>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<small id="comment_content-help" class="form-text text-muted">64 character limit</small>
				<textarea aria-describedby="comment_content-help" id="comment_content" name="comment_content" class="form-control" rows="3" required maxlength="64"></textarea>
			</div>
			<input type="hidden" id="post_id" name="post_id" class="form-control" value={$post_id}>
			<br/>
		</div>

		<label for="captcha">Please verify you are not a bot...</label>
		<br />
		<img src="/includes/captcha.php" alt="CAPTCHA" class="captcha-image" /> <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span></button>
		<br />
		<br />
    <input type="text" id="captcha_challenge" name="captcha_challenge" pattern="[A-Z]{6}">
		<button type="submit" class="btn btn-primary">Submit</button>

	</form>
</div>
<hr/>
EOT;
display_post_comments($post_id);
?>
