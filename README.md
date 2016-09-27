# Full YouTube RSS-Feed

Fork of [YouTube Downloader from John Eckman](https://github.com/jeckman/YouTube-Downloader)
License: GPL v2 or Later

This PHP script creates a RSS feed for a YouTube channel with full video download. So you can subscribe to channels with a podcast app and watch the videos there.  

NOTE: Full YouTube RSS-Feed does not work with videos using a cipher signature, see https://github.com/jeckman/YouTube-Downloader/issues/9

![full youtube rss-feed_02](https://cloud.githubusercontent.com/assets/2162994/18888898/9c5c2296-84fa-11e6-9fd0-08fa7610c0d2.png)

## Requirements

- Git
- >= PHP 4.5
- [Composer](https://getcomposer.org)

## Install

Clone this repo and install the dependencies with [Composer](https://getcomposer.org).

```
# Clone the repository with Git
git clone https://github.com/Art4/YouTube-Downloader.git

# Change in the new directory
cd YouTube-Downloader/

# Install the dependencies
composer install
```

## Notes

- The script tries to offer the videos at format "mpg4 small" by default.
