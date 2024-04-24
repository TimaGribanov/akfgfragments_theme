<?php
/**
 * Links Administration Screen.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title       = __( 'Links' );
$this_file   = 'links.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e( 'Links Management' ); ?></h1>
    <a class="page-title-action" href="/wp-admin/links-new.php">Add new or edit existent</a>
    <hr class="wp-header-end">
    
    <div>
    <?php
        $intdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
        $results = $intdb->get_results( "SELECT * FROM links ORDER BY id;" );
        
        echo "<table class='wp-list-table widefat fixed striped table-view-list pages'>";
            echo "<thead>";
            echo "<tr>"; //Header
                echo "<th>ID</th>";
                echo "<th>Title</th>";
                echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";

            echo "<tbody id='the-list'>";
            foreach ($results as $row) {
                echo "<tr>";
                    echo "<td>$row->id</td>";
                    echo "<td>$row->title</td>";
                    echo "<td><a href='/wp-admin/links-edit.php?$row->id' target='_blank'>Edit</a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
        echo "</table>";
    ?>
    </div>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>