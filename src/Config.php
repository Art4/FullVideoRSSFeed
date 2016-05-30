<?php

namespace YoutubeDownloader;

/**
 * config
 */
class Config
{
	protected $config = [
		/**********|| Other ||***************/
		// Set your default timezone
		// use this link: http://php.net/manual/en/timezones.php
		'default_timezone' => 'Asia/Tehran',
	];

	// Debug mode
	#$debug=true; // debug mode on
	protected $debug = false; // debug mode off

	function __construct()
	{
		/**********|| Thumbnail Image Configuration ||***************/
		# $config['ThumbnailImageMode']=0;   // don't show thumbnail image
		# $config['ThumbnailImageMode']=1;   // show thumbnail image directly from YouTube
		$this->config['ThumbnailImageMode'] = 2;    // show thumbnail image by proxy from this server

		/**********|| Video Download Link Configuration ||***************/
		#$config['VideoLinkMode']='direct'; // show only direct download link
		#$config['VideoLinkMode']='proxy'; // show only by proxy download link
		$this->config['VideoLinkMode'] = 'both'; // show both direct and by proxy download links

		/**********|| features ||***************/
		$this->config['feature']['browserExtensions'] = true; // show links for install browser extensions? true or false

		/**********|| Multiple IPs ||***************/
		# You can enable this option if you are having problems with youtube IP limit / IP ban.
		# This option will work only if the IP you add are available for the server.
		# That means you have to buy some additionnal public IPs and assign these new static IPs to the server.
		# This should work only if you have a dedicated server...
		#
		#
		# Example of adding additional IPs to Ubuntu server 14.04 LTS
		# !!!! Be very careful, you may block yourself !!!!
		# !!!! If you are connecting to your server remotly by ssh. You would do this only if you know what you do !!!!
		# !!!! This is only an example with a specific dedicated server (ovh.net) !!!!
		#
		# For this example, the main IP on the server is 123.456.789.001
		# We want to add additionnal IPs 789.456.123.001 and 789.456.123.002
		#
		# Edit /etc/network/interfaces and put something like this:
		#
		# # The loopback network interface
		# auto lo
		# iface lo inet loopback
		#
		# # The Main server IP:
		# auto eth0
		# iface eth0 inet static
		#     address 123.456.789.001
		#     netmask 255.255.255.0
		#     network 123.456.789.0
		#     broadcast 123.456.789.255
		#     gateway 123.456.789.254
		#
		# # Additionnal IP: 789.456.123.001
		# auto eth0:0
		# iface eth0:0 inet static
		#     address 789.456.123.001
		#     netmask 255.255.255.255
		#     broadcast 789.456.123.001
		#     gateway 123.456.789.254
		#
		# # Additionnal IP: 789.456.123.002
		# auto eth0:1
		# iface eth0:0 inet static
		#     address 789.456.123.002
		#     netmask 255.255.255.255
		#     broadcast 789.456.123.002
		#     gateway 123.456.789.254
		#
		# # Additionnal IP xxx.xxx.xxx.xxx
		# auto eth0:2
		# iface eth0:2 inet static
		# (...)
		#
		# and so on for each IP you want to add....
		#
		#
		# Reboot your server
		# If you are having trouble and cannot connect anymore over ssh to your server,
		# that means your new network configuration has errors...
		# So be very careful before applying your configuration.
		# Try it first on a local dev server before messing up with your pro server.
		#
		#
		$this->config['multipleIPs'] = false; // enable multiple IPs support to bypass Youtube IP limit? true or false
		$this->config['IPs'] = [
			//'xxx.xxx.xxx.xxx',
			//'xxx.xxx.xxx.xxx',
			//'xxx.xxx.xxx.xxx',
			//'xxx.xxx.xxx.xxx',
			//'xxx.xxx.xxx.xxx',
			// add as many ips as you want (they must be available in the server conf (ex: /etc/network/interfaces fro ubuntu/debian)
		];

		date_default_timezone_set($this->config['default_timezone']);
	}

	public function get($key)
	{
		if (array_key_exists($key, $this->config))
		{
			return $this->config[$key];
		}

		throw new \InvalidArgumentException;
	}

}
