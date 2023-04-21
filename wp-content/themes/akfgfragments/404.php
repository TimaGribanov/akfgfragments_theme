<?php get_header(); ?>

<main role="main">
    <div class="container-lg">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <p><?php _e('Oops!', 'akfgfragments'); ?></p>
                    <p><?php _e('It seems that this page doesn\'t exist', 'akfgfragments'); ?></p>
                    <p>
                        <?php
                        $args = array('numberposts' => '1');
                        $recent_posts = wp_get_recent_posts($args);
                        foreach ($recent_posts as $recent) {
                            $latest_url = get_permalink($recent["ID"]);
                        }
                        echo sprintf(__('Go to our <a href="https://akfgfragments.com">home page</a> or check the <a href="%s">latest material</a> we\'ve written.', 'akfgfragments'), $latest_url);
                        ?>
                    </p>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

</body>

</html>