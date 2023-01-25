<!DOCTYPE html>
<html>

<head>
    <?php
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        
        $slug = parse_url($url, PHP_URL_PATH);
        $slug = str_replace('/', '', $slug);
        $slug = str_replace('_', ' ', $slug);
        $slug = ucwords($slug);

        $title = parse_url($url, PHP_URL_QUERY); //Get a query
        $title_parsed = "";
        if ($title) {
            $title_parsed = str_replace('_', ' ', $title); //Delete underscores if they exist
            $title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
            $title_parsed = str_replace('/', '', $title); //Delete slashes if they exist
            $title_parsed = str_replace('_', ' ', $title_parsed); //Delete underscores if they exist
            $title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
            $title_parsed = str_replace('%26', '&', $title_parsed); //Change %26 to an ampersand
            $title_parsed = str_replace('%23', '#', $title_parsed); //Change %26 to a number sign
            $title_parsed = str_replace('%3F', '?', $title_parsed); //Change %26 to a question mark
            $title_parsed = ucwords($title_parsed); //Capitalise each word
        }

        $og_title = "";
        if(!empty($post->post_title) && strcmp($post->post_title, "Release") !== 0 && strcmp($post->post_title, "Song") !== 0 && !(parse_url($url, PHP_URL_PATH) == "/") && !(str_contains(parse_url($url, PHP_URL_PATH), "/page"))) {
            $og_title = get_the_title();
        } else {
            if (!$title_parsed) {
                if (!$slug || str_contains(parse_url($url, PHP_URL_PATH), "/page")) {
                    $og_title = "Home";
                } else {
                    $og_title = $slug;
                }
            } else {
                $og_title = $title_parsed;
            }
        }

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri().'/style.css'; ?>">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;700&display=swap');
    </style> 
</head>

<?php get_header("header"); ?>
