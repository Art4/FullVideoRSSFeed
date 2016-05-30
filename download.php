<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require(__DIR__ . \DIRECTORY_SEPARATOR . 'vendor' . \DIRECTORY_SEPARATOR . 'autoload.php');

$config = new YoutubeDownloader\Config;
$curl = new YoutubeDownloader\Curl($config);

$video = new YoutubeDownloader\Video;

$handler = new YoutubeDownloader\Handler($curl);

if ( ! array_key_exists('v', $_GET) )
{
	die('Please define a video');
}

$video_id = $_GET['v'];

$video_info = $handler->getVideoInfo($video_id);

if ( $video_info['status'] === 'fail' or ! isset($video_info['url_encoded_fmt_stream_map']) )
{
	echo 'Error in video ID';
	exit();
}

$stream_map = $handler->parseStreamMap($video_info['url_encoded_fmt_stream_map']);

$stream_info = $handler->chooseStreamFromMap($stream_map);

// Set operation params
$mime = filter_var($stream_info['type']);
$ext  = str_replace(array('/', 'x-'), '', strstr($mime, '/'));
$url  = $stream_info['url'];
$name = $video->clean($video_info['title']) . '.' .$ext;

$size = $curl->get_size($url);
// Generate the server headers
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
{
	header('Content-Type: "' . $mime . '"');
	header('Content-Disposition: attachment; filename="' . $name . '"');
	header('Expires: 0');
	header('Content-Length: '.$size);
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header("Content-Transfer-Encoding: binary");
	header('Pragma: public');
}
else
{
	header('Content-Type: "' . $mime . '"');
	header('Content-Disposition: attachment; filename="' . $name . '"');
	header("Content-Transfer-Encoding: binary");
	header('Expires: 0');
	header('Content-Length: '.$size);
	header('Pragma: no-cache');
}

readfile($url);
exit;
