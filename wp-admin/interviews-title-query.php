<?php
/**
 * Interviews New Administration Screen – Get Title Query.
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
$text_arr = $intdb->get_results("SELECT `title` FROM interviews_text WHERE interview_id = $int_id AND lang = \"$lang\";");

$text = $text_arr[0]->title;

if (empty($text)) {
    echo "";
} else {
    echo $text;
}
?>