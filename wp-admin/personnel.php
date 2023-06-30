<?php
/**
 * Personnel Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title       = __( 'Personnel' );
$this_file   = 'personnel.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e( 'Personnel Management' ); ?></h1>
    <a class="page-title-action" href="/wp-admin/personnel-new.php">Add new</a>
    <hr class="wp-header-end">
    <h2 class="screen-reader-text">Filter people</h2>
    
    <div>
    <?php
        $mvdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
        $results = $mvdb->get_results( "SELECT * FROM personnel ORDER BY id ASC;" );
        
        echo "<table class='wp-list-table widefat fixed striped table-view-list pages'>";
            echo "<thead>";
            echo "<tr>"; //Header
                echo "<th>ID</th>";
                echo "<th>English</th>";
                echo "<th>Japanese</th>";
                echo "<th>Russian</th>";
                echo "<th>Ukrainian</th>";
                echo "<th>Belarusian</th>";
                echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";

            echo "<tbody id='the-list'>";
            foreach ($results as $row) {
                echo "<tr>";
                    echo "<td>$row->id</td>";
                    echo "<td>$row->en</td>";
                    echo "<td>$row->ja</td>";
                    echo "<td>$row->ru</td>";
                    echo "<td>$row->uk</td>";
                    echo "<td>$row->be</td>";
                    echo "<td><a href='/wp-admin/personnel-edit.php?$row->id' target='_blank'>Edit</a> Delete</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        echo "</table>";
    ?>
    </div>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>