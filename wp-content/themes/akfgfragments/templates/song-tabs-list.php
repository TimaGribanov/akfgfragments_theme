<?php /* Template Name: Akfgfragments Tabs' List */?>

<?php get_header(); ?>

<?php require_once(get_theme_root() . "/akfgfragments/normalise_title.php"); ?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
                <?php
                $curr_locale = get_locale();
                $tabdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
                $results = $tabdb->get_results("SELECT s.title_ro AS `title` FROM tabs t JOIN songs s ON t.song_id = s.id GROUP BY t.song_id ORDER BY s.title_ro ASC");

                $results_letter = $tabdb->get_results( "SELECT DISTINCT LEFT(s.title_ro, 1) AS `first_letter` FROM tabs t JOIN songs s ON t.song_id = s.id ORDER BY s.title_ro ASC;" );

                            foreach($results_letter as $letter) {
                                echo "<div class='row mb-2'>";
                                echo "<h3>$letter->first_letter</h3>";
                                $tabs = $tabdb->get_results( "SELECT s.title_ro AS `title` FROM tabs t JOIN songs s ON t.song_id = s.id WHERE LEFT(title_ro, 1)='$letter->first_letter' GROUP BY t.song_id ORDER BY s.title_ro ASC;" );
                                $tabs_number = count($tabs);
                                echo "<div class='row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-3 lyrics-songs-row'>";
                                for ($i = 0; $i < $tabs_number; $i++) {
                                    $tab = $tabs["$i"]->title;
                                    echo "<div class='col mb-2'>";
                                    echo "<a class='lyrics-link' href='/song-tabs?" . normaliseTitle($tab) . "' target='blank_'>" . $tab . "</a>";
                                    echo "</div>";
                                }
                                echo "</div>";
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