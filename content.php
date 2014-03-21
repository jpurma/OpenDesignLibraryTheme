<?php
/**
 * Modified template for displaying content as a block in front page or as a single post
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage OpenDesignLibraryTheme
 */
?>
	<?php if ( is_single() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<!-- single page, full post -->
		<header class="entry-header">
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->


		<footer class="entry-meta">
			<?php twentytwelve_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
			<?php if ( get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php
						/** This filter is documented in author.php */
						$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
						echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div><!-- .author-avatar -->
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
			<?php if ( comments_open() ) : ?>
				<div class="comments-link">
					<?php comments_popup_link( '', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
				</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>

		</footer><!-- .entry-meta -->
		</article>
	<?php else : ?>
		<!-- thumbnail in front page or search results -->
		<article id="post-<?php the_ID(); ?>" class="post_thumb">
			<div class="inner"></div>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('cover'); ?></a>
			<h2 class="cover-title"><span class="white">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></span>
			</h2>
			<div class="meta"><span class="white"><?php odl_thumb_meta(); ?></span></div>
			<?php comments_popup_link( '', '<div class="comments-link">1</div>', '<div class="comments-link">%</div>'); ?>			
		</article><!-- #post -->
<?php endif; ?>

