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

                echo "<div class='dropdown'>";
                echo "<button class='btn btn-langs dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>";
                _e('Change the interview\'s language', 'akfgfragments');
                echo "</button>";
                echo "<ul class='dropdown-menu dropdown-menu-end'>";
                echo "<li class='dropdown-item lang-list' lang='en'>";
                _e('English', 'akfgfragments');
                echo "</li>";
                echo "<li class='dropdown-item lang-list' lang='de'>";
                _e('German', 'akfgfragments');
                echo "</li>";
                echo "<li class='dropdown-item lang-list' lang='es'>";
                _e('Spanish', 'akfgfragments');
                echo "</li>";
                echo "<li class='dropdown-item lang-list' lang='fr'>";
                _e('French', 'akfgfragments');
                echo "</li>";
                echo "<li class='dropdown-item lang-list' lang='ru'>";
                _e('Russian', 'akfgfragments');
                echo "</li>";
                // echo "<li class='dropdown-item lang-list' lang='uk'>";
                // _e('Ukrainian', 'akfgfragments');
                // echo "</li>";
                // echo "<li class='dropdown-item lang-list' lang='be'>";
                // _e('Belarusian', 'akfgfragments');
                // echo "</li>";
                echo "</ul>";
                echo "</div>";

                echo "<div id='interview-text'></div>";
                ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<script type="text/javascript">
    //load interviews
    $('.lang-list').click(function () {
        const lang = $(this).attr('lang')
        $.ajax({
            url: `/wp-content/themes/akfgfragments/get_interviews.php?slug=<?php global $int_slug; echo $int_slug; ?>&lang=${lang}`,
            success: function (response) {
                $('#interview-text').html(response)
            }
        })
    })

    $(function () {
        $.ajax({
            url: `/wp-content/themes/akfgfragments/get_interviews.php?slug=<?php global $int_slug; echo $int_slug; ?>&lang=<?php global $lang; echo $lang; ?>`,
            success: function (response) {
                $('#interview-text').html(response)
            }
        })
    })
</script>

<?php get_footer(); ?>

</body>

</html>