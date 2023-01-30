<?php /* Template Name: Akfgfragments Music Videos */?>

<?php get_header(); ?>

<?php require( get_theme_root() . "/akfgfragments/normalise_title.php"); ?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
                <?php
                $mvdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
                $results = $mvdb->get_results("SELECT id, title_ro, director, `date` FROM music_videos ORDER BY id ASC;");

                if (!empty($results)) {
                    foreach ($results as $row) {
                        echo "<div class='row'>";
                        echo "<h3><a href='/mv?" . normaliseTitle($row->title_ro) . "' target='_blank'>$row->title_ro</a></h3>";
                        echo "<p>" . __( 'Year', 'akfgfragments' ) . ": " . date("Y", strtotime("$row->date")) . "</p>";
                        echo "<p>" . __( 'Director', 'akfgfragments' ) . ": " . $row->director . "</p>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

</body>

</html>