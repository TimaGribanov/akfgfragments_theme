<?php
/**
 * Links Edit Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title = __('Edit a links tree');
$this_file = 'links-edit.php';
$parent_file = 'links.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
  <h1><?php esc_html_e('Edit a links tree'); ?></h1>
  <form action="" method="POST">
    <div style="display: flex; width: 500px;">
      <div style="flex: 1;">
        <?php
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $id = parse_url($url, PHP_URL_QUERY); //Get a query
        
        $linksdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
        $results = $linksdb->get_results("SELECT * FROM links WHERE id = \"$id\";");
        foreach ($results as $row) {
          ?>
          <label for="title">
            <h3>Title (in English):</h3>
          </label>
          <input type="text" id="title" name="title" value="<?php echo $row->title; ?>">
          <label for="img_uri">
            <h3>Image URL (full):</h3>
          </label>
          <input type="text" id="img_uri" name="img_uri" value="<?php echo $row->img_uri; ?>">
          <label for="en">
            <h3>English:</h3>
          </label>
          <input type="text" id="en" name="en" value="<?php echo $row->en; ?>">
          <label for="ja">
            <h3>Japanese:</h3>
          </label>
          <input type="text" id="ja" name="ja" value="<?php echo $row->ja; ?>">
          <label for="de">
            <h3>German:</h3>
          </label>
          <input type="text" id="de" name="de" value="<?php echo $row->de; ?>">
          <label for="idd">
            <h3>Indonesian:</h3>
          </label>
          <input type="text" id="idd" name="idd" value="<?php echo $row->idd; ?>">
          <label for="ru">
            <h3>Russian:</h3>
          </label>
          <input type="text" id="ru" name="ru" value="<?php echo $row->ru; ?>">
          <label for="uk">
            <h3>Ukrainian:</h3>
          </label>
          <input type="text" id="uk" name="uk" value="<?php echo $row->uk; ?>">
          <label for="es">
            <h3>Spanish:</h3>
          </label>
          <input type="text" id="es" name="es" value="<?php echo $row->es; ?>">
          <?php
        }
        ?>
      </div>
    </div>
    <input type="submit" name="submit" value="Edit a links tree">
  </form>

  <?php
  if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $img_uri = $_POST['img_uri'];
    $en = $_POST['en'];
    $ja = $_POST['ja'];
    $de = $_POST['de'];
    $idd = $_POST['idd'];
    $ru = $_POST['ru'];
    $uk = $_POST['uk'];
    $es = $_POST['es'];

    $linksdb->update(
      "links",
      array(
        "title" => "$title",
        "img_uri" => "$img_uri",
        "en" => "$en",
        "ja" => "$ja",
        "de" => "$de",
        "idd" => "$idd",
        "ru" => "$ru",
        "uk" => "$uk",
        "es" => "$es"
      ),
      array("ID" => $id)
    );

    echo "<meta http-equiv='refresh' content='0'>";
  }
  ;
  ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>