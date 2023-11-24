<?php
/**
 * Catalogue Number Edit Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title = __('Edit a catalogue version');
$this_file = 'catalogue-edit.php';
$parent_file = 'catalogue.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e('Edit a catalogue version'); ?></h1>
    <form action="" method="POST">
        <div style="display: flex; width: 500px;">
            <div style="flex: 1;">
                <?php
                $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $id = parse_url($url, PHP_URL_QUERY); //Get a query
                
                $catdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
                $results = $catdb->get_results("SELECT * FROM catalogue WHERE id = \"$id\";");
                foreach ($results as $row) {
                    ?>
                    <label for="num">
                        <h3>Catalogue number*:</h3>
                    </label>
                    <input type="text" id="num" name="num" value="<?php echo $row->num; ?>" required>
                    <label for="info">
                        <h3>Info*:</h3>
                        <h5>Only English now, sorry. It'll be fixed</h5>
                    </label>
                    <?php
                    $breaks = array("<br />","<br>","<br/>","<br />","&lt;br /&gt;","&lt;br/&gt;","&lt;br&gt;");
                    $info_text = str_ireplace($breaks, "\n", $row->info);
                    ?>
                    <textarea id="info" name="info" style="width: 400px; height: 424px;" required><?php echo $info_text; ?></textarea>
                    <?php
                }
                ?>
            </div>
        </div>
        <br>
        <input type="submit" name="submit" value="Edit a version">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $num = $_POST['num'];
        $info = nl2br($_POST['info'], false);
        $info = preg_replace("/[\r\n]*/", "", $info);

        $catdb->update(
            "catalogue",
            array(
                "num" => "$num",
                "info" => "$info"
            ),
            array("ID" => $id)
        );

        echo "<meta http-equiv='refresh' content='0'>";
    }
    ;
    ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>