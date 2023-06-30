<?php
/**
 * Interviews New Administration Screen – Get Text Query.
 *
 * @package WordPress
 * @subpackage Administration
 */

require_once __DIR__ . '/admin.php';

$slug = $_POST['slug'];
$lang = $_POST['lang'];

$intdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
$int_id_arr = $intdb->get_results("SELECT id FROM interviews WHERE slug = \"$slug\";");
$int_id = $int_id_arr[0]->id;
$text_arr = $intdb->get_results("SELECT `text` FROM interviews_text WHERE interview_id = $int_id AND lang = \"$lang\";");

$breaks = array("<br />","<br>","<br/>","<br />","&lt;br /&gt;","&lt;br/&gt;","&lt;br&gt;");

$text = str_ireplace($breaks, "\n", $text_arr[0]->text);

if (empty($text)) {
    echo "";
} else {
    $text_parsed = str_replace('\\\'', '\'', $text);
    $text_parsed = str_replace('\"', '"', $text_parsed);
    echo $text_parsed;
}
?>