<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kalon
 */

?>

<article id="post-<?php the_ID(); ?>"<?php post_class(); ?>>
	<header class="entry-header">
		<?php 
        
        the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
        
        if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php kalon_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
        
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
