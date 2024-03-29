<?php
/**
 * The main template file
 *
 * Modified from TwentyTwelve/index.php
 * 
 * Move navigation bar inside the main page area instead of header. 
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage OpenDesignLibraryTheme
 */

get_header(); ?>
	<div class="clear"></div>

	<div id="primary" class="site-content">
		<nav class="main-navigation" role="navigation">
		<?php $home = esc_url( home_url() ); ?>
		<ul class="static_nav">
			<li class="menu-item">
				<a href="<?php echo $home; ?>/category/ideas/">Ideas</a>
			</li>
			<li class="menu-item">
				<a href="<?php echo $home; ?>/category/designs/">Designs</a>
			</li>
			<li class="menu-item">
				<a href="<?php echo $home; ?>/category/courses-and-workshops">Courses and workshops</a>
			</li>
		</ul>
		</nav><!-- #site-navigation -->
		<?php twentytwelve_content_nav( 'nav-below' ); ?>

		<div id="content" role="main">
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>


		<?php else : ?>

			<article id="post-0" class="post no-results not-found">

			<?php if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'No posts to display', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwelve' ), admin_url( 'post-new.php' ) ); ?></p>
				</div><!-- .entry-content -->

			<?php else :
				// Show the default message to everyone else.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			<?php endif; // end current_user_can() check ?>

			</article><!-- #post-0 -->

		<?php endif; // end have_posts() check ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>