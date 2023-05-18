<?php
function getInterviews($locale) {
    $intdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
    $results = $intdb->get_results("SELECT i.slug AS `slug`, i.date AS `date`, it.title AS `title` FROM interviews i JOIN interviews_text it ON i.id = it.interview_id WHERE it.lang = \"$locale\" ORDER BY i.date;");

    return $results;
}

function getSingleInterview($slug, $locale) {
    $intdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
    $results = $intdb->get_results("SELECT i.date AS `date`, i.cover AS `cover`, it.title AS `title`, it.text AS `text` FROM interviews i JOIN interviews_text it ON i.id = it.interview_id WHERE i.slug = \"$slug\" AND it.lang = \"$locale\";");

    return $results;
}

#https://wordpress.stackexchange.com/questions/38560/what-is-the-best-way-to-get-directory-path-for-wp-config-php
function find_wp_config_path()
{
    $dir = dirname(__FILE__);
    do {
        if (file_exists($dir . "/wp-config.php")) {
            return $dir;
        }
    } while ($dir = realpath("$dir/.."));
    return null;
}

if (!function_exists('add_action')) {
    include_once(find_wp_config_path() . '/wp-load.php');
}

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$query = parse_url($url, PHP_URL_QUERY); //Get a query
parse_str($query, $output);
$slug = $output['slug'];
$lang = $output['lang'];

if (empty($slug) || $slug == NULL) {
    $results = getInterviews($lang);

    if (!empty($results)) {
        foreach ($results as $row) {
            echo "<div class='row'>";
            echo "<h3><a class='interviews-links' href='/interview?slug=" . $row->slug . "&lang=" . $lang . "' target='_blank'>$row->title</a></h3>";
            echo "</div>";
        }
    }
} else {
    $results = getSingleInterview($slug, $lang);

    if (!empty($results)) {
        foreach ($results as $row) {
            echo "<h1 class='interview_title'>$row->title</h1>";
            echo "<p><strong>" . __( 'Date of the interview', 'akfgfragments' ) . ":</strong> " . date("Y", strtotime("$row->date")) . "</p>";
            $text_parsed = str_replace('\\\'', '\'', $row->text);
            $text_parsed = str_replace('\"', '"', $text_parsed);
            echo "<div id='interview_text'>$text_parsed</div>";
        }
    }
}
?>
