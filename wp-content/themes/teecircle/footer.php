			</div><!-- #main -->
			<footer id="colophon" class="site-footer wholefooter" role="contentinfo">				<div class="wholefooter1">
					<?php 					if ( is_active_sidebar( 'tc-footer-widget-area1' ) ){						dynamic_sidebar( 'tc-footer-widget-area1' );					}					if ( is_active_sidebar( 'tc-footer-widget-area2' ) ){						dynamic_sidebar( 'tc-footer-widget-area2' );					}					if ( is_active_sidebar( 'tc-footer-widget-area3' ) ){						dynamic_sidebar( 'tc-footer-widget-area3' );					}					if ( is_active_sidebar( 'tc-footer-widget-area4' ) ){						dynamic_sidebar( 'tc-footer-widget-area4' );					}					?>				</div>				
				<div class="site-info">
					<?php do_action( 'twentythirteen_credits' ); ?>
					<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentythirteen' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentythirteen' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentythirteen' ), 'WordPress' ); ?></a>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
		</div><!-- #page -->
	</body>
</html>