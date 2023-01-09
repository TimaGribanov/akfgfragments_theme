<!DOCTYPE html>
<?php 
    $curr_locale = get_locale();
    
    $html_locale = strtolower( $curr_locale );
    $html_locale = str_replace( '_', '-', $html_locale );
?>
<html lang="<?php echo $html_locale; ?>">

<head>
    <?php
        require( get_theme_root() . "/akfgfragments/set_cookie.php" );
        require( get_theme_root() . "/akfgfragments/parse_url.php" );
        
        $og_title = "";

        $curr_locale = get_locale();

        if(!empty($post->post_title) && strcmp($post->post_title, "Release") !== 0 && strcmp($post->post_title, "Song") !== 0 && !(parse_url($url, PHP_URL_PATH) == "/") && !(str_contains(parse_url($url, PHP_URL_PATH), "/page"))) {
            $og_title = get_the_title();
        } else {
            if (!$title_parsed) {
                if (!$slug || str_contains(parse_url($url, PHP_URL_PATH), "/page")) {
                    if ($curr_locale != 'en_GB') {
                        $og_title = __( 'Home', 'akfgfragments' );
                    } else {
                        $og_title = 'Home';
                    }
                } else {
                    $og_title = $slug;
                }
            } else {
                $og_title = $title_parsed;
            }
        }

        $og_title = "$og_title — akfgfragments";

    //https://wordpress.stackexchange.com/questions/83887/return-current-page-type
    function wp_post_type() {
        global $wp_query;
        $loop = 'notfound';
    
        if ( $wp_query->is_page ) {
            $loop = is_front_page() ? 'front' : 'page';
        } elseif ( $wp_query->is_home ) {
            $loop = 'home';
        } elseif ( $wp_query->is_single ) {
            $loop = ( $wp_query->is_attachment ) ? 'attachment' : 'single';
        } elseif ( $wp_query->is_category ) {
            $loop = 'category';
        } elseif ( $wp_query->is_tag ) {
            $loop = 'tag';
        } elseif ( $wp_query->is_tax ) {
            $loop = 'tax';
        } elseif ( $wp_query->is_archive ) {
            if ( $wp_query->is_day ) {
                $loop = 'day';
            } elseif ( $wp_query->is_month ) {
                $loop = 'month';
            } elseif ( $wp_query->is_year ) {
                $loop = 'year';
            } elseif ( $wp_query->is_author ) {
                $loop = 'author';
            } else {
                $loop = 'archive';
            }
        } elseif ( $wp_query->is_search ) {
            $loop = 'search';
        } elseif ( $wp_query->is_404 ) {
            $loop = 'notfound';
        }
    
        return $loop;
    }

    $meta_title = "";
    if($og_title === "Home") {
        $meta_title = "akfgfragments";
    } else {
        $meta_title = $og_title;
    }
    ?>

    <meta charset="utf-8">
    <meta name="description" content="Your ultimate guide to Asian Kung-Fu Generation world.">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">

    <meta property="og:image" content="https://akfgfragments.com/wp-content/uploads/2022/05/akfgfragments_meta_image.png">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <meta property="og:image:alt" content="<?php echo $meta_title; ?>">
    <meta property="og:title" content="<?php echo $meta_title; ?>">
    <meta property="og:type" content="<?php echo wp_post_type(); ?>">
    <meta property="og:url" content="<?php if($og_title === "Home") {echo "https://akfgfragments.com";} else {echo $url;} ?>">
    <meta property="og:site_name" content="akfgfragments">
    <meta property="og:locale" content="<?php echo get_locale(); ?>" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@AkfgfragmentsEn" />
    <meta name="twitter:title" content="<?php echo $meta_title; ?>" />
    <meta name="twitter:description" content="Your ultimate guide to Asian Kung-Fu Generation world." />
    <meta name="twitter:image" content="https://akfgfragments.com/wp-content/uploads/2022/05/akfgfragments_meta_image.png" />

    <meta name="google-site-verification" content="l0FRBaDseDjdiy5dTC3vsNiG0DbxBRPsuYxf29BDv8Y" />
    <meta name="msvalidate.01" content="A6B2545E3F1222DC6899B9CDDBF4591B" />

    <title>
    <?php echo $og_title; ?>
    </title>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri().'/style.css'; ?>">
    <?php
    if ($curr_locale == 'ja_JP') {
        echo '<link rel="stylesheet" href="';
        echo get_stylesheet_directory_uri().'/style-ja.css';
        echo '">';
    } 
    ?>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
</head>

<?php get_header('header'); ?>