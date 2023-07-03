<?php
// FOR INTERVIEWS
if (is_single() && 'interview' == get_post_type()) { ?>
    <div class="row interview">
        <div class="col">
            <h1><?php the_title(); ?></h1>
            <?php
            if (has_post_thumbnail()) {
                $post_thumbnail_id = get_post_thumbnail_id();
                $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
                echo '<div class="post-image"><img title="';
                the_title();
                echo '" alt="';
                the_title();
                echo '" src="' . $post_thumbnail_url . '"></div>';
            }
            ?>
            <p><?php the_content(); ?></p>
        </div>
    </div>
    <?php
    // FOR SINGLE POST
} else if (is_single() && 'post' == get_post_type()) { ?>
        <div class="row main-post">
            <div class="col">
                <h1><?php the_title(); ?></h1>
                <h5><?php
                $date_format = get_option('date_format');
                $time_format = get_option('time_format');
                $timezone = $_COOKIE["local_timezone"];
                echo wp_date("{$date_format} {$time_format}", get_post_timestamp(), new DateTimeZone($timezone));
                ?></h5>
                <?php
                $post_tags = get_the_tags();
                if (!empty($post_tags)) {
                    echo '<ul class="main-post-taglist">';
                    foreach ($post_tags as $post_tag) {
                        echo '<li><a href="' . get_tag_link($post_tag) . '">' . $post_tag->name . '</a></li>';
                    }
                    echo '</ul>';
                }
                ?>
                <?php
                if (has_post_thumbnail()) {
                    $post_thumbnail_id = get_post_thumbnail_id();
                    $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
                    echo '<div class="post-image"><img title="';
                    the_title();
                    echo '" alt="';
                    the_title();
                    echo '" src="' . $post_thumbnail_url . '"></div>';
                }
                ?>
                <p><?php the_content(); ?></p>
            </div>
        </div>
    <?php
    // FOR FEED
} else { ?>
        <!-- DESKTOP -->
        <div class="row main-post d-none d-sm-none d-md-none d-lg-block d-xl-block d-xxl-block">
            <div class="row">
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
                    <h6><?php
                    $date_format = get_option('date_format');
                    $time_format = get_option('time_format');
                    $timezone = $_COOKIE["local_timezone"];
                    echo wp_date("{$date_format} {$time_format}", get_post_timestamp(), new DateTimeZone($timezone));
                    ?></h6>
                    <?php
                    $post_tags = get_the_tags();
                    if (!empty($post_tags)) {
                        echo '<ul class="main-post-taglist">';
                        foreach ($post_tags as $post_tag) {
                            echo '<li><a href="' . get_tag_link($post_tag) . '">' . $post_tag->name . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                    <p><?php the_content(__('(more...)', 'akfgfragments')); ?></p>
                </div>
            </div>
        </div>

        <!-- MOBILE -->
        <div class="row main-post d-block d-sm-block d-md-block d-lg-none d-xl-none d-xxl-none">
            <div class="row">
                <div class="row">
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
                <div class="row main-post-right">
                    <a href="<?php the_permalink(); ?>">
                        <h1><?php the_title(); ?></h1>
                    </a>
                    <h6><?php
                    $date_format = get_option('date_format');
                    $time_format = get_option('time_format');
                    $timezone = $_COOKIE["local_timezone"];
                    echo wp_date("{$date_format} {$time_format}", get_post_timestamp(), new DateTimeZone($timezone));
                    ?></h6>
                    <?php
                    $post_tags = get_the_tags();
                    if (!empty($post_tags)) {
                        echo '<ul class="main-post-taglist">';
                        foreach ($post_tags as $post_tag) {
                            echo '<li><a href="' . get_tag_link($post_tag) . '">' . $post_tag->name . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                    <p><?php the_content(__('(more...)', 'akfgfragments')); ?></p>
                </div>
            </div>
        </div>
<?php } ?>

<script type="text/javascript">
    window.onload = () => {
        const ytVideos = document.getElementsByClassName('wp-block-embed-youtube')

        console.log(ytVideos)

        for (let i = 0; i < ytVideos.length; i++) {
            const e = ytVideos[i]

            e.className = ''
            e.firstChild.className = 'ratio ratio-16x9'
        }
    }
</script>