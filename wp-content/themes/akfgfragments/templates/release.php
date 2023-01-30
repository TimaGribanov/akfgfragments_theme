<?php /* Template Name: Akfgfragments Release */ ?>

<?php get_header(); ?>
    <main role="main">
        <div class="container">
            <div id="main" class="row">
                <div id="content" class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <?php
                            require( get_theme_root() . "/akfgfragments/parse_url.php" );
                            require( get_theme_root() . "/akfgfragments/normalise_title.php");

                            //Connect to another DB containing discography data
                            $releasedb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
                            $results = $releasedb->get_results( "SELECT r.title_ja, r.title_ro, r.title_en, r.title_ru, r.title_es, r.title_de, r.title_fr, r.title_be, r.title_uk, r.title_fi, r.title_pt, r.date, r.catalogue, r.spotify_uri, r.img_uri, t.type FROM releases r JOIN types t ON t.id = r.type WHERE title_ro =  \"$title_parsed\";" );
                            $tracklist = $releasedb->get_results( "SELECT s.title_ro FROM rel_songs rs JOIN releases r ON r.id = rs.release_id JOIN songs s ON s.id = rs.song_id WHERE r.title_ro = \"$title_parsed\" ORDER BY rs.release_pos ASC;" );

                            if(!empty($results)) {
                                foreach($results as $row) {
                                    echo "<h1 class='song_title'>$row->title_ro</h1>"; //Release title
                                    echo "<div class='col'>"; //The first col: Title translations, Type of release, Release date, Tracklist, Credits
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
                                        
                                        echo "<div class='row'>"; //Release type ?>
                                            <p id="release-type"><?php _e( 'Type of release:', 'akfgfragments' ) ?> <?php echo $row->type; ?></span>
                                        <?php echo "</div>";

                                        echo "<div class='row'>"; //Release date
                                        if($row->date == "2000-01-01") {
                                        ?>
                                            <p id="release-type"><?php _e( 'Release date:', 'akfgfragments' ) ?> <?php echo date("Y", strtotime("$row->date")); ?></p>
                                        <?php
                                        } else {
                                        ?>
                                            <p id="release-type"><?php _e( 'Release date:', 'akfgfragments' ) ?> <?php echo date("jS F Y", strtotime("$row->date")); ?></p>
                                        <?php
                                        }
                                        echo "</div>";

                                        echo "<div class='row'>"; //Tracklist
                                        $tracklist_length = count($tracklist);
                                        ?>
                                            <h3><?php _e( 'Tracklist:', 'akfgfragments' ) ?></h3>
                                        <?php
                                            echo "<ol class='main-tracklist'>";
                                            for ($i = 0; $i < $tracklist_length; $i++) {
                                                $track = $tracklist["$i"]->title_ro;
                                                echo "<li><a class='main-tracklist-link' href='song?" . str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_',$track))))) . "'>" . $track . "</a></li>";
                                            }
                                            echo "</ol>";
                                        echo "</div>";

                                        //echo "<div class='row'>"; //Credits
                                        //echo "<h3>Credits:</h3>";
                                        //echo "</div>"; //End of credits
                                    echo "</div>"; //End of the first col

                                    echo "<div class='col'>"; //The second col: Album cover, Spotify
                                        echo "<div class='row main-image-container'>"; //Album cover
                                            if(strpos($row->img_uri, ",") === false) {
                                                echo "<img src='$row->img_uri' />";
                                            } else {
                                                $img_uri_arr = explode(",", $row->img_uri);
                                                foreach($img_uri_arr as &$img) {
                                                    echo "<img class='main-double-image' src='$img' />";
                                                }
                                                echo "<div class='main-double-image-arrows'>";
                                                    echo "<i class='bi bi-chevron-left main-double-image-arrow main-double-image-arrow-left'></i>";
                                                    echo "<i class='bi bi-chevron-right main-double-image-arrow main-double-image-arrow-right'></i>";
                                                echo "</div>";
                                            }
                                        echo "</div>";
                                        echo "<div class='row'>"; //Spotify
                                            if(strpos($row->spotify_uri, ",") === false) {
                                                echo "<iframe style='border-radius:12px' src='https://open.spotify.com/embed/album/" . $row->spotify_uri . "?utm_source=generator' width='60%' height='380' frameBorder='0' allowfullscreen='' allow='autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture'></iframe>";
                                            } else {
                                                $spotify_uri_arr = explode(",", $row->spotify_uri);
                                                foreach($spotify_uri_arr as &$uri) {
                                                    echo "<iframe style='border-radius:12px' src='https://open.spotify.com/embed/album/" . $uri . "?utm_source=generator' width='60%' height='380' frameBorder='0' allowfullscreen='' allow='autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture'></iframe>";
                                                }
                                            }
                                        echo "</div>";
                                    echo "</div>"; //End of the second col
                                }
                            }                            
                        ?>
                    </div>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>

        <script type="text/javascript">
            //Click through images
            (function($) {

                $('.main-double-image-arrow-left').on('click', function() {
                    var images = $('.main-image-container').find('.main-double-image');

                    var currentIndex;
                    images.each(function() {
                        if($(this).is(':visible')) {
                            currentIndex = $(images).index(this);
                        }
                    });

                    $(images[currentIndex]).hide();
                    $(images[currentIndex - 1]).show();
                    $('.main-double-image-arrow-right').show();
                    if(currentIndex - 1 == 0) {
                        $('.main-double-image-arrow-left').hide();
                    }
                });

                $('.main-double-image-arrow-right').on('click', function() {
                    var images = $('.main-image-container').find('.main-double-image');

                    var currentIndex;
                    
                    images.each(function() {
                        if($(this).is(':visible')) {
                            currentIndex = $(images).index(this);
                        }
                    });

                    $(images[currentIndex]).hide();
                    $(images[currentIndex + 1]).show();
                    $('.main-double-image-arrow-left').show();
                    if(currentIndex == images.length - 2) {
                        $('.main-double-image-arrow-right').hide();
                    }
                });

            })( jQuery );
        </script>

    </main>

    <?php get_footer(); ?>
    
    <script type="text/javascript">
        //Show and hide 'more...'
        (function($) {

            $('#open-hidden').on('click', function() {
                if($('#hidden-translations').is(':hidden')) {
                    $('#hidden-translations').show();
                    $('#open-hidden').text('less...');
                } else {
                    $('#hidden-translations').hide();
                    $('#open-hidden').text('more...');
                }
            })

        })( jQuery );
    </script>
</body>
</html>