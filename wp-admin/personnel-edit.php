<?php
/**
 * Personnel Edit Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title = __('Edit a person');
$this_file = 'personnel-edit.php';
$parent_file = 'personnel.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e('Edit a person'); ?></h1>
    <form action="" method="POST">
        <div style="display: flex; width: 500px;">
            <div style="flex: 1;">
                <?php
                $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $id = parse_url($url, PHP_URL_QUERY); //Get a query
                
                $persondb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
                $results = $persondb->get_results("SELECT * FROM personnel WHERE id = \"$id\";");
                foreach ($results as $row) {
                    ?>
                    <label for="en">
                        <h3>English:</h3>
                    </label>
                    <input type="text" id="en" name="en" value="<?php echo $row->en; ?>">
                    <label for="ja">
                        <h3>Japanese:</h3>
                    </label>
                    <input type="text" id="ja" name="ja" value="<?php echo $row->ja; ?>">
                    <label for="ru">
                        <h3>Russian:</h3>
                    </label>
                    <input type="text" id="ru" name="ru" value="<?php echo $row->ru; ?>">
                    <label for="uk">
                        <h3>Ukrainian:</h3>
                    </label>
                    <input type="text" id="uk" name="uk" value="<?php echo $row->uk; ?>">
                    <label for="be">
                        <h3>Belarusian:</h3>
                    </label>
                    <input type="text" id="be" name="be" value="<?php echo $row->be; ?>">
                    <?php
                }
                ?>
            </div>
        </div>
        <input type="submit" name="submit" value="Edit a person">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $en = $_POST['en'];
        $ja = $_POST['ja'];
        $ru = $_POST['ru'];
        $uk = $_POST['uk'];
        $be = $_POST['be'];

        $persondb->update(
            "personnel",
            array(
                "en" => "$en",
                "ja" => "$ja",
                "ru" => "$ru",
                "uk" => "$uk",
                "be" => "$be"
            ),
            array("ID" => $id)
        );

        echo "<meta http-equiv='refresh' content='0'>";
    }
    ;
    ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>