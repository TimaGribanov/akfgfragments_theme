<?php /* Template Name: Akfgfragments Interview Page */ ?>

<?php get_header(); ?>

<main role="main">
    <div class="container-lg">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'category_name' => 'interview',
                    'posts_per_page' => 10,
                );
                    
                $arr_posts = new WP_Query( $args );
                    
                if ( $arr_posts->have_posts() ) : while ( $arr_posts->have_posts() ) : $arr_posts->the_post();
                require( get_theme_root() . "/akfgfragments/posts.php");
                endwhile;
                endif;
                ?>                 
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

</body>
</html>