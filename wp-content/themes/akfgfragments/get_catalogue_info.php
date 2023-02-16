<?php
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
$cat = $output['cat'];

//Connect to another DB containing discography data
$catdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);

if (mysqli_connect_errno()) {
    // Connection Error
    exit("Couldn't connect to the database: " . mysqli_connect_error());
}

$cat_results = $catdb->get_results("SELECT * FROM catalogue WHERE num = \"$cat\"");

if (!empty($cat_results)) {
    foreach ($cat_results as $row) {
        $cat_info = $row->info;
        echo $cat_info;
    }
} else {
    echo __('Sorry! There\'s no information about this version.', 'akfgfragments');
}
?>