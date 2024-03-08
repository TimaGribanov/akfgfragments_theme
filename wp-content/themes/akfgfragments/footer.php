<footer id="main-footer">
    <div class="main-wrapper">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-8 col-xxl-8" id="ftr-left-block">
                <h5>akfgfragments.com</h5>
                <?php
                if (get_locale() === "en_GB") {
                    echo "<p>Your guide to Asian Kung-Fu Generation <span class='ftr-crossed'>world world</span> world</p>";
                } else {
                    ?>
                    <p><?php _e('Your guide to Asian Kung-Fu Generation world', 'akfgfragments'); ?></p>
                    <?php
                }

                ?>
            </div>
            <div class="col-4" id="ftr-right-block">
                <div class="row">
                    <div class="col-6">
                        <nav id="ftr-menu" class="navbar navbar-expand-lg">
                            <div class="container-fluid">
                                <div class="collapse navbar-collapse">
                                    <ul class="navbar-nav d-flex flex-column me-auto mb-2 mb-lg-0">
                                        <li class="nav-item"><a class="nav-link"
                                                href="/about"><?php _e('About us', 'akfgfragments') ?></a></li>
                                        <li class="nav-item"><a class="nav-link"
                                                href="/team"><?php _e('Team', 'akfgfragments') ?></a></li>
                                        <li class="nav-item"><a class="nav-link"
                                                href="/thanks"><?php _e('Thanks', 'akfgfragments') ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="col-6">
                        <nav id="ftr-socials" class="navbar navbar-expand-lg">
                            <div class="container-fluid">
                                <div class="collapse navbar-collapse">
                                    <ul class="navbar-nav d-flex flex-column">
                                        <li class="nav-item me-3 me-lg-0">
                                            <a class="nav-link" href="https://twitter.com/AkfgfragmentsEn"
                                                rel="nofollow" target="_blank" role="img" title="Twitter"
                                                aria-label="Twitter">Twitter</a>
                                        </li>
                                        <li class="nav-item me-3 me-lg-0">
                                            <a class="nav-link" href="https://t.me/akfgfragments" rel="nofollow"
                                                target="_blank" role="img" title="Telegram"
                                                aria-label="Telegram">Telegram</a>
                                        </li>
                                        <li class="nav-item me-3 me-lg-0">
                                            <a class="nav-link" href="https://www.instagram.com/akfgfragments_com/" rel="nofollow"
                                                target="_blank" role="img" title="Instagram"
                                                aria-label="Instagram">Instagram</a>
                                        </li>
                                        <li class="nav-item me-3 me-lg-0">
                                            <a class="nav-link" href="https://facebook.com/akfgfragmentscom"
                                                rel="nofollow" target="_blank" role="img" title="Telegram"
                                                aria-label="Telegram">Facebook</a>
                                        </li>
                                        <li class="nav-item me-3 me-lg-0">
                                            <a class="nav-link" href="https://discord.gg/mQJ4TcjM3h" rel="nofollow"
                                                target="_blank" role="img" title="Discord"
                                                aria-label="Discord">Discord</a>
                                        </li>
                                        <li class="nav-item me-3 me-lg-0">
                                            <a class="nav-link" href="https://www.reddit.com/r/AsianKungFuGeneration"
                                                rel="nofollow" target="_blank" role="img" title="Reddit"
                                                aria-label="Reddit">Reddit</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div id="ftr-copyright" class="row text-center">
            <p class="mb-0">akfgfragments © <?php echo date('Y'); ?></p>
        </div>
    </div>
    <?php wp_footer(); ?>
</footer>
