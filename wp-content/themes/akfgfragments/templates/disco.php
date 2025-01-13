<?php /* Template Name: Akfgfragments Discography List */?>

<?php get_header(); ?>
<?php require(get_theme_root() . "/akfgfragments/normalise_title.php"); ?>

<?php
function pluraliseTypes($input, $locale)
{
    $plural_form = "";

    if ($locale == 'de_DE') {
        switch ($input) {
            case 'album':
                $plural_form = 'alben';
                break;
            case 'mini-album':
                $plural_form = 'mini-alben';
                break;
            case 'kompilation':
                $plural_form = 'kompilationen';
                break;
            case 'videoalbum':
                $plural_form = 'videoalben';
                break;
            default:
                $plural_form = $input . "s";
                break;
        }
    } elseif ($locale == 'id_ID') {
        $plural_form = $input;
    }elseif ($locale == 'ru_RU') {
        if ($input == 'видео' || $input == 'другое' || $input == 'инди') {
            $plural_form = $input;
        } elseif ($input == 'сборник') {
            $plural_form = 'сборники';
        } else {
            $plural_form = $input . "ы";
        }
    } elseif ($locale == 'uk') {
        if ($input == 'збірка') {
            $plural_form = 'збірки';
        } elseif ($input == 'альбом' || $input == 'сингл' || $input == 'міні-альбом') {
            $plural_form = $input . "и";
        } else {
            $plural_form = $input;
        }
    } elseif ($locale == 'bel') {
        if ($input == 'зборнік') {
            $plural_form = 'зборнікі';
        } elseif ($input == 'альбом' || $input == 'сінгл' || $input == 'міні-альбом') {
            $plural_form = $input . "ы";
        } else {
            $plural_form = $input;
        }
    }

    return $plural_form;
}
?>

<?php
function capitaiseFirstLetter($input) {
    //https://stackoverflow.com/a/41370797
    $output = preg_replace_callback(
        '/\p{L}/u',
        function($matches) { return mb_strtoupper($matches[0]); },
        mb_strtolower($input),
        1
    );

    return $output;
}
?>

<div id="top-btn"><a href="#"><i class="bi bi-arrow-up-circle"></i></a></div>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="content" class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="row disco-list">
                    <div class="row mb-3">
                        <div class="col"><?php _e('Jump to:', 'akfgfragments') ?></div>
                        <div class="col"><a href="#albums"><?php _e( 'albums', 'akfgfragments' ) ?></a></div>
                        <div class="col"><a href="#singles"><?php _e( 'singles', 'akfgfragments' ) ?></a></div>
                        <div class="col"><a href="#compilations"><?php _e( 'compilations', 'akfgfragments' ) ?></a></div>
                        <div class="col"><a href="#indies"><?php _e( 'indies', 'akfgfragments' ) ?></a></div>
                        <div class="col"><a href="#other"><?php _e( 'other', 'akfgfragments' ) ?></a></div>
                    </div>
                    <?php
                    $discodb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
                    $results_types = $discodb->get_results("SELECT DISTINCT t.`type` AS type_string, t.`type_de` AS type_string_de, t.`type_uk` AS type_string_uk, t.`type_be` AS type_string_be, t.`type_ja` AS type_string_ja, t.`type_ru` AS type_string_ru, t.`type_id` AS type_string_id, r.`type` AS type_int FROM releases r JOIN types t ON t.id = r.`type`;");

                    foreach ($results_types as $type) {
                        echo "<div class='row mb-2'>";

                        $curr_locale = get_locale();

                        switch ($curr_locale) {
                            case 'en_GB':
                                $type_print = ucwords($type->type_string) . "s";
                                break;
                            case 'de_DE':
                                $type_print = ucwords(pluraliseTypes($type->type_string_de, 'de_DE'));
                                break;
                            case 'ja':
                                $type_print = $type->type_string_ja;
                                break;
                            case 'uk':
                                $type_print = capitaiseFirstLetter( pluraliseTypes($type->type_string_uk, 'uk') );
                                break;
                            case 'bel':
                                $type_print = capitaiseFirstLetter( pluraliseTypes($type->type_string_be, 'bel') );
                                break;
                            case 'ru_RU':
                                $type_print = capitaiseFirstLetter( pluraliseTypes($type->type_string_ru, 'ru_RU') );
                                break;
                            case 'id_ID':
                                $type_print = capitaiseFirstLetter( pluraliseTypes($type->type_string_id, 'id_ID') );
                                break;
                            default:
                                $type_print = ucwords($type->type_string) . "s";
                                break;
                        }

                        echo "<section id='" . $type->type_string . "s'>";
                        echo "<h3>" . $type_print . "</h3>";
                        $results_releases = $discodb->get_results("SELECT title_ro, img_uri, date FROM releases WHERE `type` = $type->type_int;");
                        foreach ($results_releases as $release) {
                            echo "<div class='row d-flex align-items-center disco-release'>";
                            echo "<div class='col-lg-1 col-md-3'>";
                            if (strpos($release->img_uri, ",") === false) {
                                echo "<a href='/release?" . normaliseTitle($release->title_ro) . "' target='blank_'><img src='" . $release->img_uri . "'></a>";
                            } else {
                                $img_uri_arr = explode(",", $release->img_uri);
                                echo "<a href='/release?" . normaliseTitle($release->title_ro) . "' target='blank_'><img src='" . $img_uri_arr[0] . "'></a>";
                            }
                            echo "</div>";
                            echo "<div class='col'>";
                            echo "<a href='/release?" . normaliseTitle($release->title_ro) . "' class='disco-release-title' target='blank_'><span>" . $release->title_ro . "</span></a>";

                            $date_format = get_option('date_format');

                            if (($release->date == "2000-01-01" || $release->date == "2002-01-01")
                                && ($type->type_string == "other" || $type->type_string == "indie")) {
                                if ($curr_locale == "ja_JP") {
                                    echo "<p class='d-none d-lg-block d-xl-block d-xxl-block'>" . date("Y年", strtotime("$release->date")) . "</p>";
                                } else {
                                    echo "<p class='d-none d-lg-block d-xl-block d-xxl-block'>" . date("Y", strtotime("$release->date")) . "</p>";
                                }
                            } else if ($release->date == "0000-00-00") {
                                echo "<p class='d-none d-lg-block d-xl-block d-xxl-block'>" . __( 'Release date is unknown', 'akfgfragments' ) . "</p>";
                            }
                            else {
                                echo "<p class='d-none d-lg-block d-xl-block d-xxl-block'>" . wp_date( "{$date_format}", strtotime("$release->date") ) . "</p>";
                            }
                            echo "</div>";
                            echo "</div>";
                        }
                        echo "</section>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
</body>

</html>
