<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage OpenDesignLibraryTheme
 */

get_header(); ?>

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

		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>