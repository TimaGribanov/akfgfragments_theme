<?php /* Template Name: Akfgfragments Release */ ?>

<?php get_header(); ?>
<?php get_header(header); ?>

    <main role="main">
        <div class="container">
            <div id="main" class="row">
                <div id="content" class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <?php
                            //THE FOLLOWING FOUR LINES ARE DOUBLED IN THE header-song.php!!! DO NOT FORGET TO MAKE CHANGES THERE AS WHERE!!!
                            $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            $title = parse_url($url, PHP_URL_QUERY); //Get a query
                            $title_parsed = str_replace('_', ' ', $title); //Delete underscores if they exist
                            $title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
                            $title_parsed = str_replace('%26', '&', $title_parsed); //Cahnge %26 to an ampersand
                            $title_parsed = str_replace('%23', '#', $title_parsed); //Cahnge %26 to a number sign
                            $title_parsed = str_replace('%3F', '?', $title_parsed); //Cahnge %26 to a question mark

                            //Connect to another DB containing discography data
                            $releasedb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
                            $results = $releasedb->get_results( "SELECT r.title_ja, r.title_ro, r.title_en, r.title_ru, r.title_es, r.title_de, r.title_fr, r.title_be, r.title_uk, r.title_fi, r.title_pt, r.date, r.catalogue, r.spotify_uri, r.img_uri, t.type FROM releases r JOIN types t ON t.id = r.type WHERE title_ro =  \"$title_parsed\";" );
                            $tracklist = $releasedb->get_results( "SELECT s.title_ro FROM rel_songs rs JOIN releases r ON r.id = rs.release_id JOIN songs s ON s.id = rs.song_id WHERE r.title_ro = \"$title_parsed\" ORDER BY rs.release_pos ASC;" );

                            if(!empty($results)) {
                                foreach($results as $row) {
                                    echo "<h1 class='song_title'>$row->title_ro</h1>"; //Release title
                                    echo "<div class='col'>"; //The first col: Title translations, Type of release, Release date, Tracklist, Credits
                                        echo "<div class='row'>"; //Title translations
                                            echo "<p class='title-trans'>$row->title_ja, $row->title_en</p>";
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
                                        
                                        echo "<div class='row'>"; //Release type
                                            echo "<p id='release-type'>Type of release: $row->type</span>";
                                        echo "</div>";

                                        echo "<div class='row'>"; //Release date
                                        if($row->date == "2000-01-01") {
                                            echo "<p id='release-type'>Release date: " . date("Y", strtotime("$row->date")) . "</p>";
                                        } else {
                                            echo "<p id='release-type'>Release date: " . date("jS F Y", strtotime("$row->date")) . "</p>";
                                        }
                                        echo "</div>";

                                        echo "<div class='row'>"; //Tracklist
                                        $tracklist_length = count($tracklist);
                                            echo "<h3>Tracklist:</h3>";
                                            echo "<ol class='main-tracklist'>";
                                            for ($i = 0; $i < $tracklist_length; $i++) {
                                                $track = $tracklist["$i"]->title_ro;
                                                echo "<li><a class='main-traclist-link' href='song?" . str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_',$track))))) . "'>" . $track . "</a></li>";
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