<?php /* Template Name: Akfgfragments Music Video Page by Song */?>

<?php get_header(); ?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
                <?php
                require(get_theme_root() . "/akfgfragments/parse_url.php");
                require_once(get_theme_root() . "/akfgfragments/normalise_title.php");
                $mvdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
                $results = $mvdb->get_results("SELECT * FROM music_videos WHERE title_ro = \"$title_parsed\";");

                if (!empty($results)) {
                    foreach ($results as $row) {
                        echo "<h1 class='song_title'>$row->title_ro</h1>";
                        if ($row->type == "youtube") {
                            echo "<iframe class='mv-page-youtube'
                            src='$row->url' title='$row->title_ro'
                            frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>";
                        } else {
                            echo "<video controls class='mv-page-local'>
                            <source src='$row->url' type='video/mp4'>
                            </video>";
                        }
                        echo "<p><strong>" . __( 'Director', 'akfgfragments' ) . ":</strong> $row->director</p>";
                        echo "<p><strong>" . __( 'Year', 'akfgfragments' ) . ":</strong> " . date("Y", strtotime("$row->date")) . "</p>";
                        echo "<p><strong><a class='mv-link' href='/song?" . normaliseTitle($title_parsed) . "' target='_blank'>Info about the song</a></strong></p>";
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