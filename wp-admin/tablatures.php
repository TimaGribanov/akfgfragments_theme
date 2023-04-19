<?php
/**
 * Discography Tabs Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title       = __( 'Tablatures' );
$this_file   = 'tablatures.php';
$parent_file = 'tablatures.php';

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$query = parse_url($url, PHP_URL_QUERY); //Get a $query
if(strpos($query, "search=") !== false) {
    $search_pre = substr($query, strpos($query, "search=")); //Search query with name
    $search = substr($search_pre, 7); //Search query
}

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Tablatures' ); ?></h1>
    <a class="page-title-action" href="/wp-admin/tablatures-new.php">Add new</a>
    <hr class="wp-header-end">
    <h2 class="screen-reader-text">Filter tabs list</h2>
    
    <div>
    <?php
        global $search;

        $tabsdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
        $results = $tabsdb->get_results("SELECT s.title_ro AS `title` FROM tabs t JOIN songs s ON t.song_id = s.id GROUP BY t.song_id ORDER BY s.title_ro ASC");
        
        echo "<table class='wp-list-table widefat fixed striped table-view-list pages'>";
            echo "<thead>";
            echo "<tr>"; //Header
                echo "<th>Title</th>";
                echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";

            echo "<tbody id='the-list'>";
            foreach ($results as $row) {
                $title_parsed = str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_',$row->title)))));
                echo "<tr>";
                    echo "<td><a href='/song-tabs?$title_parsed' target='_blank'>$row->title</a></td>";
                    echo "<td><a href='/song-tabs?$title_parsed' target='_blank'>View</a> Edit Delete</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        echo "</table>";
    ?>
    </div>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>