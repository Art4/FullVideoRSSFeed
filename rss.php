<?php

error_reporting(0);
ini_set('display_errors', 'Off');

require(__DIR__ . \DIRECTORY_SEPARATOR . 'vendor' . \DIRECTORY_SEPARATOR . 'autoload.php');

if ( ! array_key_exists('channel_id', $_GET) )
{
	die('Please define a channel_id');
}

$channel_id = $_GET['channel_id'];

$feed = new SimplePie();

// Set the feed to process.
$feed->set_feed_url('https://www.youtube.com/feeds/videos.xml?channel_id=' . $channel_id);
$feed->set_cache_location(__DIR__ . '/cache');

// Run SimplePie.
$feed->init();

if ( $feed->error() !== null )
{
	die($feed->error());
}

$ssl      = ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' );
$sp       = strtolower( $_SERVER['SERVER_PROTOCOL'] );
$protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
$port     = $_SERVER['SERVER_PORT'];
$port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
$host     = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : null;
$host     = isset( $host ) ? $host : $_SERVER['SERVER_NAME'] . $port;

$base_url = $protocol . '://' . $host . $_SERVER['SCRIPT_NAME'];
$base_url = substr($base_url, 0, -7);

$rssfeed = '<?xml version="1.0" encoding="UTF-8"?>';
$rssfeed .= '<rss version="2.0">';
$rssfeed .= '<channel>';
$rssfeed .= '<title>' . $feed->get_title() . '</title>';
$rssfeed .= '<link>' . $feed->get_permalink() . '</link>';
$rssfeed .= '<description>' . $feed->get_description() . '</description>';

foreach ($feed->get_items() as $item)
{
	$video_id = substr(strstr($item->get_permalink(), 'v='), 2, 11);

	$enclosure = $item->get_enclosure();

	$rssfeed .= '<item>';
	$rssfeed .= '<title>' . $item->get_title() . '</title>';
	$rssfeed .= '<description>' . $enclosure->get_description() . '</description>';
	$rssfeed .= '<link>' . $item->get_permalink() . '</link>';
	$rssfeed .= '<pubDate>' . $item->get_date('D, d M Y H:i:s O') . '</pubDate>';
	$rssfeed .= '<enclosure url="' . $base_url . 'download.php?v=' . $video_id . '" type="video/mp4" />';
	//$rssfeed .= '<media:thumbnail url="' . $enclosure->get_thumbnail() . '" />';
	$rssfeed .= '</item>';
}

$rssfeed .= '</channel>';
$rssfeed .= '</rss>';

echo $rssfeed;

die();
?>
