<?php
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$slug = parse_url($url, PHP_URL_PATH);
$slug = str_replace('/', '', $slug);
$slug = str_replace('_', ' ', $slug);
$slug = ucwords($slug);

$title = parse_url($url, PHP_URL_QUERY); //Get a query

if (str_contains($title, 'title=')) {
    $title = str_replace('title=', '', $title);
}

$title_parsed = str_replace('_', ' ', $title); //Delete underscores if they exist
$title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
$title_parsed = str_replace('/\'', '\'', $title_parsed); //Delete slashes if they exist
$title_parsed = str_replace('%26', '&', $title_parsed); //Change %26 to an ampersand
$title_parsed = str_replace('%23', '#', $title_parsed); //Change %26 to a number sign
$title_parsed = str_replace('%3F', '?', $title_parsed); //Change %26 to a question mark
$title_parsed = str_replace('%28', '(', $title_parsed); //Change %28 to an opening bracket
$title_parsed = str_replace('%29', ')', $title_parsed); //Change %29 to a closing bracket
$title_split = explode(" ", $title_parsed);
$particles_list = array("no", "wo", "de", "wa", "ni", "ga", "e", "mo", "kara", "made", "yo", "ne", "ka", "ya", "to");
foreach ($title_split as $part) {
    if (!in_array($part, $particles_list)) {
        $part = ucwords($part);
    }
}
$title_parsed = implode(" ", $title_split); //Capitalise each word
?>