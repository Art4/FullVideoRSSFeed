<?php

namespace YoutubeDownloader;

/**
 * Video
 */
class Video
{
	public function clean($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

	public function formatBytes($bytes, $precision = 2) {
		$units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		$bytes = max($bytes, 0);
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
		$pow = min($pow, count($units) - 1);
		$bytes /= pow(1024, $pow);
		return round($bytes, $precision) . '' . $units[$pow];
	}

	public function is_chrome(){
		$agent=$_SERVER['HTTP_USER_AGENT'];
		if( preg_match("/like\sGecko\)\sChrome\//", $agent) ){	// if user agent is google chrome
			if(!strstr($agent, 'Iron')) // but not Iron
				return true;
		}
		return false;	// if isn't chrome return false
	}

	public function __construct()
	{
		# code...
	}

}
