<!-- POST ON DESKTOP -->
<!-- For feed -->
<?php if (!is_single()) {?>
<div class="row main-post d-none d-lg-block d-xl-block d-xxl-block">
    <div class="row">
    <div class="col-4">
    <?php
    if ( has_post_thumbnail() ) {
        $post_thumbnail_id = get_post_thumbnail_id();
        $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
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
        <a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
        <h6><?php
        $date_format = get_option('date_format');
        $time_format = get_option('time_format');
        $timezone = $_COOKIE["local_timezone"];
        echo wp_date( "{$date_format} {$time_format}", get_post_timestamp(), new DateTimeZone($timezone) );
        ?></h6>
        <?php
        $post_tags = get_the_tags();
        if (!empty($post_tags)) {
            echo '<ul class="main-post-taglist">';
            foreach($post_tags as $post_tag) {
                echo '<li><a href="' . get_tag_link($post_tag) . '">' . $post_tag->name . '</a></li>';
            }
            echo '</ul>';
        }   
        ?>
        <p><?php the_content(__( '(more...)', 'akfgfragments' )); ?></p>
    </div>
    </div>
</div>
<?php } else { ?>

<!-- For single post -->
<div class="row main-post">
    <div class="col">
        <h1><?php the_title(); ?></h1>
        <h5><?php 
        $date_format = get_option('date_format');
        $time_format = get_option('time_format');
        $timezone = $_COOKIE["local_timezone"];
        echo wp_date( "{$date_format} {$time_format}", get_post_timestamp(), new DateTimeZone($timezone) );
        ?></h5>
        <?php
        $post_tags = get_the_tags();
        if (!empty($post_tags)) {
            echo '<ul class="main-post-taglist">';
            foreach($post_tags as $post_tag) {
                echo '<li><a href="' . get_tag_link($post_tag) . '">' . $post_tag->name . '</a></li>';
            }
            echo '</ul>';
        }   
        ?>
        <?php
        if ( has_post_thumbnail() ) {
            $post_thumbnail_id = get_post_thumbnail_id();
            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
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
<?php } ?>

<!-- POST ON MOBILE -->
<div class="row main-post-mobile d-block d-md-block d-lg-none">
    <a class="main-title-mobile" href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
    <h6><?php _e( 'Posted on', 'akfgfragments' ); ?> <?php wp_date( get_option( 'date_format' ), get_post_timestamp() ); ?></h6>
    <?php
    $post_tags = get_the_tags();
        if (!empty($post_tags)) {
            echo '<ul class="main-post-taglist">';
            foreach($post_tags as $post_tag) {
                echo '<li><a href="' . get_tag_link($post_tag) . '" class="main-tag-mobile">' . $post_tag->name . '</a></li>';
            }
            echo '</ul>';
        }   
        ?>
        <?php
        if ( has_post_thumbnail() ) {
            $post_thumbnail_id = get_post_thumbnail_id();
            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
            echo '<div class="post-image"><a href="';
            the_permalink();
            echo '" class="main-thumbnail-mobile"><img title="image title" alt="thumb image" class="wp-post-image" src="' . $post_thumbnail_url . '" style="width:100%; height:auto;"></a></div>';
        }
        ?>
    <p><?php the_content(__( '(more...)', 'akfgfragments' )); ?></p>
</div>