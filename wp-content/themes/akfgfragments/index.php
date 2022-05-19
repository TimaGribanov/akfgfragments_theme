<?php get_header(); ?>
<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                <div class="row">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="row main-post border border-light border-2 rounded-2">
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
                        <p>Written by <?php the_author(); ?></p>
                        <p><?php the_content(__('(more...)')); ?></p>
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
                            'prev_text'    => __('« Previous'),
                            'next_text'    => __('Next »'),
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