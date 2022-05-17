<?php /* Template Name: Akfgfragments Blank Page */ ?>

<?php get_header(); ?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                <div class="row">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="row main-post border border-light border-2 rounded-2">
                        <p><?php the_content(__('(more...)')); ?></p>
                    </div>
                    <?php endwhile; else: ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
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