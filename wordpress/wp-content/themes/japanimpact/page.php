
<?php include("head.php"); ?>
<body>





  <?php
  //
  // if ( is_front_page() && is_home() ) {
  //   // Default homepage
  //   echo "default homepage";
  // } elseif ( is_front_page() ) {
  //   // static homepage
  //   echo "static homepage";
  // } elseif ( is_home() ) {
  //   // blog page
  //   echo "blog page";
  // } else {
  //   //everything else
  //   echo "sth??? check in page.php";
  // }

  ?>


  <?php include("header.php"); ?>

  <section id="page">


  <?php
  while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<?php
    		// Post thumbnail.
    		// twentyfifteen_post_thumbnail();
    	?>

      <div class="container">


    	<header class="entry-header">
    		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    	</header><!-- .entry-header -->

    	<div class="entry-content">
    		<?php the_content(); ?>
    		<?php
    			wp_link_pages( array(
    				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
    				'after'       => '</div>',
    				'link_before' => '<span>',
    				'link_after'  => '</span>',
    				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
    				'separator'   => '<span class="screen-reader-text">, </span>',
    			) );
    		?>
    	</div><!-- .entry-content -->

      <?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<br> <br><footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>


      </div>


    </article><!-- #post-## -->
<?php
endwhile; ?>

</section>


  <?php include("footer.php") ?>
