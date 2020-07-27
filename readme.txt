=== SB Breadcumbs block ===
Contributors:      bobbingwide
Tags:              block, breadcrumbs, link
Requires at least: 5.4.2
Tested up to:      5.4.2
Stable tag:        0.4.0
Requires PHP:      7.2.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

Show Breadcrumb links to the current content.

== Description ==
Use the Breadcrumbs block ( sb/breadcrumbs-block ) to display a links to the current content as a breadcrumb trail.
Works for any hierarchical post type such as pages.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/sb-breadcrumbs-block` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress

== Frequently Asked Questions ==


== Screenshots ==
1. breadcrumbs block

== Upgrade Notice ==
= 0.4.0 =
Use the breadcrumbs block (sb/breadcrumbs-block) from the SB breadcrumbs block plugin when you need to show links to all the current posts' ancestors.


== Changelog ==
= 0.4.0 =
* Changed: Copied and cobbled from SB Parent block plugin.

== Build process ==

- To build the block during development.

`npm start`

Press Ctrl-C to to stop process.

- To build the block for runtime.

`npm run build`

The routine should terminate when the build is complete.

Note: The scripts don't yet support internationalization.

Pre-requisite:

You need to have `npm` - Node Package Manager - installed.

For some basic instructions see the [oik-blocks summary of blocks README](https://github.com/bobbingwide/oik-blocks/tree/master/blocks)

Most people run the `npm` command from the command line.



