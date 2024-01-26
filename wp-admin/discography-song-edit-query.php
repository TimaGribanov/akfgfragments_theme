<?php
/**
 * Discography Songs Administration Screen – Edit song – Query.
 *
 * @package WordPress
 * @subpackage Administration
 */

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/admin.php';
require_once(get_theme_root() . "/akfgfragments/parse_url.php");

$title = $_POST['song'];
$title_parsed = str_replace('_', ' ', $title); //Delete underscores if they exist
$title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
$title_parsed = str_replace('%26', '&', $title_parsed); //Change %26 to an ampersand
$title_parsed = str_replace('%23', '#', $title_parsed); //Change %23 to a number sign
$title_parsed = str_replace('%3F', '?', $title_parsed); //Change %3F to a question mark
$title_parsed = str_replace('=', '', $title_parsed);
$title_parsed = str_parsed('%2F', '/', $title_parsed);

$lang = $_POST['lang'];

$lyricsdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
$song_id_arr = $lyricsdb->get_results( "SELECT id FROM songs WHERE title_ro = \"$title_parsed\";" );
$song_id = $song_id_arr["0"]->id;
$lyrics = $lyricsdb->get_results( "SELECT text FROM lyrics WHERE song_id = \"$song_id\" AND lang = \"$lang\";" );

foreach ($lyrics as $row) {
    $breaks = array("<br />","<br>","<br/>","<br />","&lt;br /&gt;","&lt;br/&gt;","&lt;br&gt;");
    $text = str_ireplace($breaks, "\n", $row->text);
    echo $text;
}
?>