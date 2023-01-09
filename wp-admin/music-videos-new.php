<?php
/**
 * Discography Songs Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title       = __( 'New music video' );
$this_file   = 'music-video-new.php';
$parent_file = 'music-video.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e( 'New music video' ); ?></h1>
    <form action="" method="POST">
        <div style="display: flex; width: 500px;">
            <div style="flex: 1;">
                <label for="title_ro"><h3>Song*:</h3></label>
                <input type="text" id="title_ro" name="title_ro">
                <script type="text/javascript">
                        document.getElementById('title_ro').addEventListener('keyup', findSongs);

                        function findSongs() {
                            let queryParam = document.getElementById('title_ro').value;
                            let searchString = 'param=' + queryParam;

                            //ADD RESULTS TO OTHER DIV AS FOR RELEASES 
                            //AJAX to search for songs
                            if (queryParam) {
                                (function($) {
                                    $.ajax({
                                        type: "POST",
                                        url: "/wp-admin/discography-release-new-query.php",
                                        data: searchString,
                                        cache: false,
                                        success: function(html) {
                                            document.getElementById('title_ro').innerHTML = html
                                        }
                                    });
                                })( jQuery );
                            } else {
                                document.getElementById('title_ro').innerHTML = '';
                            }
                        
                            return false;
                        }
                </script>

                <label for="director"><h3>Director:</h3></label>
                <input type="text" id="director" name="director"><br>
                <label for="date"><h3>Date:</h3></label>
                <input type="date" id="date" name="date"><br>
                <label for="mv_url"><h3>MV URL:</h3></label>
                <input type="text" id="mv_url" name="mv_url"><br><br>
            </div>
        </div>
        <input type="submit" name="submit" value="Add music video">
    </form>

    <?php
        if (isset($_POST['submit'])) {
            $title_ro = stripslashes($_POST['title_ro']);
            $director = $_POST['director'];
            $date = $_POST['date'];
            $url = $_POST['mv_url'];

            $mvdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
            $mvdb->insert(
                "music_videos",
                array(
                    "title_ro" => "$title_ro",
                    "director" => "$director",
                    "date" => "$date",
                    "url" => "$mv_url"
                ) 
            );
        };
    ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>