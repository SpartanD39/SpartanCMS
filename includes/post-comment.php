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
			  <input type="text" id="comment_email" name="comment_email" class="form-control" placeholder="Your email" required>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<textarea id="comment_content" name="comment_content" class="form-control" rows="3" required></textarea>
			</div>
			<input type="hidden" id="post_id" name="post_id" class="form-control" value={$post_id}>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
EOT;
$comments = get_post_comments($post_id);
display_post_comments($comments);
/*
<!-- Blog Comments -->
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <hr>
                <!-- Posted Comments -->
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>
*/
?>