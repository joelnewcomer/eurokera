=== Plugin Name ===
Contributors: marclarr
Tags: page, pages, post, posts, switch, admin, ui, edit, easy, quick, fast, wp-admin, metabox
Requires at least: 3.1
Tested up to: 4.7
Stable tag: 1.5.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Save time switching between posts of any post-type in wp-admin.

== Description ==

This plugin adds a metabox to the edit screen for any post type. The metabox lets you quickly switch between all available posts using the Select2 jQuery plugin. No need to visit "All Posts“ first. You can use the settings page to determine for which post types (e.g. Pages, Posts, etc.) the metabox should be available.

Please do not use the rating system for your support requests. Simply leave a message in the plugin [support forum](https://wordpress.org/support/plugin/fast-page-switch) and I will get back to you right away.

<em>If this plugin saves you time, please consider supporting it with a good rating. Thanks.</em>

== Screenshots ==

1. The fast page switch metabox and it's functionality.
2. Preview of the admin settings page (since v1.4).

== Changelog ==

= 1.5.7 - October 11, 2016 =
* Removed "acf-disabled" from post-statuses setting.
* Removed Easy Digital Download items from post-statuses setting.
* Removed WooCommerce items from post-statuses and post-type settings.
* Applied new CSS max-height to Select2 drop-down.

= 1.5.6 - October 11, 2016 =
* Hardened option retrieval to avoid non-existent post-type and post-status errors.
* Improved settings to allow for custom post statuses.
* Added Minimum Capability info to settings.
* Fixed metabox CSS bug where the screen would become horizontally scrollable.
* Updated transition (.pot) file.

= 1.5.5 - October 11, 2016 =
* Hardened admin_enqueue_scripts function.
* Added settings link to metabox.
* Improved metabox CSS spacing.

= 1.5.4 - October 3, 2016 =
* Patched undefined variable notice.

= 1.5.3 - September 23, 2016 =
* Updated Select2 JS & CSS to version 4.0.3.
* Improved JS to better handle Select2 V3 backwards compatibility.
* Increased Select2 results height.
* Added "Switch" string to translation.

= 1.5.2 - September 21, 2016 =
* Improved select2 JS.

= 1.5.1 - September 21, 2016 =
* Fixed styling bug.

= 1.5.0 - September 21, 2016 =
* Added loading indicator to metabox.
* Posts are now ordered by title, not date.
* Updated info text on settings page.
* Updated translation (.pot) file.

= 1.4.0 - September 16, 2016 =
* Added support for custom post types.
* Created settings page for managing post types shown.
* To keep the database clean, settings are delete via uninstall.php when plugin is deleted.
* Contrary to version 1.3.1, the metabox now only shows if the current user can edit at least one of the available post-types which also has at least one post the user is allowed to edit.
* Removed filter "fps_get_pages_by_post_status" in favor of admin setting "Post Statuses."
* Removed filter "fps_get_posts_by_post_status" in favor of admin setting "Post Statuses."
* The plugin is now translatable.

= 1.3.1 =
* Added a placeholder for "Add New" screens.
* Limited the metabox to show only for admin and editor roles for now.

= 1.3.0 =
* Fixed a bug were select2.js wasn't not enqueued on post edit screens.

= 1.2.9 =
* Added posts to the page switch dropdown.
* Included a filter called "fps_get_posts_by_post_status" to change the post_status argument for get_posts().

= 1.1.9 =
* Added Select2 version 3 backwards compatibility.
* Changed Select2 script handles to a generic name to prevent clashes with other plugins using Select2.

= 1.1.7 =
* Addressed a bug where Select2 was getting stuck on the new value when a page change was prevented due to unsaved changes.
* Fixed a bug where select2.js wasn't being loaded for "add new" pages.
* Included more post_status pages: private, draft, future and pending are now available via the dropdown. This also includes password protected pages.
* Included a filter called "fps_get_pages_by_post_status" to change the post_status argument for get_pages().

= 1.1.3 =
* Included the [Select2](https://github.com/select2/select2) version 4 jQuery plugin.
* Lowered the minimum required WP version from 4 to the accurate version.
* Changed the metabox title to the plugin's name.

= 1.0.1 =
* Added a little bit of code documentation.
* Updated the readme.

= 1.0.0 =
* Initial Release
