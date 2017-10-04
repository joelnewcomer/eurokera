=== Heartbeat Control ===
Contributors: JeffMatson
Donate link: https://jeffmatson.net/donate
Tags: heartbeat, admin-ajax, server resources, heartbeat control, heartbeat api, performance, debugging, javascript
Requires at least: 3.6
Tested up to: 4.8.2
Stable tag: 1.1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows you to easily manage the frequency of the WordPress heartbeat API.

== Description ==

**Important:**
Upon the release of 1.1, a small issue existed that caused a big problem which broke the plugin. The issue has been resolved as of version 1.1.2.
If you're getting errors, check your plugin version and update to 1.1.3, which should fix everything. You'll need to replace the plugin (wp-content/plugins/heartbeat-control) via FTP. Once you do that, all should be well.

Allows you to easily manage the frequency of the WordPress heartbeat API with just a few clicks.

The heartbeat API can be disabled entirely and allowed for only specific locations.

Heartbeat intervals can be modified between 15 and 300 seconds between requests, saving on server resources.

== Installation ==

1.  Upload the plugin folder to the /wp-content/plugins/ directory.
1.  Activate Heartbeat Control on the Plugins page.
1.  Adjust any settings within Settings > Heartbeat Control.

== Frequently Asked Questions ==

= How do I change my settings? =

All options are located within Settings > Heartbeat Control.

= Why would I want to change the default heartbeat intervals? =

If you commonly leave your WordPress admin up for long periods of time, especially while writing or editing a post, the repeated POST requests can cause high resource usage.  To avoid this, the heartbeat can be modified or even disabled to lower your server resource usage.

== Changelog ==
= 1.1.3 =
* Readme updates.

= 1.1.2 =
* Bugfixes.
* Resolves potential fatal error mistakenly pushed to 1.1.

= 1.1.1 =
* Bugfixes.

= 1.1 =
* Rewritten from the ground up for future extensibility.
* Performance enhancements.
* Improved UI.
* Better handling for late calls to the Heartbeat API.
* New condition settings for filtering on the frontend.

= 1.0.2 =
* Bumped tested version
* Added donation button

= 1.0 =
*   Initial release.
