<?php /* Template Name: Akfgfragments Song */ ?>

<?php get_header(); ?>

    <main role="main">
        <div class="container">
            <div id="main" class="row">
                <div id="main-content" class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <?php
                            require( get_theme_root() . "/akfgfragments/parse_url.php" );

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
                                    echo "<p class='title-trans'><span title='日本語' lang='ja-jp'>" . $row->title_ja . "</span>, <span title='English'>" . $row->title_en . "</span></p>";
                                    echo "<p class='title-trans' id='open-hidden'>";
                                        _e( 'more...', 'akfgfragments' );
                                    echo "</p>";
                                    echo "<div id='hidden-translations' style='display:none;'>";
                                    if ($row->title_de != "") {echo "<p class='title-trans'><span title='Deutsche'>" . $row->title_de . "</span></p>";}
                                    if ($row->title_es != "") {echo "<p class='title-trans'><span title='Español'>" . $row->title_es . "</span></p>";}
                                    if ($row->title_fr != "") {echo "<p class='title-trans'><span title='Française'>" . $row->title_fr . "</span></p>";}
                                    if ($row->title_pt != "") {echo "<p class='title-trans'><span title='Português'>" . $row->title_pt . "</span></p>";}
                                    if ($row->title_ru != "") {echo "<p class='title-trans'><span title='Русский'>" . $row->title_ru . "</span></p>";}
                                    if ($row->title_uk != "") {echo "<p class='title-trans'><span title='Українська'>" . $row->title_uk . "</span></p>";}
                                    if ($row->title_be != "") {echo "<p class='title-trans'><span title='Беларуская'>" . $row->title_be . "</span></p>";}
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
                                        foreach($spotify_uri_arr as &$uri) {
                                            echo "<iframe style='border-radius:12px' src='https://open.spotify.com/embed/track/" . $uri . "?utm_source=generator' width='60%' height='80' frameBorder='0' allowfullscreen='' allow='autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture'></iframe>";
                                        }
                                    }
                                    echo "</div>";
                                    echo "<div class='row'>"; //Releases
                                    echo "<h3>";
                                        _e( 'Part of:', 'akfgfragments' );
                                    echo "</h3>";
                                    echo "<div>"; //List of releases
                                    if(!empty($song_releases)) {  
                                        foreach($song_releases as $row) {
                                            echo "<p class='song-releases'><a href='release?" . str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_', $row->title_ro))))) . "'>" . $row->title_ro . "</a></p>";                      
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
                            <h3><?php _e( 'Lyrics:', 'akfgfragments' ) ?></h3>
                            <div class="d-grid gap-2 d-md-block"> <!-- Buttons -->
                                <div id="song-text-buttons">
                                    <input type="submit" class="me-2 mb-2 song-text-btn" name="ja" value="<?php _e( 'japanese', 'akfgfragments' ); ?>">
                                    <input type="submit" class="me-2 mb-2 song-text-btn" name="ro" value="<?php _e( 'romaji', 'akfgfragments' ); ?>">
                                    <input type="submit" class="me-2 mb-2 song-text-btn" name="en" value="<?php _e( 'english', 'akfgfragments' ); ?>">
                                    <input type="submit" class="me-2 mb-2 song-text-btn" name="fr" value="<?php _e( 'french', 'akfgfragments' ); ?>">
                                    <input type="submit" class="me-2 mb-2 song-text-btn" name="de" value="<?php _e( 'german', 'akfgfragments' ); ?>">
                                    <input type="submit" class="me-2 mb-2 song-text-btn" name="es" value="<?php _e( 'spanish', 'akfgfragments' ); ?>">
                                    <input type="submit" class="me-2 mb-2 song-text-btn" name="pt" value="<?php _e( 'portuguese', 'akfgfragments' ); ?>">
                                    <input type="submit" class="me-2 mb-2 song-text-btn" name="ru" value="<?php _e( 'russian', 'akfgfragments' ); ?>">
                                    <input type="submit" class="me-2 mb-2 song-text-btn" name="uk" value="<?php _e( 'ukrainian', 'akfgfragments' ); ?>">
                                    <input type="submit" class="mb-2 song-text-btn" name="be" value="<?php _e( 'belarusian', 'akfgfragments' ); ?>">
                                </div>
                            </div>
                            <div id="song-lyrics"></div>
                            <script type="text/javascript">
                                $('.song-text-btn').click(function() {
                                    const lang = $(this).attr('name')
                                    $.ajax({
                                        url: `/wp-content/themes/akfgfragments/load_lyrics.php?title=<?php global $title_parsed; echo $title_parsed; ?>&lang=${lang}`,
                                        success: function(response) {
                                            $('#song-lyrics').html(response)
                                        }
                                    })
                                })
                            </script>
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
                    $('#open-hidden').text('<?php _e( 'less...', 'akfgfragments'); ?>');
                } else {
                    $('#hidden-translations').hide();
                    $('#open-hidden').text('<?php _e( 'more...', 'akfgfragments'); ?>');
                }
            })

        })( jQuery );
    </script>
</body>
</html>