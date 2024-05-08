<?php /* Template Name: Akfgfragments Music Video Page by Song */?>

<?php get_header(); ?>

<?php require(get_theme_root() . "/akfgfragments/get_people.php"); ?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
                <?php
                require(get_theme_root() . "/akfgfragments/parse_url.php");
                require_once(get_theme_root() . "/akfgfragments/normalise_title.php");
                $mvdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
                $results = $mvdb->get_results("SELECT * FROM music_videos WHERE title_ro = \"$title_parsed\";");
                $curr_locale = get_locale();

                if (!empty($results)) {
                    foreach ($results as $row) {
                        echo "<h1 class='song_title'>$row->title_ro</h1>";
                        if ($row->type == "youtube") {
                            echo "<div class='ratio ratio-16x9'><iframe
                            src='$row->url' title='$row->title_ro'
                            frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe></div>";
                        } else {
                            echo "<video controls class='mv-page-local'>
                            <source src='$row->url' type='video/mp4'>
                            </video>";
                        }

                        $dir_id = $row->director;
                        $dir = getName($dir_id, $curr_locale);

                        echo "<p class='mt-3 mb-1'><strong>" . __( 'Director', 'akfgfragments' ) . ":</strong> $dir</p>";
                        echo "<p class='mt-1 mb-1'><strong>" . __( 'Year', 'akfgfragments' ) . ":</strong> " . date("Y", strtotime("$row->date")) . "</p>";
                        echo "<p class='mt-1'><strong><a class='mv-link' href='/song?" . normaliseTitle($title_parsed) . "' target='_blank'>" . __( 'Info about the song', 'akfgfragments' ) . "</a></strong></p>";
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
