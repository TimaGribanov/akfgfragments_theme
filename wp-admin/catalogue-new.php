<?php
/**
 * Catalogue Number New Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title = __('Add a catalogue version');
$this_file = 'catalogue-new.php';
$parent_file = 'catalogue.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e('Add a catalogue version'); ?></h1>
    <form action="" method="POST">
        <div style="display: flex; width: 500px;">
            <div style="flex: 1;">
                <label for="num">
                    <h3>Catalogue number*:</h3>
                </label>
                <input type="text" id="num" name="num" required>
                <label for="info">
                    <h3>Info*:</h3>
                    <h5>Only English for now, sorry. It'll be fixed.</h5>
                </label>
                <textarea id="info" name="info" style="width: 400px; height: 424px;" required></textarea>
            </div>
        </div>
        <br>
        <input type="submit" name="submit" value="Add a version">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $num = $_POST['num'];
        $info = nl2br($_POST['info'], false);
        $info = preg_replace("/[\r\n]*/", "", $info);

        $catdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
        $catdb->insert(
            "catalogue",
            array(
                "num" => "$num",
                "info" => "$info"
            )
        );

        echo "<meta http-equiv='refresh' content='0'>";
    }
    ;
    ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>