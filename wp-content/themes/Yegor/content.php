<?php
/**
 * @package web2feel
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-sm-6'); ?>>

		<?php
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
			$image = aq_resize( $img_url, 720, 400, true ); //resize & crop the image
		?>
					
		<?php if($image) : ?>
		<a href="<?php the_permalink(); ?>"> <img class="img-responsive post-image" src="<?php echo $image ?>"/></a>
		<?php endif; ?>
<?php
/**
 *pour la partie post article
 */
?>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="entry-meta"> <?php _e( 'Postée le', 'web2feel' ); ?> <?php the_time('j F Y') ?> <?php _e( 'par ', 'web2feel' ); ?>
 <?php the_author_firstname(); ?>
  <?php _e(' dans la categorie ', 'web2feel' );?> 
      <?php the_category(' ') ?> 
      </br>
      </br> 
      <?php 
      the_tags('difficulté du cours : '); 
      $tar = get_the_tags();
      $accents = array('À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ò','Ó','Ô','Õ','Ö','Ù','Ú','Û','Ü','Ý','à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ð','ò','ó','ô','õ','ö','ù','ú','û','ü','ý','ÿ');
      $sans = array('A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','O','O','O','O','O','U','U','U','U','Y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','o','u','u','u','u','y','y');

      foreach($tar as $tag){
            $diff = str_replace($accents, $sans, $tag->name);
            echo '<img alt="" src="http://virgile-gouala.fr/projects/formation/prepetna/2014/phpfrance/wp-content/uploads/2014/04/'.strtolower($diff). '.png" style="margin-top:-5px;margin-left: 10px;"/>'; 
  }
      
    //  var_dump($tar.label("NAME"));
     /* if ($tar == "FACILE")
          echo "poule";*/
      ?></div>
	</header><!-- .entry-header -->


	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	

</article><!-- #post-## -->
