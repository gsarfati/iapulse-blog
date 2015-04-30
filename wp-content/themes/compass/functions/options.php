<?php return array(


/* Theme Admin Menu */
"menu" => array(
    array("id"    => "1",
          "name"  => "General"),

    array("id"    => "2",
          "name"  => "Homepage"),

),

/* Theme Admin Options */
"id1" => array(
    array("type"  => "preheader",
          "name"  => "Theme Settings"),

    array("name"  => "Custom Feed URL",
          "desc"  => "Example: <strong>http://feeds.feedburner.com/wpzoom</strong>",
          "id"    => "misc_feedburner",
          "std"   => "",
          "type"  => "text"),

	array("name"  => "Enable comments for static pages",
          "id"    => "comments_page",
          "std"   => "off",
          "type"  => "checkbox"),

    array("type" => "startsub",
          "name" => "Breaking News Bar"),

    array("name"  => "Display Breaking News Bar?",
          "desc"  => "Edit posts which you want to display here, and check the option from editing page: <strong>Add to Breaking News Bar</strong> ",
          "id"    => "breaking_on",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Number of Posts",
          "desc"  => "Default: <strong>5</strong> (posts).",
          "id"    => "breaking_number",
          "std"   => "5",
          "type"  => "text"),

    array("type"  => "endsub"),

      array(
            "type" => "preheader",
            "name" => "Global Posts Options"
        ),

        array(
            "name" => "Content",
            "desc" => "Number of posts displayed on homepage can be changed <a href=\"options-reading.php\" target=\"_blank\">here</a>.",
            "id" => "display_content",
            "options" => array(
                'Excerpt',
                'Full Content',
                'None'
            ),
            "std" => "Excerpt",
            "type" => "select"
        ),

        array(
            "name" => "Excerpt length",
            "desc" => "Default: <strong>50</strong> (words)",
            "id" => "excerpt_length",
            "std" => "50",
            "type" => "text"
        ),

        array(
            "type" => "startsub",
            "name" => "Featured Image"
        ),

        array(
            "name" => "Display Featured Image",
            "id" => "index_thumb",
            "std" => "on",
            "type" => "checkbox"
        ),

        array(
            "name" => "Featured Image Width (in pixels)",
            "desc" => "Default: <strong>270</strong> (pixels).<br/><br/>You'll have to run the <a href=\"http://wordpress.org/extend/plugins/regenerate-thumbnails/\" target=\"_blank\">Regenerate Thumbnails</a> plugin each time you modify width or height (<a href=\"http://www.wpzoom.com/tutorial/fixing-stretched-images/\" target=\"_blank\">view how</a>).",
            "id" => "thumb_width",
            "std" => "270",
            "type" => "text"
        ),

        array(
            "name" => "Featured Image Height (in pixels)",
            "desc" => "Default: <strong>200</strong> (pixels)",
            "id" => "thumb_height",
            "std" => "200",
            "type" => "text"
        ),

        array(
            "type" => "endsub"
        ),

        array(
            "name" => "Display Author",
            "id" => "display_author",
            "std" => "on",
            "type" => "checkbox"
        ),


        array(
            "name" => "Display Date/Time",
            "desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
            "id" => "display_date",
            "std" => "on",
            "type" => "checkbox"
        ),

        array(
            "name" => "Display Category",
            "id" => "display_category",
            "std" => "on",
            "type" => "checkbox"
        ),


        array(
            "name" => "Display Comments Count",
            "id" => "display_comments",
            "std" => "on",
            "type" => "checkbox"
        ),


        array(
            "type" => "preheader",
            "name" => "Single Post Options"
        ),


        array(
            "name" => "Display Date/Time",
            "desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
            "id" => "post_date",
            "std" => "on",
            "type" => "checkbox"
        ),

        array(
            "name" => "Display Author",
            "desc" => "You can edit your profile on this <a href='profile.php' target='_blank'>page</a>.",
            "id" => "post_author",
            "std" => "on",
            "type" => "checkbox"
        ),

        array(
            "name" => "Display Category",
            "id" => "post_category",
            "std" => "on",
            "type" => "checkbox"
        ),

        array("type" => "startsub",
               "name" => "Share Buttons"),

          array("name"  => "Display Sharing Buttons",
                "id"    => "post_share",
                "std"   => "on",
                "type"  => "checkbox"),

          array("name"  => "Twitter Button Label",
                "desc"  => "Default: <strong>Tweet</strong>",
                "id"    => "post_share_label_twitter",
                "std"   => "Tweet",
                "type"  => "text"),

          array("name"  => "Facebook Button Label",
                "desc"  => "Default: <strong>Share</strong>",
                "id"    => "post_share_label_facebook",
                "std"   => "Share",
                "type"  => "text"),

          array("name"  => "Google+ Button Label",
                "desc"  => "Default: <strong>Share</strong>",
                "id"    => "post_share_label_gplus",
                "std"   => "Share",
                "type"  => "text"),

        array("type"  => "endsub"),



        array(
            "name" => "Display Tags",
            "id" => "post_tags",
            "std" => "on",
            "type" => "checkbox"
        ),

        array(
            "name" => "Display Author Profile",
            "desc" => "You can edit your profile on this <a href='profile.php' target='_blank'>page</a>.",
            "id" => "post_author_box",
            "std" => "on",
            "type" => "checkbox"
        ),

        array(
            "name" => "Display Comments",
            "id" => "post_comments",
            "std" => "on",
            "type" => "checkbox"
        ),

    ),


"id2" => array(

  array("type"  => "preheader",
        "name"  => "Recent Posts"),

  array("name"  => "Title for Recent Posts",
        "desc"  => "Default: <em>Latest news</em>",
        "id"    => "recent_title",
        "std"   => "Latest news",
        "type"  => "text"),

  array("name"  => "Exclude categories",
        "desc"  => "Choose the categories which should be excluded from the main Loop on the homepage.<br/><em>Press CTRL or CMD key to select/deselect multiple categories </em>",
        "id"    => "recent_part_exclude",
        "std"   => "",
        "type"  => "select-category-multi"),

  array("name"  => "Hide Featured Posts in Recent Posts?",
        "desc"  => "You can use this option if you want to hide posts which are featured in the slider on front page.",
        "id"    => "hide_featured",
        "std"   => "on",
        "type"  => "checkbox"),


    array("type"  => "preheader",
          "name"  => "Homepage Slideshow"),

    array("name"  => "Display Slideshow on homepage?",
          "desc"  => "Do you want to show a featured slider on the homepage? To add posts in slider, go to <a href='edit.php?post_type=slider' target='_blank'>Slideshow section</a>",
          "id"    => "featured_posts_show",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Autoplay Slideshow?",
          "desc"  => "Do you want to auto-scroll the slides?",
          "id"    => "slideshow_auto",
          "std"   => "on",
          "type"  => "checkbox",
          "js"    => true),

    array("name"  => "Slider Autoplay Interval",
          "desc"  => "Select the interval (in miliseconds) at which the Slider should change posts (<strong>if autoplay is enabled</strong>). Default: 3000 (3 seconds).",
          "id"    => "slideshow_speed",
          "std"   => "3000",
          "type"  => "text",
          "js"    => true),

    array("name"  => "Number of Posts in Slider",
          "desc"  => "How many posts should appear in  Slider on the homepage? Default: 5.",
          "id"    => "slideshow_posts",
          "std"   => "5",
          "type"  => "text"),

    array(
        "name" => "Display Date/Time",
        "desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
        "id" => "slider_date",
        "std" => "on",
        "type" => "checkbox"
    ),

    array(
        "name" => "Display Comments Count",
        "id" => "slider_comments",
        "std" => "on",
        "type" => "checkbox"
    ),

)

/* end return */);