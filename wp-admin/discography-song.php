<?php
/**
 * Discography Songs Administration Screen.
 *
 * If accessed directly in a browser this page shows a list of actions which can be done.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

// Used in the HTML title tag.
$title       = __( 'Songs' );
$this_file   = 'discography-song.php';
$parent_file = 'discography-release.php';

require_once ABSPATH . 'wp-admin/admin-header.php'; ?>

<div class="wrap">
    <h1><?php esc_html_e( 'Discography Management' ); ?></h1>
    <h2><a href="discography-release.php">Edit releases</a></h2>
    <h2><a href="discography-song.php">Edit songs</a></h2>
</div>

<?php require_once ABSPATH . 'wp-admin/admin-footer.php'; ?>