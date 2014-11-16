<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: About
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article>
    <header id="page-heading">
        <h1><?php the_title(); ?></h1>
        <a href="http://nl.linkedin.com/pub/maurice-moret/84/573/795" target="_blank"><img class="linkedin" title="LinkedIn" src="/wp-content/themes/portfolio/images/linkedin-icon.png" alt="LinkedIn Icon" /></a>
    </header>
    <!-- /page-heading -->
    
    <div class="post full-width clearfix">
    <?php the_content(); ?>
    </div>
    <!-- /post -->
</article>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>