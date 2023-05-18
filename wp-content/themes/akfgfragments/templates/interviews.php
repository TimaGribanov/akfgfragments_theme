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

                echo "<div class='dropdown'>";
                echo "<button class='btn btn-langs dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>Change interviews' language</button>";
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

                echo "<div id='interviews-list'></div>";
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
            url: `/wp-content/themes/akfgfragments/get_interviews.php?slug=&lang=${lang}`,
            success: function (response) {
                $('#interviews-list').html(response)
            }
        })
    })

    $(function () {
        $.ajax({
            url: `/wp-content/themes/akfgfragments/get_interviews.php?slug=&lang=<?php global $locale; echo $locale; ?>`,
            success: function (response) {
                $('#interviews-list').html(response)
            }
        })
    })
</script>

<?php get_footer(); ?>

</body>

</html>