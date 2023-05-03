<body class="d-flex flex-column min-vh-100">
    <header id="main-header" class="jumbotron">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid main-wrapper">
                <a class="navbar-brand" href="/">
                    <img src="/wp-content/themes/akfgfragments/assets/img/logo.png" />
                    <span>akfgfragments</span>
                </a>
                <div class="collapse navbar-collapse ml-5">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="./discography"><?php _e( 'Discography', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./music-videos"><?php _e( 'Music Videos', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./lyrics"><?php _e( 'Lyrics', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./tablatures"><?php _e( 'Tablatures', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./interviews"><?php _e( 'Interviews', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="./stuff"><?php _e( 'Stuff', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="./side"><?php _e( 'Side Projects', 'akfgfragments' ); ?></a>
                        </li>
                    </ul>
                </div>

                <?php
                    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                    $langs = array(
                        array('English', 'en'),
                        array('Deutsch', 'de'),
                        //array('Français', 'fr'),
                        //array('Español', 'es'),
                        //array('Português', 'pt'),
                        array('Русский', 'ru'),
                        array('Українська', 'uk'),
                        array('Беларуская', 'be'),
                        //array('Suomi', 'fi'),
                        array('日本語', 'ja')
                    );
                    $scheme = parse_url($url, PHP_URL_SCHEME);
                    $domain = 'test.akfgfragments.com';
                    $curr_locale = get_locale();
                    $curr_locale_short = substr($curr_locale, 0, 2);
                    
                    echo "<div class='dropdown'>";
                    for ($i=0; $i < sizeof($langs); $i++) {
                        if ($langs[$i][1] == $curr_locale_short)
                            echo "<button class='btn btn-langs dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>{$langs[$i][0]}</button>";
                    }
                    echo "<ul class='dropdown-menu dropdown-menu-end'>";
                    for ($i=0; $i < sizeof($langs); $i++) {
                        if ($langs[$i][1] != $curr_locale_short) {
                            if ($langs[$i][1] == "en")
                                echo "<li><a class='dropdown-item' href='{$scheme}://{$domain}'>{$langs[$i][0]}</a></li>";
                            else
                                echo "<li><a class='dropdown-item' href='{$scheme}://{$langs[$i][1]}.{$domain}'>{$langs[$i][0]}</a></li>";
                        }
                    }
                    echo "</ul>";
                    echo "</div>";
                ?>

                <!-- Hamburger menu -->
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#hamburgerMenu" aria-controls="hamburgerMenu" aria-expanded="false" aria-controls="Toggle navigation">
                    <span class="ham-bars"><i class="bi bi-list"></i></span>
                </button>

                <div class="collapse" id="hamburgerMenu">
                    <ul class="navbar-nav mr-auto text-center vertical-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="./"><?php _e( 'Home', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./discography"><?php _e( 'Discography', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./music-videos"><?php _e( 'Music Videos', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./lyrics"><?php _e( 'Lyrics', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./tablatures"><?php _e( 'Tablatures', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./interviews"><?php _e( 'Interviews', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="./stuff"><?php _e( 'Stuff', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="./side"><?php _e( 'Side Projects', 'akfgfragments' ); ?></a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" href="./about"><?php _e( 'About us', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./team"><?php _e( 'Team', 'akfgfragments' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./thanks"><?php _e( 'Thanks', 'akfgfragments' ); ?></a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" href="https://ajikanproject.com/" target="_blank">Ajikan Worldwide Project</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://discord.gg/mQJ4TcjM3h" target="_blank"><?php _e( 'Join our Discord', 'akfgfragments' ); ?></a>
                        </li>
                        <hr>
                        <li class="mt-2">
                            <a class="ham-icon me-2" href="https://twitter.com/AkfgfragmentsEn" rel="nofollow" target="_blank" role="img" title="Twitter" aria-label="Twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a class="ham-icon me-2" href="https://t.me/akfgfragments" rel="nofollow" target="_blank" role="img" title="Telegram" aria-label="Telegram">
                                <i class="bi bi-telegram"></i>
                            </a>
                            <a class="ham-icon me-2" href="https://facebook.com/akfgfragmentscom" rel="nofollow" target="_blank" role="img" title="Telegram" aria-label="Telegram">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a class="ham-icon me-2" href="https://discord.gg/mQJ4TcjM3h" rel="nofollow" target="_blank" role="img" title="Discord" aria-label="Discord">
                                <i class="bi bi-discord"></i>
                            </a>
                            <a class="ham-icon" href="https://www.reddit.com/r/AsianKungFuGeneration" rel="nofollow" target="_blank" role="img" title="Reddit" aria-label="Reddit">
                                <i class="bi bi-reddit"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>