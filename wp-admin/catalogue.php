<?php
/**
 * CAtalogue Numbers Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title = __('Catalogue Numbers');
$this_file = 'catalogue.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e('Catalogue Numbers Management'); ?></h1>
    <a class="page-title-action" href="/wp-admin/catalogue-new.php">Add new</a>
    <hr class="wp-header-end">
    <h2 class="screen-reader-text">Filter catalogue numbers</h2>

    <div>
        <?php
        $catdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
        $results = $catdb->get_results("SELECT * FROM catalogue ORDER BY id ASC;");

        echo "<table class='wp-list-table widefat fixed striped table-view-list pages'>";
        echo "<thead>";
        echo "<tr>"; //Header
        echo "<th>ID</th>";
        echo "<th>Catalogue Number</th>";
        echo "<th>Info</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";

        echo "<tbody id='the-list'>";
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>$row->id</td>";
            echo "<td>$row->num</td>";
            echo "<td>$row->info</td>";
            echo "<td><a href='/wp-admin/catalogue-edit.php?$row->id' target='_blank'>Edit</a> Delete</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        ?>
    </div>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>