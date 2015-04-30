<?php
/**
 * The template for displaying the footer
 *
 */

$widgets_areas = (int) get_theme_mod( 'footer-widget-areas', compass_get_default( 'footer-widget-areas' ) );

$has_active_sidebar = false;
if ( $widgets_areas > 0 ) {
    $i = 1;

    while ( $i <= $widgets_areas ) {
        if ( is_active_sidebar( 'footer_' . $i ) ) {
            $has_active_sidebar = true;
            break;
        }

        $i++;
    }
}

?>

    <footer id="colophon" class="site-footer" role="contentinfo">


        <?php if ( $has_active_sidebar ) : ?>
            <div class="footer-widgets widgets widget-columns-<?php echo esc_attr( $widgets_areas ); ?>">


                <?php for ( $i = 1; $i <= $widgets_areas; $i ++ ) : ?>

                    <div class="column">
                        <?php dynamic_sidebar( 'footer_' . $i ); ?>
                    </div><!-- .column -->

                <?php endfor; ?>

                  <div class="clear"></div>
            </div><!-- .footer-widgets -->

            <hr class="site-footer-separator">

        <?php endif; ?>


        <div class="site-info">
            <p class="copyright">
                <?php echo get_theme_mod( 'footer-text', compass_get_default( 'footer-text' ) ); ?>
            </p>
            <p class="designed-by">
                <?php compass_footer_text( ); ?>
            </p>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->

</div>
<?php wp_footer(); ?>

</body>
</html>