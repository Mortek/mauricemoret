<?php
/**
 * @package WordPress
 * @subpackage Adapt Theme
 * Template Name: Contact
 */
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article>
    <header id="page-heading">
        <h1><?php the_title(); ?></h1>		
    </header>
    <!-- /page-heading -->
    
    <div class="post full-width clearfix">
    	<div class="contact-sidebar">
    		<h2>Contact informatie</h2>

    		<div class="contact-sidebar-info">
	    		<p>
	    			<span class="bold">email:</span> info@mauricemoret.nl
	    		</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2468.7947183599013!2d4.673997516325388!3d51.773359899042234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c428ba44d0ba89%3A0x1b614f8cc456b747!2sSlangenburg+152%2C+3328+DS+Dordrecht!5e0!3m2!1snl!2snl!4v1446278793155" width="625" height="310" frameborder="0" style="border:0" allowfullscreen></iframe>
                
	    	</div>


    	</div>
    <?php the_content(); ?>
    </div>
    <!-- /post -->
</article>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>