<?php /* Template Name: Akfgfragments Lyrics List */ ?>

<?php get_header(); ?>

    <main role="main">
        <div class="container">
            <div id="main" class="row">
                <div id="content" class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                    <div class="row">
                        <?php
                            //Connect to another DB containing discography data
                            $lyricsdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
                            $results_letter = $lyricsdb->get_results( "SELECT DISTINCT LEFT(title_ro, 1) AS first_letter FROM songs ORDER BY title_ro ASC;" );

                            foreach($results_letter as $letter) {
                                echo "<div class='row mb-2'>";
                                echo "<h3>$letter->first_letter</h3>";
                                $results_songs = $lyricsdb->get_results( "SELECT title_ro FROM songs WHERE LEFT(title_ro, 1)='$letter->first_letter' ORDER BY title_ro ASC;" );
                                $songs_number = count($results_songs);
                                echo "<div class='row row-cols-3 lyrics-songs-row'>";
                                for ($i = 0; $i < $songs_number; $i++) {
                                    $song = $results_songs["$i"]->title_ro;
                                    echo "<div class='col mb-2'>";
                                    echo "<a href='/song?" . str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_',$song))))) . "' target='blank_'>" . $song . "</a>";
                                    echo "</div>";
                                }
                                echo "</div>";
                                echo "</div>";
                            }                       
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