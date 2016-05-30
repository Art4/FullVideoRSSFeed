<?php

namespace YoutubeDownloader;

/**
 * Handler
 */
class Handler
{
	protected $curl;

	function __construct(Curl $curl)
	{
		$this->curl = $curl;
	}

	public function getVideoInfo($video_id)
	{
		$video_info = 'http://www.youtube.com/get_video_info?&video_id=' .  $video_id . '&asv=3&el=detailpage&hl=en_US'; //video details fix *1

		$info_string = $this->curl->get($video_info);

		$info_array = [];

		parse_str($info_string, $info_array);

		return $info_array;
	}

	public function parseStreamMap($map)
	{
		$map_parts = explode(',', $map);

		$map_array = [];

		$expire = time();

		foreach($map_parts as $part)
		{
			parse_str($part, $part_array);

			$type = explode(';', $part_array['type']);

			parse_str(urldecode($part_array['url']), $url_array);

			$new_array = [
				'itag' => $part_array['itag'],
				'quality' => $part_array['quality'],
				'type' => $type[0],
				'url' => urldecode($part_array['url']) . '&signature=' . $url_array['signature'],
				'expires' => $url_array['expire'] ?: $expire,
				'ipbits' => $url_array['ipbits'],
				'ip' => $url_array['ip'],
			];

			$map_array[] = $new_array;
		}

		return $map_array;
	}

	public function chooseStreamFromMap(array $map)
	{
		$parts = [];

		foreach ($map as $part)
		{
			$parts[$part['itag']] = $part;
		}

		// mp4 small
		if ( isset($parts[18]) )
		{
			return $parts[18];
		}

		// mp4 large
		if ( isset($parts[22]) )
		{
			return $parts[22];
		}

		// webm
		if ( isset($parts[43]) )
		{
			return $parts[43];
		}

		// 3gpp large
		if ( isset($parts[36]) )
		{
			return $parts[36];
		}

		// 3gpp small
		if ( isset($parts[17]) )
		{
			return $parts[17];
		}

		return array_pop($parts);
	}
}
