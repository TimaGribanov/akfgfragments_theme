<?php
/**
 * Interview New Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title = __('Add/edit an interview');
$this_file = 'interview-new.php';
$parent_file = 'interview.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e('Add an interview'); ?></h1>
    <form action="" method="POST">
        <div style="display: flex; width: 900px;">
            <div style="flex: 1;">
                <label for="slug">
                    <h3>Slug*:</h3>
                </label>
                <h4>Choose an existing slug or add this interview as a new one</h4>
                <select id="slug-type" name="slugType">
                    <option value="" disabled selected>Select</option>
                    <?php
                    $intdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
                    $slug_res = $intdb->get_results("SELECT * FROM interviews ORDER BY id ASC;");
                    foreach ($slug_res as $row) {
                        echo "<option value='$row->slug' onclick='fillOtherFields(\"$row->slug\", \"$row->date\", $row->cover)'>$row->slug</option>";
                    }
                    ?>
                    <option value="new-slug" onclick="showNewSlug()">New slug</option>
                </select>
                <script type="text/javascript">
                    function showNewSlug() {
                        document.getElementById('slug').style.display = 'block'
                        document.getElementById('date').value = ''
                    }

                    function hideNewSlug() {
                        document.getElementById('slug').style.display = 'none'
                    }

                    function fillOtherFields(slug, date, cover) {
                        let slug_current = slug
                        hideNewSlug()
                        loadTitle(slug_current, 'en')
                        loadText(slug_current, 'en')

                        document.getElementById('slug').value = slug
                        document.getElementById('date').value = date
                        if (cover) {
                            document.getElementById('cover').value = cover
                        }
                    }
                </script>
                <input type="text" id="slug" name="slug" required hidden>
                <label for="date">
                    <h3>Date*:</h3>
                </label>
                <input type="date" id="date" name="date" required>
                <label for="cover">
                    <h3>Cover image URI:</h3>
                </label>
                <input type="text" id="cover" name="cover">

                <label for="lang">
                    <h3>Language*:</h3>
                </label>
                <select id="lang" name="lang" required>
                    <option value="en" onclick="loadTextLocale('en')" selected>English</option>
                    <option value="ja" onclick="loadTextLocale('ja')">Japanese</option>
                    <option value="de" onclick="loadTextLocale('de')">German</option>
                    <option value="es" onclick="loadTextLocale('es')">Spanish</option>
                    <option value="fr" onclick="loadTextLocale('fr')">French</option>
                    <option value="ru" onclick="loadTextLocale('ru')">Russian</option>
                    <option value="uk" onclick="loadTextLocale('uk')">Ukrainian</option>
                    <option value="be" onclick="loadTextLocale('be')">Belarusian</option>
                    <!--option value="fi" onclick="loadTextLocale('fi')">Finnish</option-->
                    <option value="pt" onclick="loadTextLocale('pt')">Portuguese</option>
                </select>
                <label for="title">
                    <h3>Title in selected language*:</h3>
                </label>
                <input type="text" id="title" name="title" required>
                <label for="text">
                    <h3>Text*:</h3>
                </label>
                <textarea id="text" name="text" style="width: 900px; height: 424px;" required></textarea>

                <script type="text/javascript">
                    function loadTitle(slug, lang) {
                        let searchString = 'slug=' + slug + '&lang=' + lang;

                        if (searchString) {
                            (function ($) {
                                $.ajax({
                                    type: "POST",
                                    url: "/wp-admin/interviews-title-query.php",
                                    data: searchString,
                                    cache: false,
                                    success: function (title) {
                                        document.getElementById('title').value = title
                                    }
                                });
                            })(jQuery);
                        } else {
                            document.getElementById('title').value = '';
                        }

                        return false;
                    }

                    function loadTextLocale(lang) {
                        const slug = document.getElementById('slug').value

                        loadText(slug, lang)
                        loadTitle(slug, lang)
                    }

                    function loadText(slug, lang) {
                        let searchString = 'slug=' + slug + '&lang=' + lang;

                        if (searchString) {
                            (function ($) {
                                $.ajax({
                                    type: "POST",
                                    url: "/wp-admin/interviews-text-query.php",
                                    data: searchString,
                                    cache: false,
                                    success: function (text) {
                                        document.getElementById('text').innerHTML = text
                                    }
                                });
                            })(jQuery);
                        } else {
                            document.getElementById('text').innerHTML = '';
                        }

                        return false;
                    }
                </script>
            </div>
        </div>
        <br>
        <input type="submit" name="submit" value="Add/edit an interview">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $slug_type = $_POST['slugType'];
        
        $cover = $_POST['cover'];
        $date = $_POST['date'];
        $slug = $_POST['slug'];

        $lang = $_POST['lang'];
        $title = $_POST['title'];
        $text = nl2br($_POST['text'], false);
        $text = preg_replace("/[\r\n]*/", "", $text);

        if ($slug_type == "new-slug") {
            $intdb->insert(
                "interviews",
                array(
                    "cover" => "$cover",
                    "date" => "$date",
                    "slug" => "$slug"
                )
            );
        }
        ;

        $res = $intdb->get_results("SELECT id FROM interviews WHERE slug = \"$slug\";");
        $interview_id = $res[0]->id;
        $res_text = $intdb->get_results("SELECT id, `text` FROM interviews_text WHERE interview_id = $interview_id AND lang = \"$lang\";");
        if (count($res_text) == 0) {
            $intdb->insert(
                "interviews_text",
                array(
                    "interview_id" => "$interview_id",
                    "lang" => "$lang",
                    "title" => "$title",
                    "text" => "$text"
                )
            );
        } else {
            $int_text_id = $res_text[0]->id;
            $intdb->update(
                "interviews_text",
                array(
                    "title" => "$title",
                    "text" => "$text"
                ),
                array("id" => $int_text_id)
            );
        }

        echo "<meta http-equiv='refresh' content='0'>";
    }
    ;
    ?>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>