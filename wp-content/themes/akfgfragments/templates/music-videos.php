<?php /* Template Name: Akfgfragments Music Videos' List */?>

<?php get_header(); ?>

<?php require_once(get_theme_root() . "/akfgfragments/normalise_title.php"); ?>
<?php require(get_theme_root() . "/akfgfragments/get_people.php"); ?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
                <?php
                $curr_locale = get_locale();
                $mvdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
                $results = $mvdb->get_results("SELECT id, title_ro, director, `date` FROM music_videos ORDER BY id ASC;");

                if (!empty($results)) {
                    echo "<div class='row'>";
                    for ($j = 0; $j < count($results); $j++) {
                        $title = $results[$j]->title_ro;
                        $date = $results[$j]->date;
                        $dir_id = $results[$j]->director;
                        $dir = getName($dir_id, $curr_locale);
                        echo "<div class='col-lg-4 col-sm-6'>";
                        echo "<h3><a href='/mv?" . normaliseTitle($title) . "' target='_blank'>$title</a></h3>";
                        echo "<p class='mb-1'>" . __('Year', 'akfgfragments') . ": " . date("Y", strtotime("$date")) . "</p>";
                        echo "<p class='mt-1'>" . __('Director', 'akfgfragments') . ": " . $dir . "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
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