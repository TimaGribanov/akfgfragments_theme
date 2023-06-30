<?php /* Template Name: Akfgfragments Release */?>

<?php
function printCover($img)
{
    echo "<div class='row main-image-container'>"; //Album cover

    if (strpos($img, ",") === false) {
        echo "<img src='$img' />";
    } else {
        $img_uri_arr = explode(",", $img);

        foreach ($img_uri_arr as &$img) {
            echo "<img class='main-double-image' src='$img' />";
        }

        echo "<div class='main-double-image-arrows'>
            <i class='bi bi-chevron-left main-double-image-arrow main-double-image-arrow-left'></i>
            <i class='bi bi-chevron-right main-double-image-arrow main-double-image-arrow-right'></i>
            </div>";
    }

    echo "</div>";
}

function printReleaseType($type)
{
    echo "<div class='row'><p id='release-type'>";
    _e('Type of release:', 'akfgfragments');
    echo " " . $type . "</p></div>";
}

function dateBlock($format, $date)
{
    if ($format == "full") {
        $formatString = "jS F Y";
    } else {
        $formatString = "Y";
    }

    echo "<p id='release-date'>";
    _e('Release date:', 'akfgfragments');
    echo " " . date($formatString, strtotime("$date"));
    echo "</p>";
}

function printReleaseDate($date)
{


    echo "<div class='row'>";

    if ($date == "2000-01-01") {
        dateBlock("short", $date);
    } else {
        dateBlock("full", $date);
    }
    echo "</div>";
}

function printTracklist($tracklist)
{
    echo "<div class='row'>"; //Tracklist

    $tracklist_length = count($tracklist);

    echo "<h3>";
    _e('Tracklist:', 'akfgfragments');
    echo "</h3>";

    echo "<ol class='main-tracklist'>";

    for ($i = 0; $i < $tracklist_length; $i++) {
        $track = $tracklist["$i"]->title_ro;
        echo "<li><a class='main-tracklist-link' href='song?" . normaliseTitle($track) . "'>" . $track . "</a></li>";
    }

    echo "</ol>";

    echo "</div>";
}

function printSpotify($url)
{
    echo "<div class='row'>"; //Spotify

    if (strpos($url, ",") === false) {
        echo "<iframe style='border-radius:12px' src='https://open.spotify.com/embed/album/" . $url . "?utm_source=generator' width='60%' height='380' frameBorder='0' allowfullscreen='' allow='autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture'></iframe>";
    } else {
        $spotify_uri_arr = explode(",", $url);

        foreach ($spotify_uri_arr as &$uri) {
            echo "<iframe style='border-radius:12px' src='https://open.spotify.com/embed/album/" . $uri . "?utm_source=generator' width='60%' height='380' frameBorder='0' allowfullscreen='' allow='autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture'></iframe>";
        }
    }

    echo "</div>";
}
?>

<?php get_header(); ?>
<main role="main">
    <div class="container">
        <div id="main" class="row">
            <?php
            require(get_theme_root() . "/akfgfragments/parse_url.php");
            require(get_theme_root() . "/akfgfragments/normalise_title.php");

            //Connect to another DB containing discography data
            $releasedb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
            $results = $releasedb->get_results("SELECT r.title_ja, r.title_ro, r.title_en, r.title_ru, r.title_es, r.title_de, r.title_fr, r.title_be, r.title_uk, r.title_fi, r.title_pt, r.date, r.catalogue, r.spotify_uri, r.img_uri, t.type FROM releases r JOIN types t ON t.id = r.type WHERE title_ro =  \"$title_parsed\";");
            $tracklist = $releasedb->get_results("SELECT s.title_ro FROM rel_songs rs JOIN releases r ON r.id = rs.release_id JOIN songs s ON s.id = rs.song_id WHERE r.title_ro = \"$title_parsed\" ORDER BY rs.release_pos ASC;");
            ?>
            <!-- ON DESKTOP -->
            <div id="content" class="col-lg-9 col-md-12 col-sm-12 col-xs-12 d-none d-lg-block d-xl-block d-xxl-block">
                <div class="row">
                    <?php
                    global $results;
                    global $tracklist;

                    if (!empty($results)) {
                        foreach ($results as $row) {
                            echo "<h1 class='song_title'>$row->title_ro</h1>"; //Release title
                    
                            echo "<div class='col'>"; //The first col: Title translations, Type of release, Release date, Tracklist, Credits
                    
                            echo "<div class='row'>"; //Title translations
                            echo "<p class='title-trans'><span title='日本語' lang='ja-jp'>" . $row->title_ja . "</span>, <span title='English'>" . $row->title_en . "</span></p>";
                            echo "<p class='title-trans' id='open-hidden'>";
                            _e('more...', 'akfgfragments');
                            echo "</p>";
                            echo "<div id='hidden-translations' style='display:none;'>";
                            if ($row->title_de != "") {
                                echo "<p class='title-trans'><span title='Deutsch'>" . $row->title_de . "</span></p>";
                            }
                            if ($row->title_es != "") {
                                echo "<p class='title-trans'><span title='Español'>" . $row->title_es . "</span></p>";
                            }
                            if ($row->title_fr != "") {
                                echo "<p class='title-trans'><span title='Française'>" . $row->title_fr . "</span></p>";
                            }
                            if ($row->title_pt != "") {
                                echo "<p class='title-trans'><span title='Português'>" . $row->title_pt . "</span></p>";
                            }
                            if ($row->title_ru != "") {
                                echo "<p class='title-trans'><span title='Русский'>" . $row->title_ru . "</span></p>";
                            }
                            if ($row->title_uk != "") {
                                echo "<p class='title-trans'><span title='Українська'>" . $row->title_uk . "</span></p>";
                            }
                            if ($row->title_be != "") {
                                echo "<p class='title-trans'><span title='Беларуская'>" . $row->title_be . "</span></p>";
                            }
                            echo "</div>";
                            echo "</div>"; //End of title translations
                    
                            printReleaseType($row->type); //Release type
                    
                            printReleaseDate($row->date); //Release date
                    
                            printTracklist($tracklist); //Tracklist
                    
                            //echo "<div class='row'>"; //Credits
                            //echo "<h3>Credits:</h3>";
                            //echo "</div>"; //End of credits
                    
                            echo "<div class='row'>"; //Versions of releases
                            $catalogue_nums = explode(",", $row->catalogue);
                            if ($catalogue_nums[0] !== "") {
                                ?>
                                <h3><?php _e('Versions:', 'akfgfragments'); ?></h3>
                                <?php
                                foreach ($catalogue_nums as $num) {
                                    echo "<div class='row mb-2'>";
                                    echo "<input type='submit' class='rel-ver-btn' name='$num' value='$num'>";
                                    echo "<div id='version-info-$num' style='display: none;' class='ms-3'></div>";
                                    echo "</div>";
                                }
                            }

                            echo "</div>"; //End of versions
                    
                            echo "</div>"; //End of the first col
                    
                            echo "<div class='col'>"; //The second col: Album cover, Spotify
                    
                            printCover($row->img_uri); //Album cover
                    
                            printSpotify($row->spotify_uri); //Spotify
                    
                            echo "</div>"; //End of the second col
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- ON MOBILE -->
            <div id="content-mobile"
                class="col-lg-8 col-md-12 col-sm-12 col-xs-12 d-lg-none d-xl-none d-xxl-none d-block d-sm-block d-md-block">
                <div class="row">
                    <?php
                    global $results;
                    global $tracklist;

                    if (!empty($results)) {
                        foreach ($results as $row) {
                            echo "<h1 class='song_title'>$row->title_ro</h1>"; //Release title
                    
                            echo "<div class='col'>"; //The first col: Title translations, Type of release, Release date, Tracklist, Credits
                    
                            printCover($row->img_uri); //Album cover
                    
                            echo "<div class='row mb-2'>"; //Title translations
                            echo "<p class='title-trans mb-1'><span title='日本語' lang='ja-jp'>" . $row->title_ja . "</span></p>";
                            echo "<p class='title-trans mt-1 mb-1'><span title='English'>" . $row->title_en . "</span></p>";
                            if ($row->title_de != "") {
                                echo "<p class='title-trans mt-1 mb-1'><span title='Deutsch'>" . $row->title_de . "</span></p>";
                            }
                            if ($row->title_es != "") {
                                echo "<p class='title-trans mt-1 mb-1'><span title='Español'>" . $row->title_es . "</span></p>";
                            }
                            if ($row->title_fr != "") {
                                echo "<p class='title-trans mt-1 mb-1'><span title='Française'>" . $row->title_fr . "</span></p>";
                            }
                            if ($row->title_pt != "") {
                                echo "<p class='title-trans mt-1 mb-1'><span title='Português'>" . $row->title_pt . "</span></p>";
                            }
                            if ($row->title_ru != "") {
                                echo "<p class='title-trans mt-1 mb-1'><span title='Русский'>" . $row->title_ru . "</span></p>";
                            }
                            if ($row->title_uk != "") {
                                echo "<p class='title-trans mt-1 mb-1'><span title='Українська'>" . $row->title_uk . "</span></p>";
                            }
                            if ($row->title_be != "") {
                                echo "<p class='title-trans mt-1 mb-1'><span title='Беларуская'>" . $row->title_be . "</span></p>";
                            }
                            echo "</div>"; //End of title translations
                    
                            printReleaseType($row->type); //Release type
                    
                            printReleaseDate($row->date); //Release date
                    
                            printTracklist($tracklist); //Tracklist
                    
                            //echo "<div class='row'>"; //Credits
                            //echo "<h3>Credits:</h3>";
                            //echo "</div>"; //End of credits
                    
                            echo "<div class='row'>"; //Versions of releases
                            $catalogue_nums = explode(",", $row->catalogue);
                            if ($catalogue_nums[0] !== "") {
                                ?>
                                <h3><?php _e('Versions:', 'akfgfragments'); ?></h3>
                                <?php
                                foreach ($catalogue_nums as $num) {
                                    echo "<div class='row mb-2'>";
                                    echo "<input type='submit' class='rel-ver-btn' name='$num' value='$num'>";
                                    echo "<div id='version-info-$num-mobile' style='display: none;' class='ms-3'></div>";
                                    echo "</div>";
                                }
                            }

                            echo "</div>"; //End of versions
                    
                            printSpotify($row->spotify_uri); //Spotify
                    
                            echo "</div>"; //End of the first col
                        }
                    }
                    ?>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

<script type="text/javascript">
    //Show and hide 'more...'
    (function ($) {

        $('#open-hidden').on('click', function () {
            if ($('#hidden-translations').is(':hidden')) {
                $('#hidden-translations').show();
                $('#open-hidden').text('less...');
            } else {
                $('#hidden-translations').hide();
                $('#open-hidden').text('more...');
            }
        })

    })(jQuery);

    //Click through images
    (function ($) {

        $('.main-double-image-arrow-left').on('click', function () {
            var images = $('.main-image-container').find('.main-double-image');

            var currentIndex;
            images.each(function () {
                if ($(this).is(':visible')) {
                    currentIndex = $(images).index(this);
                }
            });

            $(images[currentIndex]).hide();
            $(images[currentIndex - 1]).show();
            $('.main-double-image-arrow-right').show();
            if (currentIndex - 1 == 0) {
                $('.main-double-image-arrow-left').hide();
            }
        });

        $('.main-double-image-arrow-right').on('click', function () {
            var images = $('.main-image-container').find('.main-double-image');

            var currentIndex;

            images.each(function () {
                if ($(this).is(':visible')) {
                    currentIndex = $(images).index(this);
                }
            });

            $(images[currentIndex]).hide();
            $(images[currentIndex + 1]).show();
            $('.main-double-image-arrow-left').show();
            if (currentIndex == images.length - 2) {
                $('.main-double-image-arrow-right').hide();
            }
        });

    })(jQuery);

    //Versions desktop
    $('.rel-ver-btn').click(function () {
        const cat = $(this).attr('name')
        const catHtml = cat.replace('.', '\\.') //needed for handling dots

        if ($(`#version-info-${catHtml}`).css('display') == 'none') {
            $.ajax({
                url: `/wp-content/themes/akfgfragments/get_catalogue_info.php?cat=${cat}`,
                success: function (response) {
                    $(`#version-info-${catHtml}`).html(response)
                    $(`#version-info-${catHtml}`).css({ display: "block" })
                }
            })
        }
        else {
            $(`#version-info-${catHtml}`).css({ display: "none" })
        }

    })

    //Versions mobile
    $('.rel-ver-btn').click(function () {
        const cat = $(this).attr('name')
        const catHtml = cat.replace('.', '\\.') //needed for handling dots

        if ($(`#version-info-${catHtml}-mobile`).css('display') == 'none') {
            $.ajax({
                url: `/wp-content/themes/akfgfragments/get_catalogue_info.php?cat=${cat}`,
                success: function (response) {
                    $(`#version-info-${catHtml}-mobile`).html(response)
                    $(`#version-info-${catHtml}-mobile`).css({ display: "block" })
                }
            })
        }
        else {
            $(`#version-info-${catHtml}-mobile`).css({ display: "none" })
        }

    })
</script>
</body>

</html>
