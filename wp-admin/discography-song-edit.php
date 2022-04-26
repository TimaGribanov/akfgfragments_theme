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
$title       = __( 'New song' );
$this_file   = 'discography-song-edit.php';
$parent_file = 'discography-song.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$title = parse_url($url, PHP_URL_QUERY); //Get a query
$title_parsed = str_replace('_', ' ', $title); //Delete underscores if they exist
$title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
?>

<div class="wrap">
    <h1><?php global $title_parsed; esc_html_e( 'Edit song $title_parsed' ); ?></h1>
    <?php
    $discodb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
    $results = $discodb->get_results( "SELECT title_ja, title_ro, title_en, title_ru, title_es, title_de, title_fr, title_be, title_uk, title_fi, title_pt, spotify_uri FROM songs WHERE title_ro =  \"$title_parsed\";" );
    foreach ($results as $row) {
    ?>

    <form action="" method="POST">
        <div style="display: flex; width: 500px;">
            <div style="flex: 1;">
                <h3>Title*:</h3>
                <div>
                <table>
                        <tr>
                            <td><label for="title_ja">Japanese*: </label></td>
                            <td><input type="text" id="title_ja" name="title_ja" value="<?php echo $row->title_ja; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="title_ro">Romaji*: </label></td>
                            <td><input type="text" id="title_ro" name="title_ro" value="<?php echo $row->title_ro; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="title_en">English*: </label></td>
                            <td><input type="text" id="title_en" name="title_en" value="<?php echo $row->title_en; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="title_ru">Russian: </label></td>
                            <td><input type="text" id="title_ru" name="title_ru" value="<?php echo $row->title_ru; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="title_es">Spanish: </label></td>
                            <td><input type="text" id="title_es" name="title_es" value="<?php echo $row->title_es; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="title_de">German: </label></td>
                            <td><input type="text" id="title_de" name="title_de" value="<?php echo $row->title_de; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="title_fr">French: </label></td>
                            <td><input type="text" id="title_fr" name="title_fr" value="<?php echo $row->title_fr; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="title_be">Belarusian: </label></td>
                            <td><input type="text" id="title_be" name="title_be" value="<?php echo $row->title_be; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="title_uk">Ukrainian: </label></td>
                            <td><input type="text" id="title_uk" name="title_uk" value="<?php echo $row->title_uk; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="title_fi">Finnish: </label></td>
                            <td><input type="text" id="title_fi" name="title_fi" value="<?php echo $row->title_fi; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="title_pt">Portuguese: </label></td>
                            <td><input type="text" id="title_pt" name="title_pt" value="<?php echo $row->title_pt; ?>"></td>
                        </tr>
                    </table>
                </div><br>

                <label for="spotify_uri"><h3>Spotify URI:</h3></label>
                <input type="text" id="spotify_uri" name="spotify_uri" value="<?php echo $row->spotify_uri; ?>"><br><br>
            </div>
        <?php
        }
        ?>

            <div style="margin-right: 20px;">
                <h3>Lyrics:</h3>
                <p><em>Please add ONLY Japanese lyrics here. All other lyrics you will be able to add from the Edit menu.</em></p>
                    <!--
                    <label for="lyrics-lang">Language: </label>
                    <select type="text" id="lyrics-lang" name="lyrics-lang">
                        <option value="ja">Japanese</option>
                        <option value="ro">romaji</option>
                        <option value="en">English</option>
                        <option value="ru">Russian</option>
                        <option value="es">Spanish</option>
                        <option value="de">German</option>
                        <option value="fr">French</option>
                        <option value="be">Belarusian</option>
                        <option value="uk">Ukrainian</option>
                        <option value="fi">Finnish</option>
                        <option value="py">Portuguese</option>
                    </select><br>
                    -->
                    <textarea name="lyrics-text" style="width: 400px; height: 424px;"></textarea>
            </div>
        </div>
        <input type="submit" name="submit" value="Update song">
    </form>

    <?php
        if (isset($_POST['submit'])) {
            $title_ja = $_POST['title_ja'];
            $title_ro = $_POST['title_ro'];
            $title_en = $_POST['title_en'];
            $title_ru = $_POST['title_ru'];
            $title_es = $_POST['title_es'];
            $title_de = $_POST['title_de'];
            $title_fr = $_POST['title_fr'];
            $title_be = $_POST['title_be'];
            $title_uk = $_POST['title_uk'];
            $title_fi = $_POST['title_fi'];
            $title_pt = $_POST['title_pt'];
            $spotify_uri = $_POST['spotify_uri'];
            $lyrics = nl2br($_POST['lyrics-text']);

            $song_id_arr = $discodb->get_results( "SELECT id FROM songs WHERE title_ro = \"$title_ro\";" );
            $song_id = $song_id_arr["0"]->id;
            $discodb->update(
                "songs",
                array(
                    "title_ja" => "$title_ja",
                    "title_ro" => "$title_ro",
                    "title_en" => "$title_en",
                    "title_ru" => "$title_ru",
                    "title_es" => "$title_es",
                    "title_de" => "$title_de",
                    "title_fr" => "$title_fr",
                    "title_be" => "$title_be",
                    "title_uk" => "$title_uk",
                    "title_fi" => "$title_fi",
                    "title_pt" => "$title_pt",
                    "spotify_uri" => "$spotify_uri"
                ),
                array( "ID" => $song_id )
            );
            $song_id = $discodb->get_results( "SELECT id FROM songs WHERE title_ja = \"$title_ja\";" );
            foreach ($song_id as $row) {
                $discodb->insert(
                    "lyrics",
                    array(
                        "song_id" => "$row->id",
                        "band_id" => "1",
                        "lang" => "ja",
                        "text" => "$lyrics"
                    )
                );
            }
        }
    ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>