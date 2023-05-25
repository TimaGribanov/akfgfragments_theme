<?php 
    add_theme_support( 'post-thumbnails' );

    //https://www.cloudways.com/blog/gutenberg-wordpress-custom-post-type/
    function cw_post_type() {
        register_post_type('interview',
            array(
                'labels' => array(
                    'name' => __( 'Interview' ),
                    'singular_name' => __( 'Interview' )
                ),
                'has_archive' => true,
                'public' => true,
                'rewrite' => array('slug' => 'interview'),
                'show_in_rest' => true,
                'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
            )
        );
     }

     add_action( 'init', 'cw_post_type' );
?>