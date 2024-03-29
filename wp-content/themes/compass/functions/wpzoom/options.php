<?php return array(


/* Framework Admin Menu */
"menu" => array(
    // 5 is reserved for styling

    "framework" =>array(
        "name"  => "Framework"),

    // 7 is reserved for banners

    "import-export" => array(
        "name"  => "Import/Export")
),

/* Framework Admin Options */

"id3" => array(
    array("type"  => "preheader",
          "name"  => "General Settings"),

    array("name"  => "Enable SEO Settings",
          "desc"  => "If you want to use a 3rd party SEO Plugin uncheck this option.<br/><strong>Recommended SEO Plugins</strong>: <a href=\"http://wordpress.org/extend/plugins/all-in-one-seo-pack/\">All in One SEO Pack</a>, <a href=\"http://wordpress.org/extend/plugins/wordpress-seo/\">WordPress SEO</a> ",
          "id"    => "seo_enable",
          "std"   => "off",
          "type"  => "checkbox"),

    array("type"  => "preheader",
          "name"  => "Title Tag Structure <code>&lt;title&gt;</code>"),

    array("name"  => "Homepage",
          "desc"  => "Choose the format you would like to display <code>&lt;title&gt;</code> tag on homepage.",
          "id"    => "seo_home_title",
          "options" => array('Site Title - Site Description','Site Description - Site Title', 'Site Title'),
          "std"   => "Site Title - Site Description",
          "type"  => "select"),

    array("name"  => "Posts and Pages",
          "desc"  => "Choose the format you would like to display <code>&lt;title&gt;</code> tag on Single Posts and Pages.",
          "id"    => "seo_posts_title",
          "options" => array('Page Title','Page Title - Site Title', 'Site Title - Page Title'),
          "std"   => "Page Title",
          "type"  => "select"),

    array("name"  => "Index Pages (Categories/Archives/Tags/Search Results)",
          "desc"  => "Choose the format you would like to display <code>&lt;title&gt;</code> tag on index pages.",
          "id"    => "seo_pages_title",
          "options" => array('Page Title - Site Title','Site Title - Page Title', 'Page Title'),
          "std"   => "Page Title - Site Title",
          "type"  => "select"),

    array("name"  => "Separator",
          "id"    => "title_separator",
          "std"   => " &mdash; ",
          "type"  => "text"),

    array("type"  => "preheader",
          "name"  => "Homepage META <code>&lt;meta&gt;</code>"),


    array("name"  => "META Description for Homepage",
          "desc"  => "Here you can insert META description for your <strong><em>home page</em></strong>, which will appear in search engines. If you leave it blank, the <a href='options-general.php' target='_blank'>Tagline</a> will be used instead. <br />On <strong><em>Single Posts</em></strong> by default will be used the excerpt to generate description.",
          "id"    => "meta_desc",
          "type"  => "textarea"),

    array("name"  => "META Keywords for Homepage",
          "desc"  => "Insert META keywords, comma separated. Generally META Keywords are ignored by Search Engines.<br />On <strong><em>Single Posts</em></strong> by default tags will be used to generate keywords.",
          "id"    => "meta_key",
          "type"  => "text"),


    array("type"  => "preheader",
          "name"  => "Search Engine Indexing Settings"),

    array("name"  => "Category Archives",
          "id"    => "index_category",
          "desc"  => "The options below will help you prevent the indexing in search engines of unwanted pages that are generated automatically by WordPress that do nothing but dilute your search results by adding <code>&lt;noindex&gt;</code> tag.",
          "options" => array('index', 'noindex'),
          "std"   => "index",
          "type"  => "select"),

    array("name"  => "Tag Archives",
          "id"    => "index_tag",
          "options" => array('index', 'noindex'),
          "std"   => "index",
          "type"  => "select"),

    array("name"  => "Author Archives",
          "id"    => "index_author",
          "options" => array('index', 'noindex'),
          "std"   => "index",
          "type"  => "select"),

    array("name"  => "Date Archives",
          "id"    => "index_date",
          "options" => array('index', 'noindex'),
          "std"   => "index",
          "type"  => "select"),

    array("name"  => "Search Results",
          "id"    => "index_search",
          "options" => array('index', 'noindex'),
          "std"   => "index",
          "type"  => "select"),

    array("type"  => "preheader",
          "name"  => "Canonical Tag Settings"),

    array("name"  => "Enable Canonical URLs",
          "desc"  => "The Canonical Tag is used to inform search engines of the proper URL to index when they crawl your website.",
          "id"    => "canonical",
          "type"  => "checkbox",
          "std"   => "off"),

),

"framework" => array(
    array("type"  => "preheader",
          "name"  => "Framework Options"),

    array("name"  => "Framework Generator Meta Tags",
          "desc"  => "Includes information about theme and framework you use in meta tags along to WordPress ones, they are used just for information and doesn't impact your SEO.",
          "id"    => "meta_generator",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Framework Updater",
          "desc"  => "This enables update features for WPZOOM framework such as menu in wp-admin and also global notifications about new updates.",
          "id"    => "framework_update_enable",
          "std"   => "off",
          "type"  => "checkbox"),

    array("name"  => "Framework Updater Notification",
          "desc"  => "Enables or disables global wp-admin notification about new versions of framework. If previous option is disabled this one is irrelevant.",
          "id"    => "framework_update_notification_enable",
          "std"   => "off",
          "type"  => "checkbox"),

    array("type"  => "preheader",
          "name"  => "Debug"),

    array("name"  => "Debug info",
          "desc"  => "You can include this information in your support tickets on WPZOOM Support Desk.",
          "id"    => "misc_debug",
          "std"   => "",
          "type"  => "textarea"),
),

"import-export" => array(
    array("type"  => "preheader",
          "name"  => "Theme Options"),

    array("name"  => "Import Options",
          "desc"  => "To import the options from another installation of this theme paste your code here.",
          "id"    => "misc_import",
          "std"   => "",
          "type"  => "textarea"),

    array("name"  => "Export Options",
          "desc"  => "Export the options to another installation of this theme, or to keep a backup of your options. You can can also save your options in a new text document.",
          "id"    => "misc_export",
          "std"   => "",
          "type"  => "textarea"),

    array("type"  => "preheader",
          "name"  => "Widgets"),


    array("name"  => "Load default widget settings",
          "desc"  => "Click on this button to load the default widget settings (as in theme demo).</br><em><strong>NOTE:</strong> Click on <strong>Save all changes</strong> button to save other modifications before loading default widgets.</em>",
          "id"    => "misc_load_default_widgets",
          "type"  => "button"),

    array("name"  => "Import Widgets",
          "desc"  => "To import widgets from another installation of this theme insert your exported code here. ",
          "id"    => "misc_import_widgets",
          "std"   => "",
          "type"  => "textarea"),

    array("name"  => "Export Widgets",
          "desc"  => "Export widgets to another installation of this theme.",
          "id"    => "misc_export_widgets",
          "std"   => "",
          "type"  => "textarea")
)

/* end return */
);
