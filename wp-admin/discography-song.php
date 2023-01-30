<?php
/**
 * Discography Songs Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title       = __( 'Songs' );
$this_file   = 'discography-song.php';
$parent_file = 'discography-song.php';

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$query = parse_url($url, PHP_URL_QUERY); //Get a $query
if(strpos($query, "search=") !== false) {
    $search_pre = substr($query, strpos($query, "search=")); //Search query with name
    $search = substr($search_pre, 7); //Search query
}

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Songs' ); ?></h1>
    <a class="page-title-action" href="/wp-admin/discography-song-new.php">Add new</a>
    <hr class="wp-header-end">
    <h2 class="screen-reader-text">Filter songs list</h2>

    <form action="" method="POST">
        <label class="screen-reader-text" for="song-search-input">Search songs:</label>
        <input id="song-search-input" type="search" name="search-song" value="">
        <input id="search-submit" class="button" type="submit" value="Search songs" name="search-song-btn">
    </form>
    <?php 
    global $url;
    if (isset($_POST['search-song-btn'])) {
        $url_path = parse_url($url, PHP_URL_PATH);
        $search_query = $_POST['search-song'];
        echo "<script type='text/javascript'>window.open('$url_path?search=$search_query','_self');</script>";
    }
    ?>
    
    <div>
    <?php
        global $search;

        $discodb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
        if(!empty($search)) {
            $results = $discodb->get_results( "SELECT title_ro, title_ja, title_en FROM songs WHERE title_ro LIKE \"%$search%\" ORDER BY title_ro ASC;" );
        } else {
            $results = $discodb->get_results("SELECT title_ro, title_ja, title_en FROM songs ORDER BY title_ro ASC;");
        }
        
        echo "<table class='wp-list-table widefat fixed striped table-view-list pages'>";
            echo "<thead>";
            echo "<tr>"; //Header
                echo "<th>Title (romaji)</th>";
                echo "<th>Title (Japanese)</th>";
                echo "<th>Title (English)</th>";
                echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";

            echo "<tbody id='the-list'>";
            foreach ($results as $row) {
                $title_parsed = str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_',$row->title_ro)))));
                echo "<tr>";
                    echo "<td><a href='/song?$title_parsed' target='_blank'>$row->title_ro</a></td>";
                    echo "<td><a href='/song?$title_parsed' target='_blank'>$row->title_ja</a></td>";
                    echo "<td><a href='/song?$title_parsed' target='_blank'>$row->title_en</a></td>";
                    echo "<td><a href='/song?$title_parsed' target='_blank'>View</a> <a href='/wp-admin/discography-song-edit.php?$title_parsed' target='_blank'>Edit</a> Delete</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        echo "</table>";
    ?>
    </div>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>