<?php /* Template Name: Akfgfragments Music Videos */ ?>

<?php get_header(); ?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
                <?php
                $mvdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
                $results = $mvdb->get_results( "SELECT * FROM music_videos ORDER BY id ASC;" );
                ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

</body>
</html>