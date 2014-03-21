<?php
/**
 * The template for displaying Category pages
 *
 * I don't have time for cleanest solution, so category menu is hard-coded. At least the
 * output is clean. 
 *
 * @package WordPress
 * @subpackage OpenDesignLibraryTheme
 */

get_header(); ?>

	<section id="primary" class="site-content">


		<div id="content" role="main">
			<nav class="main-navigation" role="navigation">
			<?php $home = esc_url( home_url() ); $q = get_queried_object(); $cat = $q->name; ?>
				<ul class="static_nav">
						<?php if  ($cat == 'Ideas'): ?>
							<li class="selected_category">Ideas</li>
						<?php else: ?>
							<li class="menu-item">
								<a href="<?php echo $home; ?>/category/ideas/">Ideas</a>
							</li>
						<?php endif; ?>
						<?php if  ($cat == 'Designs'): ?>
							<li class="selected_category">Designs</li>
						<?php else: ?>
							<li class="menu-item">
								<a href="<?php echo $home; ?>/category/designs/">Designs</a>
							</li>
						<?php endif; ?>
						<?php if  ($cat == 'Courses and workshops'): ?>
							<li class="selected_category">Courses and workshops</li>
						<?php else: ?>
							<li class="menu-item">
								<a href="<?php echo $home; ?>/category/courses-and-workshops/">Courses and workshops</a>
							</li>
						<?php endif; ?>
					</li>
				</ul>
			</nav><!-- #site-navigation -->

			<header class="archive-header">
				<?php if  ($cat == 'Ideas'): ?>
					<a class="big_button" href="<?php echo $home; ?>/wp-admin/post-new.php?category=ideas"> Contribute an idea </a>
				<?php elseif  ($cat == 'Designs'): ?>
					<a class="big_button" href="<?php echo $home; ?>/wp-admin/post-new.php?category=designs"> Add a design </a>
				<?php elseif  ($cat == 'Courses and workshops'): ?>
					<a class="big_button" href="<?php echo $home; ?>/wp-admin/post-new.php?category=courses-and-workshops"> Announce a course or a workshop </a>
				<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			twentytwelve_content_nav( 'nav-below' );

			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			?>


		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>