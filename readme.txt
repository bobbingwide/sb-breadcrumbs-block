=== SB Breadcrumbs block ===
Contributors:      bobbingwide
Tags:              block, breadcrumbs, link, Yoast, Genesis
Requires at least: 5.4.2
Tested up to:      6.4.1
Stable tag:        0.6.1
Requires PHP:      7.2.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

Show breadcrumb links to the current content.

== Description ==
Use the Breadcrumbs block ( sb/breadcrumbs-block ) to display links to the current content in a breadcrumb trail.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/sb-breadcrumbs-block` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress

== Frequently Asked Questions ==

= Does it use Yoast SEO breadcrumbs? =
Yes. If they're Enabled. But only on the front end.

= Does it use Genesis breadcrumbs? =
Yes. If available and breadcrumbs have not already been created using Yoast breadcrumbs.
And also, only on the front end.

= Why doesn't Gutenberg provide a breadcrumbs block? =
See the feature request  
https://github.com/WordPress/gutenberg/issues/21943

== Screenshots ==
1. breadcrumbs block

== Upgrade Notice ==
= 0.6.1 = 
Update for support for PHP 8.1 and PHP 8.2

= 0.6.0 = 
Upgrade for an internationalized and localized version.

= 0.5.3 = 
May fix a problem with WSOD when Jetpack also active?

= 0.5.2 =
Update for support for Genesis breadcrumbs.

= 0.5.1 =
Update for improved documentation.

= 0.5.0 =
Now internationalized. Supported languages are US English, UK English ( 'en_GB' locale ) and bbboing language ( 'bb_BB' locale )

= 0.4.0 =
Use the breadcrumbs block (sb/breadcrumbs-block) from the SB breadcrumbs block plugin when you need to show links to all the current posts' ancestors.

== Changelog ==
= 0.6.1 = 
* Changed: Support PHP 8.1 and PHP 8.2 #8
* Tested: With WordPress 6.4.1 and WordPress Multisite
* Tested: With Gutenberg 17.1.4
* Tested: With PHP 8.1 and PHP 8.2
* Tested: With Yoast-SEO 21.6

= 0.6.0 = 
* Changed: Block is registered using block.json apiVersion:2 #7
* Changed: Internationalized and localized. #7
* Tested: With WordPress 5.8.1
* Tested: With Gutenberg 11.5.1
* Tested: With PHP 8.0
* Tested: With Yoast-SEO 17.2

= 0.5.3 = 
* Changed: Updated build.

= 0.5.2 =
* Changed: Add support for Genesis Breadcrumbs - front end only, [github bobbingwide sb-breadcrumbs-block issues 3]

= 0.5.1 =
* Changed: Improved internationalization strings, [github bobbingwide sb-breadcrumbs-block issues 1]
* Tested: With WordPress 5.5-RC1

= 0.5.0 =
* Added: Uses Yoast SEO breadcrumbs if enabled, [github bobbingwide sb-breadcrumbs-block issues 2]
* Changed: Internationalised. Localised into UK English and bbboing language, [github bobbingwide sb-breadcrumbs-block issues 1]
* Tested: With WordPress 5.4.2 and WordPress Multi Site
* Tested: With WordPress 5.5-beta3
* Tested: With PHP 7.3 and PHP 7.4

= 0.4.0 =
* Changed: Copied and cobbled from SB Parent block plugin.

== Build process ==
Only necessary if you want to build the block yourself.

- To build the block during development.

`npm start`

Press Ctrl-C to to stop process.

- To build the block for runtime.

`npm run build`

The routine should terminate when the build is complete.

- To build the main file for translation

`npm run makepot`

- To perform automatic localization to UK English ( en_GB ) and bbboing ( bb_BB ) locales.

`npm run l10n`

- To create the block editor language files after translation

`npm run makejson`

Pre-requisite:

You need to have `npm` - Node Package Manager - installed.

For some basic instructions see the [oik-blocks summary of blocks README](https://github.com/bobbingwide/oik-blocks/tree/master/blocks)

Most people run the `npm` command from the command line.



