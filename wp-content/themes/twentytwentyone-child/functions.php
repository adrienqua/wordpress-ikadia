<?php
//ADD styles and scripts
function my_theme_enqueue_styles() {
    if (is_front_page()){
        $parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
        $theme = wp_get_theme();
        wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
            array(),  // if the parent theme code has a dependency, copy it to here
            $theme->parent()->get('Version')
        );
        wp_enqueue_style( 'child-style', get_stylesheet_uri(),
            array( $parenthandle ),
            $theme->get('Version') // this only works if you have Version in the style header
        );

        wp_enqueue_style('AOS_animate', get_stylesheet_directory_uri() . '/css/aos.css', false, null);
        wp_enqueue_script('AOS', get_stylesheet_directory_uri() . '/js/aos.js', false, null, true);

        wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/parallax.js', array ( 'jquery' ), 5.8, true);
        wp_enqueue_script( 'script2', get_stylesheet_directory_uri() . '/js/script.js', array ( 'jquery' ), 5.8, true);

    }
}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


//SHORTCODE to show recent posts
function recent_posts_shortcode($atts, $content = null) {
	
	global $post;
	
	extract(shortcode_atts(array(
		'cat'     => '',
		'num'     => '2',
		'order'   => 'DESC',
		'orderby' => 'post_date',
	), $atts));
	
	$args = array(
		'cat'            => $cat,
		'posts_per_page' => $num,
		'order'          => $order,
		'orderby'        => $orderby,
	);
	
	$output = '';
	
	$posts = get_posts($args);
	
	foreach($posts as $post) {
		
		setup_postdata($post);
		
		$output .= 
        '<div class="recent-post recent-post-'.get_the_id().'">
            <div class="recent-post-content">
                <p class="recent-post-date">'.get_the_date().' | Dans </p>
                <p class="recent-post-category">'.get_the_category_list().'</p>
                <h2><a class="recent-post-title" href="'. get_the_permalink() .'">'. get_the_title()  .'</a></h2>
                <p class="recent-post-excerpt">'.get_the_excerpt().'</p>

            </div>
            <div class="recent-post-thumbnail">
            <a href="'.get_the_permalink().'">'.get_the_post_thumbnail().'</a>
            </div>
        </div>';
		
	}
	
	wp_reset_postdata();
	
	return '<div class="recent-posts">'. $output .'</div>';
	
}
add_shortcode('recent_posts', 'recent_posts_shortcode');