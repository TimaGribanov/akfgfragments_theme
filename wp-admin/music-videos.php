<?php
/**
 * Discography Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title       = __( 'Music Videos' );
$this_file   = 'music-videos.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e( 'Music Videos Management' ); ?></h1>
    <a class="page-title-action" href="/wp-admin/music-videos-new.php">Add new</a>
    <hr class="wp-header-end">
    <h2 class="screen-reader-text">Filter music videos</h2>
    
    <div>
    <?php
        $mvdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
        $results = $mvdb->get_results( "SELECT * FROM music_videos ORDER BY id ASC;" );
        
        echo "<table class='wp-list-table widefat fixed striped table-view-list pages'>";
            echo "<thead>";
            echo "<tr>"; //Header
                echo "<th>Title</th>";
                echo "<th>Director</th>";
                echo "<th>Date</th>";
                echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";

            echo "<tbody id='the-list'>";
            foreach ($results as $row) {
                $title_parsed = str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_',$row->title_ro)))));
                echo "<tr>";
                    echo "<td><a href='/song?$title_parsed' target='_blank'>$row->title_ro</a></td>";
                    echo "<td>$row->director</td>";
                    echo "<td>$row->date</td>";
                    echo "<td><a href='/wp-admin/music-videos-edit.php?$title_parsed' target='_blank'>Edit</a> Delete</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        echo "</table>";
    ?>
    </div>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>