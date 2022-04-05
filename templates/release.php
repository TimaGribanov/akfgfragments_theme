<?php /* Template Name: Akfgfragments Release */ ?>

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
                                            echo "<p id='release-type'>Release date: " . date("jS F, Y", strtotime("$row->date")) . "</span>";
                                        echo "</div>";

                                        echo "<div class='row'>"; //Tracklist
                                        ## CHANGE TRACKLISTS LOGIC!!!!
                                        $tracklist_length = count($tracklist);
                                            echo "<h3>Tracklist:</h3>";
                                            echo "<ol>";
                                            for ($i = 0; $i < $tracklist_length; $i++) {
                                                $track = $tracklist["$i"]->title_ro;
                                                echo "<li>$track</li>";
                                            }
                                            echo "</ol>";
                                        echo "</div>";

                                        //echo "<div class='row'>"; //Credits
                                        //echo "<h3>Credits:</h3>";
                                        //echo "</div>"; //End of credits
                                    echo "</div>"; //End of the first col

                                    echo "<div class='col'>"; //The second col: Album cover, Spotify
                                        echo "<div class='row'>"; //Album cover
                                            echo "<img src='$row->img_uri' />";
                                        echo "</div>";
                                        echo "<div class='row'>"; //Spotify
                                            echo "<iframe style='border-radius:12px' src='https://open.spotify.com/embed/album/" . $row->spotify_uri . "?utm_source=generator' width='60%' height='380' frameBorder='0' allowfullscreen='' allow='autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture'></iframe>";
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