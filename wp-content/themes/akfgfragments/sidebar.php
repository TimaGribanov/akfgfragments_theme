<?php require_once(get_theme_root() . "/akfgfragments/normalise_title.php"); ?>

<div id="main-sidebar" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 d-none d-lg-block d-xl-block d-xxl-block">
    <div id="main-discord" class="main-side-block text-center">
        <h4><?php _e('Join our Discord server!', 'akfgfragments'); ?></h4>
        <p><?php _e('We have interesting Asian Kung-Fu Generation related discussions there, and more!', 'akfgfragments'); ?>
        </p>
        <a href="https://discord.gg/mQJ4TcjM3h" target="_blank"><button type="button" class="btn btn-discord mb-2"><i
                    class="bi bi-discord"></i><span class="main-btn-text">Join</span></button></a>
    </div>

    <hr class="block-separator" />

    <div id="main-twitter-block" class="main-side-block text-center">
        <h4><?php _e('Follow us on Twitter!', 'akfgfragments'); ?></h4>
        <p><?php _e('All the news are there!', 'akfgfragments'); ?></p>
        <a href="https://twitter.com/AkfgfragmentsEn" target="_blank"><button type="button"
                class="btn btn-twitter mb-2"><i class="bi bi-twitter"></i><span
                    class="main-btn-text">Follow</span></button></a>
    </div>

    <hr class="block-separator" />

    <div id="main-latest-release" class="main-side-block text-center">
        <h4><?php _e('The latest release', 'akfgfragments'); ?></h4>
        <?php
        $releasedb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
        $results = $releasedb->get_results("SELECT r.title_ro AS title, r.date AS `date`, r.img_uri AS uri, t.type AS type FROM releases r JOIN types t ON t.id = r.type ORDER BY r.date DESC LIMIT 1;");
        ?>
        <h5><?php echo $results[0]->title; ?></h5>
        <img src="<?php echo $results[0]->uri; ?>"
            alt="<?php echo "Cover of " . $results[0]->title . " " . $results[0]->type; ?>" width="200px"
            height="200px" />
        <?php $date_format = get_option('date_format');
        $rel_date = $results[0]->date; ?>
        <p class="mb-1"><?php _e('Release date: ', 'akfgfragments');
        echo wp_date("{$date_format}", strtotime("$rel_date")); ?></p>
        <p class="mb-1"><?php _e('Type: ', 'akfgfragments');
        echo $results[0]->type; ?></p>
        <a class="main-latest-release-link" href="/release?<?php echo normaliseTitle($results[0]->title); ?>"><?php _e('More about this release', 'akfgfragments'); ?></a>
    </div>

    <hr class="block-separator" />

    <div id="main-ajikan-project" class="main-side-block text-center">
        <a href="https://ajikanproject.akfgfragments.com" target="_blank"><img
                src="/wp-content/themes/akfgfragments/assets/img/ajikan_project_logo.png" width="300px"
                height="300px" /></a>
    </div>

    <hr class="block-separator" />
</div>
