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

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Songs' ); ?></h1>
    <a class="page-title-action" href="/wp-admin/discography-song-new.php">Add new</a>
    <hr class="wp-header-end">
    <h2 class="screen-reader-text">Filter releases list</h2>
    
    <div>
    <?php
        $discodb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
        $results = $discodb->get_results( "SELECT title_ro, title_ja, title_en FROM songs ORDER BY title_ro ASC;" );
        
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
                $title_parsed = str_replace('\'', '%27', str_replace(' ', '_', $row->title_ro));
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