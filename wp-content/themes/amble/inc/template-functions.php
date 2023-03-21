<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 * @package Amble
 * @since 2.0.0
 */

/* TABLE of CONTENTS
   ==================================================== 
   BODY OPEN
   BODY CLASSES
   SITE LOGO & TITLE
   SITE TAGLINE
   HEADER BRANDING
   MAIN NAVIGATION
   MODIFY SEARCH FORM
   ARCHIVE TITLE PREFIX
   ARCHIVE TITLES
   PAGE HEADERS
   DISPLAY A SINGLE POST CATEGORY
   DISPLAY FEATURED or CATEGORY LABEL
   META DATE
   UPDATED POST DATE
   META AUTHOR
   ENTRY FOOTER
   POST THUMBNAILS
   AUTHOR BIO
   CHECK IF POST AUTHOR HAS COMMENT
   MODIFY the COMMENT FORM
   ADD A TITLE TO POSTS MISSING TITLES
   FILTER THE EXCERPT LENGTH
   FILTER THE EXCERPT SUFFIX
   CREATE A CONTINUE READING LINK FOR EXCERPTS
   MOVE READ MORE LINK OUTSIDE OF PARAGRAPHS
   DISPLAY SVG ICONS IN MENU
   CONVERT HEX to RGBA
   INLINE COLOUR PRESETS
   BLOG  NAVIGATION
   POST NAVIGATION
   MULTIPAGE NAVIGATION
   ====================================================*/


/* BODY OPEN
 @since 2.0.0
   ==================================================== */
if (!function_exists('wp_body_open')) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
endif;


/* BODY CLASSES
@since 2.0.0
   ==================================================== */
function amble_body_classes($classes)
{

	$amble_blog_style = apply_filters('amble_blog_layout', esc_attr(get_theme_mod('amble_blog_style', 'center')));
	$amble_post_style = apply_filters('amble_post_layout', esc_attr(get_theme_mod('amble_post_style', 'classic-right')));
	$amble_footer_style = apply_filters('amble_footer_layout', esc_attr(get_theme_mod('amble_footer_style', 'footer1')));

	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Blog style classes
	if ($amble_blog_style && is_home() || is_archive()) {
		$classes[] = 'blog-' . esc_attr($amble_blog_style);
	}

	// Post style classes
	if ($amble_post_style && is_single()) {
		$classes[] = 'single-' . esc_attr($amble_post_style);
	}

	// Page excerpt class
	if (is_page() && has_excerpt()) {
		$classes[] = 'has-excerpt';
	}

	// Check whether the current page is the default page template
	if (basename(get_page_template()) === 'page.php' && is_page()) {
		$classes[] = 'template-right';
	}

	// Check whether the current page is the left column template
	if (is_page_template(array('templates/template-left.php'))) {
		$classes[] = 'template-left';
	}

	// Check whether the current page is the full width template
	if (is_page_template(array('templates/template-full-width.php'))) {
		$classes[] = 'template-full';
	}

	// Check whether the current page is the full width template
	if (is_page_template(array('templates/template-wide.php'))) {
		$classes[] = 'template-wide';
	}

	// Check whether the current page is the short width template
	if (is_page_template(array('templates/template-short-width.php'))) {
		$classes[] = 'template-short';
	}

	// Check whether the current page is the left column template
	if (is_page_template(array('templates/template-blank.php'))) {
		$classes[] = 'template-blank';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('blog-sidebar') ||  !is_active_sidebar('left-sidebar') || !is_active_sidebar('right-sidebar')) {
		$classes[] = 'no-sidebar';
	}

	// Check for post thumbnail
	if (
		is_single() && has_post_thumbnail()
		|| is_page() && has_post_thumbnail()
	) {
		$classes[] = 'has-post-thumbnail';
	} else {
		$classes[] = 'no-post-thumbnail';
	}

	// Footer style
	if ($amble_footer_style !== 'footer1') {
		$classes[] = esc_attr($amble_footer_style);
	}

	// Check whether we're in the customizer preview
	if (is_customize_preview()) {
		$classes[] = 'customizer-preview';
	}

	return $classes;
}
add_filter('body_class', 'amble_body_classes');



/* SITE LOGO & TITLE
@since 2.0.0
   ==================================================== */
if (!function_exists('amble_site_identity')) :
	function amble_site_identity()
	{

		if (has_custom_logo()) {
			the_custom_logo();
		}

		// Check whether the site title is activated in the customizer.
		$amble_hide_site_title = get_theme_mod('amble_hide_site_title', false);
		if (false === $amble_hide_site_title) {

			printf(
				'<%1$s class="site-title"><a class="navbar-brand" href="%2$s" rel="home">%3$s</a></%1$s>',
				is_front_page() && is_home() ? 'h1' : 'p',
				esc_url(home_url('/')),
				esc_html(get_bloginfo('name'))
			);
		}
	}
endif;


/* SITE TAGLINE
@since 2.0.0
==================================================== */
if (!function_exists('amble_site_tagline')) :
	function amble_site_tagline()
	{

		$description  = get_bloginfo('description', 'display');
		// Check whether the site title is activated in the customizer.
		$amble_hide_tagline = get_theme_mod('amble_hide_tagline', false);


		if ($description) {
			if (false === $amble_hide_tagline) {
				echo '<p class="site-description">' . esc_html($description) . '</p>';
			}
		}
	}
endif;


/* HEADER BRANDING
@since 2.0.0
==================================================== */
if (!function_exists('amble_header_branding')) :
	function amble_header_branding()
	{

		$description  = get_bloginfo('description', 'display');
		echo '<div class="site-branding">';

		amble_site_identity();
		amble_site_tagline();
	}
endif;


/* MAIN NAVIGATION
   ====================================================*/
if (!function_exists('amble_mainnav')) :
	function amble_mainnav()
	{

		$amble_header_layout = apply_filters('amble_header_layout', get_theme_mod('amble_header_layout', 'header1'));
?>

		<nav class="<?php echo esc_attr($amble_header_layout); ?> navbar" aria-label="navbar">
			<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#headernav" aria-controls="headernav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"><?php amble_theme_svg('nav'); ?></span>
			</button>

			<div class="navbar-collapse collapse" id="headernav">
				<?php
				if (has_nav_menu('primary')) {
					wp_nav_menu(array(
						'menu_id'              => 'mainmenu',
						'theme_location' => 'primary',
						'container'         => 'ul',
						'menu_class'     => 'navbar-nav',
						'link_before'  => '<span>',
						'link_after'   => '</span>',
					));
				} else {
					echo '<ul class="navbar-nav">';
					wp_list_pages(array(
						'match_menu_classes' 	=> true,
						'title_li' 				=> false,
						'link_before'  => '<span>',
						'link_after'   => '</span>',
					));
					echo '</ul>';
				}
				?>

			</div>
		</nav>
	<?php
	}
endif;

/* MODIFY SEARCH FORM
 @since 2.0.0
   ==================================================== */
if (!function_exists('amble_search_form')) :
	function amble_search_form($form)
	{
		$form = '
      <form  method="get" class="search-form" action="' . esc_url(home_url('/')) . '">
        <div class="search-wrap input-group">
            <input type="search" class="search-field" placeholder="' . esc_attr_x('Type keywords...', 'placeholder', 'amble') . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x('Search for:', '', 'amble') . '" />
          <button type="submit" class="button">' . esc_html('Search', 'amble') . '</button>
        </div>
			</form>';
		return $form;
	}
endif;
add_filter('get_search_form', 'amble_search_form');


/* ARCHIVE TITLE PREFIX
	Styles the archive title prefix with a span
	@since 2.0.0
   ==================================================== */
function amble_prefix_archive_title($title)
{

	$regex = apply_filters(
		'amble_prefix_the_archive_title_regex',
		array(
			'pattern'     => '/(\A[^\:]+\:)/',
			'replacement' => '<span class="archive-prefix colour">$1</span>',
		)
	);

	if (empty($regex)) {
		return $title;
	}
	return preg_replace($regex['pattern'], $regex['replacement'], $title);
}

add_filter('get_the_archive_title', 'amble_prefix_archive_title');

/* ARCHIVE TITLES
	Change how archive titles are displayed
	@since 2.0.0
   ==================================================== */
if (!function_exists('amble_archive_title')) :
	function amble_archive_title($title)
	{

		// Check if this is set to show or hide the archive prefix
		$amble_hide_prefix_archive = get_theme_mod('amble_hide_prefix_archive', false);

		// If enabled - the prefix archive label is hidden
		if (true === $amble_hide_prefix_archive) {
			if (is_category()) {
				return single_cat_title('', false);
			} elseif (is_author()) {
				return get_the_author();
			}
		}
		return $title;
	}
endif;
add_filter('get_the_archive_title', 'amble_archive_title', 10, 1);


/* PAGE HEADERS
	Load the appropriate page headers
	@since 2.0.0
   ==================================================== */
if (!function_exists('amble_page_headers')) :
	function amble_page_headers()
	{
		if (is_archive()) {
			echo '<header class="archive-header">';
			the_archive_title('<h1 class="archive-title">', '</h1>');
			the_archive_description('<div class="archive-description">', '</div>');

			// action hook for any content after the archive title and description
			if (!is_category() && !is_author()) {
				do_action('amble_after_archive_description');
			}
			echo '</header>';
		} elseif (is_page() && has_post_thumbnail()) {

			echo '<header class="page-header">';
			amble_post_thumbnail();
			echo '</header>';
		}
	}
endif;
add_action('amble_page_header', 'amble_page_headers');



/* DISPLAY A SINGLE POST CATEGORY
@since 2.0.0
==================================================== */
if (!function_exists('amble_first_category')) :
	function amble_first_category()
	{
		$category = get_the_category();
		$first_category = $category[0];
		echo sprintf(
			'<span class="single-category post-meta"><a href="%s">%s</a></span>',
			get_category_link($first_category),
			$first_category->name
		); // phpcs:ignore WordPress.Security.EscapeOutput
	}
endif;


/* DISPLAY FEATURED or CATEGORY LABEL
@since 2.0.0
==================================================== */
if (!function_exists('amble_featured_category_badge')) :
	function amble_featured_category_badge()
	{
		$amble_featured_label_text = get_theme_mod('amble_featured_label_text', esc_html__('Featured', 'amble'));

		if (is_sticky() && is_home() && !is_paged()) {
			echo '<span class="featured-badge">', wp_kses_post($amble_featured_label_text), '</span>';
		} else {
			echo '<span class="category-badge">', esc_html(amble_first_category()), '</span>';
		}
	}
endif;


/* META DATE
@since 2.0.0
==================================================== */
if (!function_exists('amble_posted_on')) :
	function amble_posted_on()
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x('%s', 'Short post date', 'amble'),
			'<span class="timestamp">' . $time_string . '</span>'
		);

		echo '<span class="posted-on post-meta">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput

	}
endif;

/* UPDATED POST DATE
@since 2.0.0
==================================================== */
if (!function_exists('amble_updated')) :
	function amble_updated()
	{
		printf(
			/* translators: %s: For the updated date. */
			'<span class="posted-update post-meta">' .	esc_html__('Updated on %s', 'amble') . '</span>',
			get_the_modified_date()
		);
	}
endif;

/* META AUTHOR
@since 2.0.0
==================================================== */
if (!function_exists('amble_posted_by')) :
	function amble_posted_by()
	{
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('by %s', 'post author', 'amble'),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="byline post-meta"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput

	}
endif;

/* META COMMENT COUNT & LINK
@since 2.0.0
==================================================== */
if (!function_exists('amble_comment_link')) :
	function amble_comment_link()
	{
		if (!post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link post-meta">';
			/* translators: %s: Name of current post. Only visible to screen readers. */
			comments_popup_link(sprintf(__('Make a comment <span class="screen-reader-text">on %s</span>', 'amble'), get_the_title()));

			echo '</span>';
		}
	}
endif;


/* ENTRY FOOTER
@since 2.0.0
==================================================== */
if (!function_exists('amble_entry_footer')) :

	// Prints HTML with meta information for the categories, tags and comments.
	function amble_entry_footer()
	{

		// Is the option to hide the edit link activated in the customizer.
		$amble_hide_edit = get_theme_mod('amble_hide_edit', false);
		$amble_hide_post_footer = get_theme_mod('amble_hide_post_footer', false);
		$amble_hide_post_categories = get_theme_mod('amble_hide_post_categories', false);
		$amble_hide_post_tags = get_theme_mod('amble_hide_post_tags', false);

		if (false === $amble_hide_post_footer) {
			echo '<footer class="entry-footer">';

			// Hide category and tag text for pages.
			if ('post' === get_post_type()) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list(esc_html__(', ', 'amble'));
				if ($categories_list && false === $amble_hide_post_categories) {
					/* translators: 1: list of categories. */
					printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'amble') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput
				}

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'amble'));
				if ($tags_list && false === $amble_hide_post_tags) {
					/* translators: 1: list of tags. */
					printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'amble') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput
				}
			}

			if (false === $amble_hide_edit) {
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__('Open <span class="screen-reader-text">%s</span>', 'amble'),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post(get_the_title())
					),
					'<span class="edit-link">' . esc_html__('Edit Post: ', 'amble'),
					'</span>'
				);
			}

			echo '</footer>';
		}
	}
endif;

add_action('amble_after_post_entry_content', 'amble_entry_footer');

/* POST THUMBNAILS
@since 2.0.0
==================================================== */
if (!function_exists('amble_post_thumbnail')) :
	function amble_post_thumbnail()
	{
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}

		$caption = get_the_post_thumbnail_caption();
	?>

		<figure class="featured-media">

			<?php if (is_singular()) : ?>

				<div class="post-thumbnail">
					<?php the_post_thumbnail(
						'post-thumbnail',
						array('class' => 'featured-thumbnail', 'alt' => get_the_title())
					);
					?>
				</div><!-- .post-thumbnail -->

			<?php else : ?>

				<a class="post-thumbnail-link" href="<?php esc_url(the_permalink()); ?>" aria-hidden="true">
					<?php the_post_thumbnail('post-thumbnail', array('alt' => get_the_title())); ?>
				</a>

			<?php endif; // End is_singular() 

			if ($caption) {
			?>

				<figcaption class="wp-caption-text"><?php echo wp_kses_post($caption); ?></figcaption>

			<?php
			}
			?>

		</figure>

<?php
	}
endif;


/* POST AUTHOR BIO
@since 2.0.0
==================================================== */
if (!function_exists('amble_author_post_bio_info')) :
	function amble_author_post_bio_info()
	{

		echo '<div class="post-author-info">';
		printf(
			'<div class="post-author-avatar">%s</div>',
			get_avatar(get_the_author_meta('user_email'), 100)
		);
		echo '<div class="post-author-description"><div class="author-bio">';
		printf(
			'<h3 class="post-author-heading">%s</h3>',
			get_the_author()
		);
		the_author_meta('description');
		echo '</div><a class="post-author-link" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" rel="author">';
		printf(
			/* translators: %s: For the author name. */
			esc_html__('View all posts by %s', 'amble'),
			get_the_author()
		);
		echo '</a></div></div>';
	}
endif;


/* CHECK IF POST AUTHOR HAS COMMENT
 @since 2.0.0
   ==================================================== */
if (!function_exists('amble_is_comment_by_post_author')) :
	function amble_is_comment_by_post_author($comment = null)
	{

		if (is_object($comment) && $comment->user_id > 0) {

			$user = get_userdata($comment->user_id);
			$post = get_post($comment->comment_post_ID);

			if (!empty($user) && !empty($post)) {

				return $comment->user_id === $post->post_author;
			}
		}
		return false;
	}
endif;


/* MODIFY the COMMENT FORM
 @since 2.0.0
   ==================================================== */
if (!function_exists('amble_comment_form_default_fields')) :
	function amble_comment_form_default_fields($fields)
	{
		$commenter = wp_get_current_commenter();

		$req      = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		$html_req = ($req ? " required='required'" : '');
		$html5    = 'html5';

		$fields['author'] = '
      <div class="row"><div class="col-md-4"><p class="comment-form-author">
        <input id="author" name="author" type="text" placeholder="' . esc_attr__('Name', 'amble') . (esc_attr($req) ? ' *' : '') . '" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . esc_attr($aria_req) . esc_attr($html_req) . ' />
      </p></div>';

		$fields['email'] = '
      <div class="col-md-4"><p class="comment-form-email">
        <input id="email" name="email" ' . (esc_attr($html5) ? 'type="email"' : 'type="text"') . ' placeholder="' . esc_attr__('Email', 'amble') . (esc_attr($req) ? ' *' : '') . '" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" aria-describedby="email-notes"' . esc_attr($aria_req) . esc_attr($html_req)  . ' />
      </p></div>';

		$fields['url'] = '
      <div class="col-md-4"><p class="comment-form-url">
        <input id="url" name="url" ' . (esc_attr($html5) ? 'type="url"' : 'type="text"') . ' placeholder="' . esc_attr__('Website', 'amble') . '" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" />
      </p></div></div>';

		return $fields;
	}
endif;
add_filter('comment_form_default_fields', 'amble_comment_form_default_fields', 10, 1);


/* ADD A TITLE TO POSTS MISSING TITLES
	When a post is missing a title, a default title will be used.
	@since 2.0.0
   ==================================================== */
if (!function_exists('amble_post_title')) {
	function amble_post_title($title)
	{
		return '' === $title ? esc_html_x('Untitled', 'Added to posts and pages that are missing titles', 'amble') : $title;
	}
}

add_filter('the_title', 'amble_post_title');


/* FILTER THE EXCERPT LENGTH
	Customizable excerpt length
	@since 2.0.0
   ==================================================== */
if (!function_exists('amble_excerpt_length')) {
	function amble_excerpt_length($length)
	{

		if (is_admin()) {
			return $length;
		}

		$excerpt_length = esc_attr(get_theme_mod('amble_excerpt_length', '25'));
		return $excerpt_length; // phpcs:ignore WordPress.Security.EscapeOutput
	}
}
add_filter('excerpt_length', 'amble_excerpt_length', 99);



/* FILTER THE EXCERPT SUFFIX
	Replaces the default [...] with a &hellip; (three dots)
	@since 2.0.0
   ==================================================== */
if (!function_exists('amble_excerpt_more')) :
	function amble_excerpt_more()
	{
		return '&hellip;';
	}
	add_filter('excerpt_more', 'amble_excerpt_more');
endif;


/* CREATE A CONTINUE READING LINK FOR EXCERPTS
@since 2.0.0
   ==================================================== */
if (!function_exists('amble_read_more_link')) :
	function amble_read_more_link()
	{
		$amble_readmore_text = esc_html(get_theme_mod('amble_readmore_text', esc_html__('Continue Reading...', 'amble')));
		echo '<p class="more-link-wrapper"><a class="more-link" href="' . esc_url(get_permalink()) . '">' . wp_kses_post($amble_readmore_text) . '</a></p>';
	}
endif;


/* MOVE READ MORE LINK OUTSIDE OF PARAGRAPHS
	Move the 'continue reading' link outside of paragraph.
	@since 2.0.0
   ==================================================== */
if (!function_exists('amble_move_more_link')) :
	function amble_move_more_link()
	{
		$amble_readmore_text = esc_html(get_theme_mod('amble_readmore_text', esc_html__('Continue Reading...', 'amble')));
		return '<p><a class="more-link" href="' . esc_url(get_permalink()) . '">' . wp_kses_post($amble_readmore_text) . '</a></p>';
	}
	add_filter('the_content_more_link', 'amble_move_more_link');
endif;


/* INSERT FORMATS TO DROP DOWN - CLASSIC EDITOR
 @since 2.0.0
   ==================================================== */
if (!function_exists('insert_formats_to_editor')) :
	function insert_formats_to_editor($init_array)
	{
		// Define the style_formats array
		$style_formats = array(
			// Each array child is a format with it's own settings

			array(
				'title' => esc_html__('Extra Small', 'amble'),
				'inline' => 'span',
				'classes' => 'has-extra-small-font-size',
				'wrapper' => true
			),

			array(
				'title' => esc_html__('Small', 'amble'),
				'inline' => 'span',
				'classes' => 'has-small-font-size',
				'wrapper' => true
			),
			array(
				'title' => esc_html__('Medium', 'amble'),
				'inline' => 'span',
				'classes' => 'has-medium-font-size',
				'wrapper' => true
			),

			array(
				'title' => esc_html__('Large', 'amble'),
				'inline' => 'span',
				'classes' => 'has-large-font-size',
				'wrapper' => true
			),
			array(
				'title' => esc_html__('Extra Large', 'amble'),
				'inline' => 'span',
				'classes' => 'has-extra-large-font-size',
				'wrapper' => true
			),
			array(
				'title' => esc_html__('Huge', 'amble'),
				'inline' => 'span',
				'classes' => 'has-huge-font-size',
				'wrapper' => true
			),
			array(
				'title' => esc_html__('Gigantic', 'amble'),
				'block' => 'span',
				'classes' => 'has-gigantic-font-size',
				'wrapper' => true
			)
		);
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode($style_formats);

		return $init_array;
	}
endif;
add_filter('tiny_mce_before_init', 'insert_formats_to_editor');


/* ADD STYLE DROP DOWN TO CLASSIC EDITOR
 @since 2.0.0
   ==================================================== */
if (!function_exists('amble_mce_buttons_2')) :
	function amble_mce_buttons_2($buttons)
	{
		array_unshift($buttons, 'styleselect');
		return $buttons; // phpcs:ignore WordPress.Security.EscapeOutput
	}
endif;
add_filter('mce_buttons_2', 'amble_mce_buttons_2');


/* DISPLAY SVG ICONS IN MENU
@since 2.0.0
   ==================================================== */
function amble_nav_menu_social_icons($item_output, $item, $depth, $args)
{
	// Change SVG icon inside social links menu if there is supported URL.
	if ('social' === $args->theme_location) {
		$svg = Amble_SVG_Icons::get_social_link_svg($item->url);
		if (empty($svg)) {
			$svg = amble_get_theme_svg('link');
		}
		$item_output = str_replace($args->link_after, '</span>' . $svg, $item_output);
	}

	return $item_output; // phpcs:ignore WordPress.Security.EscapeOutput
}

add_filter('walker_nav_menu_start_el', 'amble_nav_menu_social_icons', 10, 4);



/* CONVERT HEX to RGBA
@since 2.0.0
   ==================================================== */
if (!function_exists('hex2rgba')) :
	function hex2rgba($color, $opacity = 1, $css = false)
	{
		if (empty($color))
			return;

		$color = str_replace('#', '', $color);

		if (strlen($color) == 6) {
			$r = hexdec($color[0] . $color[1]);
			$g = hexdec($color[2] . $color[3]);
			$b = hexdec($color[4] . $color[5]);
		} elseif (strlen($color) == 3) {
			$r = hexdec($color[0] . $color[0]);
			$g = hexdec($color[1] . $color[1]);
			$b = hexdec($color[2] . $color[2]);
		} else {
			return false;
		}

		$opacity = floatval($opacity);

		if ($css)
			return 'rgba( ' . esc_attr($r) . ', ' . esc_attr($g) . ', ' . esc_attr($b) . ', ' . esc_attr($opacity) . ' )';
		else
			return compact(esc_attr($r), esc_attr($g), esc_attr($b), esc_attr($opacity));
	}
endif;


/* INLINE COLOUR PRESETS
   ====================================================*/
if (!function_exists('amble_colour_presets')) :
	function amble_colour_presets()
	{

		$amble_presets = get_theme_mod('amble_presets', 'preset1');
		switch (esc_attr($amble_presets)) {

			case "preset12":
				echo '--amble-primary: #b16060;
					--amble-secondary: #854c4c;
					--amble-tertiary: #c35249;
					--amble-body: #445062;';
				break;

			case "preset11":
				echo '--amble-primary: #9ea7af;
					--amble-secondary: #87939f;
					--amble-tertiary: #d56a62;
					--amble-body: #e4e5e7;';
				break;

			case "preset10":
				echo '--amble-primary: #ba8300;
					--amble-secondary: #ffba19;
					--amble-tertiary: #2c66e5;
					--amble-body: #dbd6d0;';
				break;

			case "preset9":
				echo '--amble-primary: #b19d8d;
					--amble-secondary: #9d8775;
					--amble-tertiary: #53a0ad;
					--amble-body: #6f8387;';
				break;

			case "preset8":
				echo '--amble-primary: #75a558;
					--amble-secondary: #abdf8b;
					--amble-tertiary: #c5613b;
					--amble-body: #97a390;';
				break;

			case "preset7":
				echo '--amble-primary: #bd4b6e;
					--amble-secondary: #e57597;
					--amble-tertiary: #ab3169;
					--amble-body: #bfb8ba;';
				break;

			case "preset6":
				echo '--amble-primary: #bda74b;
					--amble-secondary: #ffe680;
					--amble-tertiary: #6e80d7;
					--amble-body: #d7d5cf;';
				break;

			case "preset5":
				echo '--amble-primary: #3f83bd;
					--amble-secondary: #6ebbff;
					--amble-tertiary: #bd8c3e;
					--amble-body: #3e5466;';
				break;

			case "preset4":
				echo '--amble-primary: #bd561e;
					--amble-secondary: #ff8442;
					--amble-tertiary: #1ebdb7;
					--amble-body: #c9d3d2;';
				break;

			case "preset3":
				echo '--amble-primary: #758870;
					--amble-secondary: #6b7c8b;
					--amble-tertiary: #365647;
					--amble-body: #c0c9c4;';
				break;

			case "preset2":
				echo '--amble-primary: #58bdad;
					--amble-secondary: #bd7559;
					--amble-tertiary: #2a7064;
					--amble-body: #e1e6e7;';
				break;

			default:
				echo '--amble-primary: #bba579;
					--amble-secondary: #c6975e;
					--amble-tertiary: #2b789b;
					--amble-body: #465156;';
		}
	}
endif;


/* BLOG  NAVIGATION
Navigation for the blog
@since 2.0.0
==================================================== */
if (!function_exists('amble_blog_nav')) :
	function amble_blog_nav()
	{
		the_posts_pagination(array(
			'prev_text'          => is_rtl() ? amble_get_theme_svg('caret-right') : amble_get_theme_svg('caret-left'),
			'next_text'          =>  is_rtl() ? amble_get_theme_svg('caret-left') :  amble_get_theme_svg('caret-right'),
			'before_page_number' => ''
		));
	}
endif;


/* POST NAVIGATION
Navigation for full posts.
@since 2.0.0
==================================================== */
if (!function_exists('amble_post_pagination')) :
	function amble_post_pagination()
	{

		the_post_navigation(array(
			'next_text' => '<span class="nav-meta">' . (is_singular('post') ? esc_html__('Next post', 'amble') : esc_html__('Next', 'amble')) . '</span> <span class="post-title">%title</span>',
			'prev_text' => '<span class="nav-meta">' . (is_singular('post') ? esc_html__('Previous post', 'amble') : esc_html__('Previous', 'amble')) . '</span> <span class="post-title">%title</span>',
		));
	}
endif;

/* MULTIPAGE NAVIGATION
Navigation for splitting posts or pages into more than one page.
@since 2.0.0
==================================================== */
if (!function_exists('amble_multipage_pagination')) :
	function amble_multipage_pagination()
	{

		wp_link_pages(array(
			'before'      => '<div class="multi-page-links"><span class="multi-page-links-title">' . esc_html__('Pages:', 'amble') . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '%',
			'separator'   => false,
		));
	}
endif;
