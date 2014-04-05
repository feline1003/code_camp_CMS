<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package web2feel
 */
?>
</div><!-- #content -->
    
<div id="bottom">
    <div class="container" style="display:none;">
        <div class="row">
		<?php if ( !function_exists('dynamic_sidebar')
		        || !dynamic_sidebar("Footer") ) : ?>  
		<?php endif; ?>
        </div>
    </div>
</div>	
    
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container"> <div class="row"> 
            <div class="site-info col-md-10">
                <div class="fcred">
                    Copyright &copy; <?php echo date('Y');?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>.<br />
				<?php fflink(); ?> | <a href="http://topwpthemes.com/<?php echo wp_get_theme(); ?>/" ><?php echo wp_get_theme(); ?> Theme</a> 	
                </div>
            </div><!-- .site-info -->
        </div></div>
</footer><!-- #colophon -->
</div><!-- #page -->
    
    
<?php wp_footer(); ?>
<script src="http://virgile-gouala.fr/projects/formation/prepetna/2014/phpfrance/wp-content/themes/Yegor/js/classie.js"></script>
<script src="http://virgile-gouala.fr/projects/formation/prepetna/2014/phpfrance/wp-content/themes/Yegor/js/uisearch.js"></script>
<script>
    new UISearch( document.getElementById( 'sb-search' ) );
</script>
</body>
</html>