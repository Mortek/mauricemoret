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

	    		<iframe width="625" height="310" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.nl/maps?source=s_q&amp;f=q&amp;hl=nl&amp;geocode=&amp;q=Ockenburg+7,+Mildenburg,+Dordrecht&amp;aq=0&amp;oq=ockenburg+7+dord&amp;sll=51.650023,4.868122&amp;sspn=0.010931,0.033023&amp;ie=UTF8&amp;hq=&amp;hnear=Ockenburg+7,+3328+TE+Sterrenburg+3,+Dordrecht,+Zuid-Holland&amp;t=m&amp;z=14&amp;ll=51.783453,4.678202&amp;output=embed"></iframe>
                
	    	</div>


    	</div>
    <?php the_content(); ?>
    </div>
    <!-- /post -->
</article>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>