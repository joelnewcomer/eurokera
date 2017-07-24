=== Tabs With History ===
Contributors: joelnewcomer
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=BSRL5A88VPNTW&lc=US&item_name=Joel%20Newcomer&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: tabs, back, history, browser, button, jquery, tools
Requires at least: 3.0.1
Tested up to: 3.5
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin creates shortcodes that generate tabs that respect the Back button.

== Description ==

Tabs are a staple when it comes to web design, so you can imagine my dismay when I searched for a simple tab plugin that supported browser history and found absolutely nothing. This plugin is intended for developers or people familiar with CSS since it includes no CSS of it's own. However, it does use the responsive structure of ZURB's Foundation framework. The tab content is generated using shortcodes.

This plugin uses a minified version of jQuery Tools that only includes the code for tabs with history.

Example shortcode structure:

[tabgroup title="Title[optional]"]
[tab title="Tab 1" id="tab-1-id"]

Tab 1 content.

[/tab]
[tab title="Tab2" id="tab-2-id"]

Tab 2 content.

[/tab]
[/tabgroup]


== Installation ==

For detailed installation instructions, please read the [standard installation procedure for WordPress plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).

1. Upload the `/tabs-with-history/` directory and its contents to `/wp-content/plugins/`.
2. Login to your WordPress installation and activate the plugin through the _Plugins_ menu.
3. Done. This plugin has no user interface or configuration options.

== Frequently Asked Questions ==

= Can I turn off the included CSS? =

I plan to include this option in the next update.

== Screenshots ==

1. The way the tabs look to website visitors.

2. Screenshot of usage for shortcodes in the admin.

== Changelog ==

= 1.0 =
Initial release.