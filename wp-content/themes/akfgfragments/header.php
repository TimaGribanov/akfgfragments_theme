<!DOCTYPE html>
<html>

<head>
    <?php
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $slug = parse_url($url, PHP_URL_PATH);
        $slug = str_replace('/', '', $slug);
        $slug = str_replace('_', ' ', $slug);
        $slug = ucwords($slug);

        $title = parse_url($url, PHP_URL_QUERY); //Get a query
        $title_parsed = str_replace('_', ' ', $title); //Delete underscores if they exist
        $title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
        $title_parsed = str_replace('/', '', $title); //Delete slashes if they exist
        $title_parsed = str_replace('_', ' ', $title_parsed); //Delete underscores if they exist
        $title_parsed = str_replace('%27', '\'', $title_parsed); //Change %27 to a single quote
        $title_parsed = str_replace('%26', '&', $title_parsed); //Cahnge %26 to an ampersand
        $title_parsed = str_replace('%23', '#', $title_parsed); //Cahnge %26 to a number sign
        $title_parsed = str_replace('%3F', '?', $title_parsed); //Cahnge %26 to a question mark
        $title_parsed = ucwords($title_parsed); //Capitalise each word
    ?>
    <title>
        <?php
            if (!$title_parsed) {
                if (!$slug) {
                    echo "Home";
                } else {
                    echo($slug);
                }
            } else {
                echo($title_parsed);
            }
        ?>
    </title>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri().'/style.css'; ?>">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
</head>

<?php get_header(header); ?>