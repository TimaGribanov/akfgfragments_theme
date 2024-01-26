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
$title = $output['title'];
$title = str_replace('%26', '&', $title);
$lang = $output['lang'];

//Connect to another DB containing discography data
$songdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);

if (mysqli_connect_errno()) {
    // Connection Error
    exit("Couldn't connect to the database: " . mysqli_connect_error());
}

$lyrics_results = $songdb->get_results("SELECT * FROM lyrics WHERE song_id = (SELECT id FROM songs WHERE title_ro = \"$title\") AND lang = \"$lang\"");

if (!empty($lyrics_results)) {
    foreach ($lyrics_results as $row) {
        $text_db = $row->text;
        $text_parsed = str_replace('\\\'', '\'', $text_db);
        if ($lang == 'ja') {
            echo "<div id='song-text' lang='ja-jp'>" . $text_parsed . "</div>";
        } else {
            echo "<div id='song-text'>" . $text_parsed . "</div>";
        }
    }
} else {
    switch ($lang) {
        case 'ja':
            $lang_full = __('Japanese', 'akfgfragments');
            break;
        case 'ro':
            $lang_full = __('romaji', 'akfgfragments');
            break;
        case 'en':
            $lang_full = __('English', 'akfgfragments');
            break;
        case 'fr':
            $lang_full = __('French', 'akfgfragments');
            break;
        case 'de':
            $lang_full = __('German', 'akfgfragments');
            break;
        case 'es':
            $lang_full = __('Spanish', 'akfgfragments');
            break;
        case 'pt':
            $lang_full = __('Portuguese', 'akfgfragments');
            break;
        case 'id':
            $lang_full = __('Indonesian', 'akfgfragments');
            break;
        case 'ru':
            $lang_full = __('Russian', 'akfgfragments');
            break;
        case 'uk':
            $lang_full = __('Ukrainian', 'akfgfragments');
            break;
        case 'be':
            $lang_full = __('Belarusian', 'akfgfragments');
            break;
        default:
            $lang_full = __('the selected language', 'akfgfragments');
    }
    echo "<div id='song-text'>";
    echo __('Sorry! This song\'s lyrics are not yet available in ', 'akfgfragments') . $lang_full . ".";
    echo "</div>";
}
?>