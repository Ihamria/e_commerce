<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kalon
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php         
        if( has_post_thumbnail() ){
            echo ( is_single() ) ? '<div class="post-thumbnail">' : '<a href="' . esc_url( get_the_permalink() ) . '" class="post-thumbnail">';
            ( is_active_sidebar( 'right-sidebar' ) ) ? the_post_thumbnail( 'kalon-with-sidebar', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'kalon-without-sidebar', array( 'itemprop' => 'image' ) );
            echo ( is_single() ) ? '</div>' : '</a>' ; 
        }        
        
    ?>
    <div class="text-holder">
        <?php kalon_category_list(); // Category list ?>
    <header class="entry-header">
        <?php
            if ( is_single() ) {
                the_title( '<h1 class="entry-title">', '</h1>' );
            } else {
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            }

        if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php kalon_posted_on(); ?>
        </div><!-- .entry-meta -->
        <?php
        endif; ?>
    </header><!-- .entry-header -->


    <div class="entry-content">  
        <?php 
            if( is_single() ){
                the_content( sprintf(
                    /* translators: %s: Name of current post. */
                    wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'kalon-chic' ), array( 'span' => array( 'class' => array() ) ) ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ) );
            }else{    
                if( false === get_post_format() ){
                    the_excerpt();                  
                }else{
                    the_content();
                } 
            }
    
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kalon-chic' ),
                'after'  => '</div>',
            ) );
        ?>
        
    </div><!-- .entry-content -->
    
    <?php if( is_single() ){ ?>
        <div class="bottom-content"><?php kalon_tag_list(); ?></div>
    <?php }else{ ?>
        <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Continue Reading', 'kalon-chic' ); ?></a>
    <?php } ?>
    
    <footer class="entry-footer">
        <?php kalon_entry_footer(); ?>
    </footer><!-- .entry-footer -->
    </div>  
</article><!-- #post-## -->
