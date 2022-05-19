<?php
/**
 * Discography Releases Administration Screen – Add new.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title       = __( 'Edit release' );
$this_file   = 'discography-release-edit.php';
$parent_file = 'discography-release.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$title = parse_url($url, PHP_URL_QUERY); //Get a query
$title_parsed = str_replace('_', ' ', $title); //Delete underscores if they exist
$title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
$title_parsed = str_replace('%26', '&', $title_parsed); //Cahnge %26 to an ampersand
$title_parsed = str_replace('%23', '#', $title_parsed); //Cahnge %23 to a number sign
$title_parsed = str_replace('%3F', '?', $title_parsed); //Cahnge %3F to a question mark
?>

<div class="wrap">
    <h1><?php global $title_parsed; esc_html_e( 'Edit release: ' . $title_parsed ); ?></h1>
    <?php
    $discodb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
    $results = $discodb->get_results( "SELECT r.title_ja, r.title_ro, r.title_en, r.title_ru, r.title_es, r.title_de, r.title_fr, r.title_be, r.title_uk, r.title_fi, r.title_pt, r.type, r.date, r.catalogue, r.spotify_uri, r.img_uri FROM releases r WHERE title_ro =  \"$title_parsed\";" );
    foreach ($results as $row) {
    ?>
    
    <form action="" method="POST">
        <div style="display: flex; width: 100%;">
            <div style="flex: 0 0 30%;">
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
                <label for="type"><h3>Type*:</h3></label>
                <select type="text" id="type" name="type">
                    <?php
                    #$discodb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
                    $types = $discodb->get_results( "SELECT * FROM types;" );
                    foreach ($types as $type) {
                        if($row->type == $type->id) {
                            
                            echo "<option selected value='$type->id'>$type->type</option>";
                        } else {
                            echo "<option value='$type->id'>$type->type</option>";
                        }
                    }
                    ?>
                </select><br><br>
                <label for="date"><h3>Date of release:</h3></label>
                <input type="date" id="date" name="date" value="<?php echo $row->date; ?>"><br><br>
                <label for="catalogue"><h3>Catalogue Number:</h3></label>
                <input type="text" id="catalogue" name="catalogue" value="<?php echo $row->catalogue; ?>"><br><br>
                <label for="spotify_uri"><h3>Spotify URI:</h3></label>
                <input type="text" id="spotify_uri" name="spotify_uri" value="<?php echo $row->spotify_uri; ?>"><br><br>
                <label for="img_uri"><h3>Cover Image URI:</h3></label>
                <input type="text" id="img_uri" name="img_uri" value="<?php echo $row->img_uri; ?>"><br><br>
                <input type="submit" name="submit" value="Update release">
            </div>
        <?php
        }
        ?>

            <div style="flex: 1;">
                <h3>Tracklist:</h3>
                
                <div id="song-list">
                <?php
                #$discodb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
                $songs = $discodb->get_results( "SELECT rs.release_pos, rs.song_id, s.title_ro FROM rel_songs rs JOIN releases r ON r.id = rs.release_id JOIN songs s ON s.id = rs.song_id WHERE r.title_ro = \"$title_parsed\";" );
                foreach ($songs as $song) {
                ?>
                    <span><?php echo $song->release_pos ?></span><input type="text" name="song[]" value="<?php echo $song->song_id ?>" style="display: none;"><input type="text" name="song-title[]" value="<?php echo $song->title_ro ?>"><br>
                <?php
                }
                $next_pos = $songs[count($songs) - 1]->release_pos + 1;
                ?>
                </div>
                <script type="text/javascript">
                    let i = <?php echo $next_pos; ?>;
                    (function($) {

                        $(document).on('click', '.song-button', function() {
                            $('#song-list').append( '<span>' + i + '</span><input type="text" name="song[]" value="' + $(this).find('.song-id').text() + '" style="display: none;"><input type="text" name="song-title[]" value="' + $(this).find('.song-title').text() + '"><br>' );
                            i++;
                        })

                    })( jQuery );
                </script>
                <input type="text" id="song-search" name="song-search" style="margin-top: 20px;">
                <div id="song-search-list"></div>
                <script type="text/javascript">
                    document.getElementById('song-search').addEventListener('keyup', findSongs);

                    function findSongs() {
                        let queryParam = document.getElementById('song-search').value;
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
            </div>
        </div>
    </form>

    <?php    
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
        if (isset($_POST['submit'])) {
            $title_ja = stripslashes($_POST['title_ja']);
            $title_ro = stripslashes($_POST['title_ro']);
            $title_en = stripslashes($_POST['title_en']);
            $title_ru = stripslashes($_POST['title_ru']);
            $title_es = stripslashes($_POST['title_es']);
            $title_de = stripslashes($_POST['title_de']);
            $title_fr = stripslashes($_POST['title_fr']);
            $title_be = stripslashes($_POST['title_be']);
            $title_uk = stripslashes($_POST['title_uk']);
            $title_fi = stripslashes($_POST['title_fi']);
            $title_pt = stripslashes($_POST['title_pt']);
            $type = $_POST['type'];
            $date = $_POST['date'];
            $catalogue = $_POST['catalogue'];
            $spotify_uri = $_POST['spotify_uri'];
            $img_uri = $_POST['img_uri'];
            $songs = $_POST['song'];
            $songs_count = count($songs);

            $discodb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
            $rel_id_arr = $discodb->get_results( "SELECT id FROM releases WHERE title_ro = \"$title_ro\";" );
            $rel_id = $rel_id_arr["0"]->id;
            $discodb->update(
                "releases",
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
                    "type" => "$type",
                    "date" => "$date",
                    "catalogue" => "$catalogue",
                    "spotify_uri" => "$spotify_uri",
                    "img_uri" => "$img_uri"
                ),
                array( "id" => $rel_id ) 
            );

            $i = 1;
            foreach ($songs as $song) {
                $rs_id_arr = $discodb->get_results( "SELECT id FROM rel_songs WHERE song_id = $song AND release_id = $rel_id;" );
                if (!empty($rs_id_arr)) {
                    $rs_id = $rs_id_arr["0"]->id;
                    $discodb->update(
                        "rel_songs",
                        array(
                            "release_id" => "$rel_id",
                            "song_id" => "$song",
                            "release_pos" => "$i"
                        ),
                        array ( "id" => $rs_id )
                    );
                } else {
                    $discodb->insert(
                        "rel_songs",
                        array(
                            "release_id" => "$rel_id",
                            "song_id" => "$song",
                            "release_pos" => "$i"
                        )
                    );
                }
                

                $i++;
            }
        }
    ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>