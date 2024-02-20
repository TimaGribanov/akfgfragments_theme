<?php /* Template Name: Akfgfragments Author Page */?>
<?php
$name = $_GET['nickname'];
$curauth = get_user_by('slug', $name);

$usertwitter = get_user_meta($curauth->ID, 'twitter');
$useryoutube = get_user_meta($curauth->ID, 'youtube');
$userinstagram = get_user_meta($curauth->ID, 'instagram');
$userfacebook = get_user_meta($curauth->ID, 'facebook');
?>

<?php get_header(); ?>

<main role="main">
  <div class="container-lg">
    <div id="main" class="row">
      <div id="main-content" class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
        <div class="row author-card">
          <h2><?php echo $curauth->display_name; ?></h2>
          <div class="col-3">
            <div class="author-photo">
              <?php echo get_avatar($curauth->user_email, '100'); ?>
            </div>
            <div class="author-links">
              <?php if ($curauth->user_url != '') {?>
                <a href="<?php echo $curauth->user_url; ?>" target="_blank" rel="nofollow">Website</a><br />
              <?php } ?>
              <?php if ($usertwitter[0] != '') { ?>
                <a href="<?php echo "https://twitter.com/"; echo $usertwitter[0]; ?>" target="_blank" rel="nofollow">Twitter</a><br/>
              <?php } ?>
              <?php if ($useryoutube[0] != '') { ?>
                <a href="<?php echo $useryoutube[0]; ?>" target="_blank" rel="nofollow">YouTube</a><br/>
              <?php } ?>
              <?php if ($userinstagram[0] != '') { ?>
                <a href="<?php echo $userinstagram[0]; ?>" target="_blank" rel="nofollow">Instagram</a><br/>
              <?php } ?>
              <?php if ($userfacebook[0] != '') { ?>
                <a href="<?php echo $userfacebook[0]; ?>" target="_blank" rel="nofollow">Facebook</a><br/>
              <?php } ?>
            </div>
          </div>
          <div class="col">
            <h4>About me</h4>
            <p><?php echo $curauth->user_description; ?></p>
          </div>
        </div>
      </div>
    <?php get_sidebar(); ?>
  </div>
  </div>
</main>

<?php get_footer(); ?>

</body>

</html>