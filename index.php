<!DOCTYPE html>
<html>
<head>
	<title>Full Youtube RSS-Feed</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>

<body>
	<h1>Full Youtube RSS-Feed</h1>
	<p>Subscribe a RSS feed from a Youtube channel with full Videodownload.</p>
<?php

error_reporting(0);
ini_set('display_errors', 'Off');

if ( isset($_GET['channel_url']) )
{
	require(__DIR__ . \DIRECTORY_SEPARATOR . 'vendor' . \DIRECTORY_SEPARATOR . 'autoload.php');

	$channel_url = urldecode($_GET['channel_url']);

	$channel = str_replace('https://youtube.com/channel/', '', $channel_url);
	$channel = str_replace('http://youtube.com/channel/', '', $channel);
	$channel = str_replace('https://www.youtube.com/channel/', '', $channel);
	$channel = str_replace('http://www.youtube.com/channel/', '', $channel);

	$channel = preg_replace('/[^A-Za-z0-9\-]/', '', $channel);

	$url = './rss.php?channel_id=' . $channel;
?>
<div class="jumbotron">
	<p><a href="<?php echo $url; ?>">RSS-Feed</a></p>
</div>
<?php
}
?>
<form method="get" action="./">
	<div class="form-group">
		<label for="channel_url">Channel url:</label>
		<input type="text" class="form-control" id="channel_url" name="channel_url" placeholder="https://youtube.com/channel/UC...">
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>
</body>
</html>
