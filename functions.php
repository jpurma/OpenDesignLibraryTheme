<?php
	add_action( 'after_setup_theme', 'odl_setup' );

add_action( 'load-post-new.php', 'odl_new_post' );
function odl_new_post(){
    add_action( 'wp_insert_post', 'odl_set_category_from_url' );
}
function odl_set_category_from_url( $post_id ){
    //set category
    if (isset($_REQUEST['category'])) {
    	$cat = get_category_by_slug(esc_attr($_REQUEST['category']));
	    wp_set_post_categories($post_id, $cat->term_id);
	}
}

add_filter('default_content', 'odl_defaults');

function odl_defaults( $content) {
    error_log($_REQUEST['category']);
    $cat_slug = esc_attr($_REQUEST['category']);
    if ($cat_slug == 'designs') {
		$content = ' (First replace this text with an image of the design (use "Add Media"-button above the editor) 

(Then describe here what the design is about.)

(List those people who were involved in the design work.)

(Explain if you have further plans for this design.)

(If this design uses an idea or is related to idea in this site, add the idea as a tag by using the tag widget on right side.)

(If this design is related to a workshop or course, add a tag of that course with right side widget.)';

	} elseif ($cat_slug == 'ideas') {
		$content = '
(First state your idea as briefly as possible.)

(Then explain a bit of its background, either from practice or from theory)

(Create a tag for this idea, like "useshortclips" on right side widget to help connecting this idea to various designs.)

(If this idea is related to a workshop or course, add a tag of that course with right side widget.)
		';    	
	} elseif ($cat_slug == 'courses-and-workshops') {
		$content = '
(Courses and workshops can produce many ideas and designs. This should be a general description of course or workshop and various designs and ideas point to here.)

(These pages can also be used as an announcement or invitation for future events.)

(Remember to include: where the event is, when it is, who it is for, how to join it or who to contact.)

(Create a tag for this course by using the right side tag widget. All designs and ideas created in this course should also use this tag.)
		';    	
    }
	return $content;
}

function odl_setup() {
	add_theme_support( 'post-thumbnails' );
    add_image_size( 'cover', 240, 240, false );	
}

function auto_featured_image() {
    global $post;

    if ($post && !has_post_thumbnail($post->ID)) {
        $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
        
	  if ($attached_image) {
              foreach ($attached_image as $attachment_id => $attachment) {
                   set_post_thumbnail($post->ID, $attachment_id);
              }
         }
    }
}
// Use it temporary to generate all featured images
// add_action('the_post', 'auto_featured_image');
// Used for new posts
add_action('save_post', 'auto_featured_image');
add_action('draft_to_publish', 'auto_featured_image');
add_action('new_to_publish', 'auto_featured_image');
add_action('pending_to_publish', 'auto_featured_image');
add_action('future_to_publish', 'auto_featured_image');



function odl_thumb_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '<span class="tags">', ', ','</span>');

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	if ( $tag_list ) {
		printf('%1$s, %3$s, added by %4$s into %2$s', $date, $categories_list, $tag_list, $author);
	} else {
		printf('%1$s, added by %3$s into %2$s', $date, $categories_list, $author);		
	}
}

function get_the_post_thumbnail_src( $size = 'cover', $attr = '' ) {
	$post_id = get_the_ID();
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );

	if ( $post_thumbnail_id ) {
		if ( in_the_loop() )
			update_post_thumbnail_cache();
		$img = wp_get_attachment_image_src( $post_thumbnail_id, $size, false);
		return $img;
	} else {
		return null;
	}
}


function odl_register() {
	if ( ! is_user_logged_in() ) {
		if ( get_option('users_can_register') )
			$link = '<a href="' . esc_url( wp_registration_url() ) . '">' . __('Register') . '</a> or ';
		else
			$link = '';
	} else {
		$link = '';
	}
	echo $link;
}


if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
/**
 * Overrides twentytwelve navigation with simpler version
 */
function twentytwelve_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<?php $page = $wp_query->get('paged'); $page = ($page) ? $page : 1; ?> 

		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
			<div class="odl-nav previous"><?php previous_posts_link('<span class="meta-nav">&larr;</span>'); ?></div>
			<?php echo $page; ?>
			/
			<?php echo $wp_query->max_num_pages; ?>
			<div class="odl-nav next"><?php next_posts_link('<span class="meta-nav">&rarr;</span>'); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;



