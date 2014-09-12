<?php
/*
Template Name: After Login Inner Pages
*/

get_header('inner'); ?>

	<div id="primary" class="mainBdy row content-area">

		<div id="content" class="site-content" role="main">



			<?php /* The loop */ ?>

			<?php while ( have_posts() ) : the_post(); ?>



				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">

						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>

						<div class="entry-thumbnail">

							<?php the_post_thumbnail(); ?>

						</div>

						<?php endif; ?>



						<h1 class="entry-title"><?php the_title(); ?></h1>

					</header><!-- .entry-header -->



					<div class="entry-content">
					<?php if ( is_user_logged_in() ) {?>
					<div class="headfv"><h2 class="acfttilr">My Dashboard</h2><div class="lancfbu grnLnk"><a href="<?php echo bloginfo ('url');?>/design/">Launch a campaign</a></div><div class="clearFix"></div></div>
					 <div class="abtLftaflog">
						<?php get_sidebar('afterlogin'); ?>
					</div><?php }?>
					 <div <?php if ( is_user_logged_in() ) {?>class="afterlogcont"<?php }?>>
						<?php the_content(); ?>
						</div>
<div class="clearFix"></div>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

					</div><!-- .entry-content -->



					<footer class="entry-meta">

						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>

					</footer><!-- .entry-meta -->

				</article><!-- #post -->



				<?php comments_template(); ?>

			<?php endwhile; ?>



		</div><!-- #content -->

	</div><!-- #primary -->

<?php get_footer('inner'); ?>