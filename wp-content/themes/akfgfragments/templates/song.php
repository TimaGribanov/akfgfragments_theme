<?php /* Template Name: Akfgfragments Song */?>

<?php
function printSpotifySong($url)
{
    echo "<div class='row'>";

    if (strpos($url, ",") === false) {
        echo "<iframe style='border-radius:12px' src='https://open.spotify.com/embed/track/" .
            $url .
            "?utm_source=generator' width='60%' height='80' frameBorder='0' allowfullscreen='' allow='autoplay;
            clipboard-write; encrypted-media; fullscreen; picture-in-picture'></iframe>";
    } else {
        $spotify_uri_arr = explode(",", $url);
        foreach ($spotify_uri_arr as &$uri) {
            echo "<iframe style='border-radius:12px' src='https://open.spotify.com/embed/track/" .
                $uri . "?utm_source=generator' width='60%' height='80' frameBorder='0' allowfullscreen='' allow='autoplay;
                clipboard-write; encrypted-media; fullscreen; picture-in-picture'></iframe>";
        }
    }

    echo "</div>";
}

function printReleases($song_releases)
{
    echo "<div class='row'>"; //Releases
    echo "<h3>";
    _e('Part of:', 'akfgfragments');
    echo "</h3>";
    echo "<div>"; //List of releases
    if (!empty($song_releases)) {
        foreach ($song_releases as $row) {
            echo "<p class='song-releases'><a href='release?" . normaliseTitle($row->title_ro) . "'>" . $row->title_ro . "</a></p>";
        }
    }
    echo "</div>";
    echo "</div>";
}

function printTabs($title, $title_ro)
{
    echo "<div>"; //Tabs
    echo "<h3>";
    _e('Tabs:', 'akfgfragments');
    echo "</h3>";
    echo "<a href='/song-tabs?$title' target='_blank'>$title_ro</a>";
    echo "</div>";
}
?>

<?php get_header(); ?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
            <?php
            require(get_theme_root() . "/akfgfragments/parse_url.php");
            require(get_theme_root() . "/akfgfragments/normalise_title.php");

            //Connect to another DB containing discography data
            $songdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
            $results = $songdb->get_results("SELECT * FROM songs WHERE title_ro = \"$title_parsed\"");
            $song_releases = $songdb->get_results("SELECT r.title_ro FROM rel_songs rs JOIN releases r ON r.id = rs.release_id JOIN songs s ON s.id = rs.song_id WHERE s.title_ro LIKE \"$title_parsed\"");
            $tabs_results = $songdb->get_results("SELECT t.id FROM tabs t JOIN songs s ON t.song_id = s.id WHERE s.title_ro = \"$title_parsed\"");
            ?>
                <!-- ON DESKTOP -->
                <div class="row d-none d-lg-block d-xl-block d-xxl-block">
                    <?php
                    global $results;
                    global $song_releases;
                    global $tabs_results;

                    if (!empty($results)) {
                        foreach ($results as $row) {
                            echo "<h1 class='song_title'>$row->title_ro</h1>"; //Song title
                            echo "<div class='row'>"; //The first row: Title translations, Credits, Spotify, Releases containing the song
                            echo "<div class='col'>"; //The first col: Title translations, Credits
                    
                            echo "<div class='row'>"; //Title translations
                            echo "<p class='title-trans'><span title='日本語' lang='ja-jp'>" . $row->title_ja . "</span>, <span title='English'>" . $row->title_en . "</span></p>";
                            echo "<p class='title-trans' id='open-hidden'>";
                            _e('more...', 'akfgfragments');
                            echo "</p>";
                            echo "<div id='hidden-translations' style='display:none;'>";
                            if ($row->title_de != "") {
                                echo "<p class='title-trans'><span title='Deutsch'>" . $row->title_de . "</span></p>";
                            }
                            if ($row->title_es != "") {
                                echo "<p class='title-trans'><span title='Español'>" . $row->title_es . "</span></p>";
                            }
                            if ($row->title_fr != "") {
                                echo "<p class='title-trans'><span title='Française'>" . $row->title_fr . "</span></p>";
                            }
                            if ($row->title_pt != "") {
                                echo "<p class='title-trans'><span title='Português'>" . $row->title_pt . "</span></p>";
                            }
                            if ($row->title_id != "") {
                                echo "<p class='title-trans'><span title='Bahasa Indonesia'>" . $row->title_id . "</span></p>";
                            }
                            if ($row->title_ru != "") {
                                echo "<p class='title-trans'><span title='Русский'>" . $row->title_ru . "</span></p>";
                            }
                            if ($row->title_uk != "") {
                                echo "<p class='title-trans'><span title='Українська'>" . $row->title_uk . "</span></p>";
                            }
                            if ($row->title_be != "") {
                                echo "<p class='title-trans'><span title='Беларуская'>" . $row->title_be . "</span></p>";
                            }
                            echo "</div>";
                            echo "</div>"; //End of title translations
                    
                            //echo "<div class='row'>"; //Credits
                            //echo "<h3>Credits:</h3>";
                            //echo "</div>"; //End of credits
                    
                            echo "</div>"; //End of the first col
                    
                            echo "<div class='col'>"; //The second col: Spotify, Releases containing the song
                    
                            printSpotifySong($row->spotify_uri);

                            printReleases($song_releases);

                            if (!empty($tabs_results)) {
                                printTabs($title, $row->title_ro);
                            }

                            echo "</div>"; //End of the second col
                            echo "</div>"; //End of the first row
                        }
                    }
                    ?>
                </div>

                <!-- ON MOBILE -->
                <div class=" row d-lg-none d-xl-none d-xxl-none d-block d-sm-block d-md-block">
                <?php
                    global $results;
                    global $song_releases;
                    global $tabs_results;

                    if (!empty($results)) {
                        foreach ($results as $row) {
                            echo "<h1 class='song_title'>$row->title_ro</h1>"; //Song title
                            echo "<div class='row'>";
                            echo "<div class='col'>";
                    
                            echo "<div class='row'>"; //Title translations
                            echo "<p class='title-trans'><span title='日本語' lang='ja-jp'>" . $row->title_ja . "</span>";
                            echo "<p class='title-trans'><span title='English'>" . $row->title_en . "</span></p>";
                            if ($row->title_de != "") {
                                echo "<p class='title-trans'><span title='Deutsch'>" . $row->title_de . "</span></p>";
                            }
                            if ($row->title_es != "") {
                                echo "<p class='title-trans'><span title='Español'>" . $row->title_es . "</span></p>";
                            }
                            if ($row->title_fr != "") {
                                echo "<p class='title-trans'><span title='Française'>" . $row->title_fr . "</span></p>";
                            }
                            if ($row->title_pt != "") {
                                echo "<p class='title-trans'><span title='Português'>" . $row->title_pt . "</span></p>";
                            }
                            if ($row->title_id != "") {
                                echo "<p class='title-trans'><span title='Bahasa Indonesia'>" . $row->title_id . "</span></p>";
                            }
                            if ($row->title_ru != "") {
                                echo "<p class='title-trans'><span title='Русский'>" . $row->title_ru . "</span></p>";
                            }
                            if ($row->title_uk != "") {
                                echo "<p class='title-trans'><span title='Українська'>" . $row->title_uk . "</span></p>";
                            }
                            if ($row->title_be != "") {
                                echo "<p class='title-trans'><span title='Беларуская'>" . $row->title_be . "</span></p>";
                            }
                            echo "</div>"; //End of title translations
                    
                            //echo "<div class='row'>"; //Credits
                            //echo "<h3>Credits:</h3>";
                            //echo "</div>"; //End of credits
                            
                            printSpotifySong($row->spotify_uri);

                            printReleases($song_releases);

                            if (!empty($tabs_results)) {
                                printTabs($title, $row->title_ro);
                            }
                    
                            echo "</div>"; //End of the first col
                            echo "</div>"; //End of the first row
                        }
                    }
                    ?>
                </div>

                <!-- LYRICS -->
                <div class="row">
                    <h3><?php _e('Lyrics:', 'akfgfragments') ?></h3>
                    <div class="d-grid gap-2 d-md-block">
                        <div id="song-text-buttons">
                            <input type="submit" class="me-2 mb-2 song-text-btn" name="ja"
                                value="<?php _e('japanese', 'akfgfragments'); ?>">
                            <input type="submit" class="me-2 mb-2 song-text-btn" name="ro"
                                value="<?php _e('romaji', 'akfgfragments'); ?>">
                            <input type="submit" class="me-2 mb-2 song-text-btn" name="en"
                                value="<?php _e('english', 'akfgfragments'); ?>">
                            <input type="submit" class="me-2 mb-2 song-text-btn" name="fr"
                                value="<?php _e('french', 'akfgfragments'); ?>">
                            <input type="submit" class="me-2 mb-2 song-text-btn" name="de"
                                value="<?php _e('german', 'akfgfragments'); ?>">
                            <input type="submit" class="me-2 mb-2 song-text-btn" name="es"
                                value="<?php _e('spanish', 'akfgfragments'); ?>">
                            <input type="submit" class="me-2 mb-2 song-text-btn" name="pt"
                                value="<?php _e('portuguese', 'akfgfragments'); ?>">
                            <input type="submit" class="me-2 mb-2 song-text-btn" name="id"
                                value="<?php _e('indonesian', 'akfgfragments'); ?>">
                            <input type="submit" class="me-2 mb-2 song-text-btn" name="ru"
                                value="<?php _e('russian', 'akfgfragments'); ?>">
                            <input type="submit" class="me-2 mb-2 song-text-btn" name="uk"
                                value="<?php _e('ukrainian', 'akfgfragments'); ?>">
                            <input type="submit" class="mb-2 song-text-btn" name="be"
                                value="<?php _e('belarusian', 'akfgfragments'); ?>">
                        </div>
                    </div>
                    <div id="song-lyrics"></div>
                </div>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

<script type="text/javascript">
    //Show and hide 'more...'
    (function ($) {

        $('#open-hidden').on('click', function () {
            if ($('#hidden-translations').is(':hidden')) {
                $('#hidden-translations').show();
                $('#open-hidden').text('<?php _e('less...', 'akfgfragments'); ?>');
            } else {
                $('#hidden-translations').hide();
                $('#open-hidden').text('<?php _e('more...', 'akfgfragments'); ?>');
            }
        })

    })(jQuery);

    //load lyrics
    $('.song-text-btn').click(function () {
        const lang = $(this).attr('name')
        $.ajax({
            url: `/wp-content/themes/akfgfragments/load_lyrics.php?title=<?php global $title_parsed;
                echo str_replace('&', '%26', $title_parsed); ?>&lang=${lang}`,
            success: function (response) {
                $('#song-lyrics').html(response)
            }
        })
    })
</script>
</body>

</html>
