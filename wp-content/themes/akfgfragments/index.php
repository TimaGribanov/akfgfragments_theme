<?php get_header(); ?>
<main role="main">
    <div class="container-lg">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="row main-post border border-light border-2 rounded-2 d-none d-lg-block d-xl-block d-xxl-block">
                        <a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
                        <h6><?php the_time('j F Y, G:i') ?></h6>
                        <?php
                            $post_tags = get_the_tags();
                            if (!empty($post_tags)) {
                                echo '<ul class="main-post-taglist">';
                                foreach($post_tags as $post_tag) {
                                    echo '<li><a href="' . get_tag_link($post_tag) . '">' . $post_tag->name . '</a></li>';
                                }
                                echo '</ul>';
                            }   
                        ?>
                        <p><?php _e("Written by ") . the_author(); ?></p>
                        <?php
                        if ( has_post_thumbnail() ) {
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                            echo '<div class="post-image"><a href="';
                            the_permalink();
                            echo '" class="main-thumbnail-mobile"><img title="image title" alt="thumb image" class="wp-post-image" src="' . $post_thumbnail_url . '" style="width:100%; height:auto;"></a></div>';
                        }
                        ?>
                        <p><?php the_content(__('(more...)')); ?></p>
                    </div>

                    <div class="row main-post-mobile d-block d-md-block d-lg-none">
                        <a class="main-title-mobile" href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
                        <h6>Posted on <?php the_time('j F Y') ?> by <?php the_author(); ?></h6>
                        <?php
                            $post_tags = get_the_tags();
                            if (!empty($post_tags)) {
                                echo '<ul class="main-post-taglist">';
                                foreach($post_tags as $post_tag) {
                                    echo '<li><a href="' . get_tag_link($post_tag) . '" class="main-tag-mobile">' . $post_tag->name . '</a></li>';
                                }
                                echo '</ul>';
                            }   
                        ?>
                        <?php
                        if ( has_post_thumbnail() ) {
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                            echo '<div class="post-image"><a href="';
                            the_permalink();
                            echo '" class="main-thumbnail-mobile"><img title="image title" alt="thumb image" class="wp-post-image" src="' . $post_thumbnail_url . '" style="width:100%; height:auto;"></a></div>';
                        }
                        ?>
                        
                        <!--div class="main-post-excerpt-mobile">
                            <a href="<?php #the_permalink(); ?>"-->
                                <p><?php the_content(__('(more...)')); ?></p>
                            <!--/a>
                        </div-->
                    </div>

                    <?php endwhile; else: ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php endif; ?>
                    <?php
                        $args = array(
                            'show_all'     => false,
                            'end_size'     => 1,
                            'mid_size'     => 1,
                            'prev_next'    => true,
                            'prev_text'    => __('«'),
                            'next_text'    => __('»'),
                            'add_args'     => false,
                            'add_fragment' => '',
                            'screen_reader_text' => __( 'Pagination' ),
                            'class'        => 'pagination'
                        );

                        the_posts_pagination($args);
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
