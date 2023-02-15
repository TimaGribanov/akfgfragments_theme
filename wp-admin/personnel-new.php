<?php
/**
 * Personnel New Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title       = __( 'Add a person' );
$this_file   = 'personnel-new.php';
$parent_file = 'personnel.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e( 'Add a person' ); ?></h1>
    <form action="" method="POST">
        <div style="display: flex; width: 500px;">
            <div style="flex: 1;">
                <label for="en"><h3>English*:</h3></label>
                <input type="text" id="en" name="en" required>
                <label for="ja"><h3>Japanese*:</h3></label>
                <input type="text" id="ja" name="ja" required>
                <label for="ru"><h3>Russian:</h3></label>
                <input type="text" id="ru" name="ru">
                <label for="uk"><h3>Ukrainian:</h3></label>
                <input type="text" id="uk" name="uk">
                <label for="be"><h3>Belarusian:</h3></label>
                <input type="text" id="be" name="be">
            </div>
        </div>
        <br>
        <input type="submit" name="submit" value="Add a person">
    </form>

    <?php
        if (isset($_POST['submit'])) {
            $en = $_POST['en'];
            $ja = $_POST['ja'];
            $ru = $_POST['ru'];
            $uk = $_POST['uk'];
            $be = $_POST['be'];

            $persondb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
            $persondb->insert(
                "personnel",
                array(
                    "en" => "$en",
                    "ja" => "$ja",
                    "ru" => "$ru",
                    "uk" => "$uk",
                    "be" => "$be"
                )
            );

            echo "<meta http-equiv='refresh' content='0'>";
        };
    ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>