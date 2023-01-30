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
$title       = __( 'Edit music video' );
$this_file   = 'music-video-edit.php';
$parent_file = 'music-video.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e( 'Edit music video' ); ?></h1>
    <form action="" method="POST">
        <div style="display: flex; width: 500px;">
            <div style="flex: 1;">
                <?php
                $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $title = parse_url($url, PHP_URL_QUERY); //Get a query
                $title_parsed = str_replace('_', ' ', $title); //Delete underscores if they exist
                $title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
                $title_parsed = str_replace('%26', '&', $title_parsed); //Change %26 to an ampersand
                $title_parsed = str_replace('%23', '#', $title_parsed); //Change %23 to a number sign
                $title_parsed = str_replace('%3F', '?', $title_parsed); //Change %3F to a question mark

                $mvdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
                $results = $mvdb->get_results( "SELECT * FROM music_videos WHERE title_ro = \"$title_parsed\";" );
                foreach ($results as $row) {
                ?>
                
                          
                <label for="title_ro"><h3>Song:</h3></label>
                <input type="text" id="title_ro" name="title_ro" value="<?php echo $row->title_ro; ?>" disabled>
                <label for="director"><h3>Director:</h3></label>
                <input type="text" id="director" name="director" value="<?php echo $row->director; ?>"><br>
                <label for="date"><h3>Date:</h3></label>
                <input type="date" id="date" name="date" value="<?php echo $row->date; ?>"><br>
                <label for="mv_url"><h3>MV URL:</h3></label>
                <input type="text" id="mv_url" name="mv_url" value="<?php echo $row->url; ?>"><br>
                <label for="mv_type"><h3>Type:</h3></label>
                <select id="mv_type" name="mv_type">
                    <?php 
                    if ($row->type == "youtube") {
                        echo "<option value='youtube' selected>YouTube</option><option value='local'>Local Video</option>";
                    } else {
                        echo "<option value='youtube'>YouTube</option><option value='local' selected>Local Video</option>";
                    }
                    ?>
                </select><br><br>
                <?php
                }
                ?>
            </div>
        </div>
        <input type="submit" name="submit" value="Edit music video">
    </form>

    <?php
        if (isset($_POST['submit'])) {
            $director = $_POST['director'];
            $date = $_POST['date'];
            $mv_url = $_POST['mv_url'];

            $mvdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
            $mv_id_arr = $mvdb->get_results( "SELECT id FROM music_videos WHERE title_ro = \"$title_parsed\";" );
            $mv_id = $mv_id_arr["0"]->id;
            $mvdb->update(
                "music_videos",
                array(
                    "director" => "$director",
                    "date" => "$date",
                    "url" => "$mv_url"
                ),
                array( "ID" => $mv_id )
            );

            echo "<meta http-equiv='refresh' content='0'>";
        };
    ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>