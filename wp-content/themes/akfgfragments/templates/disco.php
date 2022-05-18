<?php /* Template Name: Akfgfragments Discography List */ ?>

<?php get_header(); ?>

    <main role="main">
        <div class="container">
            <div id="main" class="row">
                <div id="content" class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                    <div class="row">
                        <?php
                            $discodb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
                            $results_types = $discodb->get_results( "SELECT DISTINCT t.`type` AS type_string, r.`type` AS type_int FROM releases r JOIN types t ON t.id = r.`type`;" );

                            foreach($results_types as $type) {
                                echo "<div class='row mb-2'>";
                                echo "<h3>" . ucwords($type->type_string) . "s</h3>";
                                $results_releases = $discodb->get_results( "SELECT title_ro, img_uri, date FROM releases WHERE `type` = $type->type_int;" );
                                foreach($results_releases as $release) {
                                    echo "<div class='row'>";
                                    echo "<div class='col-1'>";
                                    if(strpos($release->img_uri, ",") === false) {
                                        echo "<a href='/release?" . str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_',$release->title_ro))))) . "' target='blank_'><img src='" . $release->img_uri . "' width='50px'></a>";
                                    } else {
                                        $img_uri_arr = explode(",", $release->img_uri);
                                        echo "<a href='/release?" . str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_',$release->title_ro))))) . "' target='blank_'><img src='" . $img_uri_arr[0] . "' width='50px'></a>";
                                    }
                                    echo "</div>";
                                    echo "<div class='col'>";
                                    echo "<a href='/release?" . str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_',$release->title_ro))))) . "' target='blank_'>" . $release->title_ro . "</a>";
                                    if($release->date == "2000-01-01") {
                                        echo "<p>" . date("Y", strtotime("$release->date")) . "</p>";
                                    } else {
                                        echo "<p>" . date("jS F Y", strtotime("$release->date")) . "</p>";
                                    }
                                    echo "</div>";
                                    echo "</div>";
                                }
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