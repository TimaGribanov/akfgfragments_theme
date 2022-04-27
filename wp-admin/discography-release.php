<?php
/**
 * Discography Releases Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title       = __( 'Releases' );
$this_file   = 'discography-release.php';
$parent_file = 'discography-release.php';

$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$query = parse_url($url, PHP_URL_QUERY); //Get a $query
$type_pre = substr($query, strpos($variable, "release_type=")); //Release type with name
$type = substr($type_pre, 13); //Release type
$search_pre = substr($query, strpos($variable, "search=")); //Search query with name
$search = substr($search_pre, 7); //Search query

require_once ABSPATH . 'wp-admin/admin-header.php';
?>

<div class="wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Releases' ); ?></h1>
    <a class="page-title-action" href="/wp-admin/discography-release-new.php">Add new</a>
    <hr class="wp-header-end">
    
    <ul class="subsubsub">
        <?php
        if (!$type) {
            echo "<li class='all'><a class='current' href='discography-release.php'>All</a></li>";
        } else {
            echo "<li class='all'><a href='discography-release.php'>All</a></li>";
        }
        if ($type == "album") {
            echo "<li class='albums'><a class='current' href='discography-release.php?release_type=album'>Albums</a></li>";
        } else {
            echo "<li class='albums'><a href='discography-release.php?release_type=album'>Albums</a></li>";
        }
        if ($type == "single") {
            echo "<li class='singles'><a class='current' href='discography-release.php?release_type=single'>Singles</a></li>";
        } else {
            echo "<li class='singles'><a href='discography-release.php?release_type=single'>Singles</a></li>";
        }
        if ($type == "mini-album") {
            echo "<li class='mini-albums'><a class='current' href='discography-release.php?release_type=mini-album'>Mini-albums</a></li>";
        } else {
            echo "<li class='mini-albums'><a href='discography-release.php?release_type=mini-album'>Mini-albums</a></li>";
        }
        if ($type == "compilation") {
            echo "<li class='compilations'><a class='current' href='discography-release.php?release_type=compilation'>Compilations</a></li>";
        } else {
            echo "<li class='compilations'><a href='discography-release.php?release_type=compilation'>Compilations</a></li>";
        }
        if ($type == "indie") {
            echo "<li class='indies'><a class='current' href='discography-release.php?release_type=indie'>Indies</a></li>";
        } else {
            echo "<li class='indies'><a href='discography-release.php?release_type=indie'>Indies</a></li>";
        }
        if ($type == "video") {
            echo "<li class='dvds'><a class='current' href='discography-release.php?release_type=video'>DVDs</a></li>";
        } else {
            echo "<li class='dvds'><a href='discography-release.php?release_type=video'>DVDs</a></li>";
        }
        if ($type == "other") {
            echo "<li class='other'><a class='current' href='discography-release.php?release_type=other'>Other</a></li>";
        } else {
            echo "<li class='other'><a href='discography-release.php?release_type=other'>Other</a></li>";
        }
        ?>
    </ul>

    <form action="" method="POST">
        <label class="screen-reader-text" for="release-search-input">Search releases:</label>
        <input id="release-search-input" type="search" name="search-rel" value="">
        <input id="search-submit" class="button" type="submit" value="Search releases" name="search-rel-btn">
    </form>
    <?php 
    global $url;
    if (isset($_POST['search-rel-btn'])) {
        $url_path = parse_url($url, PHP_URL_PATH);
        $search_query = $_POST['search-rel'];
        echo "<script type='text/javascript'>window.open('$url_path?search=$search_query','_self');</script>";
    }
    ?>

    <div>    
    <?php
        global $type;
        global $search;

        $discodb = new wpdb( DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST );
        if(!$search) {
            if (!$type) {
                $results = $discodb->get_results( "SELECT r.title_ro, t.type, r.catalogue, r.date FROM releases r JOIN types t ON r.type = t.id;" );
            } else {
                $results = $discodb->get_results( "SELECT r.title_ro, t.type, r.catalogue, r.date FROM releases r JOIN types t ON r.type = t.id WHERE t.type = \"$type\";" );
            }
        } else {
            $results = $discodb->get_results( "SELECT r.title_ro, t.type, r.catalogue, r.date FROM releases r JOIN types t ON r.type = t.id WHERE r.title_ro LIKE \"%$search%\";" );
        }
        
        echo "<table class='wp-list-table widefat fixed striped table-view-list pages'>";
            echo "<thead>";
            echo "<tr>"; //Header
                echo "<th>Title</th>";
                echo "<th id='title'>Type of release</th>";
                echo "<th>Catalogue No.</th>";
                echo "<th>Date of release</th>";
                echo "<th>Action</th>";
            echo "</tr>";
            echo "</thead>";

            echo "<tbody id='the-list'>";
            foreach ($results as $row) {
                $title_parsed = str_replace('?', '%3F', str_replace('#', '%23', str_replace('&', '%26', str_replace('\'', '%27', str_replace(' ', '_',$row->title_ro)))));
                echo "<tr>";
                    echo "<td><a href='/release?$title_parsed' target='_blank'>$row->title_ro</a></td>";
                    echo "<td>$row->type</td>";
                    echo "<td>$row->catalogue</td>";
                    echo "<td>$row->date</td>";
                    echo "<td><a href='/release?$title_parsed' target='_blank'>View</a> <a href='/wp-admin/discography-release-edit.php?$title_parsed' target='_blank'>Edit</a> Delete</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        echo "</table>";
    ?>
    </div>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>