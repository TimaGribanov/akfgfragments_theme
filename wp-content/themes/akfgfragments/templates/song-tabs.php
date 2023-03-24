<?php /* Template Name: Akfgfragments Tabs per Song */ ?>

<?php get_header(); ?>

    <main role="main">
        <div class="container">
            <div id="main" class="row">
                <div id="main-content" class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <?php
                            require( get_theme_root() . "/akfgfragments/parse_url.php" );
                            require( get_theme_root() . "/akfgfragments/normalise_title.php");

                            //Connect to another DB containing discography data
                            $tabdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
                            $results = $tabdb->get_results( "SELECT t.file AS `filename`, tt.type AS `type` FROM tabs t JOIN songs s ON t.song_id = s.id JOIN tab_types tt ON t.type = tt.id WHERE s.title_ro = \"$title_parsed\";" );
                            
                            echo "<h1 class='song_title'>$title_parsed</h1>";
                            echo "<div class='row'>";

                            if(!empty($results)) {
                                echo "<div class='d-grid gap-2 d-md-block'>";
                                echo "<div id='tabs-buttons'>";

                                foreach($results as $row) {
                                    echo "<button class='me-2 mb-2 tabs-btn'><a href='$row->filename' download>$row->type</a></button>";
                                }

                                echo "</div>";
                                echo "</div>";
                            } else {
                                echo "<p>Sorry! There are no tabs for this song on our site yet.</p>";
                                echo "<p>But we're working on it!</p>";
                            }
                            
                            echo "</div>";
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