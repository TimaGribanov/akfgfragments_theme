<?php get_header(); ?>
<main role="main">
    <div class="container-lg">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <?php
                    if (have_posts()):
                        while (have_posts()):
                            the_post();
                            require(get_theme_root() . "/akfgfragments/posts.php");
                            ?>

                            <hr class="block-separator" />

                        <?php endwhile; else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.', 'akfgfragments'); ?></p>
                    <?php endif; ?>

                    <?php
                    $args = array(
                        'show_all' => false,
                        'end_size' => 1,
                        'mid_size' => 1,
                        'prev_next' => true,
                        'prev_text' => '«',
                        'next_text' => '»',
                        'add_args' => false,
                        'add_fragment' => '',
                        'screen_reader_text' => __('Pagination', 'akfgfragments'),
                        'class' => 'pagination'
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