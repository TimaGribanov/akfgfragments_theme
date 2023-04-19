<?php /* Template Name: Akfgfragments Song */ ?>

<?php get_header(); ?>

    <main role="main">
        <div class="container">
            <div id="main" class="row">
                <div id="main-content" class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <?php
                            //THE FOLLOWING FOUR LINES ARE DOUBLED IN THE header.php!!! DO NOT FORGET TO MAKE CHANGES THERE AS WELL!!!
                            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            $title = parse_url($url, PHP_URL_QUERY); //Get a query
                            $title_parsed = str_replace('_', ' ', $title); //Delete underscores if they exist
                            $title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
                            $title_parsed = str_replace('%26', '&', $title_parsed); //Change %26 to an ampersand
                            $title_parsed = str_replace('%23', '#', $title_parsed); //Change %26 to a number sign
                            $title_parsed = str_replace('%3F', '?', $title_parsed); //Change %26 to a question mark

                            //Connect to another DB containing discography data
                            $songdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
                            $results = $songdb->get_results( "SELECT * FROM songs WHERE title_ro = \"$title_parsed\"" );
                            $song_releases = $songdb->get_results( "SELECT r.title_ro FROM rel_songs rs JOIN releases r ON r.id = rs.release_id JOIN songs s ON s.id = rs.song_id WHERE s.title_ro LIKE \"$title_parsed%\"" );

                            if(!empty($results)) {
                                foreach($results as $row) {
                                    echo "<h1 class='song_title'>$row->title_ro</h1>"; //Song title
                                    echo "<div class='row'>"; //The first row: Title translations, Credits, Spotify, Releases containing the song
                                    echo "<div class='col'>"; //The first col: Title translations, Credits
                                    echo "<div class='row'>"; //Title translations
                                    echo "<p class='title-trans'>" . $row->title_ja . ", " . $row->title_en . "</p>";
                                    echo "<p class='title-trans' id='open-hidden'>";
                                        _e("more...");
                                    echo "</p>";
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
                                    echo "<h3>";
                                        _e("Part of the following releases:");
                                    echo "</h3>";
                                    echo "<div>"; //List of releases
                                    if(!empty($song_releases)) {  
                                        foreach($song_releases as $row) {
                                            echo "<p class='release'><a href='release?" . str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_', $row->title_ro))))) . "'>" . $row->title_ro . "</a></p>";                      
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
                            <h3><?php _e("Lyrics:") ?></h3>
                            <div class="d-grid gap-2 d-md-block"> <!-- Buttons -->
                            <form method="post">
                                <input type="submit" class="btn btn-primary me-2 mb-2 song-text-btn" name="ja" value="<?php _e("japanese"); ?>">
                                <input type="submit" class="btn btn-primary me-2 mb-2 song-text-btn" name="ro" value="<?php _e("romaji"); ?>">
                                <input type="submit" class="btn btn-primary me-2 mb-2 song-text-btn" name="en" value="<?php _e("english"); ?>">
                                <input type="submit" class="btn btn-primary me-2 mb-2 song-text-btn" name="fr" value="<?php _e("french"); ?>">
                                <input type="submit" class="btn btn-primary me-2 mb-2 song-text-btn" name="de" value="<?php _e("german"); ?>">
                                <input type="submit" class="btn btn-primary me-2 mb-2 song-text-btn" name="es" value="<?php _e("spanish"); ?>">
                                <input type="submit" class="btn btn-primary me-2 mb-2 song-text-btn" name="pt" value="<?php _e("portuguese"); ?>">
                                <input type="submit" class="btn btn-primary mb-2 song-text-btn" name="ru" value="<?php _e("russian"); ?>">
                            </form>
                            </div>
                            <?php
                                if (array_key_exists('ja', $_POST)) {
                                    getLyrics('ja');
                                } elseif (array_key_exists('ro', $_POST)) {
                                    getLyrics('ro');
                                } elseif (array_key_exists('en', $_POST)) {
                                    getLyrics('en');
                                } elseif (array_key_exists('fr', $_POST)) {
                                    getLyrics('fr');
                                } elseif (array_key_exists('de', $_POST)) {
                                    getLyrics('de');
                                } elseif (array_key_exists('es', $_POST)) {
                                    getLyrics('es');
                                } elseif (array_key_exists('pt', $_POST)) {
                                    getLyrics('pt');
                                } elseif (array_key_exists('ru', $_POST)) {
                                    getLyrics('ru');
                                }
                                function getLyrics($lang) {
                                    global $title_parsed, $songdb;
                                    
                                    $lyrics_results = $songdb->get_results( "SELECT * FROM lyrics WHERE song_id = (SELECT id FROM songs WHERE title_ro = \"$title_parsed\") AND lang = \"$lang\"" );
                                    if(!empty($lyrics_results)) {
                                        foreach($lyrics_results as $row) {
                                            $text_db = $row->text;
                                            $text_parsed = str_replace('\\\'', '\'', $text_db);
                                            echo "<div id='song-text'>" . $text_parsed . "</div>";
                                        }
                                    } else {
                                        switch ($lang) {
                                            case 'ja':
                                                $lang_full = __('Japanese');
                                                break;
                                            case 'ro':
                                                $lang_full = __('romaji');
                                                break;
                                            case 'en':
                                                $lang_full = __('English');
                                                break;
                                            case 'fr':
                                                $lang_full = __('French');
                                                break;
                                            case 'de':
                                                $lang_full = __('German');
                                                break;
                                            case 'es':
                                                $lang_full = __('Spanish');
                                                break;
                                            case 'pt':
                                                $lang_full = __('Portuguese');
                                                break;
                                            case 'ru':
                                                $lang_full = __('Russian');
                                                break;
                                            default:
                                                $lang_full = __('the selected language');
                                        }
                                        echo "<div id='song-text'>";
                                            echo __("Sorry! This song's lyrics are not yet available in ") . $lang_full . ".";
                                        echo "</div>";
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
                    $('#open-hidden').text('<?php _e("less..."); ?>');
                } else {
                    $('#hidden-translations').hide();
                    $('#open-hidden').text('<?php _e("more..."); ?>');
                }
            })

        })( jQuery );
    </script>
</body>
</html>
