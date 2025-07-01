<?php
/**
 * Template Name: List Category Posts
 */
get_header();
?>
<main class="site-main">
    <?php
    echo do_shortcode('[catlist id=21]');
    ?>
</main>
<?php
get_footer();

