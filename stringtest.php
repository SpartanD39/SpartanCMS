<?php
$singleString = "single-quoted";
$doubleString = "22";

echo 'This is a $singleString string';
echo "<br/>";
echo "This is a $doubleString string";
echo "<br/>";

echo "this is a '$doubleString' string";
echo "<br/>";
echo 'This is a "$singleString" string';

echo "<br/>";

$comment["comment_author"] = "Bob";
$comment["comment_date"] = "08-27-2019";
$comment["comment_content"] = "Nice!";
echo "nowdoc below:";
echo<<<EOT
<div class="media">
	<a class="pull-left" href="#">
		<img class="media-object" src="http://placehold.it/64x64" alt="">
	</a>
	<div class="media-body">
		<h4 class="media-heading">{$comment["comment_author"]}
			<small>{$comment["comment_date"]}</small>
		</h4>
		{$comment["comment_content"]}
	</div>
</div>

EOT;

echo "<br/>";
echo "heredoc below:";
echo<<<'EOT'
<div class="media">
	<a class="pull-left" href="#">
		<img class="media-object" src="http://placehold.it/64x64" alt="">
	</a>
	<div class="media-body">
		<h4 class="media-heading">{$comment["comment_author"]}
			<small>{$comment["comment_date"]}</small>
		</h4>
		{$comment["comment_content"]}
	</div>
</div>

EOT;
?>