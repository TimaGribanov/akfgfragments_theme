<?php
/**
 * Tablatures New Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title = __('Add a tablature');
$this_file = 'tablatures-new.php';
$parent_file = 'tablatures.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e('Add a tablature'); ?></h1>
    <form action="" method="POST">
        <div style="display: flex; width: 500px;">
            <div style="flex: 1;">
                <script type="text/javascript">
                    (function ($) {

                        $(document).on('click', '.song-button', function () {
                            $('#title').val($(this).find('.song-title').text());
                        })

                    })(jQuery);
                </script>
                <label for="title">
                    <h3>Title:</h3>
                </label>
                <input type="text" id="title" name="title" required>
                <div id="song-search-list"></div>
                <script type="text/javascript">
                    document.getElementById('title').addEventListener('keyup', findSongs);

                    function findSongs() {
                        let queryParam = document.getElementById('title').value;
                        let searchString = 'param=' + queryParam;

                        //AJAX to search for songs
                        if (queryParam) {
                            (function ($) {
                                $.ajax({
                                    type: "POST",
                                    url: "/wp-admin/discography-release-new-query.php",
                                    data: searchString,
                                    cache: false,
                                    success: function (html) {
                                        document.getElementById('song-search-list').innerHTML = html
                                    }
                                });
                            })(jQuery);
                        } else {
                            document.getElementById('song-search-list').innerHTML = '';
                        }

                        return false;
                    }
                </script>

                <input type="hidden" name="gp" value="false">
                <label for="gp">
                    <h3>Guitar Pro:</h3>
                </label>
                <input type="checkbox" id="gp" name="gp" value="true">

                <input type="hidden" name="ms" value="false">
                <label for="ms">
                    <h3>MuseScore:</h3>
                </label>
                <input type="checkbox" id="ms" name="ms" value="true">
            </div>
        </div>
        <br>
        <input type="submit" name="submit" value="Add a tab">
    </form>

    <?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $gp = false;
        if ($_POST['gp'] == 'true') {
            $gp = true;
        }
        var_dump($gp);
        $ms = false;
        if ($_POST['ms'] == 'true') {
            $ms = true;
        }
        var_dump($ms);
        

        $tabsdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
        $song_id_arr = $tabsdb->get_results("SELECT id FROM songs WHERE title_ro = \"$title\";");
        $song_id = $song_id_arr["0"]->id;

        $title_parsed = str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_', $title)))));

        if ($gp == true) {
            $filename = $title_parsed . ".gp";
            var_dump($song_id);
            var_dump($filename);
            $tabsdb->insert(
                "tabs",
                array(
                    "song_id" => "$song_id",
                    "type" => "1",
                    "file" => "$filename"
                )
            );
        }

        if ($ms == true) {
            $filename = $title_parsed . ".mscz";
            $tabsdb->insert(
                "tabs",
                array(
                    "song_id" => "$song_id",
                    "type" => "2",
                    "file" => "$filename"
                )
            );
        }

        #echo "<meta http-equiv='refresh' content='0'>";
    }
    ;
    ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>