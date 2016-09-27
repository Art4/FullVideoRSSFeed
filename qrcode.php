<?php

error_reporting(0);
ini_set('display_errors', 'Off');

require(__DIR__ . \DIRECTORY_SEPARATOR . 'vendor' . \DIRECTORY_SEPARATOR . 'autoload.php');

if ( isset($_GET['url']) )
{
	$url = urldecode($_GET['url']);
}
elseif ( isset($_SERVER['SCRIPT_URI']) )
{
	$url = $_SERVER['SCRIPT_URI'];
}
else
{
	$url = './';
}

$renderer = new \BaconQrCode\Renderer\Image\Png();
$renderer->setHeight(256);
$renderer->setWidth(256);
$writer = new \BaconQrCode\Writer($renderer);

$image = $writer->writeString($url);

header('Content-Type: "image/png"');
header('Content-Disposition: attachment; filename="qrcode.svg"');
header('Expires: 0');
header('Content-Length: '.strlen($image));
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header("Content-Transfer-Encoding: binary");
header('Pragma: public');

echo $image;
exit;
