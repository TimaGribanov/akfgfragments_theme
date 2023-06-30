<?php
/**
 * Interviews Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title       = __( 'Interviews' );
$this_file   = 'interviews.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e( 'Interviews Management' ); ?></h1>
    <a class="page-title-action" href="/wp-admin/interviews-new.php">Add new or edit existent</a>
    <hr class="wp-header-end">
    <h2 class="screen-reader-text">Filter interviews</h2>
    
    <div>
    <?php
        $intdb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
        $results = $intdb->get_results( "SELECT i.id AS `id`, i.date AS `date`, i.slug AS `slug`, GROUP_CONCAT(it.lang) AS `lang` FROM interviews i, interviews_text it WHERE i.id=it.interview_id GROUP BY i.id;" );
        
        echo "<table class='wp-list-table widefat fixed striped table-view-list pages'>";
            echo "<thead>";
            echo "<tr>"; //Header
                echo "<th>ID</th>";
                echo "<th>Slug</th>";
                echo "<th>Date</th>";
                echo "<th>Languages</th>";
            echo "</tr>";
            echo "</thead>";

            echo "<tbody id='the-list'>";
            foreach ($results as $row) {
                echo "<tr>";
                    echo "<td>$row->id</td>";
                    echo "<td>$row->slug</td>";
                    echo "<td>$row->date</td>";
                    echo "<td>$row->lang</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        echo "</table>";
    ?>
    </div>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>