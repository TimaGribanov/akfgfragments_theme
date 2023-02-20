<?php /* Template Name: Akfgfragments Interview */?>

<?php get_header(); ?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
                <?php
                $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                $slug = parse_url($url, PHP_URL_PATH);
                $slug = str_replace('/', '', $slug);
                $slug = str_replace('_', ' ', $slug);
                $slug = ucwords($slug);
                
                $query = parse_url($url, PHP_URL_QUERY); //Get a query
                parse_str($query, $query_arr);
                $int_slug = $query_arr['slug'];
                $lang = $query_arr['lang'];

                $intdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
                $results = $intdb->get_results("SELECT i.date AS `date`, i.cover AS `cover`, it.title AS `title`, it.text AS `text` FROM interviews i JOIN interviews_text it ON i.id = it.interview_id WHERE i.slug = \"$int_slug\" AND it.lang = \"$lang\";");

                if (!empty($results)) {
                    foreach ($results as $row) {
                        echo "<h1 class='interview_title'>$row->title</h1>";
                        echo "<p><strong>" . __( 'Date of the interview', 'akfgfragments' ) . ":</strong> " . date("Y", strtotime("$row->date")) . "</p>";
                        $text_parsed = str_replace('\\\'', '\'', $row->text);
                        $text_parsed = str_replace('\"', '"', $text_parsed);
                        echo "<div id='interview_text'>$text_parsed</div>";
                    }
                }
                ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

</body>

</html>