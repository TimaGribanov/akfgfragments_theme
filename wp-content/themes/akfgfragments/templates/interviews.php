<?php /* Template Name: Akfgfragments Interviews' List */

get_header(); 

function printInterviews()
{
$args = array(
    'post_type' => 'interview',
    'post_status' => 'publish'
);

$interviews = new WP_Query($args);

if ($interviews->have_posts()) {
    while ($interviews->have_posts()) {
        $interviews->the_post();
        ?>
        <div class="row interview-post">
            <div class="col-4">
                <?php
                if (has_post_thumbnail()) {
                    $post_thumbnail_id = get_post_thumbnail_id();
                    $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
                    echo '<div class="post-image"><a href="';
                    the_permalink();
                    echo '" class="main-thumbnail"><img title="';
                    the_title();
                    echo '" alt="';
                    the_title();
                    echo '" class="wp-post-image" src="' . $post_thumbnail_url . '"></a></div>';
                }
                ?>
            </div>
            <div class="col-8 main-post-right">
                <a href="<?php the_permalink(); ?>">
                    <h1><?php the_title(); ?></h1>
                </a>
                <p><?php the_excerpt(); ?></p>
            </div>
        </div>
        <?php
    }

    wp_reset_postdata();
} else {
    printf("No data");
}
}

?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
                <?php printInterviews(); ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

</body>

</html>