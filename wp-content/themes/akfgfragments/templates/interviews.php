<?php /* Template Name: Akfgfragments nterviews' List */?>

<?php get_header(); ?>

<?php require_once(get_theme_root() . "/akfgfragments/normalise_title.php"); ?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
                <?php
                $curr_locale = get_locale();
                $locale = substr($curr_locale, 0, 2);
                $intdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
                $results = $intdb->get_results("SELECT i.slug AS `slug`, i.date AS `date`, it.title AS `title` FROM interviews i JOIN interviews_text it ON i.id = it.interview_id WHERE it.lang = \"$locale\" ORDER BY i.date;");

                if (!empty($results)) {
                    foreach ($results as $row) {
                        echo "<div class='row'>";
                        echo "<h3><a class='interviews-links' href='/interview?slug=" . $row->slug . "&lang=" . $locale . "' target='_blank'>$row->title</a></h3>";
                        echo "</div>";
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