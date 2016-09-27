<!DOCTYPE html>
<html lang="en">
<head>
	<title>Full Youtube RSS-Feed</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fortawesome/font-awesome/css/font-awesome.min.css">
</head>

<body>
<div class="container">
	<a href="./"><h1><i class="fa fa-youtube-play" aria-hidden="true"></i> <i class="fa fa-rss" aria-hidden="true"></i> Full Youtube RSS-Feed</h1></a>
	<p>Subscribe a RSS feed from a Youtube channel with full video download.</p>
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

	$url = '.';

	if ( isset($_SERVER['SCRIPT_URI']) )
	{
		$url = rtrim($_SERVER['SCRIPT_URI'], '/');
	}

	$url .= '/rss.php?channel_id=' . $channel;

	$qrcode = './qrcode.php?url=' . urlencode($url);
?>
<div class="alert alert-success">
	<p><a href="<?php echo $url; ?>" class="alert-link"><i class="fa fa-rss" aria-hidden="true"></i> RSS-Feed</a></p>
	<p><i class="fa fa-qrcode" aria-hidden="true"></i> QRCode:</p>
	<img src="<?php echo $qrcode ?>" />
</div>
<?php
}
?>
<form method="get" action="./">
	<div class="form-group">
		<label for="channel_url">Channel-ID or channel url:</label>
		<input type="text" class="form-control" id="channel_url" name="channel_url" placeholder="https://youtube.com/channel/UC...">
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>
<hr>
<footer>
<p><a href="https://github.com/Art4/YouTube-Downloader"><i class="fa fa-github" aria-hidden="true"></i> Fork me on Github</a> | <a href="https://twitter.com/weigandtLabs"><i class="fa fa-twitter" aria-hidden="true"></i> @weigandtLabs</a></p>
</footer>
</div>
</body>
</html>
