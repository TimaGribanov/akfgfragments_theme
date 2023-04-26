<?php /* Template Name: Akfgfragments Blank Page */ ?>

<?php get_header(); ?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-8 col-sm-12 col-md-12 col-xs-12">
                <div class="row">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="row main-post d-none d-lg-block d-xl-block d-xxl-block">
                        <p><?php the_content(__( '(more...)', 'akfgfragments' )); ?></p>
                    </div>

                    <div class="row main-post-mobile d-block d-md-block d-lg-none">
                        <p><?php the_content(__( '(more...)', 'akfgfragments' )); ?></p>
                    </div>
                    <?php endwhile; else: ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'akfgfragments' ); ?></p>
                    <?php endif; ?>                   
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

</body>
</html>