<?php
/*-----------------------------------------------------------------------------------*/
/* Initializing Widgetized Areas (Sidebars)				 							 */
/*-----------------------------------------------------------------------------------*/


register_sidebar(array('name'=>'Sidebar',
   'id' => 'Sidebar',
   'before_widget' => '<div class="widget %2$s" id="%1$s">',
   'after_widget' => '<div class="clear"></div></div>',
   'before_title' => '<h3 class="title"><span>',
   'after_title' => '</span></h3>',
));


register_sidebar(array('name'=>'Homepage (Featured Categories)',
    'id' => 'homepage',
    'description' => 'Widget area for: "WPZOOM: Featured Category" widget. Recommended number of widgets: 2-4',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget' => '<div class="clear"></div></div>',
    'before_title' => '<h3 class="title"><span>',
    'after_title' => '</span></h3>',
));


register_sidebar(array('name'=>'Homepage (Footer Featured Categories)',
    'description' => 'Place here multiple "WPZOOM: Recent Posts" widgets.',
    'id' => 'widgetized_section',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget' => '<div class="clear"></div></div>',
    'before_title' => '<h3 class="title"><span>',
    'after_title' => '</span></h3>',
));

/*----------------------------------*/
/* Footer widgetized areas		    */
/*----------------------------------*/

register_sidebar( array(
    'name'          => 'Footer: Column 1',
    'id'            => 'footer_1',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget'  => '<div class="clear"></div></div>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>',
) );

register_sidebar( array(
    'name'          => 'Footer: Column 2',
    'id'            => 'footer_2',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget'  => '<div class="clear"></div></div>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>',
) );

register_sidebar( array(
    'name'          => 'Footer: Column 3',
    'id'            => 'footer_3',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget'  => '<div class="clear"></div></div>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>',
) );

register_sidebar( array(
    'name'          => 'Footer: Column 4',
    'id'            => 'footer_4',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget'  => '<div class="clear"></div></div>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>',
) );
