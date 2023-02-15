<?php
/**
 * Music Videos New Administration Screen.
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
                <script type="text/javascript">
                    (function($) {

                        $(document).on('click', '.song-button', function() {
                            $('#title_ro').val( $(this).find('.song-title').text() );
                        })

                    })( jQuery );
                </script>
                <label for="title_ro"><h3>Song*:</h3></label>
                <input type="text" id="title_ro" name="title_ro">
                <div id="song-search-list"></div>
                <script type="text/javascript">
                    document.getElementById('title_ro').addEventListener('keyup', findSongs);

                    function findSongs() {
                        let queryParam = document.getElementById('title_ro').value;
                        let searchString = 'param=' + queryParam;

                        //AJAX to search for songs
                        if (queryParam) {
                            (function($) {
                                $.ajax({
                                    type: "POST",
                                    url: "/wp-admin/discography-release-new-query.php",
                                    data: searchString,
                                    cache: false,
                                    success: function(html) {
                                        document.getElementById('song-search-list').innerHTML = html
                                    }
                                });
                            })( jQuery );
                        } else {
                            document.getElementById('song-search-list').innerHTML = '';
                        }
                        
                        return false;
                    }
                </script>

                <script type="text/javascript">
                    (function($) {

                        $(document).on('click', '.name-button', function() {
                            $('#director').val( $(this).find('.name-en').text() );
                            $('#director-id').val( $(this).find('.name-id').text() );
                        })

                    })( jQuery );
                </script>
                <label for="director"><h3>Director:</h3></label>
                <input type="text" id="director" name="director">
                <input type="text" id="director-id" name="director-id" hidden><br>
                <div id="name-search-list"></div>
                <script type="text/javascript">
                    document.getElementById('director').addEventListener('keyup', findNames);

                    function findNames() {
                        let queryParam = document.getElementById('director').value;
                        let searchString = 'param=' + queryParam;

                        //AJAX to search for names
                        if (queryParam) {
                            (function($) {
                                $.ajax({
                                    type: "POST",
                                    url: "/wp-admin/personnel-query.php",
                                    data: searchString,
                                    cache: false,
                                    success: function(html) {
                                        document.getElementById('name-search-list').innerHTML = html
                                    }
                                });
                            })( jQuery );
                        } else {
                            document.getElementById('name-search-list').innerHTML = '';
                        }
                        
                        return false;
                    }
                </script>

                <label for="date"><h3>Year:</h3></label>
                <input type="text" id="date" name="date" minlength="4" maxlength="4"><br>
                <label for="mv_url"><h3>MV URL:</h3></label>
                <input type="text" id="mv_url" name="mv_url"><br>
                <label for="mv_type"><h3>Type:</h3></label>
                <select id="mv_type" name="mv_type">
                    <option value="youtube">YouTube</option>
                    <option value="local">Local Video</option>
                </select><br><br>
            </div>
        </div>
        <input type="submit" name="submit" value="Add music video">
    </form>

    <?php
        if (isset($_POST['submit'])) {
            $title_ro = stripslashes($_POST['title_ro']);
            $director = $_POST['director-id'];
            $strdate = $_POST['date'];
            $mv_url = $_POST['mv_url'];
            $mv_type = $_POST['mv_type'];

            $date = "$strdate-01-01";

            $mvdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
            $mvdb->insert(
                "music_videos",
                array(
                    "title_ro" => "$title_ro",
                    "director" => "$director",
                    "date" => "$date",
                    "url" => "$mv_url",
                    "type" => "$mv_type"
                ) 
            );

            echo "<meta http-equiv='refresh' content='0'>";
        };
    ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>