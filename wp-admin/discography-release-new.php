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
$title       = __( 'New release' );
$this_file   = 'discography-release-new.php';
$parent_file = 'discography-release.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e( 'New release' ); ?></h1>
    <form action="" method="POST">
        <div style="display: flex; width: 500px;">
            <div style="flex: 1;">
                <h3>Title:</h3>
                <div>
                    <label for="title_ja">Japanese*: </label><input type="text" id="title_ja" name="title_ja"><br>
                    <label for="title_ro">Romaji*: </label><input type="text" id="title_ro" name="title_ro"><br>
                    <label for="title_en">English*: </label><input type="text" id="title_en" name="title_en"><br>
                    <label for="title_ru">Russian: </label><input type="text" id="title_ru" name="title_ru"><br>
                    <label for="title_es">Spanish: </label><input type="text" id="title_es" name="title_es"><br>
                    <label for="title_de">German: </label><input type="text" id="title_de" name="title_de"><br>
                    <label for="title_fr">French: </label><input type="text" id="title_fr" name="title_fr"><br>
                    <label for="title_be">Belarusian: </label><input type="text" id="title_be" name="title_be"><br>
                    <label for="title_uk">Ukrainian: </label><input type="text" id="title_uk" name="title_uk"><br>
                    <label for="title_fi">Finnish: </label><input type="text" id="title_fi" name="title_fi"><br>
                    <label for="title_pt">Portuguese: </label><input type="text" id="title_pt" name="title_pt">
                </div><br>
                <label for="type"><h3>Type*:</h3></label>
                <select type="text" id="type" name="type">
                    <?php
                    $discodb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
                    $types = $discodb->get_results( "SELECT * FROM types;" );
                    foreach ($types as $row) {
                        echo "<option value='$row->id'>$row->type</option>";
                    }
                    ?>
                </select><br><br>
                <label for="date"><h3>Date of release:</h3></label>
                <input type="date" id="date" name="date"><br><br>
                <label for="catalogue"><h3>Catalogue Number:</h3></label>
                <input type="text" id="catalogue" name="catalogue"><br><br>
                <label for="spotify_uri"><h3>Spotify URI:</h3></label>
                <input type="text" id="spotify_uri" name="spotify_uri"><br><br>
                <label for="img_uri"><h3>Cover Image URI:</h3></label>
                <input type="text" id="img_uri" name="img_uri"><br><br>
                <input type="submit" name="submit">
            </div>

            <div style="margin-right: 20px;">
                <h3>Tracklist:</h3>
            </div>
        </div>
    </form>

    <?php
        if (isset($_POST['submit'])) {
            $title_ja = $_POST['title_ja'];
            $title_ro = $_POST['title_ro'];
            $title_en = $_POST['title_en'];
            $type = $_POST['type'];

            $discodb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
            $discodb->insert(
                "releases",
                array(
                    "title_ja" => "$title_ja",
                    "title_ro" => "$title_ro",
                    "title_en" => "$title_en",
                    "type" => "$type"
                ) 
            );
        }
    ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>