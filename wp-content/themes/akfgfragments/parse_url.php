<?php
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$slug = parse_url($url, PHP_URL_PATH);
        $slug = str_replace('/', '', $slug);
        $slug = str_replace('_', ' ', $slug);
        $slug = ucwords($slug);
        
$title = parse_url($url, PHP_URL_QUERY); //Get a query
        $title_parsed = str_replace('_', ' ', $title); //Delete underscores if they exist
        $title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
        $title_parsed = str_replace('/', '', $title); //Delete slashes if they exist
        $title_parsed = str_replace('_', ' ', $title_parsed); //Delete underscores if they exist
        $title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
        $title_parsed = str_replace('%26', '&', $title_parsed); //Change %26 to an ampersand
        $title_parsed = str_replace('%23', '#', $title_parsed); //Change %26 to a number sign
        $title_parsed = str_replace('%3F', '?', $title_parsed); //Change %26 to a question mark
        $title_parsed = ucwords($title_parsed); //Capitalise each word
?>