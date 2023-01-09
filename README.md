# akfgfragments_theme

A simple but effective WordPress theme for akfgfragments – international Asian Kung-Fu Generation fans project.

## localisation

[![Crowdin](https://badges.crowdin.net/akfgfragments/localized.svg)](https://crowdin.com/project/akfgfragments)

Localisation is done with Wordpress Multisite and i18n strings (`__()`, `_e()`, etc.).

You can help translate the site to your language [here](https://crowdin.com/project/akfgfragments). If your language doesn't exist there – create a discussion topic on [Crowdin](https://crowdin.com/project/akfgfragments/discussions) or on [GitHub](https://github.com/TimaGribanov/akfgfragments_theme/issues).

## wp-content

Contains the theme itself.

### templates

#### lyrics.php

Loads a list of songs in alphabetical order based on the result from the database.

![image](https://user-images.githubusercontent.com/48593815/169022363-1eb09610-1bb8-412f-9203-0e2744d74d48.png)

#### song.php

Loads information about the song from the database and displays it.

![image](https://user-images.githubusercontent.com/48593815/169024184-8857adb6-8b03-413e-a03c-34068d9a6b9a.png)

#### disco.php

Loads a list of releases in chronological order based on the result from the database and separates them into categories by type (album, single, etc.).

![image](https://user-images.githubusercontent.com/48593815/169033807-3bcf65ac-247b-4a11-ad71-08a98cfd3168.png)

#### release.php

Loads information about the release (album, single, etc.) from the database and displays it.

![image](https://user-images.githubusercontent.com/48593815/169033963-a7dea558-1703-41ca-8789-0a098fae6c91.png)

#### blank.php

The same as index.php but with no title, post date and tags. Considered to be used for a single page with content.

## wp-admin

Contains extra pages for admin panel which allow to edit releases and songs.
