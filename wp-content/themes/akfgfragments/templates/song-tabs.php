<?php /* Template Name: Akfgfragments Tabs per Song */?>

<?php get_header(); ?>

<main role="main">
    <div class="container">
        <div id="main" class="row">
            <div id="main-content" class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <?php
                    require(get_theme_root() . "/akfgfragments/parse_url.php");
                    require(get_theme_root() . "/akfgfragments/normalise_title.php");

                    //Connect to another DB containing discography data
                    $tabdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
                    $results = $tabdb->get_results("SELECT t.file AS `filename`, tt.type AS `type` FROM tabs t JOIN songs s ON t.song_id = s.id JOIN tab_types tt ON t.type = tt.id WHERE s.title_ro = \"$title_parsed\";");
                    ?>

                    <h1 class="song_title"><?php echo $title_parsed; ?></h1>
                    <div class="row">
                        <p><a href="/song?<?php echo $title; ?>"><?php _e('Information about the song', 'akfgfragments'); ?></a></p>
                    </div>
                    <div class="row mt-3">
                        <h2>Download</h2>

                        <?php
                        if (!empty($results)) {
                            echo "<div class='d-grid gap-2 d-md-block'>";
                            echo "<div id='tabs-buttons'>";

                            foreach ($results as $row) {
                                echo "<button class='me-2 mb-2 tabs-btn'><a href='/downloads/tabs/$row->filename' download>$row->type</a></button>";
                            }

                            echo "</div>";
                            echo "</div>";
                        } else {
                            echo "<p>Sorry! There are no tabs for this song on our site yet.</p>";
                            echo "<p>But we're working on it!</p>";
                        }
                        ?>

                    </div>

                    <?php
                    if (!empty($results)) {
                        ?>
                        <div class="row mt-3">
                            <h2>Online view</h2>
                            <div class="d-grid gap-2 d-md-block">
                                <div id="tabs-pdf-buttons">
                                    <input type="submit" class="me-2 mb-2 tabs-pdf-btn" name="full"
                                        value="<?php _e('Full Band Score', 'akfgfragments'); ?>">
                                    <input type="submit" class="me-2 mb-2 tabs-pdf-btn" name="gotoh"
                                        value="<?php _e('Rhythm Guitar (Gotoh)', 'akfgfragments'); ?>">
                                    <input type="submit" class="me-2 mb-2 tabs-pdf-btn" name="kita"
                                        value="<?php _e('Lead Guitar (Kita)', 'akfgfragments'); ?>">
                                    <input type="submit" class="me-2 mb-2 tabs-pdf-btn" name="yamada"
                                        value="<?php _e('Bass (Yamada)', 'akfgfragments'); ?>">
                                    <input type="submit" class="me-2 mb-2 tabs-pdf-btn" name="ijichi"
                                        value="<?php _e('Drums (Ijichi)', 'akfgfragments'); ?>">
                                </div>
                            </div>

                            <div id="tabs-pdf-div">
                                <canvas id="tabs-pdf" class="w-100"></canvas>
                            </div>

                            <div id="tabs-pdf-pages" class="row">
                                <div class="text-center">
                                    <button id="tabs-pdf-pages-prev" onclick="loadPrev()">prev</button>
                                    <button id="tabs-pdf-pages-next" onclick="loadNext()">next</button>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<!-- PDF.JS library -->
<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>


<script type="text/javascript">
    function resizeCanvas() {
        var canvas = document.getElementById('tabs-pdf');
        var context = canvas.getContext('2d');
        canvas.height = 0;
    }

    function hideNavButtons() {
        document.getElementById('tabs-pdf-pages').style = 'display: none'
    }

    function showNavButtons() {
        document.getElementById('tabs-pdf-pages').style = 'display: block'
    }

    function hidePrev() {
        document.getElementById('tabs-pdf-pages-prev').style = 'display: none'
    }

    function showPrev() {
        document.getElementById('tabs-pdf-pages-prev').style = 'display: inline'
    }

    function checkPrev() {
        if (currentPage == 1) {
            hidePrev()
        } else {
            showPrev()
        }
    }

    function delNoTabsText() {
        const el = document.getElementById('tabs-pdf-div-text')

        if (el) {
            el.remove()
        }

    }

    let url = ''

    let currentPage = 1

    function loadPdf(title, part) {
        currentPage = 1

        switch (part) {
            case 'full':
                filename = title;
                break;
            case 'gotoh':
                filename = title + '_Gotoh';
                break;
            case 'kita':
                filename = title + '_Kita';
                break;
            case 'yamada':
                filename = title + '_Yamada';
                break;
            case 'ijichi':
                filename = title + '_Ijichi';
                break;
            default:
                filename = title;
                break;
        }

        url = '/files/tabs/' + title + '/' + filename + '.pdf'

        const pdfjsLib = window['pdfjs-dist/build/pdf']

        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js'

        const loadingTask = pdfjsLib.getDocument(url)

        delNoTabsText()

        printPdf()
    }

    function printPdf() {
        const loadingTask = pdfjsLib.getDocument(url)

        loadingTask.promise.then(function (pdf) {

            let pageNumber = currentPage;

            if (currentPage = 1) { }

            getPage(pageNumber);
        }, function (reason) {
            // PDF loading error
            //console.error(reason);
            resizeCanvas()

            document.getElementById('tabs-pdf-div').innerHTML += '<p id="tabs-pdf-div-text">Sorry! Online view for this tab is not available.</p>'

            hideNavButtons()
        });
    }

    function getPage(pageNumber) {
        const loadingTask = pdfjsLib.getDocument(url)

        loadingTask.promise.then(function (pdf) {
            pdf.getPage(pageNumber).then(function (page) {

                var scale = 1.5;
                var viewport = page.getViewport({ scale: scale });

                // Prepare canvas using PDF page dimensions
                var canvas = document.getElementById('tabs-pdf');
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);
                renderTask.promise.then(function () {
                    showNavButtons()
                });
            });
        }, function (reason) {
            // PDF loading error
            //console.error(reason);
            resizeCanvas()
        });
    }

    function loadPrev() {
        getPage(currentPage - 1)
        currentPage--
        checkPrev()
    }

    function loadNext() {
        getPage(currentPage + 1)
        currentPage++
        checkPrev()
    }

    window.onload = () => {
        loadPdf('<?php echo $title; ?>', 'full')
        checkPrev()
    }
</script>

<script type="text/javascript">
    $('.tabs-pdf-btn').click(function () {
        const part = $(this).attr('name')

        loadPdf('<?php echo $title; ?>', part)
    })
</script>

<?php get_footer(); ?>
</body>

</html>