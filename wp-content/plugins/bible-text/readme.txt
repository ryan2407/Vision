=== Bible Text ===
Contributors: mark8barnes
Donate link: http://www.4-14.org.uk/wordpress-plugins/donate
Tags: bible, esv, kjv, asv
Requires at least: 2.5
Tested up to: 2.8.4
Stable tag: trunk

Automatically adds the full text of any Bible passage to your Wordpress post/page in your choice of Bible version and language (dozens supported).

== Description ==

The Bible Text wordpress plugin allows you to very simply add the full text of any passage of the Bible with a simple shortcode like this `[bible passage="John 3" version="esv"]`.

Several Bible versions are supported, including ESV (the default), NET Bible, KJV, ASV and many, many others. Dozens more are available in other languages including Spanish, Arabic, Chinese, Portugese, Russian, and German. Original languages (Greek and Hebrew) are also available. For a full list, see http://www.4-14.org.uk/wordpress-plugins/bible-text

The text you request is automatically added to your website whenever someone views your post or page. A special API service sends you only the text you need, so you don't have to store the whole Bible on your own site.

The bible text is added by your server, not by Javascript. This means the text can be even seen by those who don't have javascript turned on (including search engines), and there are no annoying popups.

The plugin intelligently determines what verses you request, even if you request from multiple books or use abbreviations. The following are all valid:

* `passage="Jn3:16"`
* `passage="Acts 3:17-4:2"`
* `passage="Amos 7; Psa 119:4-16"`
* `passage="Acts 15:1-5, 10, 15"`

A heading can be automatically inserted, by adding the parameter `heading="h3"`, like this: `[bible passage="Genesis 1:1-2:3" heading="h3"]`. The h3 is an HTML code, and can be changed to any other valid HTML tag. If h3 is too big, try h4 or h5.

= Limitations =
* You can request up to a maximum of 500 verses.
* Although non-English Bible versions are supported, the passage must be requested using English book names.

== Installation ==

1. Add it to your site using Wordpress' built in plugin installer.
2. Activate.
3. Add to any post or page using shortcodes like this: [bible passage="John 3" version="esv"]

== Screenshots ==

1. When you're editing a post, insert the Bible text using simple shortcodes like this:
2. When people view your page, the plugin will magically transform it to something like this:

== Changelog ==

= 0.1 =
* 24 September 2009
* Initial release.
