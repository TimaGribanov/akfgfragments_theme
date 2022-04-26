<?php
/**
 * Discography Releases Administration Screen – Add new – Query.
 *
 * @package WordPress
 * @subpackage Administration
 */



require_once __DIR__ . '/admin.php';

$song = $_POST['param'];

$songsdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
$song_id_arr = $songsdb->get_results( "SELECT id, title_ja, title_ro, title_en FROM songs WHERE title_ro LIKE \"$song%\" OR title_ja LIKE \"$song%\" OR title_en LIKE \"$song%\";" );
$song_id_arr_length = count($song_id_arr);

$i = 0;

foreach ($song_id_arr as $song_id) {
?>
    <table>
        <tbody>
            <tr class="song-button" style="cursor: pointer;">
                <td><span class="song-id"><?php echo $song_id->id; ?></span></td>
                <td><?php echo $song_id->title_ja; ?></td>
                <td><span class="song-title"><?php echo $song_id->title_ro; ?></span></td>
                <td><?php echo $song_id->title_en; ?></td>
            </tr>
        </tbody>
    </table>
<?php
$i++;
}
?>