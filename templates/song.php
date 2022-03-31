<?php /* Template Name: Akfgfragments Song */ ?>

<?php get_header(song); ?>
<?php get_header(header); ?>

    <main>
        <div class="container">
            <div id="ttr_main" class="row">
                <div id="ttr_content" class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                    <div class="row">
                        <?php
                            //THE FOLLOWING FOUR LINES ARE DOUBLED IN THE header-song.php!!! DO NOT FORGET TO MAKE CHANGES THERE AS WHERE!!!
                            $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            $title = parse_url($url, PHP_URL_QUERY); //Get a query
                            $title_parsed = str_replace('_', ' ', $title); //Delete underscores if they exist
                            $title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote

                            //Connect to another DB containing discography data
                            $songdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
                            $results = $songdb->get_results( "SELECT * FROM songs WHERE title_ro = \"$title_parsed\"" );
                            $song_releases = $songdb->get_results( "SELECT r.title_ro FROM rel_songs rs JOIN releases r ON r.id = rs.release_id JOIN songs s ON s.id = rs.song_id WHERE s.title_ro LIKE '$title_parsed%'" );

                            if(!empty($results)) {
                                foreach($results as $row) {
                                    echo "<h1 class='song_title'>$row->title_ro</h1>"; //Song title
                                    echo "<div class='row'>"; //The first row: Title translations, Credits, Spotify, Releases containing the song
                                    echo "<div class='col'>"; //The first col: Title translations, Credits
                                    echo "<div class='row'>"; //Title translations
                                    echo "<p class='title-trans'>" . $row->title_ja . ", " . $row->title_en . "</p>";
                                    echo "<p class='title-trans' id='open-hidden'>more...</p>";
                                    echo "<div id='hidden-translations' style='display:none;'>";
                                    echo "<p class='title-trans'>" . $row->title_de . "</p>";
                                    echo "<p class='title-trans'>" . $row->title_es . "</p>";
                                    echo "<p class='title-trans'>" . $row->title_fr . "</p>";
                                    echo "<p class='title-trans'>" . $row->title_pt . "</p>";
                                    echo "<p class='title-trans'>" . $row->title_ru . "</p>";
                                    echo "<p class='title-trans'>" . $row->title_uk . "</p>";
                                    echo "<p class='title-trans'>" . $row->title_be . "</p>";
                                    echo "</div>";
                                    echo "</div>"; //End of title translations
                                    //echo "<div class='row'>"; //Credits
                                    //echo "<h3>Credits:</h3>";
                                    //echo "</div>"; //End of credits
                                    echo "</div>"; //End of the first col
                                    echo "<div class='col'>"; //The second col: Spotify, Releases containing the song
                                    echo "<div class='row'>"; //Spotify
                                    if(strpos($row->spotify_uri, ",") === false) {
                                        echo "<iframe style='border-radius:12px' src='https://open.spotify.com/embed/track/" . $row->spotify_uri . "?utm_source=generator' width='60%' height='80' frameBorder='0' allowfullscreen='' allow='autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture'></iframe>";
                                    } else {
                                        $spotify_uri_arr = explode(",", $row->spotify_uri);
                                        foreach($spotify_uri_arr as &$uri) {
                                            echo "<iframe style='border-radius:12px' src='https://open.spotify.com/embed/track/" . $uri . "?utm_source=generator' width='60%' height='80' frameBorder='0' allowfullscreen='' allow='autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture'></iframe>";
                                        }
                                    }
                                    echo "</div>";
                                    echo "<div class='row'>"; //Releases
                                    echo "<h3>Part of the following releases:</h3>";
                                    echo "<div>"; //List of releases
                                    if(!empty($song_releases)) {  
                                        foreach($song_releases as $row) {
                                            echo "<p class='release'>" . $row->title_ro . "</p>";                      
                                        }
                                    }
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>"; //End of the second col
                                    echo "</div>"; //End of the first row
                                }
                            }                            
                        ?>

                        <div class="row" id="lyrics-div"> <!-- The second row: Lyrics -->
                            <h3>Lyrics:</h3>
                            <div class="d-grid gap-2 d-md-block"> <!-- Buttons -->
                            <form method="post">
                                <input type="submit" class="btn btn-primary me-2 song-text-btn" name="ja" value="japanese">
                                <input type="submit" class="btn btn-primary me-2 song-text-btn" name="ro" value="romaji">
                                <input type="submit" class="btn btn-primary me-2 song-text-btn" name="en" value="english">
                                <input type="submit" class="btn btn-primary me-2 song-text-btn" name="fr" value="french">
                                <input type="submit" class="btn btn-primary me-2 song-text-btn" name="de" value="german">
                                <input type="submit" class="btn btn-primary me-2 song-text-btn" name="es" value="spanish">
                                <input type="submit" class="btn btn-primary song-text-btn" name="pt" value="portuguese">
                            </form>
                            </div>
                            <?php
                                if (array_key_exists('ja', $_POST)) {
                                    getLyrics(ja);
                                } elseif (array_key_exists('ro', $_POST)) {
                                    getLyrics(ro);
                                } elseif (array_key_exists('en', $_POST)) {
                                    getLyrics(en);
                                } elseif (array_key_exists('fr', $_POST)) {
                                    getLyrics(fr);
                                } elseif (array_key_exists('de', $_POST)) {
                                    getLyrics(de);
                                } elseif (array_key_exists('es', $_POST)) {
                                    getLyrics(es);
                                } elseif (array_key_exists('pt', $_POST)) {
                                    getLyrics(pt);
                                }
                                function getLyrics($lang) {
                                    global $title_parsed, $songdb;
                                    
                                    $lyrics_results = $songdb->get_results( "SELECT * FROM lyrics WHERE song = '$title_parsed' AND lang = '$lang'" );
                                    if(!empty($lyrics_results)) {
                                        foreach($lyrics_results as $row) {
                                            echo "<div id='song-text'>" . $row->text . "</div>";
                                        }
                                    } else {
                                        switch ($lang) {
                                            case ja:
                                                $lang_full = 'Japanese';
                                                break;
                                            case ro:
                                                $lang_full = 'romaji';
                                                break;
                                            case en:
                                                $lang_full = 'English';
                                                break;
                                            case fr:
                                                $lang_full = 'French';
                                                break;
                                            case de:
                                                $lang_full = 'German';
                                                break;
                                            case es:
                                                $lang_full = 'Spanish';
                                                break;
                                            case pt:
                                                $lang_full = 'Portuguese';
                                                break;
                                            default:
                                                $lang_full = 'the selected language';
                                        }
                                        echo "<div id='song-text'>Sorry! This song's lyrics are not yet available in $lang_full.</div>";
                                    }
                                }
                            ?>
                        </div> <!-- End of the second row -->
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
    
    <script type="text/javascript">
        //Show and hide 'more...'
        (function($) {

            $('#open-hidden').on('click', function() {
                if($('#hidden-translations').is(':hidden')) {
                    $('#hidden-translations').show();
                } else {
                    $('#hidden-translations').hide();
                }
            })

        })( jQuery );
    </script>
</body>
</html>