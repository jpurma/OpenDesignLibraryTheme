<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 * Add Open Developer Library and how-to-participate links.
 *
 * @package WordPress
 * @subpackage OpenDesignLibraryTheme
 */
?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<aside id="participation" class="widget widget_meta">
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>" title="What is Learning Layers Open Developer Library?" rel="about">About</a></li>
					<li><a href="<?php echo esc_url( home_url( '/participate' ) ); ?>" title="Contributing ideas for better learning" rel="participate">How to participate</a></li>
				</ul>
			</aside>
			<aside id="" class="widget">
					<a id="developers-library-link" title="Developers' support site" href="http://developer.learning-layers.eu/">Open Developer Library</a>
			</aside>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>

			<p style="text-align: center;"><a href="<?php echo esc_url( home_url( '/license' ) ); ?>" title="Licensing for content in ODL" rel="license"><img style="border-width: 0;" alt="Creative Commons License" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png"/></a></p>
		</div><!-- #secondary -->
	<?php endif; ?>